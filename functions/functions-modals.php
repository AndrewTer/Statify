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
			        	<h5 class="modal-title text-center">Окно жалобы</h5>
			        	<p class="modal-close" data-dismiss="modal" aria-label="Close">
			          	<svg viewBox="0 0 48 48" width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" class="svg-close-icon">
			          		<rect width="48" height="48" fill="none"></rect> 
			          		<path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
			          	</svg>
			        	</p>
			      	</div>

			      	<div class="modal-body">
			        	<div class="p-0 m-2">
			          	<p class="text-center fz-14"><strong class="fz-14 complaint-bold-text">Жалоба на пользователя '.$receiver_name.'</strong></p>

			          	<div class="form-group">
			            	<label class="fz-14">Пожалуйста, уточните <strong class="fz-14 complaint-bold-text">причину</strong> жалобы:</label>
			            
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
			            	<label for="commentOnComplaint"><strong class="fz-14 complaint-bold-text">Комментарий</strong></label>
			            	<textarea class="form-control fz-14 textarea" rows="5" name="commentOnComplaint" maxlength="500" placeholder="Не более 500 символов"></textarea>
			          	</div>

			          	<div class="w-100 d-flex flex-row-reverse justify-content-center">
			              <input type="submit" class="btn w-35 m-0 btn-skip" value="Отмена" data-dismiss="modal" aria-label="Close">
			              <input type="submit" class="btn w-35 m-0 mr-4 btn-red font-weight" 
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
			        <h5 class="modal-title text-center">Окно жалобы</h5>
			        <p class="modal-close" data-dismiss="modal" aria-label="Close">
			          <svg viewBox="0 0 48 48" width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" class="svg-close-icon">
			          	<rect width="48" height="48" fill="none"></rect>
			          	<path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
			          </svg>
			        </p>
			      </div>

			      <div class="modal-body">
			        <div class="p-0 m-2">
			          <p class="text-center fz-14"><strong class="fz-14 complaint-bold-text">Жалоба на комментарий пользователя</strong></p>

			          <div class="w-100 m-0 mb-2 p-2 d-flex flex-row comment-in-report-modal">
<?
                if (get_latest_avatar($receiver_uuid))
                  echo '<img class="rounded-circle offline m-0 mr-3 p-0 rounded-saved-user-picture" src="users/'.$receiver_uuid.'/'.get_latest_avatar($receiver_uuid).'" alt="'.get_user_fullname($receiver_uuid).'">';
                else
                  echo '<img class="rounded-circle offline m-0 mr-3 p-0 rounded-saved-user-picture" src="imgs/no-avatar.png" alt="'.get_user_fullname($receiver_uuid).'">';

                $comment_text = ($comment_text) ? $comment_text : '';
?>
									<div class="w-100 m-0 p-0">
										<a class="m-0 p-0 d-block comment-user-fullname" href="<?= './?u='.get_user_nickname($receiver_uuid); ?>" title="<?= get_user_fullname($receiver_uuid); ?>">
											<p class="fz-14 m-0 p-0 w-100 text-left"><?= get_user_fullname($receiver_uuid); ?></p>
										</a>
										<p class="w-100 m-0 p-0 fz-13"><?= str_replace(array("\r\n", "\r", "\n"), '<br>', (strlen($comment_text) > 250) ? mb_substr($comment_text, 0, 250).'...' : $comment_text); ?></p>
									</div>
			          </div>

			          <div class="form-group">
			            <label class="fz-14">Пожалуйста, уточните <strong class="fz-14 complaint-bold-text">причину</strong> жалобы:</label>
			            
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
			            <label for="commentOnComplaint"><strong class="fz-14 complaint-bold-text">Комментарий</strong></label>
			            <textarea class="form-control fz-14 textarea" rows="5" name="commentOnComplaint" maxlength="500" placeholder="Не более 500 символов"></textarea>
			          </div>

			          <div class="w-100 d-flex flex-row-reverse justify-content-center">
			             <input type="submit" class="btn w-35 m-0 btn-skip" value="Отмена" data-dismiss="modal" aria-label="Close">
			             <input type="submit" class="btn w-35 m-0 mr-4 btn-red font-weight" 
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
										<p class="fz-16 m-0 w-100 text-left"><?= get_user_fullname($another_user_uuid); ?></p>
										<p class="fz-12 m-0 w-100 text-left">Общие друзья: <?= $mutual_friends_count; ?></p>
								</a>
							</div>

							<p class="ml-auto modal-close" data-dismiss="modal" aria-label="Close">
          			<svg viewBox="0 0 48 48" width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" class="svg-close-icon">
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
        			<h5 class="modal-title text-center fz-18">Восстановление пароля</h5>
        			<p class="modal-close" data-dismiss="modal" aria-label="Close">
          			<svg viewBox="0 0 48 48" width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" class="svg-close-icon">
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
	        			<h5 class="modal-title text-center">Премиум</h5>
	        			<p class="modal-close" data-dismiss="modal" aria-label="Close">
	          			<svg viewBox="0 0 48 48" width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" class="svg-close-icon">
	          				<rect width="48" height="48" fill="none"></rect>
	          				<path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
	          			</svg>
	        			</p>
	      			</div>

	      			<div class="modal-body">
	        			<svg class="w-100 m-0 mt-2 mb-2 p-0 premium-star" width="110px" height="110px" viewBox="0 0 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#2ACAEA" stroke-width="0.00048000000000000007" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
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
						    	<p class="fz-15 w-100 m-0 p-1 pl-3 pr-3">
						    		- количество оценок пользователей в зависимости от пола
						    	</p>
						    	<p class="fz-15 w-100 m-0 p-1 pl-3 pr-3">
						    		- количество сохранений, включая разделение по полу
						    	</p>
						    	<p class="fz-15 w-100 m-0 p-1 pl-3 pr-3">
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
			        <h5 class="modal-title text-center">Оценки пользователей</h5>
	        		<p class="modal-close" data-dismiss="modal" aria-label="Close">
	          		<svg viewBox="0 0 48 48" width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" class="svg-close-icon">
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
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_male_mark_five; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-female"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Женский пол</p>
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_female_mark_five; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-other"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Без пола</p>
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_other_mark_five; ?></p>
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
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_male_mark_four; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-female"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Женский пол</p>
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_female_mark_four; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-other"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Без пола</p>
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_other_mark_four; ?></p>
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
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_male_mark_three; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-female"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Женский пол</p>
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_female_mark_three; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-other"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Без пола</p>
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_other_mark_three; ?></p>
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
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_male_mark_two; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-female"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Женский пол</p>
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_female_mark_two; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-other"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Без пола</p>
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_other_mark_two; ?></p>
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
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_male_mark_one; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-female"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Женский пол</p>
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_female_mark_one; ?></p>
	        						</div>
	        						<div class="m-0 p-0 pl-4 pr-4 w-100 d-flex flex-row align-items-center">
	        							<p class="m-0 p-0 number-of-ratings-doughnut-chart-legend-other"></p>
	        							<p class="m-0 p-0 ml-2 mr-auto">Без пола</p>
	        							<p class="m-0 p-0 ml-auto"><?= $number_of_ratings_from_other_mark_one; ?></p>
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