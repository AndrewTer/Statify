<?php
	function get_recent_registered_users_list($limit)
  {
  	$recent_registered_users_array = [];

  	$limit_text = 'LIMIT '.$limit;

		$recent_registered_users_query = pg_query("SELECT u.uuid 
																								FROM users u
																								WHERE EXISTS (SELECT * FROM users_avatars WHERE user_uuid = u.uuid)
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

//----------------------------------------------------------------------------------------------------------------

	function new_friend_news($current_user_uuid, $user_uuid, $friend_uuid)
	{
		if (!empty($current_user_uuid) && !empty($user_uuid) && !empty($friend_uuid))
		{
			$user_info_fullname = get_user_fullname($user_uuid);
			$user_info_name = get_user_name($user_uuid);
			$user_info_surname = get_user_surname($user_uuid);
			$user_info_nickname = get_user_nickname($user_uuid);
			$user_info_avatar = get_latest_avatar($user_uuid);
			$user_info_gender = get_user_gender($user_uuid);

			$friend_info_nickname = get_user_nickname($friend_uuid);
			$ban_check = ban_check($user_uuid);
			$hash_modal = sha1($friend_uuid.$user_uuid);
			$premium_status = check_premium_active($user_uuid);
?>
			<div class="news-card m-0 mb-3 p-2 pl-3 pr-3">
				<div class="w-100 m-0 p-1 d-flex flex-row news-card-header">
					<div class="news-friend-card-avatar d-flex align-items-center justify-content-start p-0 mr-3">
<?
					$preview_photo_check = file_exists('users/'.$user_uuid.'/'.get_latest_avatar_preview($user_uuid)) ? 1 : 0;
					if ($ban_check == 'success')
						if (!is_null(check_user_online_status($user_uuid))) 
							if ($user_info_avatar)
								echo '<img class="rounded-circle online m-0 p-0 w-100" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($user_uuid) : $user_info_avatar).'" alt="'.$user_info_fullname.'" onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$user_info_avatar.'\');">';
							else
							
								echo '<img class="rounded-circle online m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$user_info_fullname.'">';
						else
							if ($user_info_avatar)
								echo '<img class="rounded-circle offline m-0 p-0 w-100" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($user_uuid) : $user_info_avatar).'" alt="'.$user_info_fullname.'" onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$user_info_avatar.'\');">';
							else
								echo '<img class="rounded-circle offline m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$user_info_fullname.'">';
					else
						if ($user_info_avatar)
							echo '<img class="rounded-circle offline m-0 p-0 w-100" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($user_uuid) : $user_info_avatar).'" alt="'.$user_info_fullname.'"
								onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$user_info_avatar.'\');">';
						else
							echo '<img class="rounded-circle offline m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$user_info_fullname.'">';
?>
					</div>

					<div class="w-100 p-0">
<?
					if ($premium_status)
          {
?>
						<a href="./?u=<?= get_user_nickname($user_uuid); ?>" class="news-user-fullname pointer">
							<p class="row m-0 fz-16 d-flex align-items-center"><?= ($user_info_name || $user_info_surname) ? $user_info_fullname : 'Имя не указано'; ?>
	              <svg class="ml-2 premium-star active" width="15px" height="15px" viewBox="0 0 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#2ACAEA" stroke-width="0.00048000000000000007" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
	                <defs>  
	                  <linearGradient id="premium-logo-gradient-<?= $hash_modal; ?>" x1="50%" y1="0%" x2="50%" y2="100%" > 
	                    <stop offset="0%" stop-color="#7A5FFF">
	                      <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
	                    </stop>
	                    <stop offset="100%" stop-color="#01FF89">
	                      <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
	                    </stop>
	                  </linearGradient> 
	                </defs>
	                <g>
	                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8712 33.0436L15.9976 44.7036C15.9362 45.5229 16.6646 46.0872 17.3161 45.722C21.9289 43.1382 36.3783 33.6479 43.7017 12.7899C44.0376 11.8331 43.1352 10.9697 42.3646 11.5094C38.0387 14.539 28.5846 20.8006 22.7421 21.9934C22.7421 21.9934 26.4836 19.3946 28.7231 15.4053C28.9426 15.0143 28.9244 14.5136 28.6796 14.1606L20.5127 2.38925C20.0287 1.69147 19.0354 1.98057 18.8606 2.87002L16.3181 15.8073L4.38437 26.2226C3.78602 26.7446 3.90808 27.7996 4.5989 28.079L16.8712 33.0436Z" fill="url('#premium-logo-gradient-<?= $hash_modal; ?>')"></path> 
	                  <path fill-rule="evenodd" clip-rule="evenodd" d="M37.9745 28.448C37.2188 29.5025 35.5908 31.6717 34.0876 32.9974C33.7871 33.2624 33.8276 33.7068 34.1724 33.9234L42.1145 38.909C42.5926 39.2091 43.2384 38.8529 43.1576 38.3323C42.7882 35.9496 41.7237 30.9818 39.0328 28.3741C38.7322 28.083 38.2142 28.1136 37.9745 28.448Z" fill="url('#premium-logo-gradient-<?= $hash_modal; ?>')"></path> 
	                </g>
	              </svg>
            	</p>
						</a>
<?
					}else
          {
?>
						<a href="./?u=<?= get_user_nickname($user_uuid); ?>" class="news-user-fullname pointer">
							<p class="row m-0 fz-16"><?= ($user_info_name || $user_info_surname) ? $user_info_fullname : 'Имя не указано'; ?></p>
						</a>
<?
          }
?>
						<hr class="hr-user-info m-0 mt-1 mb-1">
						<p class="w-100 m-0 p-0">
<?
						switch ($user_info_gender) {
							case 'male':
								echo 'Добавил в друзья&nbsp;';
								break;

							case 'female':
								echo 'Добавила в друзья&nbsp;';
								break;
						        			
							default:
								echo 'Пользователь добавил в друзья&nbsp;';
								break;
						}
?>
							<a class="pointer" href="./?u=<?= get_user_nickname($friend_uuid); ?>">
								<em class="news-user-link"><?= ($friend_info_nickname) ? '@'.$friend_info_nickname : ''; ?></em>
							</a>

						</p>
					</div>
				</div>
			</div>
<?
		}else
			return null;
	};

//----------------------------------------------------------------------------------------------------------------

	function new_profile_photo_news($current_user_uuid, $user_uuid, $old_photo, $new_photo)
	{
		if (!empty($current_user_uuid) && !empty($user_uuid) && !empty($new_photo))
		{
			$user_info_fullname = get_user_fullname($user_uuid);
			$user_info_name = get_user_name($user_uuid);
			$user_info_surname = get_user_surname($user_uuid);
			$user_info_nickname = get_user_nickname($user_uuid);
			$user_info_gender = get_user_gender($user_uuid);
			$user_info_avatar = get_latest_avatar($user_uuid);

			$ban_check = ban_check($user_uuid);
			$hash_modal = sha1($user_uuid.$old_photo.$new_photo);
			$premium_status = check_premium_active($user_uuid);
?>

			<div class="news-card m-0 mb-3 p-2 pl-3 pr-3">
				<div class="w-100 m-0 p-1 d-flex flex-row news-card-header">
				  	<div class="news-friend-card-avatar d-flex align-items-center justify-content-center p-0 mr-3">
<?						
					$preview_photo_check = file_exists('users/'.$user_uuid.'/'.get_latest_avatar_preview($user_uuid)) ? 1 : 0;
					if ($ban_check == 'success')
						if (!is_null(check_user_online_status($user_uuid))) 
							if ($user_info_avatar)
								echo '<img class="rounded-circle online m-0 p-0 w-100" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($user_uuid) : $user_info_avatar).'" alt="'.$user_info_fullname.'" onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$user_info_avatar.'\');">';
							else
								echo '<img class="rounded-circle online m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$user_info_fullname.'">';
						
						else
							if ($user_info_avatar)
								echo '<img class="rounded-circle offline m-0 p-0 w-100" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($user_uuid) : $user_info_avatar).'" alt="'.$user_info_fullname.'" onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$user_info_avatar.'\');">';
							else
								echo '<img class="rounded-circle offline m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$user_info_fullname.'">';
					else
						if ($user_info_avatar)
							echo '<img class="rounded-circle offline m-0 p-0 w-100" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($user_uuid) : $user_info_avatar).'" alt="'.$user_info_fullname.'"
								onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$user_info_avatar.'\');">';
						else
							echo '<img class="rounded-circle offline m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$user_info_fullname.'">';
?>
					</div>

					<div class="w-100 p-0">
<?
					if ($premium_status)
          {
?>
						<a href="./?u=<?= get_user_nickname($user_uuid); ?>" class="news-user-fullname pointer">
							<p class="row m-0 fz-16 d-flex align-items-center"><?= ($user_info_name || $user_info_surname) ? $user_info_fullname : 'Имя не указано'; ?>
	              <svg class="ml-2 premium-star active" width="15px" height="15px" viewBox="0 0 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#2ACAEA" stroke-width="0.00048000000000000007" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
	                <defs>  
	                  <linearGradient id="premium-logo-gradient-<?= $hash_modal; ?>" x1="50%" y1="0%" x2="50%" y2="100%" > 
	                    <stop offset="0%" stop-color="#7A5FFF">
	                      <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
	                    </stop>
	                    <stop offset="100%" stop-color="#01FF89">
	                      <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
	                    </stop>
	                  </linearGradient> 
	                </defs>
	                <g>
	                  <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8712 33.0436L15.9976 44.7036C15.9362 45.5229 16.6646 46.0872 17.3161 45.722C21.9289 43.1382 36.3783 33.6479 43.7017 12.7899C44.0376 11.8331 43.1352 10.9697 42.3646 11.5094C38.0387 14.539 28.5846 20.8006 22.7421 21.9934C22.7421 21.9934 26.4836 19.3946 28.7231 15.4053C28.9426 15.0143 28.9244 14.5136 28.6796 14.1606L20.5127 2.38925C20.0287 1.69147 19.0354 1.98057 18.8606 2.87002L16.3181 15.8073L4.38437 26.2226C3.78602 26.7446 3.90808 27.7996 4.5989 28.079L16.8712 33.0436Z" fill="url('#premium-logo-gradient-<?= $hash_modal; ?>')"></path> 
	                  <path fill-rule="evenodd" clip-rule="evenodd" d="M37.9745 28.448C37.2188 29.5025 35.5908 31.6717 34.0876 32.9974C33.7871 33.2624 33.8276 33.7068 34.1724 33.9234L42.1145 38.909C42.5926 39.2091 43.2384 38.8529 43.1576 38.3323C42.7882 35.9496 41.7237 30.9818 39.0328 28.3741C38.7322 28.083 38.2142 28.1136 37.9745 28.448Z" fill="url('#premium-logo-gradient-<?= $hash_modal; ?>')"></path> 
	                </g>
	              </svg>
            	</p>
						</a>
<?
          }else
          {
?>
						<a href="./?u=<?= get_user_nickname($user_uuid); ?>" class="news-user-fullname pointer">
							<p class="row m-0 fz-16"><?= ($user_info_name || $user_info_surname) ? $user_info_fullname : 'Имя не указано'; ?></p>
						</a>
<?
					}
?>

						<hr class="hr-user-info m-0 mt-1 mb-1">
						<p class="w-100 m-0 p-0">
<?
						switch ($user_info_gender) {
							case 'male':
								echo 'Обновил фотографию профиля&nbsp;';
								break;

							case 'female':
								echo 'Обновила фотографию профиля&nbsp;';
								break;
						        			
							default:
								echo 'Пользователь обновил фотографию профиля&nbsp;';
								break;
						}
?>
						</p>
					</div>
				</div>

<?
				if ($old_photo)
				{
?>
				<div class="w-100 m-0 p-1 d-flex flex-row justify-content-center news-card-body">
					<div class="news-friend-card-avatar-update d-flex align-items-center justify-content-end p-0 mr-5">
						<img class="rounded-circle offline m-0 p-0 w-100" src="<?= 'users/'.$user_uuid.'/'.$old_photo; ?>" alt="<?= $user_info_fullname; ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$old_photo.'\''; ?>);">
					</div>

					<div class="d-flex align-items-center justify-content-center p-0">
						<i class="fa fa-angle-double-right fz-25" aria-hidden="true"></i>
					</div>

					<div class="news-friend-card-avatar-update d-flex align-items-center justify-content-start p-0 ml-5">
						<img class="rounded-circle offline m-0 p-0 w-100" src="<?= 'users/'.$user_uuid.'/'.$new_photo; ?>" alt="<?= $user_info_fullname ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$new_photo.'\''; ?>);">
					</div>
				</div>
<?
				}else
				{
?>
				<div class="w-100 m-0 p-1 news-card-body d-flex justify-content-center align-items-center">
					<div class="news-friend-card-avatar-update d-flex justify-content-center align-items-center p-0">
						<img class="rounded-circle offline m-0 p-0 w-100" src="<?= 'users/'.$user_uuid.'/'.$new_photo; ?>" alt="<?= $user_info_fullname; ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$new_photo.'\''; ?>);">
					</div>
				</div>
<?
				}
?>
			</div>
<?
		}else
			return null;
	};

//----------------------------------------------------------------------------------------------------------------
/*
	function new_achievement_news($current_user_uuid, $user_uuid, $achievement_uuid)
	{
		if(!empty($user_uuid) && !empty($achievement_uuid))
		{
			$user_info_fullname = get_user_fullname($user_uuid);
			$user_info_name = get_user_name($user_uuid);
			$user_info_surname = get_user_surname($user_uuid);
			$user_info_nickname = get_user_nickname($user_uuid);
			$user_info_gender = get_user_gender($user_uuid);
			$user_info_avatar = get_latest_avatar($user_uuid);

			$achievement_info_query = pg_query("SELECT a.title, a.description, a.picture, ac.picture 
																					FROM achievements a 
																							 INNER JOIN achievement_categories ac 
																											 ON a.category_uuid = ac.uuid 
																					WHERE a.uuid = '{$achievement_uuid}'") 
																or trigger_error(pg_last_error().$achievement_info_query);

			if ($achievement_info_result = pg_fetch_array($achievement_info_query))
			{
				$achievement_info_title = $achievement_info_result[0];
				$achievement_info_description = $achievement_info_result[1];
				$achievement_info_picture = $achievement_info_result[2];
				$achievement_info_picture_back = $achievement_info_result[3];

				$hash_achievement_modal = sha1($user_uuid.$achievement_info_picture);
?>
				<div class="news-card m-0 mb-3 p-2 pl-3 pr-3">
					<div class="w-100 m-0 p-1 d-flex flex-row news-card-header">
						<div class="news-friend-card-avatar d-flex align-items-center justify-content-start p-0 mr-3">
<?						
						if (!is_null(check_user_online_status($user_uuid))) 
						{
?>
							<img class="rounded-circle online m-0 p-0 w-100" src="<?= 'users/'.$user_uuid.'/'.$user_info_avatar; ?>" alt="<?= $user_info_fullname; ?>" data-toggle="modal" data-target="#ppm<?= $hash_achievement_modal; ?>">
<?
						}else
						{
?>
							<img class="rounded-circle offline m-0 p-0 w-100" src="<?= 'users/'.$user_uuid.'/'.$user_info_avatar; ?>" alt="<?= $user_info_fullname; ?>" data-toggle="modal" data-target="#ppm<?= $hash_achievement_modal; ?>">
<?
						}
?>
						</div>

						<div class="w-100 p-0">
<?
						if ($current_user_uuid == $user_uuid)
						{
?>
							<a href="index.php">
								<p class="row m-0 fz-16"><?= ($user_info_name || $user_info_surname) ? $user_info_fullname : 'Имя не указано'; ?></p>
							</a>
<?
						}else
						{
?>
							<a href="search.php?q=<?= $user_info_nickname; ?>">
								<p class="row m-0 fz-16"><?= ($user_info_name || $user_info_surname) ? $user_info_fullname : 'Имя не указано'; ?></p>
							</a>
<?
						}
?>
							<hr class="hr-user-info m-0 mt-1 mb-1">
							<p class="w-100 m-0 p-0">
<?
							switch ($user_info_gender) {
								case 'male':
									echo 'Получил достижение&nbsp;';
									break;

								case 'female':
									echo 'Получила достижение&nbsp;';
									break;

								default:
									echo 'Пользователь получил достижение&nbsp;';
									break;
							}
?>
							</p>
						</div>
					</div>

					<div class="w-100 m-0 p-1 d-flex justify-content-center align-items-center news-card-body">
						<div class="news-friend-card-avatar-update d-flex align-items-center justify-content-center p-0">
							<img class="rounded-circle m-0 p-0 w-100" src="<?= 'imgs/achievements/'.$achievement_info_picture; ?>" alt="<?= $achievement_info_title; ?>" data-toggle="modal" data-target="#uam<?= $hash_achievement_modal; ?>">
						</div>
					</div>
				</div>
<?
				user_achievement_modal($achievement_info_title, $achievement_info_description, $achievement_info_picture, $achievement_info_picture_back, $hash_achievement_modal);
			}else
				return null;
		}else
			return null;
	};
?>*/