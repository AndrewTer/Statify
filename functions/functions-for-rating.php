<?php
	function get_new_rating_card($user_uuid)
	{
		if (!empty($user_uuid) && isset($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
		{
			$new_rating_card_query_text = "SELECT rating_photo.profile_picture
										   								FROM users_avatars rating_photo
																				 	LEFT JOIN users
																				 				ON rating_photo.user_uuid = users.uuid
																			WHERE rating_photo.user_uuid != '{$user_uuid}'
																						-- не стоит оценка 1-5
																					  AND NOT EXISTS (
																					  	SELECT 1
																					  	FROM rating
																					  	WHERE author = '{$user_uuid}'
																					  		  AND photo_uuid = rating_photo.uuid
																					  		  AND mark != 7
																					  )
																					  -- имеется подтверждённый email
																					  AND EXISTS (SELECT * FROM users_technical_data WHERE user_uuid = rating_photo.user_uuid AND email_confirmed = true)
																					  -- пол равен препочтениям пользователя
																					  AND users.gender = (SELECT gender_preference FROM users WHERE uuid = '{$user_uuid}')
																					  -- возраст попадает в диапазон предпочтений пользователя
																					  AND date_part('year', age(users.birthday)) >= (SELECT minimum_age_preference FROM users WHERE uuid = '{$user_uuid}')
																					  AND date_part('year', age(users.birthday)) <= (SELECT maximum_age_preference FROM users WHERE uuid = '{$user_uuid}')
																					  -- пользователь не забанен
																					  AND NOT EXISTS (SELECT * FROM banned_users WHERE user_uuid = rating_photo.user_uuid AND (permanent_ban_identifier = 1 OR finish_date > NOW()))
																					  -- отсутствует запись 'фотографии оценивать могут только друзья' или пользователи являются друзьями
																					  AND (EXISTS (SELECT * FROM users_technical_data WHERE user_uuid = rating_photo.user_uuid AND rate_photos_for_only_friends = false)
																					  		OR EXISTS (SELECT * FROM friends 
																					  								WHERE (first_uuid = rating_photo.user_uuid AND second_uuid = '{$user_uuid}') 
																					  											OR (second_uuid = rating_photo.user_uuid AND first_uuid = '{$user_uuid}')))
																			ORDER BY RANDOM()
																			LIMIT 1";


			$new_rating_card_query = pg_query($new_rating_card_query_text)
										or trigger_error(pg_last_error().$new_rating_card_query);

			if ($new_rating_card_result = pg_fetch_array($new_rating_card_query))
			{
				$new_rating_card_uuid = $new_rating_card_result[0];
				return $new_rating_card_uuid;
			}else
				return null;
		}else
			return null;
	}

	function get_list_of_photos_to_rate($user_uuid, $limit, $offset)
	{
		if (!empty($user_uuid) && isset($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
		{
			$limit_and_offset_text = '';

			if (isset($limit))
			{
				$limit_and_offset_text = (isset($offset)) ? 'LIMIT '.$limit.' OFFSET '.$offset : 'LIMIT '.$limit;
			}else
				$limit_and_offset_text = '';

			$photo_array_for_rating_query = pg_query("SELECT rating_photo.user_uuid,
		                                                   rating_photo.profile_picture
		                                            FROM users_avatars rating_photo
		                                                LEFT JOIN users
		                                                      ON rating_photo.user_uuid = users.uuid
		                                            WHERE rating_photo.user_uuid != '{$user_uuid}'
		                                                  -- не стоит оценка 1-5
		                                                  AND NOT EXISTS (
		                                                    SELECT 1
		                                                    FROM rating
		                                                    WHERE author = '{$user_uuid}'
		                                                        AND photo_uuid = rating_photo.uuid
		                                                        AND mark != 7
		                                                  )
		                                                  -- имеется подтверждённый email
		                                                  AND EXISTS (SELECT * FROM users_technical_data WHERE user_uuid = rating_photo.user_uuid AND email_confirmed = true)
		                                                  -- пол равен препочтениям пользователя
		                                                  AND users.gender = (SELECT gender_preference FROM users WHERE uuid = '{$user_uuid}')
		                                                  -- возраст попадает в диапазон предпочтений пользователя
		                                                  AND date_part('year', age(users.birthday)) >= (SELECT minimum_age_preference FROM users WHERE uuid = '{$user_uuid}')
		                                                  AND date_part('year', age(users.birthday)) <= (SELECT maximum_age_preference FROM users WHERE uuid = '{$user_uuid}')
		                                                  -- пользователь не забанен
		                                                  AND NOT EXISTS (SELECT * FROM banned_users WHERE user_uuid = rating_photo.user_uuid AND (permanent_ban_identifier = 1 OR finish_date > NOW()))
		                                                  -- отсутствует запись 'фотографии оценивать могут только друзья' или пользователи являются друзьями
		                                                  AND (EXISTS (SELECT * FROM users_technical_data WHERE user_uuid = rating_photo.user_uuid AND rate_photos_for_only_friends = false)
		                                                      OR EXISTS (SELECT * FROM friends 
		                                                                  WHERE (first_uuid = rating_photo.user_uuid AND second_uuid = '{$user_uuid}') 
		                                                                        OR (second_uuid = rating_photo.user_uuid AND first_uuid = '{$user_uuid}')))
		                                            ORDER BY RANDOM()
		                                            $limit_and_offset_text") or trigger_error(pg_last_error().$photo_array_for_rating_query);

		  if ($photo_array_for_rating_result = pg_fetch_array($photo_array_for_rating_query))
		  {
		    $photo_array_for_rating_num = 0;

		    do {
		      $photo_array_for_rating[$photo_array_for_rating_num]['user_uuid'] = $photo_array_for_rating_result[0];
		      $photo_array_for_rating[$photo_array_for_rating_num]['photo_name'] = $photo_array_for_rating_result[1];
		      $photo_array_for_rating_num++;
		    }while($photo_array_for_rating_result = pg_fetch_array($photo_array_for_rating_query));

		    return $photo_array_for_rating;
		  }
		}else
			return null;
	}

	function get_user_uuid_by_rating_photo($rating_photo)
	{
		if (!empty($rating_photo))
		{
			$user_uuid_query = pg_query("SELECT user_uuid FROM users_avatars WHERE profile_picture = '{$rating_photo}'")
								or trigger_error(pg_last_error().$user_uuid_query);

			if ($user_uuid_result = pg_fetch_array($user_uuid_query))
			{
				return $user_uuid_result[0];
			}else
				return null;
		}else
			return null;
	}
?>