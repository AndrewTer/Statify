<?php
  function get_user_uuid_by_cookie($login, $key)
  {
    if (!empty($login) && !empty($key))
    {
        $user_uuid_query = pg_query("SELECT u.uuid 
                                     FROM users u 
                                          INNER JOIN users_technical_data utd 
                                                  ON u.uuid = utd.user_uuid 
                                     WHERE u.email = '{$login}' AND utd.cookie = '{$key}'")
                            or trigger_error(pg_last_error().$user_uuid_query);

        if($user_uuid_result = pg_fetch_row($user_uuid_query))
        {
            $user_uuid = $user_uuid_result[0];
            return $user_uuid;
        } else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_fullname($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_fullname_query = pg_query("SELECT name, surname
                                         FROM users
                                         WHERE uuid = '{$user_uuid}'
                                         LIMIT 1")
                                or trigger_error(pg_last_error().$user_fullname_query);

        if($user_fullname_result = pg_fetch_row($user_fullname_query))
        {
            $user_fullname = $user_fullname_result[0].' '.$user_fullname_result[1];
            return $user_fullname;
        } else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_name($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_name_query = pg_query("SELECT name
                                         FROM users
                                         WHERE uuid = '{$user_uuid}'
                                         LIMIT 1")
                                or trigger_error(pg_last_error().$user_name_query);

        if($user_name_result = pg_fetch_row($user_name_query))
        {
            $user_name = $user_name_result[0];
            return $user_name;
        } else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_surname($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_surname_query = pg_query("SELECT surname
                                         FROM users
                                         WHERE uuid = '{$user_uuid}'
                                         LIMIT 1")
                                or trigger_error(pg_last_error().$user_surname_query);

        if($user_surname_result = pg_fetch_row($user_surname_query))
        {
            $user_surname = $user_surname_result[0];
            return $user_surname;
        } else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_nickname($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_nickname_query = pg_query("SELECT nickname
                                         FROM users
                                         WHERE uuid = '{$user_uuid}'
                                         LIMIT 1")
                                or trigger_error(pg_last_error().$user_nickname_query);

        if($user_nickname_result = pg_fetch_row($user_nickname_query))
        {
            $user_nickname = $user_nickname_result[0];
            return $user_nickname;
        } else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_uuid_by_nickname($user_nickname)
  {
    if (!empty($user_nickname) && isset($user_nickname))
    {
        $user_uuid_query = pg_query("SELECT uuid FROM users WHERE nickname = '{$user_nickname}' LIMIT 1")
                            or trigger_error(pg_last_error().$user_uuid_query);

        if($user_uuid_result = pg_fetch_row($user_uuid_query))
        {
            $user_uuid = $user_uuid_result[0];
            return $user_uuid;
        }
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_email($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_email_query = pg_query("SELECT email
                                         FROM users
                                         WHERE uuid = '{$user_uuid}'
                                         LIMIT 1")
                                or trigger_error(pg_last_error().$user_email_query);

        if($user_email_result = pg_fetch_row($user_email_query))
        {
            $user_email = $user_email_result[0];
            return $user_email;
        } else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_birthday($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_birthday_query = pg_query("SELECT birthday
                                         FROM users
                                         WHERE uuid = '{$user_uuid}'
                                         LIMIT 1")
                                or trigger_error(pg_last_error().$user_birthday_query);

        if($user_birthday_result = pg_fetch_row($user_birthday_query))
        {
            $user_birthday = $user_birthday_result[0];
            return $user_birthday;
        } else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_registration_date($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_registration_date_query = pg_query("SELECT creation_date
                                         FROM users
                                         WHERE uuid = '{$user_uuid}'
                                         LIMIT 1")
                                or trigger_error(pg_last_error().$user_registration_date_query);

        if($user_registration_date_result = pg_fetch_row($user_registration_date_query))
        {
            $user_registration_date = $user_registration_date_result[0];
            return $user_registration_date;
        } else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_tags($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_tags_query = pg_query("SELECT tag_text
                                     FROM tags
                                     WHERE user_uuid = '{$user_uuid}'
                                     LIMIT 5")
                            or trigger_error(pg_last_error().$user_tags_query);

        if ($user_tags_result = pg_fetch_row($user_tags_query))
        {
            $user_tags_array = [];
            $user_tags_num = 0;

            do {
                $user_tags_array[$user_tags_num] = $user_tags_result[0];
                $user_tags_num++;
            }while ($user_tags_result = pg_fetch_row($user_tags_query));

            return $user_tags_array;
        } else
            return null;
    } else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_rating_among_all_users($user_uuid)
  {
    if (!empty($user_uuid) && isset($user_uuid))
    {
        $current_user_statistics = pg_query("SELECT one_star_count, two_star_count, three_star_count, four_star_count, five_star_count, maximum_user_score 
                                             FROM users_statistics 
                                             WHERE user_uuid = '{$user_uuid}'")
                                        or trigger_error(pg_last_error().$current_user_statistics);

        $max_score_among_all_users = pg_query("SELECT max(maximum_user_score) FROM users_statistics") or trigger_error(pg_last_error().$max_score_among_all_stars);                             

        if ($current_user_statistics_result = pg_fetch_row($current_user_statistics))
        {
            $one_star_count = $current_user_statistics_result[0];
            $two_star_count = $current_user_statistics_result[1];
            $three_star_count = $current_user_statistics_result[2];
            $four_star_count = $current_user_statistics_result[3];
            $five_star_count = $current_user_statistics_result[4];
            $max_user_score = $current_user_statistics_result[5];
        }else
            $max_user_score = 0;

        if ($max_score_among_all_users_result = pg_fetch_row($max_score_among_all_users))
        {
            $max_score_among_all_users_value = ($max_score_among_all_users_result[0] != 0) ? $max_score_among_all_users_result[0] : 1;
        }else
            $max_score_among_all_users_value = 1;

        $result = $max_user_score / $max_score_among_all_users_value * 100;

        return ($result != 0) ? remove_zeros_after_dot($result).' %' : 0;
    }else
        return 0;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_ratings_number_from_user($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $ratings_number_query = pg_query("SELECT COUNT(*) 
                                          FROM rating 
                                          WHERE receiver = '{$user_uuid}' AND mark != 7")
                                    or trigger_error(pg_last_error().$ratings_number_query);

        if($ratings_number_result = pg_fetch_row($ratings_number_query))
        {
            $ratings_number = $ratings_number_result[0];

            if (is_null($ratings_number))
                return '0';
            else
                return $ratings_number;
        }else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_uuid_by_photo_uuid($photo_uuid)
  {
    if (!empty($photo_uuid))
    {
        $user_uuid_query = pg_query("SELECT user_uuid FROM users_avatars
                                       WHERE uuid = '{$photo_uuid}'
                                       LIMIT 1")
                                or trigger_error(pg_last_error().$user_uuid_query);

        if($user_uuid_result = pg_fetch_row($user_uuid_query))
        {
            $user_uuid = $user_uuid_result[0];
            return $user_uuid;
        }else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_photo_uuid_by_name($photo_name)
  {
    if (!empty($photo_name))
    {
        $photo_name_query = pg_query("SELECT uuid FROM users_avatars
                                        WHERE profile_picture = '{$photo_name}'
                                        LIMIT 1")
                                or trigger_error(pg_last_error().$photo_name_query);

        if($photo_name_result = pg_fetch_row($photo_name_query))
        {
            $current_photo_uuid = $photo_name_result[0];
            return $current_photo_uuid;
        }else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_photo_name_by_uuid($photo_uuid)
  {
    if (!empty($photo_uuid))
    {
        $photo_name_query = pg_query("SELECT profile_picture FROM users_avatars
                                      WHERE uuid = '{$photo_uuid}'
                                      LIMIT 1")
                                or trigger_error(pg_last_error().$photo_name_query);

        if($photo_name_result = pg_fetch_row($photo_name_query))
        {
            $current_photo_name = $photo_name_result[0];
            return $current_photo_name;
        }else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_latest_avatar($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $latest_avatar_query = pg_query("SELECT profile_picture
                                         FROM users_avatars
                                         WHERE user_uuid = '$user_uuid'
                                         ORDER BY creation_date DESC
                                         LIMIT 1")
                                or trigger_error(pg_last_error().$latest_avatar_query);

        if($latest_avatar_result = pg_fetch_row($latest_avatar_query))
        {
            $user_profile_picture = $latest_avatar_result[0];
            return $user_profile_picture;
        } else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_latest_avatar_preview($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $last_user_avatar = get_latest_avatar($user_uuid);

        if ($last_user_avatar)
        {
            $file_info = new SplFileInfo($last_user_avatar);
            $file_ext = '.'.$file_info->getExtension();
            $last_user_avatar_preview = stristr($last_user_avatar, $file_ext, true).'_90x90'.$file_ext;

            return $last_user_avatar_preview;
        } else
            return null;
    } else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_latest_avatar_date_upload($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $latest_date_upload_query = pg_query("SELECT creation_date
                                              FROM users_avatars
                                              WHERE user_uuid = '{$user_uuid}'
                                              ORDER BY creation_date DESC
                                              LIMIT 1")
                                        or trigger_error(pg_last_error().$latest_date_upload_query);

        $latest_date_upload_query_rows_count = pg_num_rows($latest_date_upload_query);

        if ($latest_date_upload_query_rows_count == 1)
        {
            if ($latest_date_upload_result = pg_fetch_row($latest_date_upload_query))
            {
                $latest_date = $latest_date_upload_result[0];
                $current_date_minus_week = date('Y-m-d', strtotime('-1 week'));

                if (strtotime($latest_date) < strtotime($current_date_minus_week))
                    return 'success';
                else
                    return null;           
            }else
                return null;
        }elseif ($latest_date_upload_query_rows_count == 0)
        {
            return 'success';
        } else
            return null;

    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_photo_statistics_stars_count($user_uuid, $current_picture, $star_number)
  {
    if (!empty($user_uuid) && !empty($current_picture) && !empty($star_number) && isset($star_number)
        && isset($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid))
        && isset($current_picture) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $current_picture)))
    {
        switch ($star_number) {
            case 1:
                $star_selected = 'one_star_count';
            break;

            case 2:
                $star_selected = 'two_star_count';
            break;

            case 3:
                $star_selected = 'three_star_count';
            break;

            case 4:
                $star_selected = 'four_star_count';
            break;

            case 5:
                $star_selected = 'five_star_count';
            break;

            default:
                $star_selected = '';
            break;

        }

        $star_count_query = pg_query("SELECT {$star_selected} FROM users_avatars_statistics WHERE user_uuid = '{$user_uuid}' AND profile_picture = '{$current_picture}'") or trigger_error(pg_last_error().$star_count_query);

        if ($star_count_result = pg_fetch_array($star_count_query))
        {
            $star_count = isset($star_count_result[0]) ? $star_count_result[0] : 0;

            return $star_count;
        }else
            return 0;
    }else
        return 0;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_photo_statistics_saves_count($user_uuid, $current_picture, $gender)
  {
    if (!empty($user_uuid) && !empty($current_picture) && !empty($gender) && isset($gender)
        && isset($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid))
      && isset($current_picture) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $current_picture)))
    {
        switch ($gender) {
            case 'male':
                $gender_query_from_text = 'LEFT JOIN users ON saves.author_uuid = users.uuid LEFT JOIN genders ON users.gender = genders.uuid';
                $gender_query_where_text = 'AND genders.title = \'male\'';
            break;

            case 'female':
                $gender_query_from_text = 'LEFT JOIN users ON saves.author_uuid = users.uuid LEFT JOIN genders ON users.gender = genders.uuid';
                $gender_query_where_text = 'AND genders.title = \'female\'';
            break;

            case 'all':
                $gender_query_from_text = '';
                $gender_query_where_text = '';
            break;

            default:
                $gender_query_from_text = '';
                $gender_query_where_text = '';
            break;
        }

        $saves_count_query = pg_query("SELECT count(saves.uuid) 
                                        FROM saves
                                             LEFT JOIN users_avatars
                                                    ON saves.profile_picture = users_avatars.profile_picture
                                            {$gender_query_from_text}
                                        WHERE saves.user_uuid = '{$user_uuid}' 
                                              AND users_avatars.uuid = '{$current_picture}' {$gender_query_where_text}")
                                   or trigger_error(pg_last_error().$saves_count_query);

        if ($saves_count_result = pg_fetch_array($saves_count_query))
        {
            $saves_count = isset($saves_count_result[0]) ? $saves_count_result[0] : 0;

            return $saves_count;
        }else
            return 0;
    }else
        return 0;
  }

//----------------------------------------------------------------------------------------------------------------

  function set_update_date_for_latest_avatar($user_uuid, $latest_avatar)
  {
    if (!empty($user_uuid) && !empty($latest_avatar))
    {
        $set_update_date_query = pg_query("UPDATE users_avatars SET update_date = NOW() WHERE user_uuid='{$user_uuid}' AND profile_picture = '{$latest_avatar}'") or trigger_error(pg_last_error().$set_update_date_query);
    }
  }

  function add_new_avatar_to_db($user_uuid, $new_avatar)
  {
    if (!empty($user_uuid) && !empty($new_avatar))
    {
        $last_avatar = get_latest_avatar($user_uuid);
        $add_new_avatar_query = pg_query("INSERT INTO users_avatars (profile_picture, creation_date, user_uuid) 
                                            VALUES ('{$new_avatar}', NOW(), '{$user_uuid}')") 
                                    or trigger_error(pg_last_error().$add_new_avatar_query);
        
        if ($add_new_avatar_query)
        {
            $new_avatar_uuid = get_photo_uuid_by_name($new_avatar);

            if (isset($new_avatar_uuid))
            {
                $add_new_avatar_statistics = pg_query("INSERT INTO users_avatars_statistics (user_uuid, profile_picture) 
                                                    VALUES ('{$user_uuid}', '{$new_avatar_uuid}')") 
                                            or trigger_error(pg_last_error().$add_new_avatar_statistics);

                $add_new_avatar_news = pg_query("INSERT INTO news (author_uuid, news_type, old_photo, new_photo, creation_date) 
                                                    VALUES ('{$user_uuid}', 'profilePhotoUpdate', '{$last_avatar}', '{$new_avatar}', NOW())") or trigger_error(pg_last_error().$add_new_avatar_news);
            }
        }
    }
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_country($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_country_query = pg_query("SELECT c.value
                                        FROM users u
                                             LEFT JOIN countries c
                                                    ON u.country_uuid = c.uuid
                                        WHERE u.uuid = '{$user_uuid}'")
                            or trigger_error(pg_last_error().$user_country_query);

        $user_country_count = pg_num_rows($user_country_query);

        if ($user_country_count == 1)
        {
            if ($user_country_result = pg_fetch_array($user_country_query))
            {
                $user_country = $user_country_result[0];

                return (is_null($user_country)) ? 'Other' : $user_country;
            }else
                return 'Other';
        }else
        {
            return 'Other';
        }
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_country_name($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_country_query = pg_query("SELECT c.title
                                        FROM users u
                                             LEFT JOIN countries c
                                                    ON u.country_uuid = c.uuid
                                        WHERE u.uuid = '{$user_uuid}'")
                            or trigger_error(pg_last_error().$user_country_query);

        $user_country_count = pg_num_rows($user_country_query);

        if ($user_country_count == 1)
        {
            if ($user_country_result = pg_fetch_array($user_country_query))
            {
                $user_country = $user_country_result[0];

                return (is_null($user_country)) ? null : $user_country;
            }else
                return null;
        }else
        {
            return null;
        }
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_city($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_city_query = pg_query("SELECT c.value
                                     FROM users u
                                          LEFT JOIN cities c
                                                 ON u.city_uuid = c.uuid
                                     WHERE u.uuid = '{$user_uuid}'")
                            or trigger_error(pg_last_error().$user_city_query);

        $user_city_count = pg_num_rows($user_city_query);

        if ($user_city_count == 1)
        {
            if ($user_city_result = pg_fetch_array($user_city_query))
            {
                $user_city = $user_city_result[0];

                return (is_null($user_city)) ? 'Other' : $user_city;
            }else
                return null;
        }else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_city_name($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_city_query = pg_query("SELECT c.title
                                     FROM users u
                                          LEFT JOIN cities c
                                                 ON u.city_uuid = c.uuid
                                     WHERE u.uuid = '{$user_uuid}'")
                            or trigger_error(pg_last_error().$user_city_query);

        $user_city_count = pg_num_rows($user_city_query);

        if ($user_city_count == 1)
        {
            if ($user_city_result = pg_fetch_array($user_city_query))
            {
                $user_city = $user_city_result[0];

                return (is_null($user_city)) ? null : $user_city;
            }else
                return null;
        }else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_gender($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_gender_query = pg_query("SELECT g.title
                                       FROM users u
                                            LEFT JOIN genders g 
                                                 ON u.gender = g.uuid
                                       WHERE u.uuid = '{$user_uuid}'")
                            or trigger_error(pg_last_error().$user_gender_query);

        if ($user_gender_result = pg_fetch_row($user_gender_query))
        {
            $user_gender = $user_gender_result[0];
            return $user_gender;
        }else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function get_user_gender_preference($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $user_gender_preference_query = pg_query("SELECT g.title
                                                  FROM users u
                                                       LEFT JOIN genders g 
                                                              ON u.gender_preference = g.uuid
                                                  WHERE u.uuid = '{$user_uuid}'")
                                    or trigger_error(pg_last_error().$user_gender_preference_query);

        if ($user_gender_preference_result = pg_fetch_row($user_gender_preference_query))
        {
            $user_gender_preference = $user_gender_preference_result[0];
            return $user_gender_preference;
        }else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

    function get_user_minimum_age_preference($user_uuid)
    {
        if (!empty($user_uuid))
        {
            $user_minimum_age_preference_query = pg_query("SELECT minimum_age_preference FROM users WHERE uuid = '{$user_uuid}'")
                                                    or trigger_error(pg_last_error().$user_minimum_age_preference_query);

            if ($user_minimum_age_preference_result = pg_fetch_row($user_minimum_age_preference_query))
            {
                $user_minimum_age_preference = $user_minimum_age_preference_result[0];
                return $user_minimum_age_preference;
            }else
                return null;
        }else
            return null;
    }

//----------------------------------------------------------------------------------------------------------------

    function get_user_maximum_age_preference($user_uuid)
    {
        if (!empty($user_uuid))
        {
            $user_maximum_age_preference_query = pg_query("SELECT maximum_age_preference FROM users WHERE uuid = '{$user_uuid}'")
                                                    or trigger_error(pg_last_error().$user_maximum_age_preference_query);

            if ($user_maximum_age_preference_result = pg_fetch_row($user_maximum_age_preference_query))
            {
                $user_maximum_age_preference = $user_maximum_age_preference_result[0];
                return $user_maximum_age_preference;
            }else
                return null;
        }else
            return null;
    }

//----------------------------------------------------------------------------------------------------------------

  function get_vk_link($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $vk_link_query = pg_query("SELECT vk_link FROM social_networks WHERE user_uuid = '{$user_uuid}'")
                            or trigger_error(pg_last_error().$vk_link_query);

        if ($vk_link_result = pg_fetch_row($vk_link_query))
        {
            $vk_link = $vk_link_result[0];
            return $vk_link;
        }else
            return null;
    }else
        return null;
  }

  function get_insta_link($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $insta_link_query = pg_query("SELECT instagram_link FROM social_networks WHERE user_uuid = '{$user_uuid}'")
                                or trigger_error(pg_last_error().$insta_link_query);

        if ($insta_link_result = pg_fetch_row($insta_link_query))
        {
            $insta_link = $insta_link_result[0];
            return $insta_link;
        }else
            return null;
    }else
        return null;
  }

  function get_ok_link($user_uuid)
  {
    if (!empty($user_uuid))
    {
        $ok_link_query = pg_query("SELECT ok_link FROM social_networks WHERE user_uuid = '{$user_uuid}'")
                            or trigger_error(pg_last_error().$ok_link_query);

        if ($ok_link_result = pg_fetch_row($ok_link_query))
        {
            $ok_link = $ok_link_result[0];
            return $ok_link;
        }else
            return null;
    }else
        return null;
  }

//----------------------------------------------------------------------------------------------------------------

  function all_requests_count($user_uuid, $type)
  {
    if (!empty($user_uuid) && !empty($type))
    {
        switch ($type) {
            case 'author':
                    $requests_query = pg_query("SELECT Count(*) FROM friendship_requests WHERE author_uuid = '{$user_uuid}'") or trigger_error(pg_last_error().$requests_query);

                    if ($requests_query_data = pg_fetch_array($requests_query))
                    {
                        $requests_query_count = $requests_query_data[0];
                        return $requests_query_count;
                    }
                break;

            case 'receiver':
                    $requests_query = pg_query("SELECT Count(fr.*) 
                                                FROM friendship_requests fr
                                                WHERE fr.receiver_uuid = '{$user_uuid}'
                                                      AND NOT EXISTS (SELECT * 
                                                                        FROM banned_users 
                                                                        WHERE user_uuid = fr.author_uuid
                                                                                AND (permanent_ban_identifier = 1 OR finish_date > NOW()))") or trigger_error(pg_last_error().$requests_query);

                    if ($requests_query_data = pg_fetch_array($requests_query))
                    {
                        $requests_query_count = $requests_query_data[0];
                        return $requests_query_count;
                    }
                break;
            
            default:
                return 0;
                break;
        }
    }
  }

//----------------------------------------------------------------------------------------------------------------

  function check_request_status($user, $friend, $type)
  {
    if (!empty($user) && !empty($friend) && !empty($type))
    {
        switch ($type) {
            case 'author':
                $request_status_query = pg_query("SELECT 1 FROM friendship_requests WHERE author_uuid = '{$user}' AND receiver_uuid = '{$friend}'") 
                                        or trigger_error(pg_last_error().$request_status_query);

                $request_status_query_count = pg_num_rows($request_status_query);

                if ($request_status_query_count == 1)
                {
                    return 1;
                }else
                    return 0;
                break;

            case 'receiver':
                $request_status_query = pg_query("SELECT 1 FROM friendship_requests WHERE author_uuid = '{$friend}' AND receiver_uuid = '{$user}'") 
                                        or trigger_error(pg_last_error().$request_status_query);

                $request_status_query_count = pg_num_rows($request_status_query);

                if ($request_status_query_count == 1)
                {
                    return 1;
                }else
                    return 0;
                break;
            
            default:
                return 0;
                break;
        }
    }else
        return 0;
  }

//----------------------------------------------------------------------------------------------------------------

  function all_friends_count($user)
  {
    if (!empty($user))
    {
        $friends_list_query = pg_query("SELECT Count(*)
                                        FROM friends
                                        WHERE first_uuid = '{$user}' OR second_uuid = '{$user}'")
                                or trigger_error(pg_last_error().$friends_list_query);

        if ($friends_list_query_data = pg_fetch_array($friends_list_query))
        {
            $friends_list_query_count = $friends_list_query_data[0];
            return $friends_list_query_count;
        }else
            return 0;
    }else
        return 0;
  }

//----------------------------------------------------------------------------------------------------------------

  function check_friendship_status($user, $friend)
  {
    if (!empty($user) && !empty($friend))
    {
        $friendship_query = pg_query("SELECT 1 FROM friends WHERE (first_uuid = '{$user}' AND second_uuid = '{$friend}') 
                                        OR (first_uuid = '{$friend}' AND second_uuid = '{$user}')") 
                            or trigger_error(pg_last_error().$friendship_query);

        $friendship_query_count = pg_num_rows($friendship_query);

        if ($friendship_query_count == 1)
        {
            return 1;
        }else
            return 0;
    }else
        return 0;
  }

//----------------------------------------------------------------------------------------------------------------

  function all_subscribers_count($user)
  {
    if (!empty($user))
    {
        $all_subscribers_query = pg_query("SELECT Count(*)
                                           FROM subscribers
                                           WHERE user_uuid = '{$user}'")
                                    or trigger_error(pg_last_error().$all_subscribers_query);

        if ($all_subscribers_query_data = pg_fetch_array($all_subscribers_query))
        {
            $all_subscribers_query_count = $all_subscribers_query_data[0];
            return $all_subscribers_query_count;
        }
    }
  }

//----------------------------------------------------------------------------------------------------------------

  function check_subscriber_status($user, $friend, $type)
  {
    if (!empty($user) && !empty($friend) && !empty($type))
    {
        switch ($type) {
            case 'user':
                $subscriber_query = pg_query("SELECT 1 FROM subscribers WHERE user_uuid = '{$user}' AND subscriber_uuid = '{$friend}'") 
                                or trigger_error(pg_last_error().$subscriber_query);

                $subscriber_query_count = pg_num_rows($subscriber_query);

                if ($subscriber_query_count == 1)
                {
                    return 1;
                }else
                    return 0;
                break;

            case 'current_user':
                $subscriber_query = pg_query("SELECT 1 FROM subscribers WHERE user_uuid = '{$friend}' AND subscriber_uuid = '{$user}'") 
                                or trigger_error(pg_last_error().$subscriber_query);

                $subscriber_query_count = pg_num_rows($subscriber_query);

                if ($subscriber_query_count == 1)
                {
                    return 1;
                }else
                    return 0;
                break;

            default:
                return 0;
                break;
        }
    }else
        return 0;
  }

//----------------------------------------------------------------------------------------------------------------

  function all_subscriptions_count($user)
  {
    if (!empty($user))
    {
        $all_subscriptions_query = pg_query("SELECT Count(*)
                                             FROM subscribers
                                             WHERE subscriber_uuid = '{$user}'")
                                    or trigger_error(pg_last_error().$all_subscriptions_query);

        if ($all_subscriptions_query_data = pg_fetch_array($all_subscriptions_query))
        {
            $all_subscriptions_query_count = $all_subscriptions_query_data[0];
            return $all_subscriptions_query_count;
        }
    }
  }

//----------------------------------------------------------------------------------------------------------------

  function count_set_ratings($user_uuid, $date)
  {
    if (isset($user_uuid) && strlen($user_uuid) > 0 && isset($date) && strlen($date) > 0 && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        switch ($date) {
            case 'day':
                $date_query_from_text = 'AND date(date_time) = current_date';
            break;

            case 'week':
                $date_query_from_text = 'AND date(date_time) >= date_trunc(\'week\', now())';
            break;

            case 'month':
                $date_query_from_text = 'AND date(date_time) >= date(cast(extract(\'year\' FROM current_date) as text) || \'-\' || cast(extract(\'month\' FROM current_date) as text) || \'-\' || \'1\')';
            break;

            default:
                $date_query_from_text = '';
            break;
        }

        $count_ratings_query = pg_query("SELECT Count(*) 
                                         FROM rating 
                                         WHERE author = '{$user_uuid}'
                                               AND mark != 7 {$date_query_from_text}")
                                or trigger_error(pg_last_error().$count_ratings_query);

        if ($count_ratings_result = pg_fetch_array($count_ratings_query))
        {
            $count_ratings = $count_ratings_result[0];
            return $count_ratings;
        } else return 0;
    } else return 0;
  }

  function count_get_ratings($user_uuid, $date)
  {
    if (isset($user_uuid) && strlen($user_uuid) > 0 && isset($date) && strlen($date) > 0 && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        switch ($date) {
            case 'day':
                $date_query_from_text = 'AND date(date_time) = current_date';
            break;

            case 'week':
                $date_query_from_text = 'AND date(date_time) >= date_trunc(\'week\', now())';
            break;

            case 'month':
                $date_query_from_text = 'AND date(date_time) >= date(cast(extract(\'year\' FROM current_date) as text) || \'-\' || cast(extract(\'month\' FROM current_date) as text) || \'-\' || \'1\')';
            break;

            default:
                $date_query_from_text = '';
            break;
        }

        $count_ratings_query = pg_query("SELECT Count(*) 
                                         FROM rating 
                                         WHERE receiver = '{$user_uuid}'
                                               AND mark != 7 {$date_query_from_text}")
                                or trigger_error(pg_last_error().$count_ratings_query);

        if ($count_ratings_result = pg_fetch_array($count_ratings_query))
        {
            $count_ratings = $count_ratings_result[0];
            return $count_ratings;
        } else return 0;
    } else return 0;
  }

//----------------------------------------------------------------------------------------------------------------

  function number_of_ratings_from_users($user_uuid, $mark)
  {
    if (isset($user_uuid) && strlen($user_uuid) > 0 && isset($mark) && strlen($mark) > 0 && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        switch ($mark) {
            case 0:
                $mark_query_text = 'AND mark != 7';
            break;

            case 1:
                $mark_query_text = 'AND mark = 1';
            break;

            case 2:
                $mark_query_text = 'AND mark = 2';
            break;

            case 3:
                $mark_query_text = 'AND mark = 3';
            break;

            case 4:
                $mark_query_text = 'AND mark = 4';
            break;

            case 5:
                $mark_query_text = 'AND mark = 5';
            break;

            default:
                $mark_query_text = 'AND mark != 7';
            break;
        }

        $number_of_rating_count_query = pg_query("SELECT COUNT(*)
                                                    FROM rating
                                                    WHERE receiver = '{$user_uuid}' {$mark_query_text}")
                                    or trigger_error(pg_last_error().$number_of_rating_count_query);

        if ($number_of_rating_count = pg_fetch_row($number_of_rating_count_query))
        {
            $number_of_rating = $number_of_rating_count[0];
            return $number_of_rating;
        }else
            return 0;

    }else
        return 0;
  }

  function number_of_ratings_from_users_by_gender($user_uuid, $mark, $gender)
  {
    if (isset($user_uuid) && strlen($user_uuid) > 0 
        && isset($mark) && strlen($mark) > 0
        && isset($gender) && strlen($gender) > 0
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        switch ($mark) {
            case 0:
                $mark_query_where_text = 'AND rating.mark != 7';
            break;

            case 1:
                $mark_query_where_text = 'AND rating.mark = 1';
            break;

            case 2:
                $mark_query_where_text = 'AND rating.mark = 2';
            break;

            case 3:
                $mark_query_where_text = 'AND rating.mark = 3';
            break;

            case 4:
                $mark_query_where_text = 'AND rating.mark = 4';
            break;

            case 5:
                $mark_query_where_text = 'AND rating.mark = 5';
            break;

            default:
                $mark_query_where_text = 'AND rating.mark != 7';
            break;
        }

        switch ($gender) {
            case 'male':
                $gender_query_from_text = 'LEFT JOIN users ON rating.author = users.uuid LEFT JOIN genders ON users.gender = genders.uuid';
                $gender_query_where_text = 'AND genders.title = \'male\'';
            break;

            case 'female':
                $gender_query_from_text = 'LEFT JOIN users ON rating.author = users.uuid LEFT JOIN genders ON users.gender = genders.uuid';
                $gender_query_where_text = 'AND genders.title = \'female\'';
            break;

            case 'other':
                $gender_query_from_text = 'LEFT JOIN users ON rating.author = users.uuid LEFT JOIN genders ON users.gender = genders.uuid';
                $gender_query_where_text = 'AND genders.title NOT IN (\'male\', \'female\')';
            break;

            default:
                $gender_query_from_text = 'LEFT JOIN users ON rating.author = users.uuid LEFT JOIN genders ON users.gender = genders.uuid';
                $gender_query_where_text = 'AND genders.title NOT IN (\'male\', \'female\')';
            break;
        }

        $number_of_rating_count_query = pg_query("SELECT COUNT(rating.uuid)
                                                    FROM rating {$gender_query_from_text}
                                                    WHERE rating.receiver = '{$user_uuid}' {$mark_query_where_text} {$gender_query_where_text}")
                                    or trigger_error(pg_last_error().$number_of_rating_count_query);

        if ($number_of_rating_count = pg_fetch_row($number_of_rating_count_query))
        {
            $number_of_rating = $number_of_rating_count[0];
            return $number_of_rating;
        }else
            return 0;

    }else
        return 0;
  }

//----------------------------------------------------------------------------------------------------------------

  function count_saves_by_user($user_uuid, $date)
  {
    if (isset($user_uuid) && strlen($user_uuid) > 0 && isset($date) && strlen($date) > 0 && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        switch ($date) {
            case 'day':
                $date_query_from_text = 'AND date(creation_date) = current_date';
            break;

            case 'week':
                $date_query_from_text = 'AND date(creation_date) >= date_trunc(\'week\', now())';
            break;

            case 'month':
                $date_query_from_text = 'AND date(creation_date) >= date(cast(extract(\'year\' FROM current_date) as text) || \'-\' || cast(extract(\'month\' FROM current_date) as text) || \'-\' || \'1\')';
            break;

            default:
                $date_query_from_text = '';
            break;
        }

        $count_saves_query = pg_query("SELECT Count(*) 
                                        FROM saves 
                                        WHERE author_uuid = '{$user_uuid}' {$date_query_from_text}")
                                or trigger_error(pg_last_error().$count_saves_query);

        if ($count_saves_result = pg_fetch_array($count_saves_query))
        {
            $count_saves = $count_saves_result[0];
            return $count_saves;
        } else return 0;
    } else return 0;
  }

//----------------------------------------------------------------------------------------------------------------

  function count_get_saves_by_genders_and_date($user_uuid, $gender, $date)
  {
    if (!empty($user_uuid) && !empty($gender) && !empty($date) && isset($gender) && isset($date)
        && isset($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        switch ($gender) {
            case 'male':
                $gender_query_from_text = 'LEFT JOIN users ON saves.author_uuid = users.uuid LEFT JOIN genders ON users.gender = genders.uuid';
                $gender_query_where_text = 'AND genders.title = \'male\'';
            break;

            case 'female':
                $gender_query_from_text = 'LEFT JOIN users ON saves.author_uuid = users.uuid LEFT JOIN genders ON users.gender = genders.uuid';
                $gender_query_where_text = 'AND genders.title = \'female\'';
            break;

            case 'other':
                $gender_query_from_text = 'LEFT JOIN users ON saves.author_uuid = users.uuid LEFT JOIN genders ON users.gender = genders.uuid';
                $gender_query_where_text = 'AND genders.title NOT IN (\'male\', \'female\')';
            break;

            default:
                $gender_query_from_text = '';
                $gender_query_where_text = '';
            break;
        }

        switch ($date) {
            case 'day':
                $date_query_from_text = 'AND date(saves.creation_date) = current_date';
            break;

            case 'week':
                $date_query_from_text = 'AND date(saves.creation_date) >= date_trunc(\'week\', now())';
            break;

            case 'month':
                $date_query_from_text = 'AND date(saves.creation_date) >= date(cast(extract(\'year\' FROM current_date) as text) || \'-\' || cast(extract(\'month\' FROM current_date) as text) || \'-\' || \'1\')';
            break;

            default:
                $date_query_from_text = '';
            break;
        }

        $saves_count_query = pg_query("SELECT count(saves.uuid) 
                                        FROM saves
                                            {$gender_query_from_text}
                                        WHERE saves.user_uuid = '{$user_uuid}' {$gender_query_where_text} {$date_query_from_text}")
                                   or trigger_error(pg_last_error().$saves_count_query);

        if ($saves_count_result = pg_fetch_array($saves_count_query))
        {
            $saves_count = isset($saves_count_result[0]) ? $saves_count_result[0] : 0;

            return $saves_count;
        }else
            return 0;
    }else
        return 0;
  }

//----------------------------------------------------------------------------------------------------------------
  
  function get_user_rating_from_current_user($current_user_uuid, $user_uuid, $picture_uuid)
  {
    if (!empty($current_user_uuid) && !empty($user_uuid) && !empty($picture_uuid))
    {
        $user_rating_query = pg_query("SELECT mark FROM rating 
                                        WHERE author = '{$current_user_uuid}' 
                                                AND receiver = '{$user_uuid}'
                                                AND photo_uuid = '{$picture_uuid}'") 
                                or trigger_error(pg_last_error().$user_rating_query);

        $user_rating_count = pg_num_rows($user_rating_query);

        switch ($user_rating_count) {
            case 0:
                return 0;
            break;

            case 1:
                if ($user_rating_result = pg_fetch_array($user_rating_query))
                {
                    $user_rating = $user_rating_result[0];
                    return $user_rating;
                }else return 0;
            break;

            default:
                pg_query("DELETE FROM rating 
                            WHERE author = '{$current_user_uuid}' 
                                    AND receiver = '{$user_uuid}'
                                    AND photo_uuid = '{$picture_uuid}'");
                return 0;
            break;
        }
    }else return 0;
  }

//----------------------------------------------------------------------------------------------------------------

  function ban_message($user_uuid)
  {
    if (!empty($user_uuid) && isset($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        $permanent_ban_query = pg_query("SELECT 1 FROM banned_users WHERE user_uuid = '{$user_uuid}' and permanent_ban_identifier = 1") 
                            or trigger_error(pg_last_error().$permanent_ban_query);

        $permanent_ban_check_count = pg_num_rows($permanent_ban_query);

        if ($permanent_ban_check_count == 0)
        {
            $ban_query = pg_query("SELECT br.description, bu.finish_date
                                    FROM banned_users bu 
                                    LEFT JOIN ban_reasons br ON bu.ban_reason_code = br.code
                                    WHERE bu.user_uuid = '{$user_uuid}' and bu.finish_date > NOW()
                                    ORDER BY bu.finish_date DESC
                                    LIMIT 1")
                            or trigger_error(pg_last_error().$ban_check_query);

            if ($ban_result = pg_fetch_array($ban_query))
            {
                $ban_description = $ban_result[0];
                $ban_finish_time = date('H:i', strtotime($ban_result[1]));
                $ban_finish_date = corrected_date_with_text_month($ban_result[1]);

                echo '<p class="fz-20 m-0 p-0 font-weight-bold text-center">Действие учетной записи приостановлено</p>
                        <hr class="hr-user-info w-100 m-0 mt-2 mb-2">
                        <p class="fz-15 m-0 p-0 pt-1 text-center">Страница заморожена до '.$ban_finish_date.' года, '.$ban_finish_time.'</p>
                        <p class="fz-15 m-0 p-0 pt-1 text-center">Причина: '.$ban_description.'</p>';
            }

            
        }else
        {
            echo '<p class="fz-20 m-0 p-0 font-weight-bold text-center">Учетная запись заблокирована навсегда</p>
                    <hr class="hr-user-info w-100 m-0 mt-2 mb-2">
                    <p class="fz-15 m-0 p-0 pt-1 text-center">Были обнаружены злоупотребления, связанные с Вашей страницей, поэтому она заблокирована навсегда</p>';
        }
    }
  }

  function ban_user_message($user_uuid)
  {
    if (!empty($user_uuid) && isset($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
        $permanent_ban_query = pg_query("SELECT 1 FROM banned_users WHERE user_uuid = '{$user_uuid}' and permanent_ban_identifier = 1") 
                            or trigger_error(pg_last_error().$permanent_ban_query);

        $permanent_ban_check_count = pg_num_rows($permanent_ban_query);

        if ($permanent_ban_check_count == 0)
        {
            $ban_query = pg_query("SELECT br.description, bu.finish_date
                                    FROM banned_users bu 
                                    LEFT JOIN ban_reasons br ON bu.ban_reason_code = br.code
                                    WHERE bu.user_uuid = '{$user_uuid}' and bu.finish_date > NOW()
                                    ORDER BY bu.finish_date DESC
                                    LIMIT 1")
                            or trigger_error(pg_last_error().$ban_check_query);

            if ($ban_result = pg_fetch_array($ban_query))
            {
                $ban_description = $ban_result[0];
                $ban_finish_time = date('H:i', strtotime($ban_result[1]));
                $ban_finish_date = corrected_date_with_text_month($ban_result[1]);

                echo '<p class="fz-15 m-0 p-0 text-center">Пользователь заблокирован до '.$ban_finish_date.' года, '.$ban_finish_time.'</p>';
            }
        }else
        {
            echo '<p class="fz-15 m-0 p-0 text-center">Пользователь заблокирован навсегда</p>';
        }
    }
  }
?>