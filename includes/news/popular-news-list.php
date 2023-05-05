<?
	$recent_registered_users_array = [];
	$recent_registered_users_array = get_recent_registered_users_list(10);

	if (count($recent_registered_users_array) > 0)
	{
?>

<div class="w-100 m-0 block-user-content">
	<h5 class="fz-15 m-0 p-0 font-weight-bold letter-spacing-05">Новые пользователи</h5>
	<hr class="hr-user-info">

	<div class="m-0 p-0 position-relative">

		<div class="m-0 p-0 new-users-slider">
<?
		for ($recent_registered_users_num = 0; $recent_registered_users_num < count($recent_registered_users_array); $recent_registered_users_num++)
		{
			$recent_registered_user_uuid = $recent_registered_users_array[$recent_registered_users_num]['user_uuid'];
			$recent_registered_user_fullname = get_user_fullname($recent_registered_user_uuid);
			$recent_registered_user_name = get_user_name($recent_registered_user_uuid);

			if (get_user_avatar($recent_registered_user_uuid))
			{
				$recent_registered_user_avatar = get_user_avatar($recent_registered_user_uuid);
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
			<svg width="23px" height="23px" viewBox="0 0 1024 1024" fill="#ffffff" stroke="#ffffff">
				<path fill="#ffffff" d="M609.408 149.376 277.76 489.6a32 32 0 0 0 0 44.672l331.648 340.352a29.12 29.12 0 0 0 41.728 0 30.592 30.592 0 0 0 0-42.752L339.264 511.936l311.872-319.872a30.592 30.592 0 0 0 0-42.688 29.12 29.12 0 0 0-41.728 0z"></path>
			</svg>
		</button>
		<button class="new-users-next-btn btn btn-sm d-flex justify-content-center align-items-center">
			<svg width="23px" height="23px" viewBox="0 0 1024 1024" fill="#ffffff" stroke="#ffffff">
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
		<h5 class="fz-15 m-0 p-0 font-weight-bold letter-spacing-05">По рейтингу</h5>
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
					<span class="position-absolute popular-card-badge fz-13 font-weight-bold <?= $text_color_class; ?> d-flex flex-row align-items-center">
						<p class="m-0 p-0 mr-1 d-flex align-items-center">
				      <svg class="m-0 p-0" viewBox="0 0 24 24" fill="none">
				        <path d="M17.2 20.7501C17.0776 20.7499 16.9573 20.7189 16.85 20.6601L12 18.1101L7.14999 20.6601C7.02675 20.7262 6.88746 20.7566 6.74786 20.7478C6.60825 20.7389 6.47391 20.6912 6.35999 20.6101C6.24625 20.5267 6.15796 20.4133 6.10497 20.2826C6.05199 20.1519 6.03642 20.0091 6.05999 19.8701L6.99999 14.4701L3.05999 10.6501C2.96124 10.5512 2.89207 10.4268 2.86027 10.2907C2.82846 10.1547 2.83529 10.0124 2.87999 9.88005C2.92186 9.74719 3.00038 9.62884 3.10652 9.53862C3.21266 9.4484 3.34211 9.38997 3.47999 9.37005L8.89999 8.58005L11.33 3.67005C11.3991 3.55403 11.4973 3.45795 11.6147 3.39123C11.7322 3.32451 11.8649 3.28943 12 3.28943C12.1351 3.28943 12.2678 3.32451 12.3853 3.39123C12.5027 3.45795 12.6008 3.55403 12.67 3.67005L15.1 8.58005L20.52 9.37005C20.6579 9.38997 20.7873 9.4484 20.8935 9.53862C20.9996 9.62884 21.0781 9.74719 21.12 9.88005C21.1647 10.0124 21.1715 10.1547 21.1397 10.2907C21.1079 10.4268 21.0387 10.5512 20.94 10.6501L17 14.4701L17.93 19.8701C17.9536 20.0091 17.938 20.1519 17.885 20.2826C17.832 20.4133 17.7437 20.5267 17.63 20.6101C17.5034 20.6976 17.3539 20.7463 17.2 20.7501ZM12 16.5201C12.121 16.5215 12.2403 16.5488 12.35 16.6001L16.2 18.6001L15.47 14.3101C15.4502 14.1897 15.4589 14.0664 15.4953 13.9501C15.5318 13.8337 15.595 13.7275 15.68 13.6401L18.8 10.6401L14.49 10.0001C14.3708 9.98109 14.2578 9.93401 14.1605 9.86271C14.0631 9.79141 13.9841 9.69795 13.93 9.59005L12 5.69005L10.07 9.60005C10.0159 9.70795 9.9369 9.80141 9.83952 9.87271C9.74214 9.94401 9.62918 9.99109 9.50999 10.0101L5.19999 10.6401L8.31999 13.6401C8.40493 13.7275 8.46817 13.8337 8.50464 13.9501C8.54111 14.0664 8.54979 14.1897 8.52999 14.3101L7.79999 18.6301L11.65 16.6301C11.7573 16.5683 11.8767 16.5308 12 16.5201Z"></path>
				      </svg>
				    </p>
						<p class="m-0 p-0"><?= round(remove_zeros_after_dot($rating_number), 1); ?></p>
					</span>
					<img class="<?= $offline_class; ?> w-100 border-radius-15" src="<?= 'users/'.$photo_user_uuid.'/'.$photo_name; ?>" alt="<?= $photo_user_name; ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$user_uuid.'\',\''.$photo_user_uuid.'\',\''.$photo_name.'\''; ?>);">
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
		<h5 class="fz-15 m-0 p-0 font-weight-bold letter-spacing-05">Самые комментируемые</h5>
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
					<span class="position-absolute popular-card-badge fz-13 font-weight-bold <?= $text_color_class; ?> d-flex flex-row align-items-center">
						<p class="m-0 p-0 mr-1 d-flex align-items-center">
							<svg class="m-0 p-0" viewBox="0 -3.5 31 31">
								<path d="m12 2.182c-.031 0-.068 0-.105 0-1.715 0-3.354.325-4.859.918l.09-.031c-1.425.526-2.633 1.347-3.599 2.394l-.006.006c-.809.847-1.314 1.99-1.338 3.251v.005c.013 1.015.35 1.948.912 2.705l-.009-.012c.675.923 1.522 1.678 2.5 2.229l.039.02 1.654.958-.597 1.432q.579-.341 1.057-.665l.75-.528.903.17c.783.15 1.684.237 2.606.24h.002.105c1.715 0 3.354-.325 4.859-.918l-.09.031c1.425-.526 2.633-1.347 3.599-2.394l.006-.006c.827-.836 1.338-1.986 1.338-3.256s-.511-2.42-1.338-3.256c-.972-1.053-2.18-1.874-3.542-2.379l-.063-.021c-1.421-.566-3.067-.895-4.79-.895-.03 0-.06 0-.09 0h.005zm0-2.182c.045 0 .098-.001.151-.001 2.119 0 4.138.429 5.974 1.206l-.101-.038c1.751.703 3.22 1.789 4.358 3.161l.014.018c.996 1.174 1.602 2.706 1.602 4.38s-.606 3.207-1.61 4.39l.008-.01c-1.152 1.389-2.621 2.475-4.299 3.152l-.073.026c-1.736.739-3.756 1.169-5.875 1.169-.053 0-.105 0-.157-.001h.008c-1.062-.003-2.099-.102-3.106-.289l.106.016c-1.352.964-2.934 1.714-4.64 2.158l-.1.022c-.389.1-.886.195-1.391.264l-.074.008h-.051c-.135-.002-.257-.053-.35-.136-.105-.088-.177-.213-.196-.355v-.003c-.011-.032-.017-.069-.017-.107 0-.001 0-.002 0-.004 0-.001 0-.001 0-.002 0-.038.003-.076.009-.113l-.001.004c.007-.038.019-.073.035-.104l-.001.002.042-.086.06-.094.068-.086.08-.086.068-.08q.086-.102.392-.426t.443-.503.383-.494c.152-.191.293-.406.415-.633l.011-.023q.179-.341.35-.75c-1.342-.759-2.454-1.773-3.303-2.985l-.021-.032c-.753-1.063-1.207-2.384-1.214-3.811v-.002c.008-1.673.611-3.203 1.609-4.391l-.009.011c1.152-1.389 2.621-2.475 4.299-3.152l.073-.026c1.736-.739 3.756-1.169 5.875-1.169.054 0 .107 0 .161.001h-.008zm14.01 19.925q.17.409.35.75c.133.25.274.465.433.665l-.007-.009q.247.315.383.494t.443.503q.306.32.392.426.017.017.068.08t.08.086c.024.026.046.054.066.083l.002.002c.02.027.04.058.058.09l.002.004.042.086.034.102.009.11-.017.11c-.029.152-.108.282-.22.374l-.001.001c-.089.075-.205.121-.331.121-.015 0-.031-.001-.046-.002h.002c-2.356-.314-4.462-1.187-6.243-2.482l.039.027c-.901.171-1.938.27-2.998.273h-.002c-.099.002-.216.004-.334.004-2.863 0-5.53-.84-7.767-2.287l.056.034q.989.068 1.5.068h.067c1.855 0 3.644-.28 5.327-.801l-.128.034c1.716-.516 3.212-1.266 4.544-2.229l-.044.03c1.336-.962 2.431-2.169 3.24-3.563l.029-.055c.718-1.244 1.142-2.736 1.142-4.327 0-.926-.143-1.818-.409-2.655l.017.062c1.401.751 2.564 1.773 3.457 3.004l.02.029c.799 1.084 1.278 2.446 1.278 3.921 0 1.433-.453 2.76-1.224 3.846l.014-.021c-.872 1.24-1.984 2.251-3.275 2.983l-.05.026z"></path>
							</svg>
						</p>
						<p class="m-0 p-0"><?= rounding_number_by_places($comments_count); ?></p>
					</span>
					<img class="<?= $offline_class; ?> w-100 border-radius-15" src="<?= 'users/'.$photo_user_uuid.'/'.$photo_name; ?>" alt="<?= $photo_user_name; ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$user_uuid.'\',\''.$photo_user_uuid.'\',\''.$photo_name.'\''; ?>);">
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
		<h5 class="fz-15 m-0 p-0 font-weight-bold letter-spacing-05">Самые сохраняемые</h5>
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
					<span class="position-absolute popular-card-badge fz-13 font-weight-bold <?= $text_color_class; ?> d-flex flex-row align-items-center">
						<p class="m-0 p-0 mr-1 d-flex align-items-center">
							<svg viewBox="0 0 24 24" fill="none">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 3C3.5 1.89543 4.39543 1 5.5 1H18.5C19.6046 1 20.5 1.89543 20.5 3V22C20.5 22.3612 20.3052 22.6944 19.9904 22.8715C19.6756 23.0486 19.2897 23.0422 18.981 22.8548L12 18.6157L5.01903 22.8548C4.71028 23.0422 4.32441 23.0486 4.00961 22.8715C3.6948 22.6944 3.5 22.3612 3.5 22V3ZM18.5 3L5.5 3V20.2228L11.481 16.591C11.7999 16.3974 12.2001 16.3974 12.519 16.591L18.5 20.2228V3Z"></path>
							</svg>
						</p>
						<p class="m-0 p-0"><?= rounding_number_by_places($saves_count); ?></p>
					</span>
					<img class="<?= $offline_class; ?> w-100 border-radius-15" style="<?= $border_style; ?>" src="<?= 'users/'.$photo_user_uuid.'/'.$photo_name; ?>" alt="<?= $photo_user_name; ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$user_uuid.'\',\''.$photo_user_uuid.'\',\''.$photo_name.'\''; ?>);">
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