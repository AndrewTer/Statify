<?php
  function get_friends_list($user_uuid)
  {
    if (!empty($user_uuid))
    {
      $friends_array = [];
      $friends_query = pg_query("SELECT u.uuid            as user_uuid
                                  FROM friends              AS f
                                        LEFT JOIN users     AS u 
                                                ON u.uuid = f.second_uuid
                                  WHERE f.first_uuid = '{$user_uuid}'
                                  UNION ALL
                                  SELECT u.uuid             as user_uuid
                                  FROM friends              AS f
                                        LEFT JOIN users     AS u 
                                              ON u.uuid = f.first_uuid
                                  WHERE f.second_uuid = '{$user_uuid}'") or trigger_error(pg_last_error().$friends_query);

      if ($friends_result = pg_fetch_array($friends_query))
      {
        $friends_num = 0;

        do {
          $friends_array[$friends_num] = $friends_result[0];
          $friends_num++;
        }while($friends_result = pg_fetch_array($friends_query));

        return $friends_array;
      }else
        return null;
    }else
      return null;
  }

  function get_mutual_friends_list($current_user_uuid, $another_user_uuid)
  {
    if (!empty($current_user_uuid) && !empty($another_user_uuid)
      && isset($current_user_uuid) && isset($another_user_uuid)
      && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $current_user_uuid))
      && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $another_user_uuid)))
    {
      $mutual_friends_query_text = "SELECT first.friend_uuid 
                                    FROM (SELECT first_uuid as friend_uuid FROM friends WHERE second_uuid = '{$current_user_uuid}'
                                          UNION ALL
                                          SELECT second_uuid as friend_uuid FROM friends WHERE first_uuid = '{$current_user_uuid}') as first
                                    INNER JOIN (SELECT first_uuid as friend_uuid FROM friends WHERE second_uuid = '{$another_user_uuid}'
                                                UNION ALL
                                                SELECT second_uuid as friend_uuid FROM friends WHERE first_uuid = '{$another_user_uuid}') as second
                                            ON first.friend_uuid = second.friend_uuid";

      $mutual_friends_query = pg_query($mutual_friends_query_text) or trigger_error(pg_last_error().$mutual_friends_query);

      if ($mutual_friends = pg_fetch_array($mutual_friends_query))
      {
        $mutual_friends_array = [];
        $mutual_friends_num = 0;

        do {
          $mutual_friends_array[$mutual_friends_num] = $mutual_friends[0];
          $mutual_friends_num++;
        }while ($mutual_friends = pg_fetch_array($mutual_friends_query));

        return $mutual_friends_array;
      }else
        return null;
    }else
      return null;
  }

  function get_potential_friends_list($user_uuid, $type)
  {
    if (!empty($user_uuid) && isset($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
      $order_by_type = '';
      switch ($type) {
        case 'random':
          $order_by_type = 'RANDOM() LIMIT 5';
          break;
        
        case 'all':
          $order_by_type = 'mutual_friends DESC';
          break;

        default:
          return null;
          break;
      }

      // Массив с uuid друзей пользователя
      $friends_array = [];

      $all_friends_query_text = "SELECT DISTINCT result.friend_uuid FROM (
                                    SELECT second_uuid as friend_uuid
                                    FROM friends
                                    WHERE first_uuid = '{$user_uuid}'
                                    UNION ALL
                                    SELECT first_uuid as friend_uuid
                                    FROM friends
                                    WHERE second_uuid = '{$user_uuid}'
                                  ) result";

      $all_friends_query = pg_query($all_friends_query_text) or trigger_error(pg_last_error().$all_friends_query);

      if ($all_friends = pg_fetch_array($all_friends_query))
      {
        $friends_num = 0;

        // Заполнение массива uuid'ами друзей пользователя
        do {
          $friends_array[$friends_num] = $all_friends[0];
          $friends_num++;
        }while ($all_friends = pg_fetch_array($all_friends_query));

        // Строка для списка с uuid'ами друзей пользователя через запятую
        $current_user_friends_list_in_string = '';
        // Формирование строки с uuid'ами друзей пользователя
        foreach ($friends_array as $n => $row)
        {
          $current_user_friends_list_in_string .= '\''.$row.'\'';

          if ($n < count($friends_array) - 1)
            $current_user_friends_list_in_string .= ', ';
        }

        // Массив с возможными друзьями (друзья друзей), содержащий uuid'ы и кол-во общих друзей 
        $friends_friends_array = [];

        $all_friends_friends_query_text = "SELECT result.friend_uuid, Count(*) as mutual_friends
                                            FROM (
                                              SELECT second_uuid as friend_uuid
                                              FROM friends
                                              WHERE first_uuid IN ($current_user_friends_list_in_string)
                                              UNION ALL
                                              SELECT first_uuid as friend_uuid
                                              FROM friends
                                              WHERE second_uuid in ($current_user_friends_list_in_string)
                                            ) result
                                            WHERE result.friend_uuid != '{$user_uuid}'
                                                  AND result.friend_uuid NOT IN ($current_user_friends_list_in_string)
                                            GROUP BY result.friend_uuid
                                            ORDER BY $order_by_type";

        $all_friends_friends_query = pg_query($all_friends_friends_query_text) or trigger_error(pg_last_error().$all_friends_friends_query);

        if ($all_friends_friends = pg_fetch_array($all_friends_friends_query))
        {
          $friends_friends_num = 0;

          do {
            $friends_friends_array[$friends_friends_num][0] = $all_friends_friends[0]; // друг друзей текущего пользователя
            $friends_friends_array[$friends_friends_num][1] = $all_friends_friends[1]; // количество общих друзей
            $friends_friends_num++;
          }while ($all_friends_friends = pg_fetch_array($all_friends_friends_query));
        }else
          return null;

        return $friends_friends_array;
      }else
        return null;
    }else
      return null;
  }

  function get_subscribers_list($user_uuid)
  {
    if (!empty($user_uuid))
    {
      $subscribers_array = [];
      $subscribers_query = pg_query("SELECT u.uuid            as user_uuid
                                     FROM subscribers         AS s
                                          LEFT JOIN users     AS u 
                                                 ON u.uuid = s.subscriber_uuid
                                     WHERE s.user_uuid='{$user_uuid}'") 
                        or trigger_error(pg_last_error().$subscribers_query);

      if ($subscribers_result = pg_fetch_array($subscribers_query))
      {
        $subscribers_num = 0;

        do {
          $subscribers_array[$subscribers_num] = $subscribers_result[0];
          $subscribers_num++;
        }while($subscribers_result = pg_fetch_array($subscribers_query));

        return $subscribers_array;
      }else
        return null;
    }else
      return null;
  }

  function get_subscriptions_list($user_uuid)
  {
    if (!empty($user_uuid))
    {
      $subscriptions_array = [];
      $subscriptions_query = pg_query("SELECT u.uuid            as user_uuid
                                       FROM subscribers         AS s
                                            LEFT JOIN users     AS u 
                                                   ON u.uuid = s.user_uuid
                                       WHERE s.subscriber_uuid='{$user_uuid}'") 
                                  or trigger_error(pg_last_error().$subscriptions_query);

      if ($subscriptions_result = pg_fetch_array($subscriptions_query))
      {
        $subscriptions_num = 0;

        do {
          $subscriptions_array[$subscriptions_num] = $subscriptions_result[0];
          $subscriptions_num++;
        }while($subscriptions_result = pg_fetch_array($subscriptions_query));

        return $subscriptions_array;
      }else
        return null;
    }else
      return null;
  }

  function get_submitted_list($user_uuid)
  {
    if (!empty($user_uuid))
    {
      $submitted_array = [];
      $submitted_query = pg_query("SELECT u.uuid
                                   FROM friendship_requests AS fr
                                        LEFT JOIN users     AS u 
                                               ON u.uuid = fr.receiver_uuid
                                   WHERE fr.author_uuid='{$user_uuid}'") 
                  or trigger_error(pg_last_error().$submitted_query);

      if ($submitted_result = pg_fetch_array($submitted_query))
      {
        $submitted_num = 0;

        do {
          $submitted_array[$submitted_num] = $submitted_result[0];
          $submitted_num++;
        }while($submitted_result = pg_fetch_array($submitted_query));

        return $submitted_array;
      }else
        return null;
    }else
      return null;
  }

  function get_received_list($user_uuid)
  {
    if (!empty($user_uuid))
    {
      $recieved_array = [];
      $recieved_query = pg_query("SELECT u.uuid
                                   FROM friendship_requests AS fr
                                        LEFT JOIN users     AS u 
                                               ON u.uuid = fr.author_uuid
                                   WHERE fr.receiver_uuid='{$user_uuid}'") 
                  or trigger_error(pg_last_error().$recieved_query);

      if ($recieved_result = pg_fetch_array($recieved_query))
      {
        $recieved_num = 0;

        do {
          $recieved_array[$recieved_num] = $recieved_result[0];
          $recieved_num++;
        }while($recieved_result = pg_fetch_array($recieved_query));

        return $recieved_array;
      }else
        return null;
    }else
      return null;
  }
?>