<?php
	function profile_picture_modal($current_user_uuid, $user_uuid, $picture_name, $type)
	{
		if (!empty($current_user_uuid) && !empty($user_uuid) && !empty($picture_name) && !empty($type)
			&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $current_user_uuid))
			&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
		{
			include("../modals/photo-modal/main-block.php");
		}else
			return null;
	};

	function report_user_modal($author_uuid, $receiver_uuid, $receiver_name)
	{
		if (!empty($author_uuid) && !empty($receiver_uuid) && !empty($receiver_name)
			&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $author_uuid))
			&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $receiver_uuid)))
		{
			echo '
				<div class="modal fade" id="ucm" tabindex="-1" role="dialog" aria-hidden="true">
			  	<div class="modal-dialog modal-dialog-centered" role="document">
			    	<div class="modal-content">

			      	<div class="modal-header">
			        	<h5 class="modal-title text-center font-weight-bold">Окно жалобы</h5>
			        	<p class="modal-close" data-dismiss="modal" aria-label="Close">
			          	<svg viewBox="0 0 48 48" width="25px" height="25px" class="svg-close-icon">
			          		<rect width="48" height="48" fill="none"></rect> 
			          		<path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
			          	</svg>
			        	</p>
			      	</div>

			      	<div class="modal-body">
			        	<div class="p-0 m-2">
			          	<p class="text-center fz-14"><strong class="fz-14 complaint-bold-text font-weight-bold">Жалоба на пользователя '.$receiver_name.'</strong></p>

			          	<div class="form-group">
			            	<label class="fz-14">Пожалуйста, уточните <strong class="fz-14 complaint-bold-text font-weight-bold">причину</strong> жалобы:</label>
			            
			            	<div class="form-check m-1">
			              	<input class="form-check-input" type="radio" name="complaintReasons" id="spamAdvertising" value="spamAdvertising">
			              	<label class="form-check-label fz-14 w-100 ml-3" for="spamAdvertising">Реклама / Спам</label>
			            	</div>

			            	<div class="form-check m-1">
			              	<input class="form-check-input" type="radio" name="complaintReasons" id="forbiddenContent" value="forbiddenContent">
			              	<label class="form-check-label fz-14 w-100 ml-3" for="forbiddenContent">Запрещённый / Непотребный контент</label>
										</div>

										<div class="form-check m-1">
			              	<input class="form-check-input" type="radio" name="complaintReasons" id="rudeBehavior" value="rudeBehavior">
			              	<label class="form-check-label fz-14 w-100 ml-3" for="rudeBehavior">Оскорбления / Грубое поведение</label>
			            	</div>

			            	<div class="form-check m-1">
			              	<input class="form-check-input" type="radio" name="complaintReasons" id="userPersonalDataOtherUsers" value="userPersonalDataOtherUsers">
			              	<label class="form-check-label fz-14 w-100 ml-3" for="userPersonalDataOtherUsers">Используется моя фотография / мои личные данные</label>
			            	</div>

			            	<div class="form-check m-1">
			              	<input class="form-check-input" type="radio" name="complaintReasons" id="otherReason" value="otherReason" checked>
			              	<label class="form-check-label fz-14 w-100 ml-3" for="otherReason">Иная причина (просим указать в поле для комментария)</label>
			            	</div>
			          	</div>

			          	<div class="form-group">
			            	<label for="commentOnComplaint"><strong class="fz-14 complaint-bold-text font-weight-bold">Комментарий</strong></label>
			            	<textarea class="form-control fz-14 textarea" rows="5" name="commentOnComplaint" maxlength="500" placeholder="Не более 500 символов"></textarea>
			          	</div>

			          	<div class="w-100 d-flex flex-row-reverse justify-content-center">
			              <input type="submit" class="btn w-35 m-0 btn-skip fz-14" value="Отмена" data-dismiss="modal" aria-label="Close">
			              <input type="submit" class="btn w-35 m-0 mr-4 btn-red fz-14" 
			              				value="Отправить" 
			              				data-complaintauthor=\''.$author_uuid.'\' 
			              				data-complaintreceiver=\''.$receiver_uuid.'\'
			              				data-dismiss="modal" 
			              				onclick="event.preventDefault();sendComplaintOnUser(this);"> 
			          	</div>

			        	</div>
			      	</div>

			    	</div>
			  	</div>
				</div>';
		}else
			return null;
	}

	function more_info_user_modal($user_uuid, $current_user_uuid)
	{
		if (!empty($user_uuid)
			&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $user_uuid)))
		{
			$current_user_page_status = check_user_page_status($user_uuid);
			$current_user_nickname = get_user_nickname($user_uuid);

			$current_user_country = get_user_country_name($user_uuid);
			$current_user_city = get_user_city_name($user_uuid);
			$current_user_birthday = get_user_birthday($user_uuid);
			$current_user_gender = get_user_gender($user_uuid);

			$current_user_gender_preference = get_user_gender_preference($user_uuid);
			$current_user_minimum_age_preference = get_user_minimum_age_preference($user_uuid);
			$current_user_maximum_age_preference = get_user_maximum_age_preference($user_uuid);
?>
			<div class="modal fade" id="user-more-info-modal" tabindex="-1" role="dialog" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">

			      <div class="modal-header">
			        <h5 class="modal-title text-center font-weight-bold">Подробная информация</h5>
			        <p class="modal-close" data-dismiss="modal" aria-label="Close">
			          <svg viewBox="0 0 48 48" width="25px" height="25px" class="svg-close-icon">
			          	<rect width="48" height="48" fill="none"></rect>
			          	<path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
			          </svg>
			        </p>
			      </div>

			      <div class="modal-body">
			        <div class="p-0 m-2">
			          <span class="m-0 p-0 w-100 d-flex flex-row align-items-center">
			          	<p class="m-0 p-0">
			          		<svg width="16px" height="16px" viewBox="0 0 24 24" fill="none">
			          			<path stroke="var(--main-text-color)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 20.064A9 9 0 1 1 21 12v1.5a2.5 2.5 0 0 1-5 0V8m0 4a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"></path>
			          		</svg>
			          	</p>
			          	<p class="m-0 ml-3 p-0 fz-14 font-weight-bold" id="nickname"><?= ($current_user_nickname) ? $current_user_nickname : 'Отсутствует'; ?></p>
			          </span>

			          <span class="m-0 mt-2 p-0 w-100 d-flex flex-row align-items-center">
<?
								if ($current_user_country && $current_user_city)
							    echo '<p class="m-0 p-0">
							            <svg class="m-0 p-0" width="16px" height="16px" viewBox="0 0 16 16" fill="var(--main-text-color)">
							              <path d="m 8 0 c -3.3125 0 -6 2.6875 -6 6 c 0.007812 0.710938 0.136719 1.414062 0.386719 2.078125 l -0.015625 -0.003906 c 0.636718 1.988281 3.78125 5.082031 5.625 6.929687 h 0.003906 v -0.003906 c 1.507812 -1.507812 3.878906 -3.925781 5.046875 -5.753906 c 0.261719 -0.414063 0.46875 -0.808594 0.585937 -1.171875 l -0.019531 0.003906 c 0.25 -0.664063 0.382813 -1.367187 0.386719 -2.078125 c 0 -3.3125 -2.683594 -6 -6 -6 z m 0 3.691406 c 1.273438 0 2.308594 1.035156 2.308594 2.308594 s -1.035156 2.308594 -2.308594 2.308594 c -1.273438 -0.003906 -2.304688 -1.035156 -2.304688 -2.308594 c -0.003906 -1.273438 1.03125 -2.304688 2.304688 -2.308594 z m 0 0" fill="var(--main-text-color)"></path>
							            </svg>
							          </p>
							          <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">'.$current_user_country.', '.$current_user_city.'</p>';
							  elseif ($current_user_country && !$current_user_city)
							    echo '<p class="m-0 p-0">
							            <svg class="m-0 p-0" width="16px" height="16px" viewBox="0 0 16 16" fill="var(--main-text-color)">
							              <path d="m 8 0 c -3.3125 0 -6 2.6875 -6 6 c 0.007812 0.710938 0.136719 1.414062 0.386719 2.078125 l -0.015625 -0.003906 c 0.636718 1.988281 3.78125 5.082031 5.625 6.929687 h 0.003906 v -0.003906 c 1.507812 -1.507812 3.878906 -3.925781 5.046875 -5.753906 c 0.261719 -0.414063 0.46875 -0.808594 0.585937 -1.171875 l -0.019531 0.003906 c 0.25 -0.664063 0.382813 -1.367187 0.386719 -2.078125 c 0 -3.3125 -2.683594 -6 -6 -6 z m 0 3.691406 c 1.273438 0 2.308594 1.035156 2.308594 2.308594 s -1.035156 2.308594 -2.308594 2.308594 c -1.273438 -0.003906 -2.304688 -1.035156 -2.304688 -2.308594 c -0.003906 -1.273438 1.03125 -2.304688 2.304688 -2.308594 z m 0 0" fill="var(--main-text-color)"></path>
							            </svg>
							          </p>
							          <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">'.$current_user_country.'</p>';
							  else
							    echo '<p class="m-0 p-0">
							            <svg class="m-0 p-0" width="16px" height="16px" viewBox="0 0 16 16" fill="var(--main-text-color)">
							              <path d="m 8 0 c -1.894531 0 -3.582031 0.882812 -4.679688 2.257812 l -1.789062 -1.789062 l -1.0625 1.0625 l 14 14 l 1.0625 -1.0625 l -3.652344 -3.652344 c 0.449219 -0.546875 0.855469 -1.082031 1.167969 -1.570312 c 0.261719 -0.414063 0.46875 -0.808594 0.585937 -1.171875 l -0.019531 0.003906 c 0.25 -0.664063 0.382813 -1.367187 0.386719 -2.078125 c 0.003906 -3.3125 -2.6875 -6 -6 -6 z m 0 3.695312 c 1.273438 -0.003906 2.308594 1.03125 2.308594 2.304688 c 0 0.878906 -0.492188 1.640625 -1.214844 2.03125 l -3.125 -3.125 c 0.390625 -0.722656 1.152344 -1.210938 2.03125 -1.210938 z m -5.9375 1.429688 c -0.039062 0.289062 -0.0625 0.578125 -0.0625 0.875 c 0.003906 0.710938 0.136719 1.414062 0.386719 2.082031 l -0.015625 -0.007812 c 0.636718 1.988281 3.78125 5.082031 5.628906 6.925781 v 0.003906 v -0.003906 c 0.5625 -0.5625 1.25 -1.253906 1.945312 -1.992188 z m 0 0" fill="var(--main-text-color)"></path>
							            </svg>
							          </p>
							          <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">Не указано</p>';
?>
								</span>

								<span class="m-0 mt-2 p-0 w-100 d-flex flex-row align-items-center">
<?
								if ($current_user_birthday)
						      echo '<p class="m-0 p-0">
						              <svg class="m-0 p-0" width="16px" height="16px" fill="var(--main-text-color)" viewBox="0 0 32 32">
						                <path d="M28 4.75h-0.75v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-17.5v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-0.75c-1.794 0.002-3.248 1.456-3.25 3.25v19.998c0.002 1.794 1.456 3.248 3.25 3.25h24c1.794-0.001 3.249-1.456 3.25-3.25v-19.998c-0.002-1.794-1.456-3.248-3.25-3.25h-0zM14.75 13.25v3.5h-5.5v-3.5zM22.75 13.25v3.5h-5.5v-3.5zM28.75 13.25v3.5h-3.5v-3.5zM6.75 16.75h-3.5v-3.5h3.5zM3.25 19.25h3.5v3.5h-3.5zM9.25 19.25h5.5v3.5h-5.5zM14.75 25.25v3.498h-5.5v-3.498zM17.25 25.25h5.5v3.498h-5.5zM17.25 22.75v-3.5h5.5v3.5zM25.25 19.25h3.5v3.5h-3.5zM4 7.25h24c0.414 0 0.75 0.336 0.75 0.75v2.75h-25.5v-2.75c0.001-0.414 0.336-0.749 0.75-0.75h0zM3.25 27.998v-2.748h3.5v3.498h-2.75c-0.414-0-0.75-0.336-0.75-0.75v-0zM28 28.748h-2.75v-3.498h3.5v2.748c-0 0.414-0.336 0.75-0.75 0.75v0z"></path>
						              </svg>
						            </p>
						            <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">Возраст: '.calculate_age($current_user_birthday).'</p>';
						    else
						      echo '<p class="m-0 p-0">
						              <svg class="m-0 p-0" width="16px" height="16px" fill="var(--main-text-color)" viewBox="0 0 32 32">
						                <path d="M28 4.75h-0.75v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-17.5v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-0.75c-1.794 0.002-3.248 1.456-3.25 3.25v19.998c0.002 1.794 1.456 3.248 3.25 3.25h24c1.794-0.001 3.249-1.456 3.25-3.25v-19.998c-0.002-1.794-1.456-3.248-3.25-3.25h-0zM4 7.25h24c0.414 0 0.75 0.336 0.75 0.75v2.75h-25.5v-2.75c0.001-0.414 0.336-0.749 0.75-0.75h0zM28 28.748h-24c-0.414-0-0.75-0.336-0.75-0.75v-14.748h25.5v14.748c-0 0.414-0.336 0.75-0.75 0.75v0zM19.896 17.31c-0.226-0.226-0.539-0.366-0.884-0.366s-0.658 0.14-0.884 0.366l-2.129 2.13-2.13-2.13c-0.226-0.226-0.539-0.366-0.884-0.366-0.69 0-1.25 0.559-1.25 1.25 0 0.345 0.14 0.657 0.366 0.883l2.131 2.132-2.131 2.132c-0.227 0.226-0.368 0.539-0.368 0.885 0 0.69 0.559 1.249 1.249 1.249 0.346 0 0.66-0.141 0.886-0.369l2.13-2.13 2.129 2.13c0.226 0.227 0.539 0.367 0.885 0.367 0.69 0 1.25-0.56 1.25-1.25 0-0.345-0.14-0.657-0.365-0.883l-2.131-2.132 2.131-2.132c0.226-0.226 0.365-0.538 0.365-0.882s-0.14-0.658-0.367-0.884l-0-0z"></path>
						              </svg>
						            </p>
						            <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">Возраст: Не указан</p>';
?>
								</span>

								<span class="m-0 mt-2 p-0 w-100 d-flex flex-row align-items-center">
<?
								switch ($current_user_gender) {
							    case 'male':
							      echo '<p class="m-0 p-0">
							              <svg class="m-0 p-0" width="16px" height="16px" fill="var(--main-text-color)" viewBox="0 0 256 256">
							                <path d="M227.9978,39.95557q-.00219-.56984-.05749-1.13819c-.018-.18408-.05237-.36279-.07849-.54443-.02979-.20557-.05371-.41211-.09424-.61621-.04029-.20362-.09607-.40088-.14649-.60059-.04541-.18017-.08484-.36084-.13867-.53906-.05884-.19434-.13159-.38135-.19971-.57129-.06445-.17969-.12353-.36084-.19677-.5376-.07349-.17724-.15967-.34668-.24109-.51953-.08582-.18213-.16687-.36621-.26257-.54492-.088-.16455-.18824-.32031-.2837-.48047-.10534-.17627-.2052-.355-.32031-.52685-.11572-.17334-.24475-.33545-.369-.502-.11-.14746-.21252-.29834-.3302-.4414-.23462-.28614-.4834-.55957-.74316-.82227-.01782-.01807-.03247-.03809-.05054-.05615-.01953-.01953-.041-.03565-.06067-.05469-.26123-.25781-.53271-.50537-.81653-.73828-.14794-.12158-.30383-.22754-.45605-.34082-.16138-.12061-.31885-.24561-.48645-.35791-.17725-.11865-.36108-.22168-.54309-.33008-.15442-.0918-.30518-.189-.46411-.27392-.18311-.09815-.37134-.18116-.55811-.269-.16846-.07959-.334-.16357-.50659-.23486-.18042-.0752-.36475-.13525-.54785-.20068-.18652-.0669-.37073-.13868-.56152-.19629-.18189-.05518-.3667-.09571-.55066-.14161-.19568-.04931-.389-.10449-.58851-.144-.20935-.041-.42077-.06592-.63171-.09619-.17688-.02539-.351-.05908-.53027-.07666q-.56837-.05567-1.13953-.05762c-.01465,0-.02893-.002-.0437-.002H168a12,12,0,0,0,0,24h19.02905l-32.7334,32.7334a83.9988,83.9988,0,1,0,16.971,16.97021L204,68.9707V88a12,12,0,0,0,24,0V40C228,39.98486,227.9978,39.97021,227.9978,39.95557ZM146.42627,194.42676a59.97169,59.97169,0,1,1,0-84.85352A60.06666,60.06666,0,0,1,146.42627,194.42676Z"></path>
							              </svg>
							            </p>
							            <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">Пол: Мужской</p>';
							      break;

							    case 'female':
							      echo '<p class="m-0 p-0">
							              <svg class="m-0 p-0" width="16px" height="16px" fill="var(--main-text-color)" viewBox="0 0 256 256">
							                <path d="M212,96a84,84,0,1,0-96,83.12891V196H88a12,12,0,0,0,0,24h28v20a12,12,0,0,0,24,0V220h28a12,12,0,0,0,0-24H140V179.12891A84.119,84.119,0,0,0,212,96ZM68,96a60,60,0,1,1,60,60A60.06812,60.06812,0,0,1,68,96Z"></path>
							              </svg>
							            </p>
							            <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">Пол: Женский</p>';
							      break;

							    default:
							      echo '<p class="m-0 p-0">
							              <svg class="m-0 p-0" width="16px" height="16px" fill="var(--main-text-color)" viewBox="0 0 256 256">
							                <path d="M212,104a84,84,0,1,0-96,83.12891V232a12,12,0,0,0,24,0V187.12891A84.119,84.119,0,0,0,212,104Zm-84,60a60,60,0,1,1,60-60A60.06812,60.06812,0,0,1,128,164Z"></path>
							              </svg>
							            </p>
							            <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">Пол: Не указан</p>';
							      break;
							  }
?>
								</span>

								<div class="hr-with-text mt-2 mb-2"><span class="m-0 fz-15 font-weight-bold">Интересы</span></div>

								<span class="m-0 p-0 w-100 d-flex flex-row align-items-center">
<?
								switch ($current_user_gender_preference) {
							    case 'male':
							      echo '<p class="m-0 p-0">
							              <svg class="m-0 p-0" width="16px" height="16px" fill="var(--main-text-color)" viewBox="0 0 256 256">
							                <path d="M227.9978,39.95557q-.00219-.56984-.05749-1.13819c-.018-.18408-.05237-.36279-.07849-.54443-.02979-.20557-.05371-.41211-.09424-.61621-.04029-.20362-.09607-.40088-.14649-.60059-.04541-.18017-.08484-.36084-.13867-.53906-.05884-.19434-.13159-.38135-.19971-.57129-.06445-.17969-.12353-.36084-.19677-.5376-.07349-.17724-.15967-.34668-.24109-.51953-.08582-.18213-.16687-.36621-.26257-.54492-.088-.16455-.18824-.32031-.2837-.48047-.10534-.17627-.2052-.355-.32031-.52685-.11572-.17334-.24475-.33545-.369-.502-.11-.14746-.21252-.29834-.3302-.4414-.23462-.28614-.4834-.55957-.74316-.82227-.01782-.01807-.03247-.03809-.05054-.05615-.01953-.01953-.041-.03565-.06067-.05469-.26123-.25781-.53271-.50537-.81653-.73828-.14794-.12158-.30383-.22754-.45605-.34082-.16138-.12061-.31885-.24561-.48645-.35791-.17725-.11865-.36108-.22168-.54309-.33008-.15442-.0918-.30518-.189-.46411-.27392-.18311-.09815-.37134-.18116-.55811-.269-.16846-.07959-.334-.16357-.50659-.23486-.18042-.0752-.36475-.13525-.54785-.20068-.18652-.0669-.37073-.13868-.56152-.19629-.18189-.05518-.3667-.09571-.55066-.14161-.19568-.04931-.389-.10449-.58851-.144-.20935-.041-.42077-.06592-.63171-.09619-.17688-.02539-.351-.05908-.53027-.07666q-.56837-.05567-1.13953-.05762c-.01465,0-.02893-.002-.0437-.002H168a12,12,0,0,0,0,24h19.02905l-32.7334,32.7334a83.9988,83.9988,0,1,0,16.971,16.97021L204,68.9707V88a12,12,0,0,0,24,0V40C228,39.98486,227.9978,39.97021,227.9978,39.95557ZM146.42627,194.42676a59.97169,59.97169,0,1,1,0-84.85352A60.06666,60.06666,0,0,1,146.42627,194.42676Z"></path>
							              </svg>
							            </p>
							            <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">Пол: Мужской</p>';
							      break;

							    case 'female':
							      echo '<p class="m-0 p-0">
							              <svg class="m-0 p-0" width="16px" height="16px" fill="var(--main-text-color)" viewBox="0 0 256 256">
							                <path d="M212,96a84,84,0,1,0-96,83.12891V196H88a12,12,0,0,0,0,24h28v20a12,12,0,0,0,24,0V220h28a12,12,0,0,0,0-24H140V179.12891A84.119,84.119,0,0,0,212,96ZM68,96a60,60,0,1,1,60,60A60.06812,60.06812,0,0,1,68,96Z"></path>
							              </svg>
							            </p>
							            <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">Пол: Женский</p>';
							      break;

							    default:
							      echo '<p class="m-0 p-0">
							              <svg class="m-0 p-0" width="16px" height="16px" fill="var(--main-text-color)" viewBox="0 0 256 256">
							                <path d="M212,104a84,84,0,1,0-96,83.12891V232a12,12,0,0,0,24,0V187.12891A84.119,84.119,0,0,0,212,104Zm-84,60a60,60,0,1,1,60-60A60.06812,60.06812,0,0,1,128,164Z"></path>
							              </svg>
							            </p>
							            <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">Пол: Не указан</p>';
							      break;
							  }
?>
								</span>

								<span class="m-0 mt-2 p-0 w-100 d-flex flex-row align-items-center">
<?
								if ($current_user_minimum_age_preference && $current_user_maximum_age_preference)
							    echo '<p class="m-0 p-0">
							            <svg class="m-0 p-0" width="16px" height="16px" fill="var(--main-text-color)" viewBox="0 0 32 32">
							              <path d="M28 4.75h-0.75v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-17.5v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-0.75c-1.794 0.002-3.248 1.456-3.25 3.25v19.998c0.002 1.794 1.456 3.248 3.25 3.25h24c1.794-0.001 3.249-1.456 3.25-3.25v-19.998c-0.002-1.794-1.456-3.248-3.25-3.25h-0zM14.75 13.25v3.5h-5.5v-3.5zM22.75 13.25v3.5h-5.5v-3.5zM28.75 13.25v3.5h-3.5v-3.5zM6.75 16.75h-3.5v-3.5h3.5zM3.25 19.25h3.5v3.5h-3.5zM9.25 19.25h5.5v3.5h-5.5zM14.75 25.25v3.498h-5.5v-3.498zM17.25 25.25h5.5v3.498h-5.5zM17.25 22.75v-3.5h5.5v3.5zM25.25 19.25h3.5v3.5h-3.5zM4 7.25h24c0.414 0 0.75 0.336 0.75 0.75v2.75h-25.5v-2.75c0.001-0.414 0.336-0.749 0.75-0.75h0zM3.25 27.998v-2.748h3.5v3.498h-2.75c-0.414-0-0.75-0.336-0.75-0.75v-0zM28 28.748h-2.75v-3.498h3.5v2.748c-0 0.414-0.336 0.75-0.75 0.75v0z"></path>
							            </svg>
							          </p>
							          <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">Возраст: от '.$current_user_minimum_age_preference.' до '.$current_user_maximum_age_preference.'</p>';
							  elseif ($current_user_minimum_age_preference && !$current_user_maximum_age_preference)
							    echo '<p class="m-0 p-0">
							            <svg class="m-0 p-0" width="16px" height="16px" fill="var(--main-text-color)" viewBox="0 0 32 32">
							              <path d="M28 4.75h-0.75v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-17.5v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-0.75c-1.794 0.002-3.248 1.456-3.25 3.25v19.998c0.002 1.794 1.456 3.248 3.25 3.25h24c1.794-0.001 3.249-1.456 3.25-3.25v-19.998c-0.002-1.794-1.456-3.248-3.25-3.25h-0zM14.75 13.25v3.5h-5.5v-3.5zM22.75 13.25v3.5h-5.5v-3.5zM28.75 13.25v3.5h-3.5v-3.5zM6.75 16.75h-3.5v-3.5h3.5zM3.25 19.25h3.5v3.5h-3.5zM9.25 19.25h5.5v3.5h-5.5zM14.75 25.25v3.498h-5.5v-3.498zM17.25 25.25h5.5v3.498h-5.5zM17.25 22.75v-3.5h5.5v3.5zM25.25 19.25h3.5v3.5h-3.5zM4 7.25h24c0.414 0 0.75 0.336 0.75 0.75v2.75h-25.5v-2.75c0.001-0.414 0.336-0.749 0.75-0.75h0zM3.25 27.998v-2.748h3.5v3.498h-2.75c-0.414-0-0.75-0.336-0.75-0.75v-0zM28 28.748h-2.75v-3.498h3.5v2.748c-0 0.414-0.336 0.75-0.75 0.75v0z"></path>
							            </svg>
							          </p>
							          <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">Возраст: от '.$current_user_minimum_age_preference.'</p>';
							  elseif ($current_user_maximum_age_preference && !$current_user_minimum_age_preference)
							    echo '<p class="m-0 p-0">
							            <svg class="m-0 p-0" width="16px" height="16px" fill="var(--main-text-color)" viewBox="0 0 32 32">
							              <path d="M28 4.75h-0.75v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-17.5v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-0.75c-1.794 0.002-3.248 1.456-3.25 3.25v19.998c0.002 1.794 1.456 3.248 3.25 3.25h24c1.794-0.001 3.249-1.456 3.25-3.25v-19.998c-0.002-1.794-1.456-3.248-3.25-3.25h-0zM14.75 13.25v3.5h-5.5v-3.5zM22.75 13.25v3.5h-5.5v-3.5zM28.75 13.25v3.5h-3.5v-3.5zM6.75 16.75h-3.5v-3.5h3.5zM3.25 19.25h3.5v3.5h-3.5zM9.25 19.25h5.5v3.5h-5.5zM14.75 25.25v3.498h-5.5v-3.498zM17.25 25.25h5.5v3.498h-5.5zM17.25 22.75v-3.5h5.5v3.5zM25.25 19.25h3.5v3.5h-3.5zM4 7.25h24c0.414 0 0.75 0.336 0.75 0.75v2.75h-25.5v-2.75c0.001-0.414 0.336-0.749 0.75-0.75h0zM3.25 27.998v-2.748h3.5v3.498h-2.75c-0.414-0-0.75-0.336-0.75-0.75v-0zM28 28.748h-2.75v-3.498h3.5v2.748c-0 0.414-0.336 0.75-0.75 0.75v0z"></path>
							            </svg>
							          </p>
							          <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">Возраст: до '.$current_user_maximum_age_preference.'</p>';
							  else
							    echo '<p class="m-0 p-0">
							            <svg class="m-0 p-0" width="16px" height="16px" fill="var(--main-text-color)" viewBox="0 0 32 32">
							              <path d="M28 4.75h-0.75v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-17.5v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-0.75c-1.794 0.002-3.248 1.456-3.25 3.25v19.998c0.002 1.794 1.456 3.248 3.25 3.25h24c1.794-0.001 3.249-1.456 3.25-3.25v-19.998c-0.002-1.794-1.456-3.248-3.25-3.25h-0zM4 7.25h24c0.414 0 0.75 0.336 0.75 0.75v2.75h-25.5v-2.75c0.001-0.414 0.336-0.749 0.75-0.75h0zM28 28.748h-24c-0.414-0-0.75-0.336-0.75-0.75v-14.748h25.5v14.748c-0 0.414-0.336 0.75-0.75 0.75v0zM19.896 17.31c-0.226-0.226-0.539-0.366-0.884-0.366s-0.658 0.14-0.884 0.366l-2.129 2.13-2.13-2.13c-0.226-0.226-0.539-0.366-0.884-0.366-0.69 0-1.25 0.559-1.25 1.25 0 0.345 0.14 0.657 0.366 0.883l2.131 2.132-2.131 2.132c-0.227 0.226-0.368 0.539-0.368 0.885 0 0.69 0.559 1.249 1.249 1.249 0.346 0 0.66-0.141 0.886-0.369l2.13-2.13 2.129 2.13c0.226 0.227 0.539 0.367 0.885 0.367 0.69 0 1.25-0.56 1.25-1.25 0-0.345-0.14-0.657-0.365-0.883l-2.131-2.132 2.131-2.132c0.226-0.226 0.365-0.538 0.365-0.882s-0.14-0.658-0.367-0.884l-0-0z"></path>
							            </svg>
							          </p>
							          <p class="w-100 m-0 ml-3 p-0 fz-14 font-weight-bold text-left">Возраст: Не указан</p>';
?>
								</span>

								<div class="hr-with-text mt-2 mb-3"><span class="m-0 fz-15 font-weight-bold">Теги</span></div>

<?
								$tags_array = get_user_tags($user_uuid);

						    if (!is_null($tags_array))
						    {
						      echo '<ul class="tags-list p-0 m-0 d-flex flex-wrap">';

						      for ($tags_num = 0; $tags_num < count($tags_array); $tags_num++)
						        echo '<a href="search?q='.$tags_array[$tags_num].'"><li class="font-weight-bold">'.$tags_array[$tags_num].'</li></a>';

						      echo '</ul>';
						    }else
						      echo '<p class="m-0 p-0 fz-14 font-weight-bold text-center w-100">Список тегов пуст</p>';
?>

								<div class="hr-with-text mt-3 mb-2"><span class="m-0 fz-15 font-weight-bold">Социальные сети</span></div>

								<span class="m-0 p-0 w-100 d-flex flex-row align-items-center justify-content-center">
<?
								if (user_friendly_status($user_uuid, $current_user_uuid) == 'friend' || $current_user_uuid == $user_uuid)
    						{
    							if (is_null(get_vk_link($user_uuid)))
							      echo '<p class="m-0 p-0">
							              <svg class="svg-social-icons svg-empty-social-icons fill-path" width="34px" height="34px" viewBox="-2.5 0 32 32">
							                <path d="M16.563 15.75c-0.5-0.188-0.5-0.906-0.531-1.406-0.125-1.781 0.5-4.5-0.25-5.656-0.531-0.688-3.094-0.625-4.656-0.531-0.438 0.063-0.969 0.156-1.344 0.344s-0.75 0.5-0.75 0.781c0 0.406 0.938 0.344 1.281 0.875 0.375 0.563 0.375 1.781 0.375 2.781 0 1.156-0.188 2.688-0.656 2.75-0.719 0.031-1.125-0.688-1.5-1.219-0.75-1.031-1.5-2.313-2.063-3.563-0.281-0.656-0.438-1.375-0.844-1.656-0.625-0.438-1.75-0.469-2.844-0.438-1 0.031-2.438-0.094-2.719 0.5-0.219 0.656 0.25 1.281 0.5 1.813 1.281 2.781 2.656 5.219 4.344 7.531 1.563 2.156 3.031 3.875 5.906 4.781 0.813 0.25 4.375 0.969 5.094 0 0.25-0.375 0.188-1.219 0.313-1.844s0.281-1.25 0.875-1.281c0.5-0.031 0.781 0.406 1.094 0.719 0.344 0.344 0.625 0.625 0.875 0.938 0.594 0.594 1.219 1.406 1.969 1.719 1.031 0.438 2.625 0.313 4.125 0.25 1.219-0.031 2.094-0.281 2.188-1 0.063-0.563-0.563-1.375-0.938-1.844-0.938-1.156-1.375-1.5-2.438-2.563-0.469-0.469-1.063-0.969-1.063-1.531-0.031-0.344 0.25-0.656 0.5-1 1.094-1.625 2.188-2.781 3.188-4.469 0.281-0.5 0.938-1.656 0.688-2.219-0.281-0.625-1.844-0.438-2.813-0.438-1.25 0-2.875-0.094-3.188 0.156-0.594 0.406-0.844 1.063-1.125 1.688-0.625 1.438-1.469 2.906-2.344 4-0.313 0.375-0.906 1.156-1.25 1.031z"></path>
							              </svg>
							            </p>';
							    else
							      echo '<a class="m-0 p-0" href="https://vk.com/'.get_vk_link($user_uuid).'" target="_blank" aria-label="Ссылка на страницу VK">
							              <p class="m-0 p-0">
							                <svg class="svg-social-icons fill-path" width="34px" height="34px" viewBox="-2.5 0 32 32">
							                  <path d="M16.563 15.75c-0.5-0.188-0.5-0.906-0.531-1.406-0.125-1.781 0.5-4.5-0.25-5.656-0.531-0.688-3.094-0.625-4.656-0.531-0.438 0.063-0.969 0.156-1.344 0.344s-0.75 0.5-0.75 0.781c0 0.406 0.938 0.344 1.281 0.875 0.375 0.563 0.375 1.781 0.375 2.781 0 1.156-0.188 2.688-0.656 2.75-0.719 0.031-1.125-0.688-1.5-1.219-0.75-1.031-1.5-2.313-2.063-3.563-0.281-0.656-0.438-1.375-0.844-1.656-0.625-0.438-1.75-0.469-2.844-0.438-1 0.031-2.438-0.094-2.719 0.5-0.219 0.656 0.25 1.281 0.5 1.813 1.281 2.781 2.656 5.219 4.344 7.531 1.563 2.156 3.031 3.875 5.906 4.781 0.813 0.25 4.375 0.969 5.094 0 0.25-0.375 0.188-1.219 0.313-1.844s0.281-1.25 0.875-1.281c0.5-0.031 0.781 0.406 1.094 0.719 0.344 0.344 0.625 0.625 0.875 0.938 0.594 0.594 1.219 1.406 1.969 1.719 1.031 0.438 2.625 0.313 4.125 0.25 1.219-0.031 2.094-0.281 2.188-1 0.063-0.563-0.563-1.375-0.938-1.844-0.938-1.156-1.375-1.5-2.438-2.563-0.469-0.469-1.063-0.969-1.063-1.531-0.031-0.344 0.25-0.656 0.5-1 1.094-1.625 2.188-2.781 3.188-4.469 0.281-0.5 0.938-1.656 0.688-2.219-0.281-0.625-1.844-0.438-2.813-0.438-1.25 0-2.875-0.094-3.188 0.156-0.594 0.406-0.844 1.063-1.125 1.688-0.625 1.438-1.469 2.906-2.344 4-0.313 0.375-0.906 1.156-1.25 1.031z"></path>
							                </svg>
							              </p>
							            </a>';

							    if (is_null(get_insta_link($user_uuid)))
							      echo '<p class="m-0 p-0">
							              <svg class="svg-social-icons svg-empty-social-icons fill-path" width="34px" height="34px" fill="#000000" viewBox="0 0 32 32">
							                <path d="M20.445 5h-8.891A6.559 6.559 0 0 0 5 11.554v8.891A6.559 6.559 0 0 0 11.554 27h8.891a6.56 6.56 0 0 0 6.554-6.555v-8.891A6.557 6.557 0 0 0 20.445 5zm4.342 15.445a4.343 4.343 0 0 1-4.342 4.342h-8.891a4.341 4.341 0 0 1-4.341-4.342v-8.891a4.34 4.34 0 0 1 4.341-4.341h8.891a4.342 4.342 0 0 1 4.341 4.341l.001 8.891z"></path>
							                <path d="M16 10.312c-3.138 0-5.688 2.551-5.688 5.688s2.551 5.688 5.688 5.688 5.688-2.551 5.688-5.688-2.55-5.688-5.688-5.688zm0 9.163a3.475 3.475 0 1 1-.001-6.95 3.475 3.475 0 0 1 .001 6.95zM21.7 8.991a1.363 1.363 0 1 1-1.364 1.364c0-.752.51-1.364 1.364-1.364z"></path>
							              </svg>
							            </p>';
							    else
							      echo '<a class="m-0 p-0" href="https://instagram.com/'.get_insta_link($user_uuid).'" target="_blank" aria-label="Ссылка на аккаунт в Instagram">
							              <p class="m-0 p-0">
							                <svg class="svg-social-icons fill-path pointer" width="34px" height="34px" viewBox="0 0 32 32">
							                  <path d="M20.445 5h-8.891A6.559 6.559 0 0 0 5 11.554v8.891A6.559 6.559 0 0 0 11.554 27h8.891a6.56 6.56 0 0 0 6.554-6.555v-8.891A6.557 6.557 0 0 0 20.445 5zm4.342 15.445a4.343 4.343 0 0 1-4.342 4.342h-8.891a4.341 4.341 0 0 1-4.341-4.342v-8.891a4.34 4.34 0 0 1 4.341-4.341h8.891a4.342 4.342 0 0 1 4.341 4.341l.001 8.891z"></path>
							                  <path d="M16 10.312c-3.138 0-5.688 2.551-5.688 5.688s2.551 5.688 5.688 5.688 5.688-2.551 5.688-5.688-2.55-5.688-5.688-5.688zm0 9.163a3.475 3.475 0 1 1-.001-6.95 3.475 3.475 0 0 1 .001 6.95zM21.7 8.991a1.363 1.363 0 1 1-1.364 1.364c0-.752.51-1.364 1.364-1.364z"></path>
							                </svg>
							              </p>
							            </a>';

							    if (is_null(get_ok_link($user_uuid)))
							      echo '<p class="m-0 p-0">
							              <svg class="svg-social-icons svg-empty-social-icons fill-path" width="28px" height="28px" viewBox="0 0 95.481 95.481">
							                <path d="M43.041,67.254c-7.402-0.772-14.076-2.595-19.79-7.064c-0.709-0.556-1.441-1.092-2.088-1.713 c-2.501-2.402-2.753-5.153-0.774-7.988c1.693-2.426,4.535-3.075,7.489-1.682c0.572,0.27,1.117,0.607,1.639,0.969 c10.649,7.317,25.278,7.519,35.967,0.329c1.059-0.812,2.191-1.474,3.503-1.812c2.551-0.655,4.93,0.282,6.299,2.514 c1.564,2.549,1.544,5.037-0.383,7.016c-2.956,3.034-6.511,5.229-10.461,6.761c-3.735,1.448-7.826,2.177-11.875,2.661 c0.611,0.665,0.899,0.992,1.281,1.376c5.498,5.524,11.02,11.025,16.5,16.566c1.867,1.888,2.257,4.229,1.229,6.425 c-1.124,2.4-3.64,3.979-6.107,3.81c-1.563-0.108-2.782-0.886-3.865-1.977c-4.149-4.175-8.376-8.273-12.441-12.527 c-1.183-1.237-1.752-1.003-2.796,0.071c-4.174,4.297-8.416,8.528-12.683,12.735c-1.916,1.889-4.196,2.229-6.418,1.15 c-2.362-1.145-3.865-3.556-3.749-5.979c0.08-1.639,0.886-2.891,2.011-4.014c5.441-5.433,10.867-10.88,16.295-16.322 C42.183,68.197,42.518,67.813,43.041,67.254z"></path>
							                <path d="M47.55,48.329c-13.205-0.045-24.033-10.992-23.956-24.218C23.67,10.739,34.505-0.037,47.84,0 c13.362,0.036,24.087,10.967,24.02,24.478C71.792,37.677,60.889,48.375,47.55,48.329z M59.551,24.143 c-0.023-6.567-5.253-11.795-11.807-11.801c-6.609-0.007-11.886,5.316-11.835,11.943c0.049,6.542,5.324,11.733,11.896,11.709 C54.357,35.971,59.573,30.709,59.551,24.143z"></path>
							              </svg>
							            </p>';
							    else
							      echo '<a class="m-0 p-0" href="https://ok.ru/'.get_ok_link($user_uuid).'" target="_blank" aria-label="Ссылка на страницу в Одноклассниках">
							              <p class="m-0 p-0">
							                <svg class="svg-social-icons fill-path pointer" width="28px" height="28px" viewBox="0 0 95.481 95.481">
							                  <path d="M43.041,67.254c-7.402-0.772-14.076-2.595-19.79-7.064c-0.709-0.556-1.441-1.092-2.088-1.713 c-2.501-2.402-2.753-5.153-0.774-7.988c1.693-2.426,4.535-3.075,7.489-1.682c0.572,0.27,1.117,0.607,1.639,0.969 c10.649,7.317,25.278,7.519,35.967,0.329c1.059-0.812,2.191-1.474,3.503-1.812c2.551-0.655,4.93,0.282,6.299,2.514 c1.564,2.549,1.544,5.037-0.383,7.016c-2.956,3.034-6.511,5.229-10.461,6.761c-3.735,1.448-7.826,2.177-11.875,2.661 c0.611,0.665,0.899,0.992,1.281,1.376c5.498,5.524,11.02,11.025,16.5,16.566c1.867,1.888,2.257,4.229,1.229,6.425 c-1.124,2.4-3.64,3.979-6.107,3.81c-1.563-0.108-2.782-0.886-3.865-1.977c-4.149-4.175-8.376-8.273-12.441-12.527 c-1.183-1.237-1.752-1.003-2.796,0.071c-4.174,4.297-8.416,8.528-12.683,12.735c-1.916,1.889-4.196,2.229-6.418,1.15 c-2.362-1.145-3.865-3.556-3.749-5.979c0.08-1.639,0.886-2.891,2.011-4.014c5.441-5.433,10.867-10.88,16.295-16.322 C42.183,68.197,42.518,67.813,43.041,67.254z"></path>
							                  <path d="M47.55,48.329c-13.205-0.045-24.033-10.992-23.956-24.218C23.67,10.739,34.505-0.037,47.84,0 c13.362,0.036,24.087,10.967,24.02,24.478C71.792,37.677,60.889,48.375,47.55,48.329z M59.551,24.143 c-0.023-6.567-5.253-11.795-11.807-11.801c-6.609-0.007-11.886,5.316-11.835,11.943c0.049,6.542,5.324,11.733,11.896,11.709 C54.357,35.971,59.573,30.709,59.551,24.143z"></path>
							                </svg>
							              </p>
							            </a>';
    						}else
      						echo '<p class="m-0 p-0 fz-14 font-weight-bold text-center w-100">Доступно только для друзей</p>';
?>
								</span>
			        </div>
			      </div>

			    </div>
			  </div>
			</div>
<?
		}else
			return null;
	}

	function report_comment_modal($author_uuid, $receiver_uuid, $comment_uuid)
	{
		if (!empty($author_uuid) && !empty($receiver_uuid) && !empty($comment_uuid)
			&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $author_uuid))
			&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $receiver_uuid))
			&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $comment_uuid)))
		{
			$comment_text = get_comment_text($comment_uuid);
?>
			<div class="modal fade" id="ucm" tabindex="-1" role="dialog" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">

			      <div class="modal-header">
			        <h5 class="modal-title text-center font-weight-bold">Окно жалобы</h5>
			        <p class="modal-close" data-dismiss="modal" aria-label="Close">
			          <svg viewBox="0 0 48 48" width="25px" height="25px" class="svg-close-icon">
			          	<rect width="48" height="48" fill="none"></rect>
			          	<path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
			          </svg>
			        </p>
			      </div>

			      <div class="modal-body">
			        <div class="p-0 m-2">
			          <p class="text-center fz-14"><strong class="fz-14 complaint-bold-text font-weight-bold">Жалоба на комментарий пользователя</strong></p>

			          <div class="w-100 m-0 mb-2 p-2 d-flex flex-row comment-in-report-modal">
<?
                if (get_latest_avatar($receiver_uuid))
                  echo '<img class="rounded-circle offline m-0 mr-3 p-0 rounded-saved-user-picture" src="users/'.$receiver_uuid.'/'.get_latest_avatar($receiver_uuid).'" alt="'.get_user_fullname($receiver_uuid).'">';
                else
                  echo '<img class="rounded-circle offline m-0 mr-3 p-0 rounded-saved-user-picture" src="imgs/no-avatar.png" alt="'.get_user_fullname($receiver_uuid).'">';

                $comment_text = ($comment_text) ? $comment_text : '';
?>
									<div class="w-100 m-0 p-0">
										<a class="m-0 p-0 d-block comment-user-fullname font-weight-bold" href="<?= './?u='.get_user_nickname($receiver_uuid); ?>" title="<?= get_user_fullname($receiver_uuid); ?>">
											<p class="fz-14 m-0 p-0 w-100 text-left"><?= get_user_fullname($receiver_uuid); ?></p>
										</a>
										<p class="w-100 m-0 p-0 fz-13"><?= str_replace(array("\r\n", "\r", "\n"), '<br>', (strlen($comment_text) > 250) ? mb_substr($comment_text, 0, 250).'...' : $comment_text); ?></p>
									</div>
			          </div>

			          <div class="form-group">
			            <label class="fz-14">Пожалуйста, уточните <strong class="fz-14 complaint-bold-text font-weight-bold">причину</strong> жалобы:</label>
			            
			            <div class="form-check m-1">
			              <input class="form-check-input" type="radio" name="complaintReasons" id="spamAdvertising" value="spamAdvertising">
			              <label class="form-check-label fz-14 w-100 ml-3" for="spamAdvertising">
			                Реклама / Спам
			              </label>
			            </div>

			            <div class="form-check m-1">
			              <input class="form-check-input" type="radio" name="complaintReasons" id="forbiddenContent" value="forbiddenContent">
			              <label class="form-check-label fz-14 w-100 ml-3" for="forbiddenContent">
			                Запрещённый / Непотребный контент
			              </label>
			            </div>

			            <div class="form-check m-1">
			              <input class="form-check-input" type="radio" name="complaintReasons" id="rudeBehavior" value="rudeBehavior">
			              <label class="form-check-label fz-14 w-100 ml-3" for="rudeBehavior">
			                Оскорбления / Грубое поведение
			              </label>
			            </div>

			            <div class="form-check m-1">
			              <input class="form-check-input" type="radio" name="complaintReasons" id="userPersonalDataOtherUsers" value="userPersonalDataOtherUsers">
			              <label class="form-check-label fz-14 w-100 ml-3" for="userPersonalDataOtherUsers">
			                Личные данные, подлежащие удалению
			              </label>
			            </div>

			            <div class="form-check m-1">
			              <input class="form-check-input" type="radio" name="complaintReasons" id="otherReason" value="otherReason" checked>
			              <label class="form-check-label fz-14 w-100 ml-3" for="otherReason">
			                Иная причина (просим указать в поле для комментария)
			              </label>
			            </div>
			          </div>

			          <div class="form-group">
			            <label for="commentOnComplaint"><strong class="fz-14 complaint-bold-text font-weight-bold">Комментарий</strong></label>
			            <textarea class="form-control fz-14 textarea" rows="5" name="commentOnComplaint" maxlength="500" placeholder="Не более 500 символов"></textarea>
			          </div>

			          <div class="w-100 d-flex flex-row-reverse justify-content-center">
			             <input type="submit" class="btn w-35 m-0 btn-skip fz-14" value="Отмена" data-dismiss="modal" aria-label="Close">
			             <input type="submit" class="btn w-35 m-0 mr-4 btn-red fz-14" 
			             				value="Отправить" 
			             				data-complaintauthor = '<?= $author_uuid; ?>' 
			             				data-complaintreceiver = '<?= $receiver_uuid; ?>' 
			             				data-complaintoncomment = '<?= $comment_uuid; ?>' 
			             				data-dismiss="modal" onclick="event.preventDefault();sendComplaintOnComment(this);">
			          </div>
			        </div>
			      </div>

			    </div>
			  </div>
			</div>
<?
		}else
			return null;
	}

	function mutual_friends_modal($current_user_uuid, $another_user_uuid)
	{
		if (!empty($current_user_uuid) && !empty($another_user_uuid)
			&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $current_user_uuid))
			&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $another_user_uuid)))
		{
			$mutual_friends_array = get_mutual_friends_list($current_user_uuid, $another_user_uuid);
			$mutual_friends_count = ($mutual_friends_array) ? count($mutual_friends_array) : 0;
?>
			<div class="modal fade" id="mutualFriendsListModal" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
    			<div class="modal-content">

      			<div class="modal-header">
        			<div class="mr-auto d-flex flex-row align-items-center">
								<a class="m-0 p-0" href="./?u=<?= get_user_nickname($another_user_uuid) ?>" title="<?= get_user_fullname($another_user_uuid); ?>">
<?
								$ban_check = ban_check($another_user_uuid);
								$preview_photo_check = file_exists('../users/'.$another_user_uuid.'/'.get_latest_avatar_preview($another_user_uuid)) ? 1 : 0;
		
								if ($ban_check == 'success')
									if (get_latest_avatar($another_user_uuid))
										if (!is_null(check_user_online_status($another_user_uuid)))
											echo '<img class="rounded-circle online m-0 p-0 rounded-saved-user-picture" src="users/'.$another_user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($another_user_uuid) : get_latest_avatar($another_user_uuid)).'" alt="'.get_user_fullname($another_user_uuid).'">';
										else
											echo '<img class="rounded-circle offline m-0 p-0 rounded-saved-user-picture" src="users/'.$another_user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($another_user_uuid) : get_latest_avatar($another_user_uuid)).'" alt="'.get_user_fullname($another_user_uuid).'">';
									else
										if (!is_null(check_user_online_status($another_user_uuid)))
											echo '<img class="rounded-circle online m-0 p-0 rounded-saved-user-picture" src="imgs/no-avatar.png" alt="'.get_user_fullname($another_user_uuid).'">';
										else
											echo '<img class="rounded-circle offline m-0 p-0 rounded-saved-user-picture" src="imgs/no-avatar.png" alt="'.get_user_fullname($another_user_uuid).'">';
								else
									echo '<img class="rounded-circle offline m-0 p-0 rounded-saved-user-picture" src="users/'.$another_user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($another_user_uuid) : get_latest_avatar($another_user_uuid)).'" alt="'.get_user_fullname($another_user_uuid).'">';
?>
								</a>

								<a class="m-0 p-0 ml-3 modal-header-user-fullname" href="./?u=<?= get_user_nickname($another_user_uuid); ?>" 
									title="<?= get_user_fullname($another_user_uuid); ?>">
										<p class="fz-16 m-0 w-100 text-left font-weight-bold"><?= get_user_fullname($another_user_uuid); ?></p>
										<p class="fz-12 m-0 w-100 text-left">Общие друзья: <?= $mutual_friends_count; ?></p>
								</a>
							</div>

							<p class="ml-auto modal-close" data-dismiss="modal" aria-label="Close">
          			<svg viewBox="0 0 48 48" width="25px" height="25px" class="svg-close-icon">
          				<rect width="48" height="48" fill="none"></rect>
          				<path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
          			</svg>
        			</p>
      			</div>
<?
						if ($mutual_friends_count > 0)
						{
							$mutual_friends_num = 0;
?>
						<div class="modal-body mutual-friends-modal-body d-flex flex-wrap justify-content-center align-items-center">
<?
							do {
								$mutual_friend_uuid = $mutual_friends_array[$mutual_friends_num];
								$preview_photo_check = file_exists('../users/'.$mutual_friend_uuid.'/'.get_latest_avatar_preview($mutual_friend_uuid)) ? 1 : 0;
?>
							<div class="m-2 p-0 d-flex flex-column justify-content-center align-items-center">
								<a class="m-0 p-0" href="./?u=<?= get_user_nickname($mutual_friend_uuid); ?>">
<?
									if ($ban_check == 'success')
										if (get_latest_avatar($mutual_friend_uuid))
											if (!is_null(check_user_online_status($mutual_friend_uuid)))
												echo '<img class="rounded-circle online m-0 p-0 rounded-saved-user-picture" src="users/'.$mutual_friend_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($mutual_friend_uuid) : get_latest_avatar($mutual_friend_uuid)).'" alt="'.get_user_fullname($mutual_friend_uuid).'">';
											else
												echo '<img class="rounded-circle offline m-0 p-0 rounded-saved-user-picture" src="users/'.$mutual_friend_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($mutual_friend_uuid) : get_latest_avatar($mutual_friend_uuid)).'" alt="'.get_user_fullname($mutual_friend_uuid).'">';
										else
											if (!is_null(check_user_online_status($mutual_friend_uuid)))
												echo '<img class="rounded-circle online m-0 p-0 rounded-saved-user-picture" src="imgs/no-avatar.png" alt="'.get_user_fullname($mutual_friend_uuid).'">';
											else
												echo '<img class="rounded-circle offline m-0 p-0 rounded-saved-user-picture" src="imgs/no-avatar.png" alt="'.get_user_fullname($mutual_friend_uuid).'">';
										else
											echo '<img class="rounded-circle offline m-0 p-0 rounded-saved-user-picture" src="users/'.$mutual_friend_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($mutual_friend_uuid) : get_latest_avatar($mutual_friend_uuid)).'" alt="'.get_user_fullname($mutual_friend_uuid).'">';
?>
									<p class="m-0 mt-2 p-0 text-center"><?= (mb_strwidth(get_user_fullname($mutual_friend_uuid)) > 15 ? mb_strimwidth(get_user_fullname($mutual_friend_uuid), 0, 15, "...") : get_user_fullname($mutual_friend_uuid)); ?></p>
								</a>
							</div>
<?

								$mutual_friends_num++;
							}while ($mutual_friends_num < $mutual_friends_count);
?>
						</div>
<?
						}else
							echo '<p class="fz-15 m-0 p-4 text-center">Общих друзей нет</p>';
?>
      			
    			</div>
  			</div>
			</div>
<?
		}else
			return null;
	}

	function recovery_password_modal()
	{
		echo '
			<div class="modal fade" id="recoveryPasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
  			<div class="modal-dialog modal-dialog-centered" role="document">
    			<div class="modal-content">

      			<div class="modal-header">
        			<h5 class="modal-title text-center fz-18 font-weight-bold">Восстановление пароля</h5>
        			<p class="modal-close" data-dismiss="modal" aria-label="Close">
          			<svg viewBox="0 0 48 48" width="25px" height="25px" class="svg-close-icon">
          				<rect width="48" height="48" fill="none"></rect>
          				<path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
          			</svg>
        			</p>
      			</div>

      			<div class="modal-body">
        			<label for="email-recovery-input" class="fz-14 w-100 text-center font-weight-bold text-white">Укажите email, который вы использовали для входа на сайт</label>
        			<input type="text" class="w-100 form-control mb-2" id="email-recovery-input" name="recpassEmail" placeholder="example@mail.ru">
        			<em id="recovery-password-message"></em>
        			<p type="submit" class="btn btn-standard fz-15 w-100 m-0 mt-2" name="recoveryPassword" onclick="event.preventDefault();recoveryPassword();">Получить пароль</p>
      			</div>
    			</div>
  			</div>
			</div>';
	}

	function premium_active_user_modal($current_user_uuid)
	{
		include("functions-for-check.php");

		if (!empty($current_user_uuid) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $current_user_uuid)))
		{
			$premium_status = 1;
?>
				<div class="modal fade" id="premiumActiveUserModal" tabindex="-1" role="dialog" aria-hidden="true">
	  			<div class="modal-dialog modal-dialog-centered" role="document">
	    			<div class="modal-content">

	      			<div class="modal-header">
	        			<h5 class="modal-title text-center font-weight-bold">Премиум</h5>
	        			<p class="modal-close" data-dismiss="modal" aria-label="Close">
	          			<svg viewBox="0 0 48 48" width="25px" height="25px" class="svg-close-icon">
	          				<rect width="48" height="48" fill="none"></rect>
	          				<path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
	          			</svg>
	        			</p>
	      			</div>

	      			<div class="modal-body">
	        			<svg class="w-100 m-0 mt-2 mb-2 p-0 premium-star" width="110px" height="110px" viewBox="0 0 48.00 48.00" fill="none" stroke="#2ACAEA" stroke-width="0.00048000000000000007" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
	        				<defs>  
						        <linearGradient id="premium-logo-gradient-in-modal" x1="50%" y1="0%" x2="50%" y2="100%" > 
						          <stop offset="0%" stop-color="#7A5FFF">
						            <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
						          </stop>
						          <stop offset="100%" stop-color="#01FF89">
						            <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
						          </stop>
						        </linearGradient> 
						    	</defs>
						      <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8712 33.0436L15.9976 44.7036C15.9362 45.5229 16.6646 46.0872 17.3161 45.722C21.9289 43.1382 36.3783 33.6479 43.7017 12.7899C44.0376 11.8331 43.1352 10.9697 42.3646 11.5094C38.0387 14.539 28.5846 20.8006 22.7421 21.9934C22.7421 21.9934 26.4836 19.3946 28.7231 15.4053C28.9426 15.0143 28.9244 14.5136 28.6796 14.1606L20.5127 2.38925C20.0287 1.69147 19.0354 1.98057 18.8606 2.87002L16.3181 15.8073L4.38437 26.2226C3.78602 26.7446 3.90808 27.7996 4.5989 28.079L16.8712 33.0436Z" fill="url('#premium-logo-gradient-in-modal')"></path> 
						      <path fill-rule="evenodd" clip-rule="evenodd" d="M37.9745 28.448C37.2188 29.5025 35.5908 31.6717 34.0876 32.9974C33.7871 33.2624 33.8276 33.7068 34.1724 33.9234L42.1145 38.909C42.5926 39.2091 43.2384 38.8529 43.1576 38.3323C42.7882 35.9496 41.7237 30.9818 39.0328 28.3741C38.7322 28.083 38.2142 28.1136 37.9745 28.448Z" fill="url('#premium-logo-gradient-in-modal')"></path> 
						    </svg>

						    <div class="w-100 m-0 mt-2 mb-2 p-2 block-user-content">
						    	<p class="fz-15 w-100 m-0 p-1 font-weight-bold">
						    		Более подробная статистика, которая содержит:
						    	</p>
						    	<p class="fz-14 w-100 m-0 p-1 pl-3 pr-3">
						    		- количество оценок пользователей в зависимости от пола
						    	</p>
						    	<p class="fz-14 w-100 m-0 p-1 pl-3 pr-3">
						    		- количество сохранений, включая разделение по полу
						    	</p>
						    	<p class="fz-14 w-100 m-0 p-1 pl-3 pr-3">
						    		- историю сохранений
						    	</p>
						    	<p class="fz-15 w-100 m-0 p-1 font-weight-bold">
						    		Возможность менять пользовательское имя каждые три месяца
						    	</p>
						    	<!--<p class="fz-15 w-100 m-0 p-1 font-weight-bold">
						    		Отсутствие рекламы
						    	</p>-->
						    </div>

<?
								if (!check_premium_active($current_user_uuid) && !check_premium_trial_period_used($current_user_uuid))
								{
?>
	        				<p type="submit" class="btn btn-standard fz-15 w-100 m-0 mt-2" name="recoveryPassword" onclick="event.preventDefault();activatePremiumTrialPeriod('<?= $current_user_uuid; ?>');">Активировать</p>
<?
								}else if (check_premium_active($current_user_uuid))
								{
?>
									<p class="w-100 m-0 mt-3 p-0 fz-15 text-center font-weight-bold">В данный момент премиум активен</p>
<?
								}else if (check_premium_trial_period_used($current_user_uuid))
								{
?>
									<p class="w-100 m-0 mt-3 p-0 fz-15 text-center font-weight-bold">Пробная версия окончена</p>
<?
								}
?>
	        			<hr class="hr-user-info m-0 mt-3 mb-2">
	        			<p class="w-100 m-0 p-0 fz-13 text-center">Пробная версия даётся сроком на 1 месяц</p>
	      			</div>
	    			</div>
	  			</div>
				</div>
<?
			}else
				return null;
	}

	function rating_statistics_for_premium_modal($current_user_uuid)
	{
			include("functions-user-data.php");

			$number_of_ratings_from_male_mark_one = number_of_ratings_from_users_by_gender($current_user_uuid, 1, 'male');
			$number_of_ratings_from_female_mark_one = number_of_ratings_from_users_by_gender($current_user_uuid, 1, 'female');
			$number_of_ratings_from_other_mark_one = number_of_ratings_from_users_by_gender($current_user_uuid, 1, 'other');

			$number_of_ratings_from_male_mark_two = number_of_ratings_from_users_by_gender($current_user_uuid, 2, 'male');
			$number_of_ratings_from_female_mark_two = number_of_ratings_from_users_by_gender($current_user_uuid, 2, 'female');
			$number_of_ratings_from_other_mark_two = number_of_ratings_from_users_by_gender($current_user_uuid, 2, 'other');

			$number_of_ratings_from_male_mark_three = number_of_ratings_from_users_by_gender($current_user_uuid, 3, 'male');
			$number_of_ratings_from_female_mark_three = number_of_ratings_from_users_by_gender($current_user_uuid, 3, 'female');
			$number_of_ratings_from_other_mark_three = number_of_ratings_from_users_by_gender($current_user_uuid, 3, 'other');

			$number_of_ratings_from_male_mark_four = number_of_ratings_from_users_by_gender($current_user_uuid, 4, 'male');
			$number_of_ratings_from_female_mark_four = number_of_ratings_from_users_by_gender($current_user_uuid, 4, 'female');
			$number_of_ratings_from_other_mark_four = number_of_ratings_from_users_by_gender($current_user_uuid, 4, 'other');

			$number_of_ratings_from_male_mark_five = number_of_ratings_from_users_by_gender($current_user_uuid, 5, 'male');
			$number_of_ratings_from_female_mark_five = number_of_ratings_from_users_by_gender($current_user_uuid, 5, 'female');
			$number_of_ratings_from_other_mark_five = number_of_ratings_from_users_by_gender($current_user_uuid, 5, 'other');
?>
			<div class="modal fade" id="ratingStatisticsForPremiumModal" tabindex="-1" role="dialog" aria-hidden="true">
  			<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    			<div class="modal-content">

    				<div class="modal-header">
			        <h5 class="modal-title text-center font-weight-bold">Оценки пользователей</h5>
	        		<p class="modal-close" data-dismiss="modal" aria-label="Close">
	          		<svg viewBox="0 0 48 48" width="25px" height="25px" class="svg-close-icon">
	          			<rect width="48" height="48" fill="none"></rect>
	          			<path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
	          		</svg>
	        		</p>
	      		</div>

      			<div class="modal-body m-0 p-0 d-flex justify-content-center align-items-center">
        			<div class="container w-100 m-0 p-0">
        				<div class="w-100 m-0 p-0 d-flex flex-wrap justify-content-center">
     							<div class="m-2 p-0 number-of-ratings-doughnut-chart-block" id="number-of-ratings-mark-five-doughnut-chart-block">
     								<canvas class="m-0 p-0" id="number-of-ratings-mark-five-doughnut-chart" width="100" height="100"></canvas>
     								<p class="fz-14 m-0 mb-3 p-0 w-100 text-center">
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     								</p>
     								<div class="number-of-ratings-doughnut-charts-legend m-0 mt-2 mb-2 p-0 w-100 d-flex flex-column justify-content-center align-items-center">
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-male"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Мужской пол</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_male_mark_five; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-female"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Женский пол</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_female_mark_five; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-other"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Без пола</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_other_mark_five; ?></p>
	        						</div>
	        					</div>
     							</div>
     							<div class="m-2 p-0 number-of-ratings-doughnut-chart-block" id="number-of-ratings-mark-four-doughnut-chart-block">
     								<canvas class="m-0 p-0" id="number-of-ratings-mark-four-doughnut-chart" width="100" height="100"></canvas>
     								<p class="fz-14 m-0 mb-3 p-0 w-100 text-center">
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     								</p>
     								<div class="number-of-ratings-doughnut-charts-legend m-0 mt-2 mb-2 p-0 w-100 d-flex flex-column justify-content-center align-items-center">
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-male"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Мужской пол</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_male_mark_four; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-female"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Женский пол</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_female_mark_four; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-other"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Без пола</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_other_mark_four; ?></p>
	        						</div>
	        					</div>
     							</div>
     							<div class="m-2 p-0 number-of-ratings-doughnut-chart-block" id="number-of-ratings-mark-three-doughnut-chart-block">
     								<canvas class="m-0 p-0" id="number-of-ratings-mark-three-doughnut-chart" width="100" height="100"></canvas>
     								<p class="fz-14 m-0 mb-3 p-0 w-100 text-center">
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     								</p>
     								<div class="number-of-ratings-doughnut-charts-legend m-0 mt-2 mb-2 p-0 w-100 d-flex flex-column justify-content-center align-items-center">
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-male"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Мужской пол</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_male_mark_three; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-female"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Женский пол</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_female_mark_three; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-other"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Без пола</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_other_mark_three; ?></p>
	        						</div>
	        					</div>
     							</div>
     							<div class="m-2 p-0 number-of-ratings-doughnut-chart-block" id="number-of-ratings-mark-two-doughnut-chart-block">
     								<canvas class="m-0 p-0" id="number-of-ratings-mark-two-doughnut-chart" width="100" height="100"></canvas>
     								<p class="fz-14 m-0 mb-3 p-0 w-100 text-center">
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     								</p>
     								<div class="number-of-ratings-doughnut-charts-legend m-0 mt-2 mb-2 p-0 w-100 d-flex flex-column justify-content-center align-items-center">
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-male"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Мужской пол</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_male_mark_two; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-female"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Женский пол</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_female_mark_two; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-other"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Без пола</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_other_mark_two; ?></p>
	        						</div>
	        					</div>
     							</div>
     							<div class="m-2 p-0 number-of-ratings-doughnut-chart-block" id="number-of-ratings-mark-one-doughnut-chart-block">
     								<canvas class="m-0 p-0" id="number-of-ratings-mark-one-doughnut-chart" width="100" height="100"></canvas>
     								<p class="fz-14 m-0 mb-3 p-0 w-100 text-center">
     									<i class="fa fa-star-o active-star fz-14" aria-hidden="true"></i>
     								</p>
     								<div class="number-of-ratings-doughnut-charts-legend m-0 mt-2 mb-2 p-0 w-100 d-flex flex-column justify-content-center align-items-center">
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-male"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Мужской пол</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_male_mark_one; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-female"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Женский пол</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_female_mark_one; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-other"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Без пола</p>
	        							<p class="m-0 p-0 ml-auto font-weight-bold"><?= $number_of_ratings_from_other_mark_one; ?></p>
	        						</div>
	        					</div>
     							</div>
     						</div>
   						</div>
      			</div>

    			</div>
  			</div>
			</div>

			<script type="text/javascript">
				var ctxMarkOne = document.getElementById('number-of-ratings-mark-one-doughnut-chart').getContext('2d'),
						ctxMarkTwo = document.getElementById('number-of-ratings-mark-two-doughnut-chart').getContext('2d'),
						ctxMarkThree = document.getElementById('number-of-ratings-mark-three-doughnut-chart').getContext('2d'),
						ctxMarkFour = document.getElementById('number-of-ratings-mark-four-doughnut-chart').getContext('2d'),
					  ctxMarkFive = document.getElementById('number-of-ratings-mark-five-doughnut-chart').getContext('2d');

				if (<?= $number_of_ratings_from_male_mark_one; ?> == <?= $number_of_ratings_from_female_mark_one; ?> &&
						<?= $number_of_ratings_from_female_mark_one; ?> == <?= $number_of_ratings_from_other_mark_one; ?> &&
						<?= $number_of_ratings_from_other_mark_one; ?> == 0)
				{
					document.getElementById('number-of-ratings-mark-one-doughnut-chart-block').style.display = 'none';
				}else
				{
					var numberOfRatingsMarkOneDoughnutChart = new Chart(ctxMarkOne, {
					  type: 'doughnut',
					  data: {
					    labels: ['Мужской пол', 'Женский пол', 'Без пола'],
					    datasets: [
					      {
					        data: [<?= $number_of_ratings_from_male_mark_one.','.$number_of_ratings_from_female_mark_one.','.$number_of_ratings_from_other_mark_one; ?>],
					        backgroundColor: ['rgba(54, 162, 235, 0.2)','rgba(255, 99, 132, 0.5)','rgba(255, 206, 86, 0.2)'],
					        borderColor: ['rgba(54, 162, 235, 1)','rgba(255,99,132,1)','rgba(255, 206, 86, 1)'],
					      },
					    ],
					  },
					  options: {
					  	layout: {
			          padding: 20
			        },
			        tooltips: {
      					bodyFontSize: 12
              },
					    legend: {
					      display: false
					    },
					  },
					});
				}

				if (<?= $number_of_ratings_from_male_mark_two; ?> == <?= $number_of_ratings_from_female_mark_two; ?> &&
						<?= $number_of_ratings_from_female_mark_two; ?> == <?= $number_of_ratings_from_other_mark_two; ?> &&
						<?= $number_of_ratings_from_other_mark_two; ?> == 0)
				{
					document.getElementById('number-of-ratings-mark-two-doughnut-chart-block').style.display = 'none';
				}else
				{
					var numberOfRatingsMarkTwoDoughnutChart = new Chart(ctxMarkTwo, {
					  type: 'doughnut',
					  data: {
					    labels: ['Мужской пол', 'Женский пол', 'Без пола'],
					    datasets: [
					      {
					        data: [<?= $number_of_ratings_from_male_mark_two.','.$number_of_ratings_from_female_mark_two.','.$number_of_ratings_from_other_mark_two; ?>],
					        backgroundColor: ['rgba(54, 162, 235, 0.2)','rgba(255, 99, 132, 0.5)','rgba(255, 206, 86, 0.2)'],
					        borderColor: ['rgba(54, 162, 235, 1)','rgba(255,99,132,1)','rgba(255, 206, 86, 1)'],
					      },
					    ],
					  },
					  options: {
					  	layout: {
			          padding: 20
			        },
			        tooltips: {
      					bodyFontSize: 12
              },
					    legend: {
					      display: false
					    },
					  },
					});
				}

				if (<?= $number_of_ratings_from_male_mark_three; ?> == <?= $number_of_ratings_from_female_mark_three; ?> &&
						<?= $number_of_ratings_from_female_mark_three; ?> == <?= $number_of_ratings_from_other_mark_three; ?> &&
						<?= $number_of_ratings_from_other_mark_three; ?> == 0)
				{
					document.getElementById('number-of-ratings-mark-three-doughnut-chart-block').style.display = 'none';
				}else
				{
					var numberOfRatingsMarkThreeDoughnutChart = new Chart(ctxMarkThree, {
					  type: 'doughnut',
					  data: {
					    labels: ['Мужской пол', 'Женский пол', 'Без пола'],
					    datasets: [
					      {
					        data: [<?= $number_of_ratings_from_male_mark_three.','.$number_of_ratings_from_female_mark_three.','.$number_of_ratings_from_other_mark_three; ?>],
					        backgroundColor: ['rgba(54, 162, 235, 0.2)','rgba(255, 99, 132, 0.5)','rgba(255, 206, 86, 0.2)'],
					        borderColor: ['rgba(54, 162, 235, 1)','rgba(255,99,132,1)','rgba(255, 206, 86, 1)'],
					      },
					    ],
					  },
					  options: {
					  	layout: {
			          padding: 20
			        },
			        tooltips: {
      					bodyFontSize: 12
              },
					    legend: {
					      display: false
					    },
					  },
					});
				}

				if (<?= $number_of_ratings_from_male_mark_four; ?> == <?= $number_of_ratings_from_female_mark_four; ?> &&
						<?= $number_of_ratings_from_female_mark_four; ?> == <?= $number_of_ratings_from_other_mark_four; ?> &&
						<?= $number_of_ratings_from_other_mark_four; ?> == 0)
				{
					document.getElementById('number-of-ratings-mark-four-doughnut-chart-block').style.display = 'none';
				}else
				{
					var numberOfRatingsMarkFourDoughnutChart = new Chart(ctxMarkFour, {
					  type: 'doughnut',
					  data: {
					    labels: ['Мужской пол', 'Женский пол', 'Без пола'],
					    datasets: [
					      {
					        data: [<?= $number_of_ratings_from_male_mark_four.','.$number_of_ratings_from_female_mark_four.','.$number_of_ratings_from_other_mark_four; ?>],
					        backgroundColor: ['rgba(54, 162, 235, 0.2)','rgba(255, 99, 132, 0.5)','rgba(255, 206, 86, 0.2)'],
					        borderColor: ['rgba(54, 162, 235, 1)','rgba(255,99,132,1)','rgba(255, 206, 86, 1)'],
					      },
					    ],
					  },
					  options: {
					  	layout: {
			          padding: 20
			        },
					  	tooltips: {
      					bodyFontSize: 12
              },
					    legend: {
					      display: false
					    },
					  },
					});
				}

				if (<?= $number_of_ratings_from_male_mark_five; ?> == <?= $number_of_ratings_from_female_mark_five; ?> &&
						<?= $number_of_ratings_from_female_mark_five; ?> == <?= $number_of_ratings_from_other_mark_five; ?> &&
						<?= $number_of_ratings_from_other_mark_five; ?> == 0)
				{
					document.getElementById('number-of-ratings-mark-five-doughnut-chart-block').style.display = 'none';
				}else
				{
					var numberOfRatingsMarkFiveDoughnutChart = new Chart(ctxMarkFive, {
					  type: 'doughnut',
					  data: {
					    labels: ['Мужской пол', 'Женский пол', 'Без пола'],
					    datasets: [
					      {
					        data: [<?= $number_of_ratings_from_male_mark_five.','.$number_of_ratings_from_female_mark_five.','.$number_of_ratings_from_other_mark_five; ?>],
					        backgroundColor: ['rgba(54, 162, 235, 0.2)','rgba(255, 99, 132, 0.5)','rgba(255, 206, 86, 0.2)'],
					        borderColor: ['rgba(54, 162, 235, 1)','rgba(255,99,132,1)','rgba(255, 206, 86, 1)'],
					      },
					    ],
					  },
					  options: {
					  	layout: {
			          padding: 20
			        },
			        tooltips: {
      					bodyFontSize: 12
              },
					    legend: {
					      display: false
					    },
					  },
					});
				}
			</script>
<?
	}
?>