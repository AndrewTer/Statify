<div class="modal-body upp-modal-body"> 
	<img class="w-100" id="userImg" src="users/<?= $user_uuid.'/'.$picture_name; ?>" alt="<?= get_user_fullname($user_uuid); ?>">

<?
	if ($current_user_uuid == $user_uuid)
	{
		$picture_uuid = get_photo_uuid_by_name($picture_name);
?>
		<div class="photo-statistics" id="photo-statistics">
			<div class="d-flex flex-row justify-content-center align-items-center pl-2 pr-2">
				<div class="w-100 m-0 ml-auto p-0 pr-4">
					<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
					<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
					<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
   				<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
				</div>
				<p class="fz-13 p-1 m-0 mr-auto statistics-number"><?= rounding_number_by_places(get_user_photo_statistics_stars_count($user_uuid, $picture_uuid, 5)); ?></p>
			</div>

			<div class="d-flex flex-row justify-content-center align-items-center pl-2 pr-2">
				<div class="w-100 m-0 ml-auto p-0 pr-4">
			  	<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o unactive-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  </div>
			  <p class="fz-13 p-1 m-0 mr-auto statistics-number"><?= rounding_number_by_places(get_user_photo_statistics_stars_count($user_uuid, $picture_uuid, 4)); ?></p>
			</div>

			<div class="d-flex flex-row justify-content-center align-items-center pl-2 pr-2">
				<div class="w-100 m-0 ml-auto p-0 pr-4">
			  	<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o unactive-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o unactive-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  </div>
			  <p class="fz-13 p-1 m-0 mr-auto statistics-number"><?= rounding_number_by_places(get_user_photo_statistics_stars_count($user_uuid, $picture_uuid, 3)); ?></p>
			</div>

			<div class="d-flex flex-row justify-content-center align-items-center pl-2 pr-2">
				<div class="w-100 m-0 ml-auto p-0 pr-4">
			  	<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o unactive-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o unactive-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o unactive-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  </div>
			  <p class="fz-13 p-1 m-0 mr-auto statistics-number"><?= rounding_number_by_places(get_user_photo_statistics_stars_count($user_uuid, $picture_uuid, 2)); ?></p>
			</div>

			<div class="d-flex flex-row justify-content-center align-items-center pl-2 pr-2">
				<div class="w-100 m-0 ml-auto p-0 pr-4">
			  	<i class="fa fa-star-o active-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o unactive-star fz-13 p-0 pr-1" aria-hidden="true"></i>
			  	<i class="fa fa-star-o unactive-star fz-13 p-0 pr-1" aria-hidden="true"></i>
					<i class="fa fa-star-o unactive-star fz-13 p-0 pr-1" aria-hidden="true"></i>
					<i class="fa fa-star-o unactive-star fz-13 p-0 pr-1" aria-hidden="true"></i>
				</div>
				<p class="fz-13 p-1 m-0 mr-auto statistics-number"><?= rounding_number_by_places(get_user_photo_statistics_stars_count($user_uuid, $picture_uuid, 1)); ?></p>
			</div>
<?
		if ($premium_status)
		{
?>
			<hr class="hr-user-info">
			<div class="d-flex flex-row justify-content-center align-items-center p-1">
				<div class="m-0 mr-auto p-0 d-flex flex-column justify-content-center align-items-center">
					<svg width="16px" height="16px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="bi bi-bookmarks-fill">
						<defs>  
		          <linearGradient id="premium-icon-gradient-saves-photo-statistics" x1="50%" y1="0%" x2="50%" y2="100%" > 
		            <stop offset="0%" stop-color="#7A5FFF">
		              <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
		            </stop>
		            <stop offset="100%" stop-color="#01FF89">
		              <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
		            </stop>
		          </linearGradient> 
		        </defs>
	        	<path fill="url('#premium-icon-gradient-saves-photo-statistics')" d="M2 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L7 13.101l-4.223 2.815A.5.5 0 0 1 2 15.5V4z"></path> 
	        	<path fill="url('#premium-icon-gradient-saves-photo-statistics')" d="M4.268 1A2 2 0 0 1 6 0h6a2 2 0 0 1 2 2v11.5a.5.5 0 0 1-.777.416L13 13.768V2a1 1 0 0 0-1-1H4.268z"></path> 
        	</svg>
        	<p class="fz-12 p-1 pt-2 pb-0 m-0 statistics-number"><?= rounding_number_by_places(get_user_photo_statistics_saves_count($user_uuid, $picture_uuid, 'all')); ?></p>
				</div>

				<div class="m-0 p-0 d-flex flex-column justify-content-center align-items-center">
					<svg fill="url('#premium-icon-gradient-saves-by-male-photo-statistics')" width="16px" height="16px" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
						<defs>  
		          <linearGradient id="premium-icon-gradient-saves-by-male-photo-statistics" x1="50%" y1="0%" x2="50%" y2="100%" > 
		            <stop offset="0%" stop-color="#7A5FFF">
		              <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
		            </stop>
		            <stop offset="100%" stop-color="#01FF89">
		              <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
		            </stop>
		          </linearGradient> 
		        </defs>
						<path d="M223.96008,39.20947c-.01117-.11377-.03271-.22412-.04858-.33642-.02069-.146-.038-.29248-.06671-.4375-.026-.13086-.0622-.2583-.09461-.38721-.03106-.124-.05829-.24854-.09546-.37158-.03839-.12647-.08593-.24854-.13037-.37256-.04382-.12256-.08429-.24609-.13427-.3667-.04779-.11523-.104-.22559-.157-.33838-.05835-.124-.11358-.249-.17865-.3706-.05774-.10791-.12359-.21-.186-.315-.07111-.11914-.13873-.24023-.21661-.35644-.07593-.11328-.16059-.22022-.242-.3291-.07464-.1001-.14429-.20264-.22424-.3003-.1521-.185-.31384-.36181-.48175-.53271-.01654-.01709-.0304-.03564-.04712-.05225-.019-.019-.04-.03466-.05908-.05322-.169-.16553-.34357-.32568-.52668-.47607-.09124-.07471-.18744-.14014-.28119-.21-.1156-.08692-.22888-.17627-.34924-.25684-.1076-.07227-.21942-.13428-.32965-.2002-.11407-.06884-.226-.14013-.34369-.20312-.10907-.05811-.22125-.10742-.33233-.16016-.12574-.06006-.24988-.12207-.37915-.17578-.1034-.04248-.20905-.07666-.31373-.11474-.14166-.05176-.28216-.10547-.42742-.14942-.09772-.02978-.197-.05029-.2956-.07617-.15411-.04-.30725-.08252-.46478-.11328-.10382-.02051-.20874-.03174-.31317-.04785-.153-.02393-.30457-.05127-.46027-.06641-.15863-.01562-.31787-.01807-.477-.02441C216.20215,32.01172,216.10254,32,216,32H168a8,8,0,0,0,0,16h28.68591l-42.0578,42.05762a80.00085,80.00085,0,1,0,11.31391,11.314L208,59.314V88a8,8,0,0,0,16,0V40.00244C224.00006,39.73779,223.98608,39.47314,223.96008,39.20947Zm-74.7052,158.04541a63.96974,63.96974,0,1,1,0-90.50976A64.07169,64.07169,0,0,1,149.25488,197.25488Z"></path>
					</svg>
        	<p class="fz-12 p-1 pt-2 pb-0 m-0 statistics-number"><?= rounding_number_by_places(get_user_photo_statistics_saves_count($user_uuid, $picture_uuid, 'male')); ?></p>
				</div>

				<div class="m-0 ml-auto p-0 d-flex flex-column justify-content-center align-items-center">
					<svg fill="url('#premium-icon-gradient-saves-by-female-photo-statistics')" width="16px" height="16px" viewBox="0 0 256 256" xmlns="http://www.w3.org/2000/svg">
						<defs>  
		          <linearGradient id="premium-icon-gradient-saves-by-female-photo-statistics" x1="50%" y1="0%" x2="50%" y2="100%" > 
		            <stop offset="0%" stop-color="#7A5FFF">
		              <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
		            </stop>
		            <stop offset="100%" stop-color="#01FF89">
		              <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
		            </stop>
		          </linearGradient> 
		        </defs>
						<path d="M208,96a80,80,0,1,0-88,79.59912V200H88a8,8,0,0,0,0,16h32v24a8,8,0,0,0,16,0V216h32a8,8,0,0,0,0-16H136V175.59912A80.1104,80.1104,0,0,0,208,96ZM64,96a64,64,0,1,1,64,64A64.07239,64.07239,0,0,1,64,96Z"></path>
					</svg>
        	<p class="fz-12 p-1 pt-2 pb-0 m-0 statistics-number"><?= rounding_number_by_places(get_user_photo_statistics_saves_count($user_uuid, $picture_uuid, 'female')); ?></p>
				</div>
			</div>
<?
		}
?>
		</div>
<?
	}
?>
</div>