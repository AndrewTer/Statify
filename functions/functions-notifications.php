<?php
	function comment_notification($author_uuid, $current_user_uuid, $picture_name, $comment_uuid, $datetime, $status)
	{
		if (!empty($author_uuid) && !empty($current_user_uuid) &&
				!empty($picture_name) && !empty($comment_uuid) && !empty($datetime) &&
				(preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $author_uuid)) &&
				(preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $current_user_uuid)) &&
				(preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $comment_uuid)))
		{
			$author_gender = get_user_gender($author_uuid);
			$author_fullname = get_user_fullname($author_uuid);
			$author_name = get_user_name($author_uuid);
			$author_surname = get_user_surname($author_uuid);
			$author_nickname = get_user_nickname($author_uuid);
			$author_premium_status = check_premium_active($author_uuid);
			$author_hash_modal = sha1($author_uuid.$comment_uuid);

			$ban_check = ban_check($author_uuid);
			$picture_uuid = get_photo_uuid_by_name($picture_name);
			$comment_text = get_comment_text($comment_uuid);

			$user_info_fullname = get_user_fullname($current_user_uuid);
?>
			<div class="notifications-card <?= ($status != 1) ? 'new-notification' : ''; ?> m-0 mb-3 p-2 pl-3 pr-3 w-100 d-flex flex-row">
				<div class="w-100 m-0 mr-2 p-1 d-flex notifications-card-content">
					<div class="notifications-author-card-avatar d-flex align-items-start justify-content-start p-0 mr-3">
<?
					$preview_photo_check = file_exists('users/'.$author_uuid.'/'.get_user_avatar_preview($author_uuid)) ? 1 : 0;

					if ($ban_check == 'success')
						if (!is_null(check_user_online_status($author_uuid))) 
							if (get_user_avatar($author_uuid))
								echo '<img class="rounded-circle online m-0 p-0 w-100" 
											src="users/'.$author_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($author_uuid) : get_user_avatar($author_uuid)).'" 
											alt="'.$author_fullname.'" 
											onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$author_uuid.'\',\''.get_user_avatar($author_uuid).'\');">';
							else
								echo '<img class="rounded-circle online m-0 p-0 w-100" 
											src="imgs/no-avatar.png" 
											alt="'.$author_fullname.'">';
						else
							if (get_user_avatar($author_uuid))
								echo '<img class="rounded-circle offline m-0 p-0 w-100" 
											src="users/'.$author_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($author_uuid) : get_user_avatar($author_uuid)).'" 
											alt="'.$author_fullname.'" 
											onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$author_uuid.'\',\''.get_user_avatar($author_uuid).'\');">';
							else
								echo '<img class="rounded-circle offline m-0 p-0 w-100" 
											src="imgs/no-avatar.png" 
											alt="'.$author_fullname.'">';
					else
						if (get_user_avatar($author_uuid))
							echo '<img class="rounded-circle offline m-0 p-0 w-100" 
										src="users/'.$author_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($author_uuid) : get_user_avatar($author_uuid)).'" 
										alt="'.$author_fullname.'" 
										onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$author_uuid.'\',\''.get_user_avatar($author_uuid).'\');">';
						else
							echo '<img class="rounded-circle offline m-0 p-0 w-100" 
										src="imgs/no-avatar.png" 
										alt="'.$author_fullname.'">';
?>
					</div>

					<div class="w-100 p-0">
						<div class="m-0 p-0 d-flex flex-row align-items-center">
							<a class="notifications-user-fullname pointer font-weight-bold" href="./?u=<?= get_user_nickname($author_uuid); ?>">
<?
							if ($author_premium_status)
							{
?>
								<p class="row m-0 fz-16 d-flex align-items-center"><?= ($author_name || $author_surname) ? $author_fullname : 'Имя не указано'; ?>
		              <svg class="ml-2 premium-star active" width="15px" height="15px" viewBox="0 0 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#2ACAEA" stroke-width="0.00048000000000000007" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
		                <defs>  
		                  <linearGradient id="premium-logo-gradient-<?= $author_hash_modal; ?>" x1="50%" y1="0%" x2="50%" y2="100%" > 
		                    <stop offset="0%" stop-color="#7A5FFF">
		                      <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
		                    </stop>
		                    <stop offset="100%" stop-color="#01FF89">
		                      <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
		                    </stop>
		                  </linearGradient> 
		                </defs>
		                <g>
		                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8712 33.0436L15.9976 44.7036C15.9362 45.5229 16.6646 46.0872 17.3161 45.722C21.9289 43.1382 36.3783 33.6479 43.7017 12.7899C44.0376 11.8331 43.1352 10.9697 42.3646 11.5094C38.0387 14.539 28.5846 20.8006 22.7421 21.9934C22.7421 21.9934 26.4836 19.3946 28.7231 15.4053C28.9426 15.0143 28.9244 14.5136 28.6796 14.1606L20.5127 2.38925C20.0287 1.69147 19.0354 1.98057 18.8606 2.87002L16.3181 15.8073L4.38437 26.2226C3.78602 26.7446 3.90808 27.7996 4.5989 28.079L16.8712 33.0436Z" fill="url('#premium-logo-gradient-<?= $author_hash_modal; ?>')"></path> 
		                  <path fill-rule="evenodd" clip-rule="evenodd" d="M37.9745 28.448C37.2188 29.5025 35.5908 31.6717 34.0876 32.9974C33.7871 33.2624 33.8276 33.7068 34.1724 33.9234L42.1145 38.909C42.5926 39.2091 43.2384 38.8529 43.1576 38.3323C42.7882 35.9496 41.7237 30.9818 39.0328 28.3741C38.7322 28.083 38.2142 28.1136 37.9745 28.448Z" fill="url('#premium-logo-gradient-<?= $author_hash_modal; ?>')"></path> 
		                </g>
		              </svg>
		            </p>
<?
							}else
							{
?>
								<p class="row m-0 fz-16"><?= ($author_name || $author_surname) ? $author_fullname : 'Имя не указано'; ?></p>
<?
							}
?>
							</a>
							<p class="m-0 ml-2 fz-10"><?= corrected_date_with_text_month(date($datetime)); ?></p>
						</div>
					  <hr class="hr-user-info m-0 mt-1 mb-1">
					  <p class="w-100 m-0 p-0">
<?
						switch ($author_gender) {
							case 'male':
								echo 'Добавил комментарий к вашей <a href="comments?p='.preg_replace('[-]', '', $picture_uuid).'"><em class="notifications-link font-weight-bold">фотографии</em></a>&nbsp;';
								break;

							case 'female':
								echo 'Добавила комментарий к вашей <a href="comments?p='.preg_replace('[-]', '', $picture_uuid).'"><em class="notifications-link font-weight-bold">фотографии</em></a>&nbsp;';
								break;
					        			
							default:
								echo 'Пользователь добавил комментарий к вашей <a href="comments?p='.preg_replace('[-]', '', $picture_uuid).'"><em class="notifications-link font-weight-bold">фотографии</em></a>&nbsp;';
								break;
						}
?>
					  </p>
					  <div class="notifications-author-card-avatar d-flex justify-content-start align-items-center w-100 p-0">
							<a class="m-0 p-0 notifications-comment-text" href="<?= 'comments?p='.preg_replace('[-]', '', $picture_uuid).'#'.preg_replace('[-]', '', $comment_uuid); ?>">
								<blockquote class="m-0 p-0 pt-2 pb-2">
									<p class="p-0 m-0"><?= str_replace(array("\r\n", "\r", "\n"), '<br>', $comment_text); ?></p>
								</blockquote>
							</a>
						</div>
					</div>
				</div>

				<div class="m-0 p-1 d-flex ml-auto notifications-card-body notifications-card-comment-photo">
					<div class="notifications-card-photo-current-user d-flex align-items-center ml-auto p-0">
						<img class="rounded-circle offline m-0 p-0 w-100" src="<?= 'users/'.$current_user_uuid.'/'.$picture_name; ?>" alt="<?= $user_info_fullname; ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$current_user_uuid.'\',\''.$current_user_uuid.'\',\''.$picture_name.'\''; ?>);">
					</div>
				</div>
			</div>
<?
		}else
			return null;
	}

//----------------------------------------------------------------------------------------------------------------

	function request_notification($current_user_uuid, $sender_uuid, $datetime, $status)
	{
		if (!empty($sender_uuid) && !empty($datetime) &&
				(preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $sender_uuid)))
		{
			$sender_gender = get_user_gender($sender_uuid);
			$sender_fullname = get_user_fullname($sender_uuid);
			$sender_name = get_user_name($sender_uuid);
			$sender_surname = get_user_surname($sender_uuid);
			$sender_nickname = get_user_nickname($sender_uuid);

			$sender_premium_status = check_premium_active($sender_uuid);
			$sender_hash_modal = sha1($sender_uuid.$sender_nickname);
?>
			<div class="notifications-card <?= ($status != 1) ? 'new-notification' : ''; ?> m-0 mb-3 p-2 pl-3 pr-3 w-100 d-flex flex-row">
				<div class="w-100 m-0 mr-auto p-1 d-flex notifications-card-content">
					<div class="notifications-author-card-avatar d-flex align-items-center justify-content-start p-0 mr-3">
						<a class="m-0 p-0" href="search.php?q=<?= $sender_nickname; ?>" title="<?= $sender_fullname; ?>">
<?
						$ban_check = ban_check($sender_uuid);
						$preview_photo_check = file_exists('users/'.$sender_uuid.'/'.get_user_avatar_preview($sender_uuid)) ? 1 : 0;

						if ($ban_check == 'success')
							if (!is_null(check_user_online_status($sender_uuid))) 
								if (get_user_avatar($sender_uuid))
									echo '<img class="rounded-circle online m-0 p-0 w-100" 
												src="users/'.$sender_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($sender_uuid) : get_user_avatar($sender_uuid)).'" 
												alt="'.$sender_fullname.'" 
												onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$sender_uuid.'\',\''.get_user_avatar($sender_uuid).'\');">';
								else
									echo '<img class="rounded-circle online m-0 p-0 w-100" 
												src="imgs/no-avatar.png" 
												alt="'.$sender_fullname.'">';
							else
								if (get_user_avatar($sender_uuid))
									echo '<img class="rounded-circle offline m-0 p-0 w-100" 
												src="users/'.$sender_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($sender_uuid) : get_user_avatar($sender_uuid)).'" 
												alt="'.$sender_fullname.'" 
												onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$sender_uuid.'\',\''.get_user_avatar($sender_uuid).'\');">';
								else
									echo '<img class="rounded-circle offline m-0 p-0 w-100" 
												src="imgs/no-avatar.png" 
												alt="'.$sender_fullname.'">';
						else
							if (get_user_avatar($sender_uuid))
								echo '<img class="rounded-circle offline m-0 p-0 w-100" 
											src="users/'.$sender_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($sender_uuid) : get_user_avatar($sender_uuid)).'" 
											alt="'.$sender_fullname.'" 
											onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$sender_uuid.'\',\''.get_user_avatar($sender_uuid).'\');">';
							else
								echo '<img class="rounded-circle offline m-0 p-0 w-100" 
											src="imgs/no-avatar.png" 
											alt="'.$sender_fullname.'">';
?>
						</a>
					</div>

					<div class="w-100 p-0">
						<div class="m-0 p-0 d-flex flex-row align-items-center">
							<a class="notifications-user-fullname pointer font-weight-bold" href="./?u=<?= get_user_nickname($sender_uuid); ?>">
<?
							if ($sender_premium_status)
							{
?>
								<p class="row m-0 fz-16 d-flex align-items-center"><?= ($sender_name || $sender_surname) ? $sender_fullname : 'Имя не указано'; ?>
		              <svg class="ml-2 premium-star active" width="15px" height="15px" viewBox="0 0 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#2ACAEA" stroke-width="0.00048000000000000007" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
		                <defs>  
		                  <linearGradient id="premium-logo-gradient-<?= $sender_hash_modal; ?>" x1="50%" y1="0%" x2="50%" y2="100%" > 
		                    <stop offset="0%" stop-color="#7A5FFF">
		                      <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
		                    </stop>
		                    <stop offset="100%" stop-color="#01FF89">
		                      <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
		                    </stop>
		                  </linearGradient> 
		                </defs>
		                <g>
		                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8712 33.0436L15.9976 44.7036C15.9362 45.5229 16.6646 46.0872 17.3161 45.722C21.9289 43.1382 36.3783 33.6479 43.7017 12.7899C44.0376 11.8331 43.1352 10.9697 42.3646 11.5094C38.0387 14.539 28.5846 20.8006 22.7421 21.9934C22.7421 21.9934 26.4836 19.3946 28.7231 15.4053C28.9426 15.0143 28.9244 14.5136 28.6796 14.1606L20.5127 2.38925C20.0287 1.69147 19.0354 1.98057 18.8606 2.87002L16.3181 15.8073L4.38437 26.2226C3.78602 26.7446 3.90808 27.7996 4.5989 28.079L16.8712 33.0436Z" fill="url('#premium-logo-gradient-<?= $sender_hash_modal; ?>')"></path> 
		                  <path fill-rule="evenodd" clip-rule="evenodd" d="M37.9745 28.448C37.2188 29.5025 35.5908 31.6717 34.0876 32.9974C33.7871 33.2624 33.8276 33.7068 34.1724 33.9234L42.1145 38.909C42.5926 39.2091 43.2384 38.8529 43.1576 38.3323C42.7882 35.9496 41.7237 30.9818 39.0328 28.3741C38.7322 28.083 38.2142 28.1136 37.9745 28.448Z" fill="url('#premium-logo-gradient-<?= $sender_hash_modal; ?>')"></path> 
		                </g>
		              </svg>
		            </p>
<?
							}else
							{
?>
								<p class="row m-0 fz-16"><?= ($sender_name || $sender_surname) ? $sender_fullname : 'Имя не указано'; ?></p>
<?
							}
?>
							</a>
							<p class="m-0 ml-2 fz-10"><?= corrected_date_with_text_month(date($datetime)); ?></p>
						</div>
					  <hr class="hr-user-info m-0 mt-1 mb-1">
					  <p class="w-100 m-0 p-0">
<?
						switch ($sender_gender) {
							case 'male':
								echo 'Отправил вам <a href="friends?sort=received"><em class="notifications-link font-weight-bold">заявку в друзья</em></a>';
								break;

							case 'female':
								echo 'Отправила вам <a href="friends?sort=received"><em class="notifications-link font-weight-bold">заявку в друзья</em></a>';
								break;
					        			
							default:
								echo 'Пользователь отправил вам <a href="friends?sort=received"><em class="notifications-link font-weight-bold">заявку в друзья</em></a>';
								break;
						}
?>
					  </p>
					</div>
				</div>
			</div>
<?
		}else
			return null;
	}
?>