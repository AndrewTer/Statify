<?php
	$picture_uuid = get_photo_uuid_by_name($picture_name);
	$user_rating_value = get_user_rating_from_current_user($current_user_uuid, $user_uuid, $picture_uuid);

	if ($ban_check == 'success')
		if ($user_rating_value >= 1 && $user_rating_value <= 5)
		{
			echo '<div class="m-0 p-1 text-center d-flex flex-row justify-content-center photo-menu-center">';
			for ($stars_count = 0; $stars_count < 5; $stars_count++)
				if ($stars_count <= $user_rating_value - 1)
					echo '<i class="fa fa-star-o active-star fz-18 p-1" aria-hidden="true"></i>';
				else
					echo '<i class="fa fa-star-o inactive-star fz-18 p-1" aria-hidden="true"></i>';
			echo '</div>';
		}else
			if (check_email_confirmed($current_user_uuid))
				if (get_latest_avatar($current_user_uuid))
					echo '<div class="m-0 p-1 text-center d-flex flex-row justify-content-center align-items-center current-photo-menu photo-menu-center" id="rating-result">
									<div class="nav-item w-100 m-0 p-0 d-flex flex-row justify-content-center align-items-center">
										<a class="nav-link w-100 m-0 p-0 text-center" onclick="displayBlockSetRating();">
											<i class="fa fa-star-half-o fz-18 p-1 m-0" aria-hidden="true"></i>
										</a>
									</div>
								</div>';
				else
					echo '<div class="m-0 p-1 text-center d-flex flex-row justify-content-center align-items-center photo-menu-center">
									<i class="fa fa-exclamation-triangle fz-18 p-1 m-0 text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Вы не можете оценивать пользователей пока не загрузите фотографию профиля"></i>
								</div>';
			else
				echo '<div class="m-0 p-1 text-center d-flex flex-row justify-content-center align-items-center photo-menu-center">
								<i class="fa fa-exclamation-triangle fz-18 p-1 m-0 text-danger" aria-hidden="true" data-toggle="tooltip" data-placement="right" title="Вы не можете оценивать пользователей пока не подтвердите email"></i>
							</div>';
?>
