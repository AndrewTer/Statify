<?php
  function get_photo_uuid_by_name($photo_name)
  {
    if (!empty($photo_name) && isset($photo_name))
    {
        $photo_name_query = pg_query("SELECT uuid FROM users_photos
                                      WHERE photo_name = '{$photo_name}'
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

  function get_photo_name_by_uuid($photo_uuid)
  {
    if (!empty($photo_uuid) && isset($photo_uuid) 
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $photo_uuid)))
    {
        $photo_name_query = pg_query("SELECT photo_name FROM users_photos
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

  function get_photos_count($user_uuid)
  {
    if (!empty($user_uuid) && isset($user_uuid) 
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
      $photos_count_query = pg_query("SELECT Count(*)
                                      FROM users_photos
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
    if (!empty($user_uuid) && isset($user_uuid) 
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
    {
      $num = 1000;
      $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

      $all_photos_count = get_photos_count($user_uuid);

      $total_count_photos_pages = intval(($all_photos_count - 1) / $num) + 1;

      if (empty($page) || $page < 0) $page = 1;
      if ($page > $total_count_photos_pages) $page = $total_count_photos_pages;

      $start_page = $page * $num - $num;

      $photos_array = [];

      $photos_list_query = pg_query("SELECT uuid,
                                            photo_name,
                                            EXTRACT(YEAR FROM creation_date)
                                      FROM users_photos
                                      WHERE user_uuid  = '{$user_uuid}'
                                      ORDER BY creation_date DESC
                                      LIMIT $num
                                      OFFSET $start_page") 
                              or trigger_error($pg_last_error().$photos_list_query);

      if ($photos_list_result = pg_fetch_array($photos_list_query))
      {
        $photos_num = 0;

        do {
          $photos_array[$photos_num]['uuid'] = $photos_list_result[0];
          $photos_array[$photos_num]['name'] = $photos_list_result[1];
          $photos_array[$photos_num]['date'] = $photos_list_result[2];

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
    if (!empty($user_uuid) && isset($user_uuid) 
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
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
                                    FROM (SELECT creation_date FROM users_photos WHERE user_uuid  = '{$user_uuid}' ORDER BY creation_date DESC LIMIT $num OFFSET $start_page) all_user_dates
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

  function get_photos_list_by_tag($tag_text)
  {
    if (!empty($tag_text) && isset($tag_text))
    {
      $tag_uuid = get_tag_uuid_by_text($tag_text);

      if ($tag_uuid)
      {
        $photos_array = [];

        $photos_list_query = pg_query("SELECT up.user_uuid,
                                              up.photo_name
                                        FROM users_photos up
                                             JOIN photos_tags pt ON up.uuid = pt.photo_uuid
                                        WHERE pt.tag_uuid  = '{$tag_uuid}'
                                        ORDER BY creation_date DESC") 
                                or trigger_error($pg_last_error().$photos_list_query);

        if ($photos_list_result = pg_fetch_array($photos_list_query))
        {
          $photos_num = 0;

          do {
            $photos_array[$photos_num]['user_uuid'] = $photos_list_result[0];
            $photos_array[$photos_num]['photo_name'] = $photos_list_result[1];

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

  function get_current_photo_tags($photo_uuid)
  {
    if (!empty($photo_uuid) && isset($photo_uuid) 
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $photo_uuid)))
    {
      $photo_tags_query = pg_query("SELECT tags.tag_text
                                    FROM photos_tags
                                          JOIN tags ON photos_tags.tag_uuid = tags.uuid
                                    WHERE photos_tags.photo_uuid = '{$photo_uuid}'")
                            or trigger_error(pg_last_error().$photo_tags_query);

      if ($photo_tags_result = pg_fetch_row($photo_tags_query))
      {
        $photo_tags_array = [];
        $photo_tags_num = 0;

        do {
          $photo_tags_array[$photo_tags_num] = $photo_tags_result[0];
          $photo_tags_num++;
        }while ($photo_tags_result = pg_fetch_row($photo_tags_query));

        return $photo_tags_array;
      }else
        return null;
    }else
      return null;
  }

  function get_tag_uuid_by_text($tag_text)
  {
    if (!empty($tag_text) && isset($tag_text))
    {
      $tag_uuid_query = pg_query("SELECT uuid FROM tags WHERE tag_text = '{$tag_text}'")
                            or trigger_error(pg_last_error().$tag_uuid_query);

      if ($tag_uuid_result = pg_fetch_row($tag_uuid_query))
      {
        $tag_uuid = $tag_uuid_result[0];
        return $tag_uuid;
      }else
        return null;
    }else
      return null;
  }

  function get_current_tag_count_by_uuid($tag_uuid)
  {
    if (!empty($tag_uuid) && isset($tag_uuid)
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $tag_uuid)))
    {
      $tag_count_query = pg_query("SELECT Count(photos_tags.id)
                                    FROM photos_tags
                                          JOIN tags ON photos_tags.tag_uuid = tags.uuid 
                                    WHERE tags.uuid = '{$tag_uuid}'")
                            or trigger_error(pg_last_error().$tag_count_query);

      if ($tag_count_result = pg_fetch_row($tag_count_query))
      {
        $tag_count = $tag_count_result[0];
        return $tag_count;
      }else
        return 0;
    }else
      return 0;
  }

  function get_current_photo_ratings_count($photo_uuid)
  {
    if (!empty($photo_uuid) && isset($photo_uuid) 
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $photo_uuid)))
    {
      $photo_ratings_count_query = pg_query("SELECT Count(*) FROM rating WHERE photo_uuid = '{$photo_uuid}'")
                            or trigger_error(pg_last_error().$photo_ratings_count_query);

      if ($photo_ratings_count_result = pg_fetch_row($photo_ratings_count_query))
      {
        $photo_ratings_count = $photo_ratings_count_result[0];
        return $photo_ratings_count;
      }else
        return 0;
    }else
      return 0;
  }

  /*function get_current_photo_description($photo_uuid)
  {
    if (!empty($photo_uuid) && isset($photo_uuid) 
        && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $photo_uuid)))
    {
      $photo_description_query = pg_query("SELECT description FROM users_photos WHERE uuid = '$photo_uuid'")
                                or trigger_error(pg_last_error().$photo_description_query);

      if($photo_description_result = pg_fetch_row($photo_description_query))
      {
        $photo_description = $photo_description_result[0];
        return $photo_description;
      } else
        return null;
    }else
      return null;
  }*/
?>