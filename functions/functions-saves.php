<?php
  function get_saves_count($user_uuid)
  {
    if (!empty($user_uuid))
    {
      $saves_count_query = pg_query("SELECT Count(*)
                                     FROM saves
                                     WHERE author_uuid  = '{$user_uuid}'") 
                            or trigger_error($pg_last_error().$saves_count_query);

      if ($saves_count_result = pg_fetch_array($saves_count_query))
      {
          $saves_count = $saves_count_result[0];
          return $saves_count;
      }else
        return 0;
    }else
        return 0;
  }

  function get_saves_list($user_uuid)
  {
    if (!empty($user_uuid))
    {
      $num = 1000;
      $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

      $all_saves_count = get_saves_count($user_uuid);

      $total_count_saves_pages = intval(($all_saves_count - 1) / $num) + 1;

      if (empty($page) || $page < 0) $page = 1;
      if ($page > $total_count_saves_pages) $page = $total_count_saves_pages;

      $start_page = $page * $num - $num;

      $saves_array = [];

      $saves_list_query = pg_query("SELECT users_photos.photo_name, -- 0
                                           saves.user_uuid, -- 1
                                           EXTRACT(YEAR FROM saves.creation_date) -- 2
                                    FROM saves
                                          JOIN users_photos 
                                            ON saves.photo_uuid = users_photos.uuid
                                    WHERE saves.author_uuid  = '{$user_uuid}'
                                    ORDER BY saves.creation_date DESC
                                    LIMIT $num
                                    OFFSET $start_page")
                             or trigger_error($pg_last_error().$saves_list_query);

      if ($saves_list_result = pg_fetch_array($saves_list_query))
      {
        $saves_num = 0;

        do {
          $saves_array[$saves_num][0] = $saves_list_result[0];
          $saves_array[$saves_num][1] = $saves_list_result[1];
          $saves_array[$saves_num][2] = $saves_list_result[2];

          $saves_num++;
        }while($saves_list_result = pg_fetch_array($saves_list_query));

        return $saves_array;
      }else
        return null;
    }else
      return null;
  }

  function get_saves_years_list($user_uuid)
  {
    if (!empty($user_uuid))
    {
      $num = 1000;
      $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

      $all_saves_count = get_saves_count($user_uuid);

      $total_count_saves_pages = intval(($all_saves_count - 1) / $num) + 1;

      if (empty($page) || $page < 0) $page = 1;
      if ($page > $total_count_saves_pages) $page = $total_count_saves_pages;

      $start_page = $page * $num - $num;
      
      $years_array = [];

      $years_list_query = pg_query("SELECT EXTRACT(YEAR FROM all_user_dates.creation_date) -- 0
                                    FROM (SELECT creation_date FROM saves WHERE author_uuid  = '{$user_uuid}' ORDER BY creation_date DESC LIMIT $num OFFSET $start_page) all_user_dates
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