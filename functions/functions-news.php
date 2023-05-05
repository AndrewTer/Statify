<?php
	function get_recent_registered_users_list($limit)
  {
  	$recent_registered_users_array = [];

  	$limit_text = 'LIMIT '.$limit;

		$recent_registered_users_query = pg_query("SELECT u.uuid 
																								FROM users u
																								WHERE avatar_uuid IS NOT NULL
																								ORDER BY u.creation_date DESC 
																								$limit_text") or trigger_error(pg_last_error().$recent_registered_users_query);

		if ($recent_registered_users_result = pg_fetch_array($recent_registered_users_query))
		{
	    $recent_registered_users_num = 0;

	    do {
	    	$recent_registered_users_array[$recent_registered_users_num]['user_uuid'] = $recent_registered_users_result[0];
				$recent_registered_users_num++;
	    }while($recent_registered_users_result = pg_fetch_array($recent_registered_users_query));

	    return $recent_registered_users_array;
		}else
			return null;    
  }

  function get_current_user_feed_news_list($page, $num)
  {
  	if (!empty($_COOKIE['login']) and !empty($_COOKIE['key']))
		{
			$cookie_login = $_COOKIE['login'];
      $cookie_key = $_COOKIE['key'];
      $user_uuid_query = get_user_uuid_by_cookie($cookie_login, $cookie_key);

      $feed_count_query = pg_query("SELECT Count(result.*) 
                                    FROM (
                                    	SELECT photos.user_uuid
																							,photos.photo_name
																							,photos.creation_date
																			FROM users_photos photos
																				 	JOIN friends  
																				 		ON photos.user_uuid = friends.first_uuid
																				 				AND friends.second_uuid = '{$user_uuid_query}'
																			UNION ALL
																			SELECT photos.user_uuid
																							,photos.photo_name
																							,photos.creation_date
																			FROM users_photos photos
																				 	JOIN friends  
																				 		ON photos.user_uuid = friends.second_uuid
																				 				AND friends.first_uuid = '{$user_uuid_query}'
                                  	) as result")
                              or trigger_error(pg_last_error().$feed_count_query);

      if ($feed_count_result = pg_fetch_row($feed_count_query))
        $feed_count = $feed_count_result[0];
      else $feed_count = 0;

      $total_count_feed_pages = intval(($feed_count - 1) / $num) + 1;

      if (empty($page) || $page < 0) $page = 1;
      if ($page > $total_count_feed_pages) $page = $total_count_feed_pages;

      $start_page = $page * $num - $num;

			$feed_news_list = [];

			$feed_news_list_query = pg_query("SELECT photos.user_uuid
																								,photos.photo_name
																								,photos.creation_date
																				 FROM users_photos photos
																				 			JOIN friends  
																				 				ON photos.user_uuid = friends.first_uuid
																				 					 AND friends.second_uuid = '{$user_uuid_query}'
																				 UNION ALL
																				 SELECT photos.user_uuid
																								,photos.photo_name
																								,photos.creation_date
																				 FROM users_photos photos
																				 			JOIN friends  
																				 				ON photos.user_uuid = friends.second_uuid
																				 					 AND friends.first_uuid = '{$user_uuid_query}'
																				 ORDER BY creation_date DESC
																				 LIMIT $num
																				 OFFSET $start_page") or trigger_error(pg_last_error().$feed_news_list_query);

			if ($feed_news_list_result = pg_fetch_array($feed_news_list_query))
			{
			  $feed_news_num = 0;

			  do {
			  	$feed_news_list[$feed_news_num]['user_uuid'] = $feed_news_list_result[0];
			  	$feed_news_list[$feed_news_num]['photos'] = $feed_news_list_result[1];
			  	$feed_news_list[$feed_news_num]['creation_date'] = $feed_news_list_result[2];
			  	$feed_news_list[$feed_news_num]['total_count_feed_pages'] = $total_count_feed_pages;
					$feed_news_num++;
			  }while($feed_news_list_result = pg_fetch_array($feed_news_list_query));

			  return $feed_news_list;
			}
		}else
			return null;
  }
?>