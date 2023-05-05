<?php
  function get_search_result_of_users_list($search_text, $page, $num)
  {
    $users_list = [];

    if (!empty($_COOKIE['login']) and !empty($_COOKIE['key']))
    {
      $cookie_login = $_COOKIE['login'];
      $cookie_key = $_COOKIE['key'];

      if (!is_null($search_text))
      {
        $search_text_query = trim(htmlspecialchars($search_text, ENT_QUOTES));
        $user_uuid_query = get_user_uuid_by_cookie($cookie_login, $cookie_key);
        $search_count_query = pg_query("SELECT Count(*) FROM users JOIN users_technical_data ON users.uuid = users_technical_data.user_uuid
                                        WHERE (upper(users.name) = upper('{$search_text_query}') OR upper(users.surname) = upper('{$search_text_query}') OR upper(users.nickname) = upper('{$search_text_query}'))
                                              AND users.uuid != '{$user_uuid_query}'
                                              AND users_technical_data.completed = true")
                              or trigger_error(pg_last_error().$search_count_query);

        if ($search_count_result = pg_fetch_row($search_count_query))
          $search_count = $search_count_result[0];
        else
          $search_count = 0;

        $total_count_search_pages = intval(($search_count - 1) / $num) + 1;

        if (empty($page) || $page < 0) $page = 1;
        if ($page > $total_count_search_pages) $page = $total_count_search_pages;

        $start_page = $page * $num - $num;

        $search_query = pg_query("SELECT DISTINCT users.uuid
                                  FROM users
                                        JOIN users_technical_data ON users.uuid = users_technical_data.user_uuid
                                        LEFT JOIN genders AS g ON g.uuid = users.gender
                                        LEFT JOIN genders AS gl ON gl.uuid = users.gender_preference
                                        LEFT JOIN countries AS c ON c.uuid = users.country_uuid
                                        LEFT JOIN cities AS cc ON cc.uuid = users.city_uuid
                                  WHERE (upper(users.name) = upper('{$search_text_query}') OR upper(users.surname) = upper('{$search_text_query}') OR upper(users.nickname) = upper('{$search_text_query}'))
                                        AND users.uuid != '{$user_uuid_query}'
                                        AND users_technical_data.completed = true
                                  LIMIT $num
                                  OFFSET $start_page")
                        or trigger_error(pg_last_error().$search_query);
      }else
      {
        $user_uuid_query = get_user_uuid_by_cookie($cookie_login, $cookie_key);
        $search_count_query = pg_query("SELECT Count(users.*) FROM users JOIN users_technical_data ON users.uuid = users_technical_data.user_uuid WHERE users.uuid != '{$user_uuid_query}' AND users_technical_data.completed = true")
                              or trigger_error(pg_last_error().$search_count_query);

        if ($search_count_result = pg_fetch_row($search_count_query))
          $search_count = $search_count_result[0];
        else $search_count = 0;

        $total_count_search_pages = intval(($search_count - 1) / $num) + 1;

        if (empty($page) || $page < 0) $page = 1;
        if ($page > $total_count_search_pages) $page = $total_count_search_pages;

        $start_page = $page * $num - $num;

        $search_query = pg_query("SELECT DISTINCT users.uuid
                                                  ,users_technical_data.completed
                                                  ,users_technical_data.email_confirmed
                                  FROM users
                                       LEFT JOIN users_technical_data
                                              ON users.uuid = users_technical_data.user_uuid
                                  WHERE users.uuid != '{$user_uuid_query}'
                                        AND users_technical_data.completed = true
                                  ORDER BY users_technical_data.completed DESC
                                            ,users_technical_data.email_confirmed DESC
                                  LIMIT $num
                                  OFFSET $start_page")
                        or trigger_error(pg_last_error().$search_query);
      }

      if ($result_list = pg_fetch_array($search_query))
      {
        $users_list_num = 0;

        do {
          $users_list[$users_list_num]['user_uuid'] = $result_list[0];
          $users_list[$users_list_num]['total_count_search_pages'] = $total_count_search_pages;
          $users_list_num++;
        }while ($result_list = pg_fetch_array($search_query));

        return $users_list;
      }else
        return null;
    }else
      return null;
  }

  function get_search_result_of_photos_list_by_tag($tag_text, $page, $num)
  {
    if (!empty($tag_text) && isset($tag_text))
    {
      $tag_uuid = get_tag_uuid_by_text($tag_text);

      if ($tag_uuid)
      {
        $search_count_query = pg_query("SELECT Count(up.uuid) 
                                        FROM users_photos up
                                            JOIN photos_tags pt ON up.uuid = pt.photo_uuid
                                        WHERE pt.tag_uuid  = '{$tag_uuid}'")
                              or trigger_error(pg_last_error().$search_count_query);

        if ($search_count_result = pg_fetch_row($search_count_query))
          $search_count = $search_count_result[0];
        else $search_count = 0;

        $total_count_search_pages = intval(($search_count - 1) / $num) + 1;

        if (empty($page) || $page < 0) $page = 1;
        if ($page > $total_count_search_pages) $page = $total_count_search_pages;

        $start_page = $page * $num - $num;

        $photos_array = [];

        $photos_list_query = pg_query("SELECT up.user_uuid,
                                              up.photo_name
                                        FROM users_photos up
                                             JOIN photos_tags pt ON up.uuid = pt.photo_uuid
                                        WHERE pt.tag_uuid  = '{$tag_uuid}'
                                        ORDER BY creation_date DESC
                                        LIMIT $num
                                        OFFSET $start_page") 
                                or trigger_error($pg_last_error().$photos_list_query);

        if ($photos_list_result = pg_fetch_array($photos_list_query))
        {
          $photos_num = 0;

          do {
            $photos_array[$photos_num]['user_uuid'] = $photos_list_result[0];
            $photos_array[$photos_num]['photo_name'] = $photos_list_result[1];
            $photos_array[$photos_num]['total_count_search_pages'] = $total_count_search_pages;
            $photos_num++;
          }while($photos_list_result = pg_fetch_array($photos_list_query));

          return $photos_array;
        }else
          return null;
      }else
        return null;
    }else
      return null;
  }
?>