<?php
  function get_top_tags()
  {
    $top_tags_array = [];
    $top_tags_query = pg_query("SELECT tag_text FROM tags GROUP BY tag_text ORDER BY Count(tag_text) DESC LIMIT 10") or trigger_error(pg_last_error().$top_tags_query);

    if ($top_tags_result = pg_fetch_array($top_tags_query))
    {
        $top_tags_num = 0;

        do {
            $top_tags_array[$top_tags_num] = $top_tags_result[0];
            $top_tags_num++;
        }while ($top_tags_result = pg_fetch_array($top_tags_query));

        return $top_tags_array;
    }else
        return null;
  }

  function get_top_ten_users()
  {
    $top_ten_users_array = [];
    $top_ten_users_query = pg_query("SELECT
                                        u.uuid, -- 0
                                        u.name, -- 1
                                        u.surname, -- 2
                                        u.nickname, -- 3
                                        ROW_NUMBER() OVER (ORDER BY COALESCE(NULLIF(us.maximum_user_score, 0), 0) DESC) as position -- 4
                                    FROM users u
                                         LEFT JOIN users_statistics us
                                                ON u.uuid = us.user_uuid
                                    WHERE NOT EXISTS (SELECT * 
                                                      FROM banned_users 
                                                      WHERE user_uuid = u.uuid 
                                                            AND permanent_ban_identifier = 1
                                                    )
                                    LIMIT 10") or trigger_error(pg_last_error().$top_ten_users_query);

    if ($top_ten_users_result = pg_fetch_array($top_ten_users_query))
    {
        $top_ten_users_num = 0;

        do {
            $top_ten_users_array[$top_ten_users_num][0] = $top_ten_users_result[0];
            $top_ten_users_array[$top_ten_users_num][1] = $top_ten_users_result[1];
            $top_ten_users_array[$top_ten_users_num][2] = $top_ten_users_result[2];
            $top_ten_users_array[$top_ten_users_num][3] = $top_ten_users_result[3];
            $top_ten_users_array[$top_ten_users_num][4] = $top_ten_users_result[4];
            $top_ten_users_num++;
        }while($top_ten_users_result = pg_fetch_array($top_ten_users_query));

        return $top_ten_users_array;
    }else
        return null;

  }

  function get_genders_list()
  {
    $genders_array = [];
    $genders_query = pg_query("SELECT DISTINCT title, description FROM genders") or trigger_error(pg_last_error().$genders_query);

    if ($genders_result = pg_fetch_array($genders_query))
    {
        $genders_num = 0;

        do {
            $genders_array[$genders_num][0] = $genders_result[0];
            $genders_array[$genders_num][1] = $genders_result[1];
            $genders_num++;
        }while ($genders_result = pg_fetch_array($genders_query));

        return $genders_array;
    }else
        return null;
  }

  function get_country_list()
  {
    $countries_array = [];
    $countries_query = pg_query("SELECT DISTINCT value, title FROM countries ORDER BY title") or trigger_error(pg_last_error().$countries_query);

    if ($countries_result = pg_fetch_array($countries_query))
    {
        $countries_num = 0;

        do {
            $countries_array[$countries_num][0] = $countries_result[0];
            $countries_array[$countries_num][1] = $countries_result[1];
            $countries_num++;
        }while ($countries_result = pg_fetch_array($countries_query));

        return $countries_array;
    }else
        return null;
  }

  function get_cities_list_in_country($country_value)
  {
    if (!empty($country_value))
    {
        $cities_array = [];

        if ($country_value == 'Other')
        {
            $cities_array[0][0] = 'Other';
            $cities_array[0][1] = 'Иной город';

            return $cities_array;
        }else
        {
            $cities_query = pg_query("SELECT DISTINCT cities.value, cities.title 
                                      FROM cities
                                           INNER JOIN countries
                                                   ON cities.country = countries.uuid
                                      WHERE countries.value = '{$country_value}'
                                      ORDER BY cities.title") 
                                or trigger_error(pg_last_error().$cities_query);

            if ($cities_result = pg_fetch_array($cities_query))
            {
                $cities_num = 0;

                do {
                    $cities_array[$cities_num][0] = $cities_result[0];
                    $cities_array[$cities_num][1] = $cities_result[1];
                    $cities_num++;
                }while ($cities_result = pg_fetch_array($cities_query));

                return $cities_array;
            }else
            {
                $cities_array[0][0] = 'Other';
                $cities_array[0][1] = 'Иной город';

                return $cities_array;
            }
        }
    }else
    {
        $cities_array[0][0] = 'Other';
        $cities_array[0][1] = 'Иной город';

        return $cities_array;
    }
  }

  function get_most_commented_photos_list($from, $limit)
  {
    $query_limit = (!empty($limit) ? 'LIMIT '.$limit : 'LIMIT 0');
    $query_offset = 'OFFSET '.$from;
    $most_commented_photos_array = [];
    $most_commented_photos_query = pg_query("SELECT uc.picture_uuid,  
                                                    ua.user_uuid, 
                                                    Count(uc.picture_uuid), 
                                                    ROW_NUMBER() OVER (ORDER BY COALESCE(NULLIF(Count(uc.picture_uuid), 0), 0)DESC) as position
                                              FROM public.users_comments uc
                                                   JOIN public.users_avatars ua
                                                     ON uc.picture_uuid = ua.uuid
                                              WHERE uc.deleted = 0
                                              GROUP BY uc.picture_uuid, ua.user_uuid
                                              ORDER BY Count(uc.picture_uuid) DESC
                                              $query_limit $query_offset") or trigger_error(pg_last_error().$most_commented_photos_query);

    if ($most_commented_photos_result = pg_fetch_array($most_commented_photos_query))
    {
        $most_commented_photos_num = 0;

        do {
            $most_commented_photos_array[$most_commented_photos_num][0] = $most_commented_photos_result[0];
            $most_commented_photos_array[$most_commented_photos_num][1] = $most_commented_photos_result[1];
            $most_commented_photos_array[$most_commented_photos_num][2] = $most_commented_photos_result[2];
            $most_commented_photos_num++;
        }while ($most_commented_photos_result = pg_fetch_array($most_commented_photos_query));

        return $most_commented_photos_array;
    }else
        return null;
  }

  function get_photos_list_sorted_by_rating($from, $limit)
  {
    $query_limit = (!empty($limit) ? 'LIMIT '.$limit : 'LIMIT 0');
    $query_offset = 'OFFSET '.$from;
    $photos_sorted_by_rating_array = [];
    $photos_sorted_by_rating_query = pg_query("SELECT uas.user_uuid, 
                                                      uas.profile_picture, 
                                                      CAST(uas.one_star_count * 0.008 AS NUMERIC) 
                                                        + CAST(uas.two_star_count * 0.04 AS NUMERIC) 
                                                        + CAST(uas.three_star_count * 0.2 AS NUMERIC) 
                                                        + CAST(uas.four_star_count * 1 AS NUMERIC) 
                                                        + CAST(uas.five_star_count * 5 AS NUMERIC) as rating
                                                FROM users_avatars_statistics uas
                                                     JOIN users_avatars ua
                                                       ON uas.profile_picture = ua.uuid
                                                ORDER BY rating DESC
                                                $query_limit $query_offset") or trigger_error(pg_last_error().$photos_sorted_by_rating_query);

    if ($photos_sorted_by_rating_result = pg_fetch_array($photos_sorted_by_rating_query))
    {
        $photos_sorted_by_rating_num = 0;

        do {
            $photos_sorted_by_rating_array[$photos_sorted_by_rating_num][0] = $photos_sorted_by_rating_result[0];
            $photos_sorted_by_rating_array[$photos_sorted_by_rating_num][1] = $photos_sorted_by_rating_result[1];
            $photos_sorted_by_rating_array[$photos_sorted_by_rating_num][2] = $photos_sorted_by_rating_result[2];
            $photos_sorted_by_rating_num++;
        }while ($photos_sorted_by_rating_result = pg_fetch_array($photos_sorted_by_rating_query));

        return $photos_sorted_by_rating_array;
    }else
        return null;
  }

  function get_photos_list_sorted_by_number_of_saves($from, $limit)
  {
    $query_limit = (!empty($limit) ? 'LIMIT '.$limit : 'LIMIT 0');
    $query_offset = 'OFFSET '.$from;
    $photos_sorted_by_number_of_saves_array = [];
    $photos_sorted_by_number_of_saves_query = pg_query("SELECT uas.user_uuid, 
                                                             uas.profile_picture,
                                                             Count(s.uuid) as number_of_saves
                                                        FROM users_avatars_statistics uas
                                                           JOIN public.users_avatars ua
                                                             ON uas.profile_picture = ua.uuid
                                                           LEFT JOIN public.saves s
                                                              ON ua.profile_picture = s.profile_picture
                                                        GROUP BY uas.user_uuid, uas.profile_picture
                                                        ORDER BY Count(s.uuid) DESC
                                                        $query_limit $query_offset") or trigger_error(pg_last_error().$photos_sorted_by_number_of_saves_query);

    if ($photos_sorted_by_number_of_saves_result = pg_fetch_array($photos_sorted_by_number_of_saves_query))
    {
        $photos_sorted_by_number_of_saves_num = 0;

        do {
            $photos_sorted_by_number_of_saves_array[$photos_sorted_by_number_of_saves_num][0] = $photos_sorted_by_number_of_saves_result[0];
            $photos_sorted_by_number_of_saves_array[$photos_sorted_by_number_of_saves_num][1] = $photos_sorted_by_number_of_saves_result[1];
            $photos_sorted_by_number_of_saves_array[$photos_sorted_by_number_of_saves_num][2] = $photos_sorted_by_number_of_saves_result[2];
            $photos_sorted_by_number_of_saves_num++;
        }while ($photos_sorted_by_number_of_saves_result = pg_fetch_array($photos_sorted_by_number_of_saves_query));

        return $photos_sorted_by_number_of_saves_array;
    }else
        return null;
  }
?>