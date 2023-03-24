<?php
  function get_photos_count($user_uuid)
  {
    if (!empty($user_uuid))
    {
      $photos_count_query = pg_query("SELECT Count(*)
                                      FROM users_avatars
                                      WHERE user_uuid  = '{$user_uuid}'") 
                            or trigger_error($pg_last_error().$photos_count_query);

      if ($photos_count_result = pg_fetch_array($photos_count_query))
      {
          $photos_count = $photos_count_result[0];
          return $photos_count;
      }else
        return 0;
    }else
        return 0;
  }

  function get_photos_list($user_uuid)
  {
    if (!empty($user_uuid))
    {
      $num = 1000;
      $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

      $all_photos_count = get_photos_count($user_uuid);

      $total_count_photos_pages = intval(($all_photos_count - 1) / $num) + 1;

      if (empty($page) || $page < 0) $page = 1;
      if ($page > $total_count_photos_pages) $page = $total_count_photos_pages;

      $start_page = $page * $num - $num;

      $photos_array = [];

      $photos_list_query = pg_query("SELECT profile_picture, -- 0
                                            EXTRACT(YEAR FROM creation_date) -- 1
                                      FROM users_avatars
                                      WHERE user_uuid  = '{$user_uuid}'
                                      ORDER BY creation_date DESC
                                      LIMIT $num
                                      OFFSET $start_page") 
                              or trigger_error($pg_last_error().$photos_list_query);

      if ($photos_list_result = pg_fetch_array($photos_list_query))
      {
        $photos_num = 0;

        do {
          $photos_array[$photos_num][0] = $photos_list_result[0];
          $photos_array[$photos_num][1] = $photos_list_result[1];

          $photos_num++;
        }while($photos_list_result = pg_fetch_array($photos_list_query));

        return $photos_array;
      }else
        return null;
    }else
      return null;
  }

  function get_photos_years_list($user_uuid)
  {
    if (!empty($user_uuid))
    {
      $num = 1000;
      $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

      $all_photos_count = get_photos_count($user_uuid);

      $total_count_photos_pages = intval(($all_photos_count - 1) / $num) + 1;

      if (empty($page) || $page < 0) $page = 1;
      if ($page > $total_count_photos_pages) $page = $total_count_photos_pages;

      $start_page = $page * $num - $num;

      $years_array = [];

      $years_list_query = pg_query("SELECT EXTRACT(YEAR FROM all_user_dates.creation_date) -- 0
                                    FROM (SELECT creation_date FROM users_avatars WHERE user_uuid  = '{$user_uuid}' ORDER BY creation_date DESC LIMIT $num OFFSET $start_page) all_user_dates
                                    GROUP BY EXTRACT(YEAR FROM all_user_dates.creation_date)
                                    ORDER BY EXTRACT(YEAR FROM all_user_dates.creation_date) DESC") 
                              or trigger_error($pg_last_error().$years_list_query);

      if ($years_list_result = pg_fetch_array($years_list_query))
      {
        $years_num = 0;

        do {
          $years_array[$years_num][0] = $years_list_result[0];
          $years_num++;
        }while($years_list_result = pg_fetch_array($years_list_query));

        return $years_array;
      }else
        return null;
    }else
      return null;
  }
?>