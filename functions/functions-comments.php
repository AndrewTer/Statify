<?php
	function get_comments_list($picture_uuid)
	{
		if (!empty($picture_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $picture_uuid)))
		{
			$comments_array = [];

			$comments_list_query = pg_query("SELECT uuid, author_uuid, replying_comment_uuid, creation_date, text
											  FROM users_comments 
											  WHERE picture_uuid = '{$picture_uuid}' AND (deleted != 1 OR deleted IS NULL)								
											  ORDER BY creation_date") 
										or trigger_error($pg_last_error().$comments_list_query);

			if ($comments_list_result = pg_fetch_array($comments_list_query))
			{
				$comments_num = 0;

				do {
						$comments_array[$comments_num]['uuid'] = $comments_list_result[0];
						$comments_array[$comments_num]['author_uuid'] = $comments_list_result[1];
						$comments_array[$comments_num]['replying_comment_uuid'] = $comments_list_result[2];
						$comments_array[$comments_num]['creation_date'] = $comments_list_result[3];
						$comments_array[$comments_num]['text'] = $comments_list_result[4];

						$comments_num++;
				}while($comments_list_result = pg_fetch_array($comments_list_query));

				return $comments_array;
			}else
				return $comments_array;

		}else
			return null;
	}

	function get_current_user_comments_list($user_uuid)
	{
		if (!empty($user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
		{
			$comments_array = [];

			$comments_list_query = pg_query("SELECT uc.uuid, uc.picture_uuid, uc.creation_date, uc.text, Count(ucc.*) as count_of_replying
																				FROM public.users_comments uc
																					 LEFT JOIN public.users_comments ucc
																					 		ON uc.uuid = ucc.replying_comment_uuid
																					 			 AND ucc.deleted != 1
																				WHERE uc.author_uuid = '{$user_uuid}' AND uc.deleted != 1
																				GROUP BY uc.uuid
																				ORDER BY uc.creation_date DESC") 
																		or trigger_error($pg_last_error().$comments_list_query);

			if ($comments_list_result = pg_fetch_array($comments_list_query))
			{
				$comments_num = 0;

				do {
						$comments_array[$comments_num]['uuid'] = $comments_list_result[0];
						$comments_array[$comments_num]['picture_uuid'] = $comments_list_result[1];
						$comments_array[$comments_num]['creation_date'] = $comments_list_result[2];
						$comments_array[$comments_num]['text'] = $comments_list_result[3];
						$comments_array[$comments_num]['count_of_replying'] = $comments_list_result[4];

						$comments_num++;
				}while($comments_list_result = pg_fetch_array($comments_list_query));

				return $comments_array;
			}else
				return $comments_array;

		}else
			return null;
	}

	function get_comment_text($comment_uuid)
	{
		if (!empty($comment_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $comment_uuid)))
		{
			$comment_text_query = pg_query("SELECT text FROM users_comments WHERE uuid = '{$comment_uuid}'")
									or trigger_error($pg_last_error().$comment_text_query);

			if ($comments_text_result = pg_fetch_array($comment_text_query))
			{
				$comment_text = $comments_text_result[0];

				return $comment_text;
			}else
				return null;
		}else
			return null;
	}

	function get_user_uuid_by_comment_uuid_referenced($comment_uuid)
	{
		if (!empty($comment_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $comment_uuid)))
		{
			$user_uuid_query = pg_query("SELECT uc.author_uuid FROM users_comments uc WHERE uc.uuid = (SELECT replying_comment_uuid FROM users_comments WHERE uuid = '{$comment_uuid}')")
									or trigger_error($pg_last_error().$user_uuid_query);

			if ($user_uuid_result = pg_fetch_array($user_uuid_query))
			{
				$user_uuid = $user_uuid_result[0];

				return $user_uuid;
			}else
				return null;
		}else
			return null;
	}
?>