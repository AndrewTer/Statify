<?
  // Сколько всего пользователей и на каком месте находится текущий пользователь
  $query_stat_main_all = pg_query("SELECT 
                                		(SELECT COUNT(*) FROM users) as all_users, -- 0
                                		-----------------------------------------------
		                                (SELECT among_all.row_number
		                                 FROM (
		                                 		SELECT u.uuid
			                                 			   ,ROW_NUMBER () OVER (ORDER BY COALESCE(NULLIF(us.maximum_user_score , 0), 0)DESC)
		                                 		FROM users u
		                                 				LEFT JOIN users_statistics us
                                               ON u.uuid = us.user_uuid
		                                 	  ) among_all
		                                 WHERE among_all.uuid = '{$user_uuid}'
		                                ) as user_among_all -- 1
                            	")
            			or trigger_error(pg_last_error().$query_stat_main_all);

  if($row_stat_main_all = pg_fetch_row($query_stat_main_all))
  {
    $all_users = $row_stat_main_all[0];
    $user_among_all = $row_stat_main_all[1];
  }

  // Сколько всего пользователей того же пола что и пол у текущего пользователя и на каком месте 
  // находится текущий пользователь
  if ($user_gender_uuid)
  {
	  $query_stat_main_gender = pg_query("SELECT 
		                                		(SELECT COUNT(users.*) 
		                                		 FROM users 
		                                		 	  	LEFT JOIN genders
		                                		 	  		 		 ON genders.uuid = users.gender
		                                		 WHERE genders.uuid = '{$user_gender_uuid}' ) as all_gender_users, -- 0
		                                		 -------------------------------------------------------------
		                                		(SELECT rating_result.position
			                                	 FROM (SELECT users.uuid
			                                								,ROW_NUMBER() OVER (ORDER BY COALESCE(NULLIF(users_statistics.maximum_user_score, 0), 0)DESC) as position
			                                		 		 FROM users
			                                		 					LEFT JOIN genders
			                                		 						 		 ON genders.uuid = users.gender
			                                		 					LEFT JOIN users_statistics
                                               						 ON users.uuid = users_statistics.user_uuid
			                                		 		 WHERE genders.uuid = '{$user_gender_uuid}'
			                                				) rating_result
			                                	 WHERE rating_result.uuid = '{$user_uuid}'
		                                		) as user_among_gender -- 1
	                            				")
	            				or trigger_error(pg_last_error().$query_stat_main_gender);

	  if($row_stat_main_gender = pg_fetch_row($query_stat_main_gender))
	  {
	    $all_gender_users = $row_stat_main_gender[0];
	    $user_among_gender = $row_stat_main_gender[1];
	  }
	} else {
		$all_gender_users = 0;
		$user_among_gender = 0;
	}

  // Сколько всего пользователей, которые являются друзьями текущего пользователя + сам текущий пользователь
  // и на каком месте находится текущий пользователь
  $query_stat_main_friends = pg_query("SELECT
  																			(SELECT COUNT(*)+1
  																			 FROM friends
  																			 WHERE first_uuid = '{$user_uuid}' 
  																			 			 OR second_uuid = '{$user_uuid}') as all_friends_users, -- 0
  																			(
  																				SELECT rating_result.position
  																				FROM (SELECT result.friend_uuid
  																										 ,ROW_NUMBER() OVER (ORDER BY COALESCE(NULLIF(result.score, 0), 0) DESC) as position
  																							FROM (
  																											SELECT u.uuid as friend_uuid,
  																														 us.maximum_user_score as score
  																											FROM friends f
  																													 LEFT JOIN users u
  																													 				ON u.uuid = f.second_uuid
  																													 LEFT JOIN users_statistics us
                                               											ON u.uuid = us.user_uuid
  																											WHERE f.first_uuid = '{$user_uuid}'
  																											UNION ALL
  																											SELECT u.uuid as friend_uuid,
  																														 us.maximum_user_score as score
  																											FROM friends f
  																													 LEFT JOIN users u
  																													 				ON u.uuid = f.first_uuid
  																													 LEFT JOIN users_statistics us
                                               											ON u.uuid = us.user_uuid
  																											WHERE f.second_uuid = '{$user_uuid}'
  																											UNION ALL
  																											SELECT u.uuid as friend_uuid,
  																														 us.maximum_user_score as score
  																											FROM users u
  																													 LEFT JOIN users_statistics us
                                               											ON u.uuid = us.user_uuid
  																											WHERE u.uuid = '{$user_uuid}'
  																									 ) result
  																						 ) rating_result
  																				WHERE rating_result.friend_uuid = '{$user_uuid}'
  																			) as user_among_friends -- 1
  																		")
  									or trigger_error(pg_last_error().$query_stat_main_friends);

  if($row_stat_main_friends = pg_fetch_row($query_stat_main_friends))
  {
  	$all_friends_users = $row_stat_main_friends[0];
  	$user_among_friends = $row_stat_main_friends[1];
  }

  // Сколько всего пользователей, которые проживают в том же городе что и текущий пользователь и на каком
  // месте находится текущий пользователь
  if ($user_city_uuid)
  {
	  $query_stat_main_city = pg_query("SELECT
	  																		(SELECT COUNT(users.*)
	  																		 FROM users
	  																		 			LEFT JOIN cities
	  																		 						 ON cities.uuid = users.city_uuid
	  																		 WHERE cities.uuid = '{$user_city_uuid}' ) as all_city_users, -- 0
	  																		 --------------------------------------------------------------
	  																		(SELECT rating_result.position
			                                	 FROM (SELECT users.uuid
			                                								,ROW_NUMBER() OVER (ORDER BY COALESCE(NULLIF(users_statistics.maximum_user_score, 0), 0) DESC) as position
			                                		 		 FROM users
			                                		 					LEFT JOIN cities
			                                		 						 		 ON cities.uuid = users.city_uuid
			                                		 					LEFT JOIN users_statistics
                                               						 ON users.uuid = users_statistics.user_uuid
			                                		 		 WHERE cities.uuid = '{$user_city_uuid}'
			                                				) rating_result
			                                	 WHERE rating_result.uuid = '{$user_uuid}'
		                                		) as user_among_city -- 1
	  																	")
	  								or trigger_error(pg_last_error().$query_stat_main_city);

	  if($row_stat_main_city = pg_fetch_row($query_stat_main_city))
	  {
	  	$all_city_users = $row_stat_main_city[0];
	  	$user_among_city = $row_stat_main_city[1];
	  }
	}else {
		$all_city_users = 0;
		$user_among_city = 0;
	}

  // Сколько всего пользователей, которые проживают в той же стране что и текущий пользователь и на каком
  // месте находится текущий пользователь
  if ($user_country_uuid)
  {
	  $query_stat_main_country = pg_query("SELECT
	  																			(SELECT COUNT(users.*)
	  																			 FROM users
	  																			 			LEFT JOIN countries
	  																			 						 ON countries.uuid = users.country_uuid
	  																			 WHERE countries.uuid = '{$user_country_uuid}' ) as all_country_users, -- 0
	  																			 --------------------------------------------------------------
		  																		(SELECT rating_result.position
				                                	 FROM (SELECT users.uuid
				                                								,ROW_NUMBER() OVER (ORDER BY COALESCE(NULLIF(users_statistics.maximum_user_score, 0), 0) DESC) as position
				                                		 		 FROM users
				                                		 					LEFT JOIN countries
				                                		 						 		 ON countries.uuid = users.country_uuid
				                                		 					LEFT JOIN users_statistics
                                               						 ON users.uuid = users_statistics.user_uuid
				                                		 		 WHERE countries.uuid = '{$user_country_uuid}'
				                                				) rating_result
				                                	 WHERE rating_result.uuid = '{$user_uuid}'
			                                		) as user_among_country -- 1
	  																		")
	  								or trigger_error(pg_last_error().$query_stat_main_country);

	  if($row_stat_main_country = pg_fetch_row($query_stat_main_country))
	  {
	  	$all_country_users = $row_stat_main_country[0];
	  	$user_among_country = $row_stat_main_country[1];
	  }
	}else {
		$all_country_users = 0;
		$user_among_country = 0;
	}
?>