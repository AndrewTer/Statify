<div class="ml-auto m-0 p-1 current-photo-menu photo-menu-right d-flex align-items-center justify-content-center">
	<div class="nav-item m-0 w-100" id="savephoto">
<?
	if (check_saved_photo($current_user_uuid, $user_uuid, $picture_name) == 'saved')
		echo '<a class="nav-link p-0 text-center d-flex flex-row justify-content-center align-items-center" 
							style="border: none;" 
							onclick="event.preventDefault();unsavePicture(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$picture_name.'\');">
						<p class="m-0 p-0">
							<svg width="22px" height="22px" viewBox="0 0 24 24" fill="none">
								<path d="M5.5 1C4.39543 1 3.5 1.89543 3.5 3V22C3.5 22.3612 3.6948 22.6944 4.00961 22.8715C4.32441 23.0486 4.71028 23.0422 5.01903 22.8548L12 18.6157L18.981 22.8548C19.2897 23.0422 19.6756 23.0486 19.9904 22.8715C20.3052 22.6944 20.5 22.3612 20.5 22V3C20.5 1.89543 19.6046 1 18.5 1H5.5Z" fill="var(--save-icon-color)"></path>
							</svg>
						</p>
					</a>';
	else
		echo '<a class="nav-link p-0 text-center d-flex flex-row justify-content-center align-items-center" 
							style="border: none;" 
							onclick="event.preventDefault();savePicture(\''.$current_user_uuid.'\',\''.$user_uuid.'\',\''.$picture_name.'\');">
						<p class="m-0 p-0">
							<svg width="22px" height="22px" viewBox="0 0 24 24" fill="none">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 3C3.5 1.89543 4.39543 1 5.5 1H18.5C19.6046 1 20.5 1.89543 20.5 3V22C20.5 22.3612 20.3052 22.6944 19.9904 22.8715C19.6756 23.0486 19.2897 23.0422 18.981 22.8548L12 18.6157L5.01903 22.8548C4.71028 23.0422 4.32441 23.0486 4.00961 22.8715C3.6948 22.6944 3.5 22.3612 3.5 22V3ZM18.5 3L5.5 3V20.2228L11.481 16.591C11.7999 16.3974 12.2001 16.3974 12.519 16.591L18.5 20.2228V3Z" fill="var(--main-text-color)"></path>
							</svg>
						</p>
					</a>';
?>
	</div>
</div>