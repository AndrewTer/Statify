<?php
  function ban_check($user_uuid)
  {
    if (!empty($user_uuid) && isset($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
      $permanent_ban_check_query = pg_query("SELECT 1 FROM banned_users WHERE user_uuid = '{$user_uuid}' and permanent_ban_identifier = 1") 
                                        or trigger_error(pg_last_error().$permanent_ban_check_query);

      $permanent_ban_check_query_count = pg_num_rows($permanent_ban_check_query);

      if ($permanent_ban_check_query_count == 0)
      {
        $ban_check_query = pg_query("SELECT 1 FROM banned_users WHERE user_uuid = '{$user_uuid}' and finish_date > NOW()")
                                or trigger_error(pg_last_error().$ban_check_query);

        $ban_check_query_count = pg_num_rows($ban_check_query);

        if ($ban_check_query_count > 0)
          return 'ban';
        else
          return 'success';
      }else
        return 'permanent';
    }else
      return 'logout';
  }

  function check_email_confirmed($user_uuid)
  {
    if (!empty($user_uuid) && isset($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        $email_confirmed_query = pg_query("SELECT email_confirmed FROM users_technical_data WHERE user_uuid = '{$user_uuid}'")
                                    or trigger_error(pg_last_error().$email_confirmed_query);

        $email_confirmed_query_count = pg_num_rows($email_confirmed_query);

        if ($email_confirmed_query_count == 1)
        {
            if ($email_confirmed_result = pg_fetch_array($email_confirmed_query))
            {
                $email_confirmed = $email_confirmed_result[0];
                if ($email_confirmed == 't')
                    return 1;
                else
                    return 0;
            }else
                return 0;
        }else
            return 0;
    }else
        return 0;
  }

  function check_user_page_status($user_uuid)
  {
    if (!empty($user_uuid) && isset($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        $user_page_status_query = pg_query("SELECT completed FROM users_technical_data WHERE user_uuid = '{$user_uuid}'")
                                    or trigger_error(pg_last_error().$user_page_status_query);

        $user_page_status_query_count = pg_num_rows($user_page_status_query);

        if ($user_page_status_query_count == 1)
        {
            if ($user_page_status_result = pg_fetch_array($user_page_status_query))
            {
                $user_page_status = $user_page_status_result[0];
                if ($user_page_status == 't')
                    return 1;
                else
                    return 0;
            }else
                return 0;
        }else
            return 0;
    }else
        return 0;
  }

  function check_nickname_exists($user_nickname)
  {
    if (!empty($user_nickname) && isset($user_nickname))
    {
      $nickname_exists_query = pg_query("SELECT 1 FROM users WHERE nickname = '$user_nickname'")
                              or trigger_error(pg_last_error().$nickname_exists_query);

      $nickname_exists_count = pg_num_rows($nickname_exists_query);

      if ($nickname_exists_count == 0)
        return 0;
      else
        return 1;
    }else
      return 0;
  }

  function check_nickname_change_date($user_uuid)
  {
    if (!empty($user_uuid) && isset($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        $nickname_change_date_query = pg_query("SELECT nickname_change_date FROM users_technical_data WHERE user_uuid = '{$user_uuid}'")
                                    or trigger_error(pg_last_error().$nickname_change_date_query);

        $nickname_change_date_rows_count = pg_num_rows($nickname_change_date_query);

        if ($nickname_change_date_rows_count == 1)
        {
          if ($nickname_change_date_result = pg_fetch_row($nickname_change_date_query))
          {
                $nickname_change_date = $nickname_change_date_result[0];
                $current_date_minus_three_month = date('Y-m-d h:i:sa', strtotime('-3 month'));

                if (strtotime($nickname_change_date) < strtotime($current_date_minus_three_month))
                    return 1;
                else
                    return 0;           
            }else
                return 0;
        }elseif ($latest_date_upload_query_rows_count == 0)
        {
          return 1;
        } else
          return 0;
    }else
      return 0;
  }

  function set_online_status($user_uuid)
  {
    if (!empty($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        $check_online_status_exist_query = "SELECT 1 FROM users_visits WHERE user_uuid = '{$user_uuid}'";
        $check_online_status_exist_row = pg_query($check_online_status_exist_query) or trigger_error(pg_last_error().$check_online_status_exist_row);
        $check_online_status_exist_row_count = pg_num_rows($check_online_status_exist_row);

        if ($check_online_status_exist_row_count == 1)
            pg_query("UPDATE users_visits SET last_visit = NOW() WHERE user_uuid = '{$user_uuid}'") or trigger_error(pg_last_error());
        else
            pg_query("INSERT INTO users_visits (user_uuid, last_visit) VALUES ('{$user_uuid}', NOW())") or trigger_error(pg_last_error());
    }
  }

  function check_user_online_status($user_uuid)
  {
    if (!empty($user_uuid) && isset($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        $user_last_visit_query = pg_query("SELECT 1 
                                           FROM users_visits 
                                           WHERE user_uuid = '{$user_uuid}' 
                                                 AND last_visit > NOW() - interval '5 minutes'")
                                    or trigger_error(pg_last_error().$user_last_visit_query);

        $user_last_visit_query_count = pg_num_rows($user_last_visit_query);

        if ($user_last_visit_query_count == 1)
        {
            if ($user_last_visit_result = pg_fetch_row($user_last_visit_query))
            {
                return 'online';
            }else
                return null;
        }else
            return null;
    }else
        return null;
  }

  function check_saved_photo($author_uuid, $user_uuid, $profile_picture)
  {
    if (!empty($author_uuid) && !empty($user_uuid) && !empty($profile_picture)
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $author_uuid))
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        $saved_photo_query = pg_query("SELECT 1 
                                       FROM saves
                                       WHERE author_uuid = '{$author_uuid}'
                                             AND user_uuid = '{$user_uuid}'
                                             AND profile_picture = '{$profile_picture}'") 
                                or trigger_error(pg_last_error().$saved_photo_query);

        $saved_photo_query_count = pg_num_rows($saved_photo_query);

        if ($saved_photo_query_count == 1)
        {
            return 'saved';
        }else
            return null;
    }else
        return null;
  }

  function check_time_to_delete_comment($author_uuid, $picture_uuid, $comment_uuid)
  {
    if (!empty($author_uuid) && !empty($picture_uuid) && !empty($comment_uuid)
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $author_uuid))
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $picture_uuid))
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $comment_uuid)))
    {
        $time_to_delete_comment_query = pg_query("SELECT 1 
                                                  FROM users_comments 
                                                  WHERE uuid = '{$comment_uuid}'
                                                        AND author_uuid = '{$author_uuid}'
                                                        AND picture_uuid = '{$picture_uuid}'
                                                        AND creation_date > NOW() - INTERVAL '1 DAY'
                                                        AND (deleted != 1 OR deleted IS NULL)")
                                            or trigger_error(pg_last_error().$time_to_delete_comment_query);

        $time_to_delete_comment_query_count = pg_num_rows($time_to_delete_comment_query);

        if ($time_to_delete_comment_query_count == 1)
        {
            return true;
        }else
            return false;
    }else
        return false;
  }

  function check_only_friends_can_rate_photos($user_uuid)
  {
    if (!empty($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        $check_query = pg_query("SELECT rate_photos_for_only_friends FROM users_technical_data WHERE user_uuid = '{$user_uuid}'") 
                            or trigger_error(pg_last_error().$check_query);

        $check_query_count = pg_num_rows($check_query);

        if ($check_query_count == 1)
        {
            if ($check_result = pg_fetch_array($check_query))
            {
                $rate_photos_for_only_friends = $check_result[0];
                if ($rate_photos_for_only_friends == 't')
                    return 1;
                else
                    return 0;
            }else
                return 0;
        }else
            return 0;
    }else
        return 0;
  }

  function check_only_friends_can_comment_photos($user_uuid)
  {
    if (!empty($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        $check_query = pg_query("SELECT comment_photos_for_only_friends FROM users_technical_data WHERE user_uuid = '{$user_uuid}'") 
                            or trigger_error(pg_last_error().$check_query);

        $check_query_count = pg_num_rows($check_query);

        if ($check_query_count == 1)
        {
            if ($check_result = pg_fetch_array($check_query))
            {
                $comment_photos_for_only_friends = $check_result[0];
                if ($comment_photos_for_only_friends == 't')
                    return 1;
                else
                    return 0;
            }else
                return 0;
        }else
            return 0;
    }else
        return 0;
  }

  function check_only_friends_can_read_comments_on_photos($user_uuid)
  {
    if (!empty($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        $check_query = pg_query("SELECT read_comments_on_photos_for_only_friends FROM users_technical_data WHERE user_uuid = '{$user_uuid}'") 
                            or trigger_error(pg_last_error().$check_query);

        $check_query_count = pg_num_rows($check_query);

        if ($check_query_count == 1)
        {
            if ($check_result = pg_fetch_array($check_query))
            {
                $read_comments_on_photos_for_only_friends = $check_result[0];
                if ($read_comments_on_photos_for_only_friends == 't')
                    return 1;
                else
                    return 0;
            }else
                return 0;
        }else
            return 0;
    }else
        return 0;
  }

  function check_premium_active($user_uuid)
  {
    if (!empty($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        $check_premium_active_query = pg_query("SELECT 1 FROM premium_users WHERE user_uuid = '{$user_uuid}' AND received_date < NOW() AND finish_date > NOW()") 
                                or trigger_error(pg_last_error().$check_premium_active_query);

        $check_premium_active_query_count = pg_num_rows($check_premium_active_query);

        if ($check_premium_active_query_count == 1)
        {
            if ($check_premium_active_result = pg_fetch_row($check_premium_active_query))
            {
                return 1;
            }else
                return 0;
        }else
            return 0;
    }else
        return 0;
  }

  function check_premium_trial_period_used($user_uuid)
  {
    if (!empty($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        $check_premium_trial_period_used_query = pg_query("SELECT 1 FROM premium_users WHERE user_uuid = '{$user_uuid}' AND finish_date < NOW()") 
                                or trigger_error(pg_last_error().$check_premium_trial_period_used_query);

        $check_premium_trial_period_used_query_count = pg_num_rows($check_premium_trial_period_used_query);

        if ($check_premium_trial_period_used_query_count == 1)
        {
            if ($check_premium_trial_period_used_result = pg_fetch_row($check_premium_trial_period_used_query))
            {
                return 1;
            }else
                return 0;
        }else
            return 0;
    }else
        return 0;
  }

  function check_for_replies_to_comment($comment_uuid)
  {
    if (!empty($comment_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $comment_uuid)))
    {
        $check_for_replies_to_comment_query = pg_query("SELECT 1 FROM users_comments WHERE replying_comment_uuid = '{$comment_uuid}' AND deleted = 0") 
                                or trigger_error(pg_last_error().$check_for_replies_to_comment_query);

        $check_for_replies_to_comment_count = pg_num_rows($check_for_replies_to_comment_query);

        if ($check_for_replies_to_comment_count == 1)
        {
            if ($check_for_replies_to_comment = pg_fetch_row($check_for_replies_to_comment_query))
            {
                return 1;
            }else
                return 0;
        }else
            return 0;
    }else
        return 0;
  }

  function user_friendly_status($current_user_uuid, $user_uuid)
  {
    if (!empty($current_user_uuid) && !empty($user_uuid)
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $current_user_uuid))
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
      // Проверка: не совпадают ли uuid пользователей
      if ($user_uuid != $current_user_uuid)
      {
        // Проверка на наличие записи в таблице "Друзья"
        $friendship_status = check_friendship_status($current_user_uuid, $user_uuid);

        // Проверка на наличие записи (получатель) в таблице "Заявки в друзья"
        $request_received_status = check_request_status($current_user_uuid, $user_uuid, 'receiver');

        // Проверка на наличие записи (отправитель) в таблице "Заявки в друзья"
        $request_author_status = check_request_status($current_user_uuid, $user_uuid, 'author');

        // Проверка на наличие записи (пользователь подписчик) в таблице "Подписчики"
        $subscriber_current_user_status = check_subscriber_status($current_user_uuid, $user_uuid, 'current_user');

        // Проверка на наличие записи (на пользователя подписались) в таблице "Подписчики"
        $subscriber_user_status = check_subscriber_status($current_user_uuid, $user_uuid, 'user');

        $check_all = array($friendship_status, $subscriber_current_user_status, $subscriber_user_status, $request_received_status, $request_author_status);

        switch ($check_all) 
        {
            case array(0, 0, 0, 0, 0):
                return 'user';
            break;

            case array(0, 0, 0, 0, 1):
                return 'submitter';
            break;

            case array(0, 0, 0, 1, 0):
                return 'receiver';
            break;

            case array(0, 0, 1, 0, 0):
                return 'subscriber';
            break;

            case array(0, 0, 1, 0, 1):
            case array(0, 0, 1, 1, 0):
            case array(0, 0, 1, 1, 1):
                return 'subscriber';
            break;

            case array(0, 1, 0, 0, 0):
                return 'subscribed';
            break;

            case array(0, 1, 0, 0, 1):
            case array(0, 1, 0, 1, 0):
            case array(0, 1, 0, 1, 1):
                return 'subscribed';
            break;

            case array(0, 0, 0, 1, 1):
            case array(0, 1, 1, 0, 0):
            case array(0, 1, 1, 0, 1):
            case array(0, 1, 1, 1, 0):
            case array(0, 1, 1, 1, 1):
                return 'friend';
            break;

            case array(1, 0, 0, 0, 0):
                return 'friend';
            break;

            case array(1, 0, 0, 0, 1):
            case array(1, 0, 0, 1, 0):
            case array(1, 0, 0, 1, 1):
                return 'friend';
            break;

            case array(1, 0, 1, 0, 0):
            case array(1, 1, 0, 0, 0):
            case array(1, 1, 1, 0, 0):
                return 'friend';
            break;

            case array(1, 0, 1, 0, 1):
            case array(1, 0, 1, 1, 0):
            case array(1, 0, 1, 1, 1):
            case array(1, 1, 0, 0, 1):
            case array(1, 1, 0, 1, 0):
            case array(1, 1, 0, 1, 1):
            case array(1, 1, 1, 0, 1):
            case array(1, 1, 1, 1, 0):
            case array(1, 1, 1, 1, 1):
                return 'friend';
            break;

            default:
                return 'user';
            break;
        }

      }
    }
  }
?>