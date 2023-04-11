<?
  include("requests/user-info-for-statistics.php");
?>
<div class="col-12 p-0">
  <div class="block-edit-user-info p-0" id="all-user-settings-block" data-attr="<?= $user_uuid; ?>">
    <p class="fz-17 text-center font-weight-bold mt-2 mb-2">Настройки</p>
    <hr class="hr-user-info">

    <div class="modal-body settings-modal-body">
      <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0 pt-1 pb-1 w-100">
        <p class="fz-13 font-weight-bold m-0 p-0 justify-content-start w-25">Email</p>
        <p class="fz-13 m-0 p-0 justify-content-center w-50 text-center" id="current-email"><?= get_user_email($user_uuid); ?></p>
        <div class="fz-13 font-weight-bold m-0 p-0 justify-content-end w-25">
          <p class="m-0 p-0 text-right">
            <a class="settings-edit-link font-weight-bold" data-toggle="collapse" role="button" href="#editEmailBlock" aria-expanded="false" aria-controls="editEmailBlock">Изменить</a>
            <i class="fa fa-pencil-square-o settings-edit-link-i d-none fz-17" aria-hidden="true" data-toggle="collapse" role="button" href="#editEmailBlock" aria-expanded="false" aria-controls="editEmailBlock"></i>
          </p>
        </div>
      </div>
    </div>

    <div id="editEmailBlock" class="collapse w-100">
      <div class="modal-body settings-modal-body pt-0">
        <hr class="hr-user-info mt-0">
        <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0 pt-1 pb-1 w-100">

          <form class="m-0 p-0 w-100" id="edit-user-email-block" action="" method="POST" onSubmit="return editUserEmailValidation();">       
            <div class="form-group w-100 m-0 p-0">
              <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0">
                <label class="font-weight-bold col-6 p-0 m-0">Новый email</label>
                <input type="email" id="email-edit" class="form-control col-6 m-0 input-field" autocomplete="off">
              </div>
              <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0">
                <em class="text-center float-right w-50"></em>
                <em id="email-edit-message" class="text-center float-right w-50"></em>
              </div>
            </div>

            <div class="form-group w-100 m-0 p-0">
              <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0">
                <label class="font-weight-bold col-6 p-0 m-0">Текущий пароль</label>
                <input type="password" id="password-for-email-edit" class="form-control col-6 m-0 input-field" autocomplete="off">
              </div>
              <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0">
                <em class="text-center float-right w-50"></em>
                <em id="password-for-email-edit-message" class="text-center float-right w-50"></em>
              </div>
            </div>
            
            <div class="d-flex justify-content-center m-0 p-0">
              <input type="submit" class="btn btn-standard fz-14 w-50 mt-3" value="Сохранить">
            </div>
          </form>

        </div>
      </div>
    </div>

    <div class="modal-body settings-modal-body">
      <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0 pt-1 pb-1 w-100">
        <p class="fz-13 font-weight-bold m-0 p-0 justify-content-start w-25">Пароль</p>
        <p class="fz-13 m-0 p-0 justify-content-center w-50"></p>
        <div class="fz-13 font-weight-bold m-0 p-0 justify-content-end w-25">
          <p class="m-0 p-0 text-right">
            <a class="settings-edit-link font-weight-bold" data-toggle="collapse" role="button" href="#editPasswordBlock" aria-expanded="false" aria-controls="editPasswordBlock">Изменить</a>
            <i class="fa fa-pencil-square-o settings-edit-link-i d-none fz-17" aria-hidden="true" data-toggle="collapse" role="button" href="#editPasswordBlock" aria-expanded="false" aria-controls="editPasswordBlock"></i>
          </p>
        </div>
      </div>
    </div>

    <div id="editPasswordBlock" class="collapse w-100">
      <div class="modal-body settings-modal-body pt-0">
        <hr class="hr-user-info mt-0">
        <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0 pt-1 pb-1 w-100">

          <form class="m-0 p-0 w-100" id="edit-user-password-block" action="" method="POST" onSubmit="return editUserPasswordValidation();">     
            <div class="form-group w-100 m-0 p-0">
              <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0">
                <label class="font-weight-bold col-6 p-0 m-0">Текущий пароль</label>
                <input type="password" id="old-password-edit" class="form-control col-6 m-0 input-field" autocomplete="off">
              </div>
              <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0">
                <em class="text-center float-right w-50"></em>
                <em id="old-password-edit-message" class="text-center float-right w-50"></em>
              </div>
            </div>

            <div class="form-group w-100 m-0 p-0">
              <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0">
                <label class="font-weight-bold col-6 p-0 m-0">Новый пароль</label>
                <input type="password" id="new-password-edit" class="form-control col-6 m-0 input-field" autocomplete="off">
              </div>
              <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0">
                <em class="text-center float-right w-50"></em>
                <em id="new-password-edit-message" class="text-center float-right w-50"></em>
              </div>
            </div>

            <div class="form-group w-100 m-0 p-0">
              <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0">
                <label class="font-weight-bold col-6 p-0 m-0">Повторите пароль</label>
                <input type="password" id="repeat-password-edit" class="form-control col-6 m-0 input-field" autocomplete="off">
              </div>
              <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0">
                <em class="text-center float-right w-50"></em>
                <em id="repeat-password-edit-message" class="text-center float-right w-50"></em>
              </div>
            </div>
            
            <div class="d-flex justify-content-center m-0 p-0">
              <input type="submit" class="btn btn-standard fz-14 w-50 mt-3" value="Сохранить">
            </div>
          </form>

        </div>
      </div>
    </div>

    <div class="hr-with-text"><span class="m-0 font-weight-bold">Приватность</span></div>

    <div class="modal-body settings-modal-body">
      <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0 pt-1 pb-1 w-100">
        <form class="m-0 p-0 w-100" id="edit-private-settings-block" action="" method="POST" onSubmit="return editUserPrivatePreferences('<?= $user_uuid; ?>');">
          <div class="m-0 p-0 d-flex justify-content-center align-items-center">
            <p class="fz-13 font-weight-bold m-0 p-0 justify-content-start w-50">Кто может оценивать мои фотографии</p>
            <div class="fz-13 font-weight-bold m-0 p-0 justify-content-end w-50">
              <div class="p-0 m-0 d-flex flex-wrap justify-content-end align-items-center">
                <div class="radio_btn settings_radio_btn m-1">
                  <input id="who-can-rate-photos-all" type="radio" name="who-can-rate-photos" value="all" <?= (!check_only_friends_can_rate_photos($user_uuid)) ? "checked" : ""; ?>>
                  <label class="font-weight-bold m-0 text-center" for="who-can-rate-photos-all">Все пользователи</label>
                </div>
                 
                <div class="radio_btn settings_radio_btn m-1">
                  <input id="who-can-rate-photos-friends" type="radio" name="who-can-rate-photos" value="friends" <?= (check_only_friends_can_rate_photos($user_uuid)) ? "checked" : ""; ?>>
                  <label class="font-weight-bold m-0 text-center" for="who-can-rate-photos-friends">Только друзья</label>
                </div>
              </div>
            </div>
          </div>

          <div class="m-0 mt-3 p-0 d-flex justify-content-center align-items-center">
            <p class="fz-13 font-weight-bold m-0 p-0 justify-content-start w-50">Кто может комментировать мои фотографии</p>
            <div class="fz-13 font-weight-bold m-0 p-0 justify-content-end w-50">
              <div class="p-0 m-0 d-flex flex-wrap justify-content-end align-items-center">
                <div class="radio_btn settings_radio_btn m-1">
                  <input id="who-can-comment-photos-all" type="radio" name="who-can-comment-photos" value="all" <?= (!check_only_friends_can_comment_photos($user_uuid)) ? "checked" : ""; ?>>
                  <label class="font-weight-bold m-0 text-center" for="who-can-comment-photos-all">Все пользователи</label>
                </div>
                 
                <div class="radio_btn settings_radio_btn m-1">
                  <input id="who-can-comment-photos-friends" type="radio" name="who-can-comment-photos" value="friends" <?= (check_only_friends_can_comment_photos($user_uuid)) ? "checked" : ""; ?>>
                  <label class="font-weight-bold m-0 text-center" for="who-can-comment-photos-friends">Только друзья</label>
                </div>
              </div>
            </div>
          </div>

          <div class="m-0 mt-3 p-0 d-flex justify-content-center align-items-center">
            <p class="fz-13 font-weight-bold m-0 p-0 justify-content-start w-50">Кто может читать комментарии к моим фотографиям</p>
            <div class="fz-13 font-weight-bold m-0 p-0 justify-content-end w-50">
              <div class="p-0 m-0 d-flex flex-wrap justify-content-end align-items-center">
                <div class="radio_btn settings_radio_btn m-1">
                  <input id="who-can-read-comments-on-photos-all" type="radio" name="who-can-read-comments-on-photos" value="all" <?= (!check_only_friends_can_read_comments_on_photos($user_uuid)) ? "checked" : ""; ?>>
                  <label class="font-weight-bold m-0 text-center" for="who-can-read-comments-on-photos-all">Все пользователи</label>
                </div>
                 
                <div class="radio_btn settings_radio_btn m-1">
                  <input id="who-can-read-comments-on-photos-friends" type="radio" name="who-can-read-comments-on-photos" value="friends" <?= (check_only_friends_can_read_comments_on_photos($user_uuid)) ? "checked" : ""; ?>>
                  <label class="font-weight-bold m-0 text-center" for="who-can-read-comments-on-photos-friends">Только друзья</label>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-center m-0 p-0">
            <input type="submit" class="btn btn-standard fz-14 w-50 mt-3" value="Сохранить">
          </div>
        </form>
      </div>
    </div>

    <div class="hr-with-text"><span class="m-0 font-weight-bold">Оформление</span></div>

    <div class="modal-body settings-modal-body">
      <div class="d-flex flex-wrap justify-content-center align-items-center m-0 p-0 pt-1 pb-1 w-100">

        <div class="m-2 ml-5 mr-5 p-0 justify-content-center align-items-center text-center">
          <p class="fz-13 font-weight-bold m-0 mb-2 p-0">Тёмная тема</p>
          <div class="m-0 p-0 d-flex flex-row justify-content-center align-items-center">
            <div class="radio_btn settings_design_theme_radio_btn m-1 mr-4" id="design-theme-darkness" data-toggle="tooltip" data-placement="bottom" title="Darkness">
              <input id="design-theme-darkness-input" type="radio" name="choose-design-theme" value="darkness">
              <label class="m-0 text-center" for="design-theme-darkness-input"></label>
            </div>
            <div class="radio_btn settings_design_theme_radio_btn m-1 ml-4 mr-4" id="design-theme-dark-sapphire" data-toggle="tooltip" data-placement="bottom" title="Dark sapphire">
              <input id="design-theme-dark-sapphire-input" type="radio" name="choose-design-theme" value="dark-sapphire">
              <label class="m-0 text-center" for="design-theme-dark-sapphire-input"></label>
            </div>
            <div class="radio_btn settings_design_theme_radio_btn m-1 ml-4" id="design-theme-night-forest" data-toggle="tooltip" data-placement="bottom" title="Night forest">
              <input id="design-theme-night-forest-input" type="radio" name="choose-design-theme" value="night-forest">
              <label class="m-0 text-center" for="design-theme-night-forest-input"></label>
            </div>
          </div>
        </div>

        <div class="m-2 ml-5 mr-5 p-0 justify-content-center align-items-center text-center">
          <p class="fz-13 font-weight-bold m-0 mb-2 p-0">Светлая тема</p>
          <div class="m-0 p-0 d-flex flex-row justify-content-center align-items-center">
            <div class="radio_btn settings_design_theme_radio_btn m-1" id="design-theme-bahama-blue" data-toggle="tooltip" data-placement="bottom" title="Bahama blue">
              <input id="design-theme-bahama-blue-input" type="radio" name="choose-design-theme" value="bahama-blue">
              <label class="m-0 text-center" for="design-theme-bahama-blue-input"></label>
            </div>
          </div>
        </div>

        <div class="m-2 ml-5 mr-5 p-0 justify-content-center align-items-center text-center">
          <p class="fz-13 font-weight-bold m-0 mb-2 p-0">Градиент</p>
          
          <div class="m-0 p-0 d-flex flex-row justify-content-center align-items-center">
            <div class="radio_btn settings_design_theme_radio_btn m-1 mr-4" id="design-theme-spotted" data-toggle="tooltip" data-placement="bottom" title="Spotted">
              <input id="design-theme-spotted-input" type="radio" name="choose-design-theme" value="spotted">
              <label class="m-0 text-center" for="design-theme-spotted-input"></label>
            </div>
            <div class="radio_btn settings_design_theme_radio_btn m-1 ml-4" id="design-theme-ocean-depths" data-toggle="tooltip" data-placement="bottom" title="Ocean depths">
              <input id="design-theme-ocean-depths-input" type="radio" name="choose-design-theme" value="ocean-depths">
              <label class="m-0 text-center" for="design-theme-ocean-depths-input"></label>
            </div>
          </div>
        </div>

      </div>

    </div>

    <hr class="hr-user-info">

    <div class="modal-body settings-modal-body">
      <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0 pt-1 pb-1 w-100">
        <div class="m-0 p-0 d-flex align-items-center" id="terminate-all-sessions" onclick="event.preventDefault();terminateAllSessions();">
          <p class="m-0 p-0">
            <svg height="20px" width="20px" class="mr-3" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#dc3545" transform="matrix(-1, 0, 0, 1, 0, 0)">
              <path d="M387.187,68.12c-4.226,0-8.328,0.524-12.249,1.511V55.44c0-27.622-22.472-50.094-50.094-50.094 c-10.293,0-19.865,3.123-27.834,8.461C288.017,5.252,275.869,0,262.508,0c-22.84,0-42.156,15.365-48.16,36.302 c-5.268-1.887-10.935-2.912-16.844-2.912c-27.622,0-50.094,22.472-50.094,50.094v82.984c-5.996-2.332-12.508-3.616-19.318-3.616 c-29.43,0-53.373,23.936-53.373,53.366v99.695c0,63.299,38.525,185.645,184.315,195.649c4.274,0.289,8.586,0.438,12.813,0.438 c91.218,0,165.435-72.378,165.435-161.35V118.214C437.281,90.592,414.81,68.12,387.187,68.12z M271.846,483.947 c-3.585,0-7.209-0.126-10.896-0.376c-134.659-9.237-158.179-126.668-158.179-167.659v-99.695c0-13.979,11.341-25.313,25.32-25.313 c13.98,0,25.321,11.334,25.321,25.313v76.997h22.05V83.485c0-12.172,9.87-22.042,22.041-22.042c12.172,0,22.042,9.87,22.042,22.042 v152.959h20.922V50.094c0-12.172,9.87-22.041,22.041-22.041c12.172,0,22.042,9.87,22.042,22.041v186.35h18.253V55.44 c0-12.172,9.87-22.041,22.042-22.041c12.171,0,22.041,9.87,22.041,22.041v181.004h18.261v-118.23 c0-12.172,9.87-22.042,22.041-22.042c12.172,0,22.042,9.87,22.042,22.042V350.65C409.229,419.748,353.445,483.947,271.846,483.947z "></path>
            </svg>
          </p>
          <p class="m-0 p-0 fz-14 font-weight-bold text-danger">Завершить все сеансы кроме текущего</p>
        </div>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript" src="js/settings.js"></script>