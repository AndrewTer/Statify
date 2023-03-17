<?
	$recent_registered_users_array = [];
	$recent_registered_users_array = get_recent_registered_users_list(10);

	if (count($recent_registered_users_array) > 0)
	{
?>

<div class="w-100 m-0 block-user-content">
	<h5 class="fz-15 m-0 p-0 font-weight-bold">Новые пользователи</h5>
	<hr class="hr-user-info">

	<div class="m-0 p-0 position-relative">

		<div class="m-0 p-0 new-users-slider">
<?
		for ($recent_registered_users_num = 0; $recent_registered_users_num < count($recent_registered_users_array); $recent_registered_users_num++)
		{
			$recent_registered_user_uuid = $recent_registered_users_array[$recent_registered_users_num]['user_uuid'];
			$recent_registered_user_fullname = get_user_fullname($recent_registered_user_uuid);
			$recent_registered_user_name = get_user_name($recent_registered_user_uuid);

			if (get_latest_avatar($recent_registered_user_uuid))
			{
				$recent_registered_user_avatar = get_latest_avatar($recent_registered_user_uuid);
?>
			<a class="m-0 p-0" href="./?u=<?= get_user_nickname($recent_registered_user_uuid); ?>">
				<div class="m-0 p-0 slider-element">
		      <div class="mx-auto d-block friends-card-avatar">
						<img class="rounded-circle offline pointer" src="users/<?= $recent_registered_user_uuid; ?>/<?= $recent_registered_user_avatar; ?>" alt="<?= $recent_registered_user_fullname; ?>">
					</div>
	    	</div>
	    </a>
<?
			}else
			{
?>
			<div class="m-0 p-0 slider-element">
	      <div class="mx-auto d-block friends-card-avatar">
					<img class="rounded-circle offline pointer" src="imgs/no-avatar.png" alt="<?= $recent_registered_user_fullname; ?>">        
				</div>
	    </div>
<?
			}
		}
?>	
		</div>

		<button class="new-users-prev-btn btn btn-sm d-flex justify-content-center align-items-center">
			<svg width="23px" height="23px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff">
				<path fill="#ffffff" d="M609.408 149.376 277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0 30.592 30.592 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.592 30.592 0 0 0 0-42.688 29.12 29.12 0 0 0-41.728 0z"></path>
			</svg>
		</button>
		<button class="new-users-next-btn btn btn-sm d-flex justify-content-center align-items-center">
			<svg width="23px" height="23px" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff">
				<path fill="#ffffff" d="M340.864 149.312a30.592 30.592 0 0 0 0 42.752L652.736 512 340.864 831.872a30.592 30.592 0 0 0 0 42.752 29.12 29.12 0 0 0 41.728 0L714.24 534.336a32 32 0 0 0 0-44.672L382.592 149.376a29.12 29.12 0 0 0-41.728 0z"></path>
			</svg>
		</button>

	</div>
</div>
<?
	}

	$most_commented_photos_list = get_most_commented_photos_list(0, 9);
	$photos_sorted_by_rating_list = get_photos_list_sorted_by_rating(0, 9);
	$photos_sorted_by_number_of_saves_list = get_photos_list_sorted_by_number_of_saves(0, 9);

	if ($photos_sorted_by_rating_list)
	{
?>
<div class="w-100 m-0 mt-3 block-user-content">
	<div class="m-0 p-0 d-flex flex-row align-items-center" id="show-more-popular-photos-sorted-by-rating">
		<h5 class="fz-15 m-0 p-0 font-weight-bold">По рейтингу</h5>
<?
		if (count(get_photos_list_sorted_by_rating(9, 91)))
		{
?>
		<p class="m-0 ml-auto mr-0 p-0 fz-14 news-popular-top-p" onclick="event.preventDefault();showMorePopularPhotosSortedByRating(<?= '\''.$user_uuid.'\''; ?>);">Топ 100</p>
<?
		}
?>
	</div>
	<hr class="hr-user-info">

	<div class="m-0 p-0 pt-2 justify-content-center grid-with-one-large-item">
<?
		for ($photos_sorted_by_rating_num = 0; $photos_sorted_by_rating_num < count($photos_sorted_by_rating_list); $photos_sorted_by_rating_num++)
	  {
			$photo_user_uuid = $photos_sorted_by_rating_list[$photos_sorted_by_rating_num][0];
			$photo_user_name = get_user_fullname($photo_user_uuid);
			$photo_name = get_photo_name_by_uuid($photos_sorted_by_rating_list[$photos_sorted_by_rating_num][1]);
			$rating_sum = $photos_sorted_by_rating_list[$photos_sorted_by_rating_num][2];
			$rating_number = $rating_sum / $photos_sorted_by_rating_list[0][2] * 100;
			$text_color_class = '';
			$gradient_border_class = '';
			$offline_class = '';

			switch ($photos_sorted_by_rating_num) {
				case 0:
					$text_color_class = 'popular-card-text-color-first';
					$gradient_border_class = 'gold-gradient-border';
					$offline_class = '';
					break;

				case 1:
					$text_color_class = 'popular-card-text-color-second';
					$gradient_border_class = '';
					$offline_class = 'offline';
					break;
				
				case 2:
					$text_color_class = 'popular-card-text-color-third';
					$gradient_border_class = '';
					$offline_class = 'offline';
					break;

				default:
					$text_color_class = '';
					$gradient_border_class = '';
					$offline_class = 'offline';
					break;
			}
?>
			<div class="popular-picture-card m-1 grid-item position-relative">
				<div class="m-0 p-0 <?= $gradient_border_class; ?>">
					<span class="position-absolute popular-card-badge fz-13 <?= $text_color_class; ?>"><i class="fa fa-star-o fz-13 p-0 pr-2 m-0 <?= $text_color_class; ?>" aria-hidden="true"></i><?= round(remove_zeros_after_dot($rating_number), 1); ?></span>
					<img class="<?= $offline_class; ?> w-100 border-radius-10" src="<?= 'users/'.$photo_user_uuid.'/'.$photo_name; ?>" alt="<?= $photo_user_name; ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$user_uuid.'\',\''.$photo_user_uuid.'\',\''.$photo_name.'\''; ?>);">
				</div>
			</div>
<?
  	}
?>
	</div>
	<div class="w-100 m-0 p-0" id="more-popular-photos-sorted-by-rating"></div>
</div>
<?
	}

	if ($most_commented_photos_list)
  {
?>
<div class="w-100 m-0 block-user-content <?= ($photos_sorted_by_rating_list) ? 'mt-3' : ''; ?>">
	<div class="m-0 p-0 d-flex flex-row align-items-center" id="show-more-popular-photos-sorted-by-number-of-comments">
		<h5 class="fz-15 m-0 p-0 font-weight-bold">Самые комментируемые</h5>
<?
		if (get_most_commented_photos_list(9, 91))
		{
?>
		<p class="m-0 ml-auto mr-0 p-0 fz-14 news-popular-top-p" onclick="event.preventDefault();showMorePopularPhotosSortedByNumberOfComments(<?= '\''.$user_uuid.'\''; ?>);">Топ 100</p>
<?
		}
?>
	</div>
	<hr class="hr-user-info">

	<div class="m-0 p-0 pt-2 justify-content-center grid-with-one-large-item">
<?
		for ($most_commented_photos_num = 0; $most_commented_photos_num < count($most_commented_photos_list); $most_commented_photos_num++)
		{
			$photo_user_uuid = $most_commented_photos_list[$most_commented_photos_num][1];
			$photo_user_name = get_user_fullname($photo_user_uuid);
			$photo_name = get_photo_name_by_uuid($most_commented_photos_list[$most_commented_photos_num][0]);
			$comments_count = $most_commented_photos_list[$most_commented_photos_num][2];
			$text_color_class = '';
			$gradient_border_class = '';
			$offline_class = '';

			switch ($most_commented_photos_num) {
				case 0:
					$text_color_class = 'popular-card-text-color-first';
					$gradient_border_class = 'gold-gradient-border';
					$offline_class = '';
					break;

				case 1:
					$text_color_class = 'popular-card-text-color-second';
					$gradient_border_class = '';
					$offline_class = 'offline';
					break;
				
				case 2:
					$text_color_class = 'popular-card-text-color-third';
					$gradient_border_class = '';
					$offline_class = 'offline';
					break;

				default:
					$text_color_class = '';
					$gradient_border_class = '';
					$offline_class = 'offline';
					break;
			}
?>
			<div class="popular-picture-card m-1 grid-item position-relative">
				<div class="m-0 p-0 <?= $gradient_border_class; ?>">
					<span class="position-absolute popular-card-badge fz-13 <?= $text_color_class; ?>"><i class="fa fa-comments-o fz-13 p-0 pr-2 m-0 <?= $text_color_class; ?>" aria-hidden="true"></i><?= rounding_number_by_places($comments_count); ?></span>
					<img class="<?= $offline_class; ?> w-100 border-radius-10" src="<?= 'users/'.$photo_user_uuid.'/'.$photo_name; ?>" alt="<?= $photo_user_name; ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$user_uuid.'\',\''.$photo_user_uuid.'\',\''.$photo_name.'\''; ?>);">
				</div>
			</div>
<?
		}
?>
	</div>
	<div class="w-100 m-0 p-0" id="more-popular-photos-sorted-by-number-of-comments"></div>
</div>
<?
	}

	if ($photos_sorted_by_number_of_saves_list)
	{
?>
<div class="w-100 m-0 block-user-content <?= ($photos_sorted_by_rating_list || $most_commented_photos_list) ? 'mt-3' : ''; ?>">
	<div class="m-0 p-0 d-flex flex-row align-items-center" id="show-more-popular-photos-sorted-by-number-of-saves">
		<h5 class="fz-15 m-0 p-0 font-weight-bold">Самые сохраняемые</h5>
<?
		if (get_photos_list_sorted_by_number_of_saves(9, 91))
		{
?>
		<p class="m-0 ml-auto mr-0 p-0 fz-14 news-popular-top-p" onclick="event.preventDefault();showMorePopularPhotosSortedByNumberOfSaves(<?= '\''.$user_uuid.'\''; ?>);">Топ 100</p>
<?
		}
?>
	</div>
	<hr class="hr-user-info">

	<div class="m-0 p-0 pt-2 justify-content-center grid-with-one-large-item">
<?
		for ($photos_sorted_by_number_of_saves_num = 0; $photos_sorted_by_number_of_saves_num < count($photos_sorted_by_number_of_saves_list); $photos_sorted_by_number_of_saves_num++)
	  {
			$photo_user_uuid = $photos_sorted_by_number_of_saves_list[$photos_sorted_by_number_of_saves_num][0];
			$photo_user_name = get_user_fullname($photo_user_uuid);
			$photo_name = get_photo_name_by_uuid($photos_sorted_by_number_of_saves_list[$photos_sorted_by_number_of_saves_num][1]);
			$saves_count = $photos_sorted_by_number_of_saves_list[$photos_sorted_by_number_of_saves_num][2];
			$text_color_class = '';
			$gradient_border_class = '';
			$offline_class = '';

			switch ($photos_sorted_by_number_of_saves_num) {
				case 0:
					$text_color_class = 'popular-card-text-color-first';
					$gradient_border_class = 'gold-gradient-border';
					$offline_class = '';
					break;

				case 1:
					$text_color_class = 'popular-card-text-color-second';
					$gradient_border_class = '';
					$offline_class = 'offline';
					break;
				
				case 2:
					$text_color_class = 'popular-card-text-color-third';
					$gradient_border_class = '';
					$offline_class = 'offline';
					break;

				default:
					$text_color_class = '';
					$gradient_border_class = '';
					$offline_class = 'offline';
					break;
			}
?>
			<div class="popular-picture-card m-1 grid-item position-relative">
				<div class="m-0 p-0 <?= $gradient_border_class; ?>">
					<span class="position-absolute popular-card-badge fz-13 <?= $text_color_class; ?>"><i class="fa fa-bookmark-o fz-13 p-0 pr-2 m-0 <?= $text_color_class; ?>" aria-hidden="true"></i><?= rounding_number_by_places($saves_count); ?></span>
					<img class="<?= $offline_class; ?> w-100 border-radius-10" style="<?= $border_style; ?>" src="<?= 'users/'.$photo_user_uuid.'/'.$photo_name; ?>" alt="<?= $photo_user_name; ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$user_uuid.'\',\''.$photo_user_uuid.'\',\''.$photo_name.'\''; ?>);">
				</div>
			</div>
<?
  	}
?>
	</div>
	<div class="w-100 m-0 p-0" id="more-popular-photos-sorted-by-number-of-saves"></div>
</div>
<?
	}
?>