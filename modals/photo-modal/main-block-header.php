<?
	include("../functions/functions-for-check.php");
?>
<div class="modal-header d-flex flex-row">
	<div class="mr-auto d-flex flex-row align-items-center">
		<a class="m-0 p-0" href="<?= ($current_user_uuid == $user_uuid) ? './' : './?u='.get_user_nickname($user_uuid); ?>" title="<?= get_user_fullname($user_uuid); ?>">
<?
		$ban_check = ban_check($user_uuid);
		$preview_photo_check = file_exists('../users/'.$user_uuid.'/'.get_latest_avatar_preview($user_uuid)) ? 1 : 0;
		$hash_current_user_photo_modal = sha1($user_uuid);
		$premium_status = check_premium_active($user_uuid);
		
		if ($ban_check == 'success')
			if (!is_null(check_user_online_status($user_uuid)))
				echo '<img class="rounded-circle online m-0 p-0 rounded-saved-user-picture" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($user_uuid) : get_latest_avatar($user_uuid)).'" alt="'.get_user_fullname($user_uuid).'">';
			else
				echo '<img class="rounded-circle offline m-0 p-0 rounded-saved-user-picture" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($user_uuid) : get_latest_avatar($user_uuid)).'" alt="'.get_user_fullname($user_uuid).'">';
		else
			echo '<img class="rounded-circle offline m-0 p-0 rounded-saved-user-picture" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($user_uuid) : get_latest_avatar($user_uuid)).'" alt="'.get_user_fullname($user_uuid).'">';
?>
		</a>

		<a class="m-0 p-0 ml-3 modal-header-user-fullname font-weight-bold" href="<?= ($current_user_uuid == $user_uuid) ? './' : './?u='.get_user_nickname($user_uuid) ?>" 
			title="<?= get_user_fullname($user_uuid); ?>">
<?
		if ($premium_status)
		{
?>
			<p class="fz-16 m-0 w-100 text-left font-weight-bold d-flex align-items-center"><?= get_user_fullname($user_uuid); ?>
				<svg class="ml-2 premium-star active" width="15px" height="15px" viewBox="0 0 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#2ACAEA" stroke-width="0.00048000000000000007" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
					<defs>  
						<linearGradient id="premium-logo-gradient-<?= $hash_current_user_photo_modal; ?>" x1="50%" y1="0%" x2="50%" y2="100%" > 
							<stop offset="0%" stop-color="#7A5FFF">
								<animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
							</stop>
              <stop offset="100%" stop-color="#01FF89">
                <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
              </stop>
						</linearGradient> 
					</defs>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8712 33.0436L15.9976 44.7036C15.9362 45.5229 16.6646 46.0872 17.3161 45.722C21.9289 43.1382 36.3783 33.6479 43.7017 12.7899C44.0376 11.8331 43.1352 10.9697 42.3646 11.5094C38.0387 14.539 28.5846 20.8006 22.7421 21.9934C22.7421 21.9934 26.4836 19.3946 28.7231 15.4053C28.9426 15.0143 28.9244 14.5136 28.6796 14.1606L20.5127 2.38925C20.0287 1.69147 19.0354 1.98057 18.8606 2.87002L16.3181 15.8073L4.38437 26.2226C3.78602 26.7446 3.90808 27.7996 4.5989 28.079L16.8712 33.0436Z" fill="url('#premium-logo-gradient-<?= $hash_current_user_photo_modal; ?>')"></path> 
          <path fill-rule="evenodd" clip-rule="evenodd" d="M37.9745 28.448C37.2188 29.5025 35.5908 31.6717 34.0876 32.9974C33.7871 33.2624 33.8276 33.7068 34.1724 33.9234L42.1145 38.909C42.5926 39.2091 43.2384 38.8529 43.1576 38.3323C42.7882 35.9496 41.7237 30.9818 39.0328 28.3741C38.7322 28.083 38.2142 28.1136 37.9745 28.448Z" fill="url('#premium-logo-gradient-<?= $hash_current_user_photo_modal; ?>')"></path> 
				</svg>
			</p>
<?
		}else
		{
?>
    	<p class="fz-16 m-0 w-100 text-left font-weight-bold"><?= get_user_fullname($user_uuid); ?></p>
<?
   	}
?>
				<p class="fz-12 m-0 w-100 text-left" id="nickname"><?= '@'.get_user_nickname($user_uuid); ?></p>
		</a>
	</div>

	<p class="ml-auto modal-close" data-dismiss="modal" aria-label="Close">
		<svg viewBox="0 0 48 48" width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" class="svg-close-icon">
			<rect width="48" height="48" fill="none"></rect>
			<path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
		</svg>
	</p>
</div>