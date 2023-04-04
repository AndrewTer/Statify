<?php
	$picture_uuid = get_photo_uuid_by_name($picture_name);
	$user_rating_value = get_user_rating_from_current_user($current_user_uuid, $user_uuid, $picture_uuid);

	if ($ban_check == 'success')
		if ($user_rating_value >= 1 && $user_rating_value <= 5)
		{
			echo '<div class="m-0 p-1 text-center d-flex flex-row justify-content-center align-items-center photo-menu-center">';
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
									<a class="nav-link w-100 m-0 p-0 text-center" onclick="displayBlockSetRating();">
										<div class="nav-item w-100 m-0 p-0 d-flex flex-row justify-content-center align-items-center">
											<p class="m-0 p-0">
												<svg class="m-0 p-0" width="24px" height="24px" viewBox="0 0 24 24" fill="none">
													<path fill-rule="evenodd" clip-rule="evenodd" d="M13.1467 4.13112C12.7115 3.12752 11.2883 3.12751 10.8531 4.13112L8.87333 8.69665L3.91947 9.16869C2.83051 9.27246 2.3907 10.626 3.2107 11.3501L6.94099 14.6438L5.85911 19.501C5.62129 20.5688 6.77271 21.4053 7.7147 20.8492L11.9999 18.3193L16.2851 20.8492C17.2271 21.4053 18.3785 20.5688 18.1407 19.501L17.0588 14.6438L20.7891 11.3501C21.6091 10.626 21.1693 9.27246 20.0804 9.16869L15.1265 8.69665L13.1467 4.13112ZM12 15.9968L12.5083 16.2969L15.8125 18.2477L14.9783 14.5023L14.85 13.9261L15.2925 13.5353L18.1689 10.9956L14.3491 10.6316L13.7613 10.5756L13.5265 10.034L12 6.51388V15.9968Z" fill="var(--main-text-color)"></path>
												</svg>
											</p>
										</div>
									</a>
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
