<?php
	function new_friend_activity($current_user_uuid, $user_uuid, $friend_uuid, $activity_num)
	{
		if (!empty($current_user_uuid) && !empty($user_uuid) && !empty($friend_uuid))
		{
			$user_info_fullname = get_user_fullname($user_uuid);
			$user_info_name = get_user_name($user_uuid);
			$user_info_surname = get_user_surname($user_uuid);
			$user_info_nickname = get_user_nickname($user_uuid);
			$user_info_avatar = get_user_avatar($user_uuid);
			$user_info_gender = get_user_gender($user_uuid);

			$friend_info_nickname = get_user_nickname($friend_uuid);
			$ban_check = ban_check($user_uuid);
			$hash_modal = sha1($friend_uuid.$user_uuid);
			$premium_status = check_premium_active($user_uuid);
?>
			<div class="m-0 p-2 pl-3 pr-3 mt-2 mb-2" 
						style="<?= ($activity_num > 0) ? 'border-top: 1px dotted var(--hr-user-info-bg-color);' : ''; ?>">
				<div class="w-100 m-0 p-1 d-flex flex-row align-items-center activity-card-header">
					<div class="activity-friend-card-avatar d-flex align-items-center justify-content-start p-0 mr-3">
<?
					$preview_photo_check = file_exists('users/'.$user_uuid.'/'.get_user_avatar_preview($user_uuid)) ? 1 : 0;
					if ($ban_check == 'success')
						if (!is_null(check_user_online_status($user_uuid))) 
							if ($user_info_avatar)
								echo '<img class="rounded-circle online m-0 p-0 w-100" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($user_uuid) : $user_info_avatar).'" alt="'.$user_info_fullname.'" onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$user_info_avatar.'\');">';
							else
							
								echo '<img class="rounded-circle online m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$user_info_fullname.'">';
						else
							if ($user_info_avatar)
								echo '<img class="rounded-circle offline m-0 p-0 w-100" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($user_uuid) : $user_info_avatar).'" alt="'.$user_info_fullname.'" onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$user_info_avatar.'\');">';
							else
								echo '<img class="rounded-circle offline m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$user_info_fullname.'">';
					else
						if ($user_info_avatar)
							echo '<img class="rounded-circle offline m-0 p-0 w-100" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($user_uuid) : $user_info_avatar).'" alt="'.$user_info_fullname.'"
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
						<a href="./?u=<?= get_user_nickname($user_uuid); ?>" class="activity-user-fullname pointer">
							<p class="row m-0 fz-16 d-flex align-items-center font-weight-bold"><?= ($user_info_name || $user_info_surname) ? $user_info_fullname : 'Имя не указано'; ?>
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
						<a href="./?u=<?= get_user_nickname($user_uuid); ?>" class="activity-user-fullname pointer">
							<p class="row m-0 fz-16 font-weight-bold"><?= ($user_info_name || $user_info_surname) ? $user_info_fullname : 'Имя не указано'; ?></p>
						</a>
<?
          }
?>
						<p class="w-100 m-0 mt-1 p-0">
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
								<em class="activity-user-link font-weight-bold"><?= ($friend_info_nickname) ? '@'.$friend_info_nickname : ''; ?></em>
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

	function new_profile_photo_activity($current_user_uuid, $user_uuid, $old_avatar_uuid, $new_avatar_uuid, $activity_num)
	{
		if (!empty($current_user_uuid) && !empty($user_uuid) && !empty($new_avatar_uuid))
		{
			$user_info_fullname = get_user_fullname($user_uuid);
			$user_info_name = get_user_name($user_uuid);
			$user_info_surname = get_user_surname($user_uuid);
			$user_info_nickname = get_user_nickname($user_uuid);
			$user_info_gender = get_user_gender($user_uuid);
			$user_info_avatar = get_user_avatar($user_uuid);

			$old_avatar_name = get_photo_name_by_uuid($old_avatar_uuid);
			$new_avatar_name = get_photo_name_by_uuid($new_avatar_uuid);

			$ban_check = ban_check($user_uuid);
			$hash_modal = sha1($user_uuid.$old_avatar_uuid.$new_avatar_uuid);
			$premium_status = check_premium_active($user_uuid);
?>

			<div class="m-0 p-2 pl-3 pr-3 mt-2 mb-2" 
						style="<?= ($activity_num > 0) ? 'border-top: 1px dotted var(--hr-user-info-bg-color);' : ''; ?>">
				<div class="w-100 m-0 p-1 d-flex flex-row align-items-center activity-card-header">
				  <div class="activity-friend-card-avatar d-flex align-items-center justify-content-center p-0 mr-3">
<?						
					$preview_photo_check = file_exists('users/'.$user_uuid.'/'.get_user_avatar_preview($user_uuid)) ? 1 : 0;
					if ($ban_check == 'success')
						if (!is_null(check_user_online_status($user_uuid))) 
							if ($user_info_avatar)
								echo '<img class="rounded-circle online m-0 p-0 w-100" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($user_uuid) : $user_info_avatar).'" alt="'.$user_info_fullname.'" onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$user_info_avatar.'\');">';
							else
								echo '<img class="rounded-circle online m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$user_info_fullname.'">';
						
						else
							if ($user_info_avatar)
								echo '<img class="rounded-circle offline m-0 p-0 w-100" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($user_uuid) : $user_info_avatar).'" alt="'.$user_info_fullname.'" onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$user_info_avatar.'\');">';
							else
								echo '<img class="rounded-circle offline m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$user_info_fullname.'">';
					else
						if ($user_info_avatar)
							echo '<img class="rounded-circle offline m-0 p-0 w-100" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($user_uuid) : $user_info_avatar).'" alt="'.$user_info_fullname.'"
								onclick="event.preventDefault();openProfilePictureModal(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$user_info_avatar.'\');">';
						else
							echo '<img class="rounded-circle offline m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$user_info_fullname.'">';
?>
					</div>

					<div class="w-100 p-0 d-flex flex-column">
<?
					if ($premium_status)
          {
?>
						<a href="./?u=<?= get_user_nickname($user_uuid); ?>" class="activity-user-fullname pointer">
							<p class="row m-0 fz-16 d-flex align-items-center font-weight-bold"><?= ($user_info_name || $user_info_surname) ? $user_info_fullname : 'Имя не указано'; ?>
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
						<a href="./?u=<?= get_user_nickname($user_uuid); ?>" class="activity-user-fullname pointer font-weight-bold">
							<p class="row m-0 fz-16"><?= ($user_info_name || $user_info_surname) ? $user_info_fullname : 'Имя не указано'; ?></p>
						</a>
<?
					}
?>
						<p class="w-100 m-0 mt-1 p-0">
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
				if ($old_avatar_name)
				{
?>
				<div class="w-100 m-0 mt-2 p-1 d-flex flex-row justify-content-center activity-card-body">
					<div class="activity-friend-card-avatar-update d-flex align-items-center justify-content-end p-0 mr-5">
						<img class="rounded-circle offline m-0 p-0 w-100" src="<?= 'users/'.$user_uuid.'/'.$old_avatar_name; ?>" alt="<?= $user_info_fullname; ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$old_avatar_name.'\''; ?>);">
					</div>

					<div class="d-flex align-items-center justify-content-center p-0">
						<p class="m-0 p-0">
							<svg width="30px" height="30px" viewBox="0 0 24 24" fill="none">
								<path d="M13 6L19 12L13 18M6 6L12 12L6 18" stroke="var(--main-text-color)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
							</svg>
						</p>
					</div>

					<div class="activity-friend-card-avatar-update d-flex align-items-center justify-content-start p-0 ml-5">
						<img class="rounded-circle offline m-0 p-0 w-100" src="<?= 'users/'.$user_uuid.'/'.$new_avatar_name; ?>" alt="<?= $user_info_fullname ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$new_avatar_name.'\''; ?>);">
					</div>
				</div>
<?
				}else
				{
?>
				<div class="w-100 m-0 mt-2 p-1 activity-card-body d-flex justify-content-center align-items-center">
					<div class="activity-friend-card-avatar-update d-flex justify-content-center align-items-center p-0">
						<img class="rounded-circle offline m-0 p-0 w-100" src="<?= 'users/'.$user_uuid.'/'.$new_avatar_name; ?>" alt="<?= $user_info_fullname; ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$new_avatar_name.'\''; ?>);">
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