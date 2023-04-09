<?php 
	defined('mystatify');
	include("../functions/functions.php");
	include("../functions/database-functions.php");
	include("../functions/functions-comments.php");
	include("../functions/functions-user-data.php");
	include("../functions/functions-for-check.php");
	require_once(realpath('../includes/connection.php'));

	$result = '';

	//$current_user_nickname = $_POST['nickname'];
	$cookie_login = $_COOKIE['login'];
	$cookie_key = $_COOKIE['key']; 

	$current_user_uuid = get_user_uuid_by_cookie($cookie_login, $cookie_key);
	$page_status = check_user_page_status($current_user_uuid);

	if ($page_status)
	{
		$comments_list = get_current_user_comments_list($current_user_uuid);

		if ($comments_list)
		{
			$result = '<div class="m-0 p-0 w-100" id="block-with-comments-by-user">';

			for ($comments_num = 0; $comments_num < count($comments_list); $comments_num++)
			{
				$comment_uuid = $comments_list[$comments_num]['uuid'];
				$comment_picture_uuid = $comments_list[$comments_num]['picture_uuid'];
				$comment_creation_date = $comments_list[$comments_num]['creation_date'];
				$comment_text = $comments_list[$comments_num]['text'];
				$comment_count_of_replyig = $comments_list[$comments_num]['count_of_replying'];

				$comment_picture_author_uuid = get_user_uuid_by_photo_uuid($comment_picture_uuid);
				$comment_picture_author_fullname = get_user_fullname($comment_picture_author_uuid);
				$comment_picture_name = get_photo_name_by_uuid($comment_picture_uuid);

				$result .= '<div class="notifications-card m-0 mb-3 p-2 pl-3 pr-3 w-100 d-flex flex-row">
											<div class="w-100 m-0 mr-2 p-1 d-flex notifications-card-content">
												<div class="w-100 p-0">
													<div class="m-0 p-0 d-flex flex-row align-items-center">
														<p class="m-0 fz-12 font-weight-bold">'.corrected_date_with_text_month(date($comment_creation_date)).'</p>

														<svg class="m-0 p-0 ml-auto" width="15px" height="15px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="var(--main-menu-icon-color)">
															<path d="M8.098 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L8.8 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L4.114 8.254a.502.502 0 0 0-.042-.028.147.147 0 0 1 0-.252.497.497 0 0 0 .042-.028l3.984-2.933zM9.3 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z"></path>
															<path d="M5.232 4.293a.5.5 0 0 0-.7-.106L.54 7.127a1.147 1.147 0 0 0 0 1.946l3.994 2.94a.5.5 0 1 0 .593-.805L1.114 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.5.5 0 0 0 .042-.028l4.012-2.954a.5.5 0 0 0 .106-.699z"></path>
														</svg>

														<p class="m-0 ml-2 fz-13 font-weight-bold">'.$comment_count_of_replyig.'</p>
													</div>
										  					
													<hr class="hr-user-info m-0 mt-1 mb-1">

													<p class="w-100 m-0 p-0">Комментарий к <a href="comments?p='.preg_replace('[-]', '', $comment_picture_uuid).'"><em class="notifications-link font-weight-bold">фотографии</em></a></p>
													<div class="notifications-author-card-avatar d-flex justify-content-start align-items-center w-100 p-0">
														<a class="m-0 p-0 notifications-comment-text" href="comments?p='.preg_replace('[-]', '', $comment_picture_uuid).'#'.preg_replace('[-]', '', $comment_uuid).'">
															<blockquote class="m-0 p-0 pt-2 pb-2">
																<p class="p-0 m-0">'.str_replace(array("\r\n", "\r", "\n"), '<br>', $comment_text).'</p>
															</blockquote>
														</a>
													</div>
												</div>
											</div>

											<div class="m-0 p-1 d-flex ml-auto notifications-card-body notifications-card-comment-photo">
												<div class="notifications-card-photo-current-user d-flex align-items-center ml-auto p-0">
													<img class="rounded-circle offline m-0 p-0 w-100" src="users/'.$comment_picture_author_uuid.'/'.$comment_picture_name.'" alt="'.$comment_picture_author_fullname.'" onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$comment_picture_author_uuid.'\',\''.$comment_picture_name.'\');">
												</div>
											</div>
										</div>';
			}

			$result .= '</div>';
		}else
			$result = '<h5 class="w-100 m-0 p-5 text-center" id="block-with-comments-by-user">Вы пока не оставляли комментарии</h5>';
	}else
	{
		$user_uuid = $current_user_uuid;
		include("../includes/user_page/registration-completion.php");
	}

	echo $result;	
?>