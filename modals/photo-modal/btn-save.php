<div class="ml-auto m-0 p-1 current-photo-menu photo-menu-right d-flex align-items-center justify-content-center">
	<div class="nav-item m-0 w-100" id="savephoto">
<?
	if (check_saved_photo($current_user_uuid, $user_uuid, $picture_name) == 'saved')
		echo '<a class="nav-link p-0 text-center d-flex flex-row justify-content-center align-items-center" 
							style="border: none;" 
							onclick="event.preventDefault();unsavePicture(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$picture_name.'\');">
						<i class="fa fa-bookmark fz-18 p-1 m-0 save-icon" aria-hidden="true"></i>
					</a>';
	else
		echo '<a class="nav-link p-0 text-center d-flex flex-row justify-content-center align-items-center" 
							style="border: none;" 
							onclick="event.preventDefault();savePicture(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$picture_name.'\');">
						<i class="fa fa-bookmark-o fz-18 p-1 m-0" aria-hidden="true"></i>
					</a>';
?>
	</div>
</div>