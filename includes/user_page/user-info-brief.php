<div class="m-0 mr-auto p-0 d-flex flex-column align-items-start justify-content-center" id="brief-user-info">
  <p class="m-0" id="nickname"><?= ($user_nickname) ? '@'.$user_nickname : ''; ?></p>
<?
  if (user_friendly_status($user_uuid, $current_user_uuid) == 'friend' || $current_user_uuid == $user_uuid)
  {
?>
  <span class="mt-2 d-flex flex-row align-items-stretch">
    <p class="m-0 p-0">
      <svg class="active-star" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
        <path d="M17.2 20.7501C17.0776 20.7499 16.9573 20.7189 16.85 20.6601L12 18.1101L7.14999 20.6601C7.02675 20.7262 6.88746 20.7566 6.74786 20.7478C6.60825 20.7389 6.47391 20.6912 6.35999 20.6101C6.24625 20.5267 6.15796 20.4133 6.10497 20.2826C6.05199 20.1519 6.03642 20.0091 6.05999 19.8701L6.99999 14.4701L3.05999 10.6501C2.96124 10.5512 2.89207 10.4268 2.86027 10.2907C2.82846 10.1547 2.83529 10.0124 2.87999 9.88005C2.92186 9.74719 3.00038 9.62884 3.10652 9.53862C3.21266 9.4484 3.34211 9.38997 3.47999 9.37005L8.89999 8.58005L11.33 3.67005C11.3991 3.55403 11.4973 3.45795 11.6147 3.39123C11.7322 3.32451 11.8649 3.28943 12 3.28943C12.1351 3.28943 12.2678 3.32451 12.3853 3.39123C12.5027 3.45795 12.6008 3.55403 12.67 3.67005L15.1 8.58005L20.52 9.37005C20.6579 9.38997 20.7873 9.4484 20.8935 9.53862C20.9996 9.62884 21.0781 9.74719 21.12 9.88005C21.1647 10.0124 21.1715 10.1547 21.1397 10.2907C21.1079 10.4268 21.0387 10.5512 20.94 10.6501L17 14.4701L17.93 19.8701C17.9536 20.0091 17.938 20.1519 17.885 20.2826C17.832 20.4133 17.7437 20.5267 17.63 20.6101C17.5034 20.6976 17.3539 20.7463 17.2 20.7501ZM12 16.5201C12.121 16.5215 12.2403 16.5488 12.35 16.6001L16.2 18.6001L15.47 14.3101C15.4502 14.1897 15.4589 14.0664 15.4953 13.9501C15.5318 13.8337 15.595 13.7275 15.68 13.6401L18.8 10.6401L14.49 10.0001C14.3708 9.98109 14.2578 9.93401 14.1605 9.86271C14.0631 9.79141 13.9841 9.69795 13.93 9.59005L12 5.69005L10.07 9.60005C10.0159 9.70795 9.9369 9.80141 9.83952 9.87271C9.74214 9.94401 9.62918 9.99109 9.50999 10.0101L5.19999 10.6401L8.31999 13.6401C8.40493 13.7275 8.46817 13.8337 8.50464 13.9501C8.54111 14.0664 8.54979 14.1897 8.52999 14.3101L7.79999 18.6301L11.65 16.6301C11.7573 16.5683 11.8767 16.5308 12 16.5201Z"></path>
      </svg>
    </p>
    <p class="m-0 ml-1 p-0 fz-16"><?= (get_user_rating_among_all_users($current_user_uuid) != 0) ? get_user_rating_among_all_users($current_user_uuid) : '0 %'; ?></p>
  </span>
<?
  }
?>
  <span class="m-0 mt-1 p-0 d-flex flex-row align-items-center">
    <p class="m-0 p-0">
      <svg class="m-0 p-0" width="9px" height="9px" viewBox="-4.5 0 20 20" fill="var(--main-text-color)">
        <g transform="translate(-305.000000, -6679.000000)" fill="var(--main-text-color)"> 
          <g transform="translate(56.000000, 160.000000)"> 
            <path d="M249.365851,6538.70769 L249.365851,6538.70769 C249.770764,6539.09744 250.426289,6539.09744 250.830166,6538.70769 L259.393407,6530.44413 C260.202198,6529.66364 260.202198,6528.39747 259.393407,6527.61699 L250.768031,6519.29246 C250.367261,6518.90671 249.720021,6518.90172 249.314072,6519.28247 L249.314072,6519.28247 C248.899839,6519.67121 248.894661,6520.31179 249.302681,6520.70653 L257.196934,6528.32352 C257.601847,6528.71426 257.601847,6529.34685 257.196934,6529.73759 L249.365851,6537.29462 C248.960938,6537.68437 248.960938,6538.31795 249.365851,6538.70769"></path>
          </g>
        </g>
      </svg>
    </p>

    <p class="m-0 ml-1 p-0 fz-12">Подробнее</p>
  </span>
<?
  if ($page_status && $current_user_uuid == $user_uuid)
  {
    $latest_avatar_date = get_latest_avatar_date_upload($user_uuid);
    
    if ($latest_avatar_date == 'success' && check_user_page_status($user_uuid) && check_email_confirmed($user_uuid))
      echo '<div class="m-0 p-0 mt-2 d-flex flex-row justify-content-center align-items-center">
              <p class="btn btn-standard user-profile-action-btn m-0 p-1" data-href="edit">Редактировать</p>

              <p class="m-0 p-0 ml-2 pointer" data-toggle="tooltip" data-placement="bottom" title="Обновить фотографию">
                <svg fill="var(--main-text-color)" id="user-profile-add-photo-icon" width="33px" height="33px" viewBox="-1 0 19 19" data-href="edit">
                  <path d="M16.5 9.5a8 8 0 1 1-8-8 8 8 0 0 1 8 8zm-2.874-2.287a.803.803 0 0 0-.8-.8h-2.054v-.251a.802.802 0 0 0-.8-.8h-2.93a.802.802 0 0 0-.8.8v.25H4.186a.802.802 0 0 0-.8.8v5.166a.802.802 0 0 0 .8.8h8.639a.803.803 0 0 0 .8-.8zm-2.692 2.582a2.427 2.427 0 1 1-2.428-2.427 2.428 2.428 0 0 1 2.428 2.427zm-4.055 0a1.627 1.627 0 1 0 1.627-1.627A1.63 1.63 0 0 0 6.88 9.795zm2.75-3.931a.4.4 0 1 0 .4.4.4.4 0 0 0-.4-.4z"></path>
                </svg>
              </p>
            </div>';
    else
    {
      if (!check_email_confirmed($user_uuid))
        echo '<div class="m-0 p-0 mt-2 d-flex flex-row justify-content-center align-items-center">
                <p class="btn btn-standard user-profile-action-btn m-0 p-1" data-href="edit">Редактировать</p>

                <p class="m-0 p-1 ml-2 pointer d-flex align-items-center justify-content-center" id="email-confirm" data-toggle="tooltip" data-placement="bottom" title="Подтвердить email">
                  <svg width="17px" height="17px" viewBox="0 0 48 48" fill="var(--content-block-bg-color-without-transparency)" data-href="edit" style="margin: 2px;">
                    <path d="M0 0h48v48H0z" fill="none"></path>
                    <path d="M42.371,8.8C41.705,8.304,40.89,8,40,8H8C7.11,8,6.295,8.304,5.629,8.8L24,27.172L42.371,8.8z"></path>
                    <path d="M4,12.828V36c0,2.2,1.8,4,4,4h32c2.2,0,4-1.8,4-4V12.828l-20,20L4,12.828z"></path>
                  </svg>
                </p>
              </div>';
      else
        echo '<p class="btn btn-standard user-profile-action-btn m-0 mt-2 p-1" data-href="edit">Редактировать</p>';
    }
  }

  $user_ban_check = ban_check($current_user_uuid);

  if ($user_ban_check == 'success')
  {

    $friendly_user_status = user_friendly_status($user_uuid, $current_user_uuid);

    switch ($friendly_user_status) {
      case 'user':
        echo '<div class="m-0 p-0 mt-4 d-flex flex-row justify-content-center align-items-center">
                <p class="btn btn-standard user-profile-action-btn w-100 m-0 p-1 pointer" data-u="'.$user_uuid.'" data-f="'.$current_user_uuid.'" id="add-friend-from-user-page-btn">Добавить в друзья</p>

                <div class="m-0 p-0" role="group">
                  <p class="m-0 ml-2 p-0 d-flex align-items-center justify-content-center border-radius-circle" id="user-profile-more-menu-icon" data-toggle="dropdown" aria-expanded="false">
                    <svg class="m-0 p-0 pointer" width="33px" height="33px" viewBox="0 0 24 24" fill="none">
                      <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="var(--main-text-color)" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M8.4707 10.7402L12.0007 14.2602L15.5307 10.7402" stroke="var(--main-text-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </p>

                  <div class="dropdown-menu dropdown-menu-right user-profile-dropdown-menu mt-1 p-0" aria-labelledby="user-profile-more-menu-icon">
                    <a class="dropdown-item only-one-item pt-2 pb-2" 
                        onclick="event.preventDefault();openReportUserModal(\''.$user_uuid.'\',\''.$current_user_uuid.'\');" 
                        href="" 
                        aria-label="Пожаловаться">Пожаловаться</a>
                  </div>
                </div>
              </div>';
      break;

      case 'friend':
        echo '<div class="m-0 p-0 mt-2 d-flex flex-row justify-content-center align-items-center">
                <p class="btn btn-red user-profile-action-btn w-100 m-0 p-1 pointer" data-u="'.$user_uuid.'" data-f="'.$current_user_uuid.'" id="del-friend-from-user-page-btn">Убрать из друзей</p>

                <div class="m-0 p-0" role="group">
                  <p class="m-0 ml-2 p-0 d-flex align-items-center justify-content-center border-radius-circle" id="user-profile-more-menu-icon" data-toggle="dropdown" aria-expanded="false">
                    <svg class="m-0 p-0 pointer" width="33px" height="33px" viewBox="0 0 24 24" fill="none">
                      <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="var(--main-text-color)" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M8.4707 10.7402L12.0007 14.2602L15.5307 10.7402" stroke="var(--main-text-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </p>

                  <div class="dropdown-menu dropdown-menu-right user-profile-dropdown-menu mt-1 p-0" aria-labelledby="user-profile-more-menu-icon">
                    <a class="dropdown-item only-one-item pt-2 pb-2" 
                        onclick="event.preventDefault();openReportUserModal(\''.$user_uuid.'\',\''.$current_user_uuid.'\');" 
                        href="" 
                        aria-label="Пожаловаться">Пожаловаться</a>
                  </div>
                </div>
              </div>';
      break;

      case 'submitter':
        echo '<div class="m-0 p-0 mt-4 d-flex flex-row justify-content-center align-items-center">
                <p class="btn btn-red user-profile-action-btn w-100 m-0 p-1 pointer" data-u="'.$user_uuid.'" data-f="'.$current_user_uuid.'" id="del-request-from-user-page-btn">Отменить заявку</p>

                <div class="m-0 p-0" role="group">
                  <p class="m-0 ml-2 p-0 d-flex align-items-center justify-content-center border-radius-circle" id="user-profile-more-menu-icon" data-toggle="dropdown" aria-expanded="false">
                    <svg class="m-0 p-0 pointer" width="33px" height="33px" viewBox="0 0 24 24" fill="none">
                      <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="var(--main-text-color)" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M8.4707 10.7402L12.0007 14.2602L15.5307 10.7402" stroke="var(--main-text-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </p>

                  <div class="dropdown-menu dropdown-menu-right user-profile-dropdown-menu mt-1 p-0" aria-labelledby="user-profile-more-menu-icon">
                    <a class="dropdown-item only-one-item pt-2 pb-2" 
                        onclick="event.preventDefault();openReportUserModal(\''.$user_uuid.'\',\''.$current_user_uuid.'\');" 
                        href="" 
                        aria-label="Пожаловаться">Пожаловаться</a>
                  </div>
                </div>
              </div>';
      break;

      case 'receiver':
        echo '<div class="m-0 p-0 mt-4 d-flex flex-row justify-content-center align-items-center">
                <div class="m-0 p-0 w-100" role="group">
                  <p class="btn btn-standard user-profile-action-btn m-0 p-1 pointer" id="user-profile-answer-request" data-u="'.$user_uuid.'" data-f="'.$current_user_uuid.'" data-toggle="dropdown" aria-expanded="false">Ответить на заявку</p>

                  <div class="dropdown-menu dropdown-menu-right user-profile-dropdown-menu mt-1 p-0" aria-labelledby="user-profile-answer-request">
                    <a class="dropdown-item pt-2 pb-2 first-item" 
                        id="accept-request-from-user-page-btn"
                        href="" 
                        aria-label="Принять заявку">Принять заявку</a>

                    <a class="dropdown-item last-item pt-2 pb-2" 
                        id="deny-request-from-user-page-btn"
                        href="" 
                        aria-label="Отклонить заявку">Отклонить заявку</a>
                  </div>
                </div>

                <div class="m-0 p-0" role="group">
                  <p class="m-0 ml-2 p-0 d-flex align-items-center justify-content-center border-radius-circle" id="user-profile-more-menu-icon" data-toggle="dropdown" aria-expanded="false">
                    <svg class="m-0 p-0 pointer" width="33px" height="33px" viewBox="0 0 24 24" fill="none">
                      <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="var(--main-text-color)" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M8.4707 10.7402L12.0007 14.2602L15.5307 10.7402" stroke="var(--main-text-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </p>

                  <div class="dropdown-menu dropdown-menu-right user-profile-dropdown-menu mt-1 p-0" aria-labelledby="user-profile-more-menu-icon">
                    <a class="dropdown-item only-one-item pt-2 pb-2" 
                        onclick="event.preventDefault();openReportUserModal(\''.$user_uuid.'\',\''.$current_user_uuid.'\');" 
                        href="" 
                        aria-label="Пожаловаться">Пожаловаться</a>
                  </div>
                </div>
              </div>
              ';
      break;

      case 'subscriber':
        echo '<div class="m-0 p-0 mt-4 d-flex flex-row justify-content-center align-items-center">
                <p class="btn btn-standard user-profile-action-btn w-100 m-0 p-1 pointer" data-u="'.$user_uuid.'" data-f="'.$current_user_uuid.'" id="add-friend-from-subscriber-from-user-page-btn">Добавить в друзья</p>

                <div class="m-0 p-0" role="group">
                  <p class="m-0 ml-2 p-0 d-flex align-items-center justify-content-center border-radius-circle" id="user-profile-more-menu-icon" data-toggle="dropdown" aria-expanded="false">
                    <svg class="m-0 p-0 pointer" width="33px" height="33px" viewBox="0 0 24 24" fill="none">
                      <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="var(--main-text-color)" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M8.4707 10.7402L12.0007 14.2602L15.5307 10.7402" stroke="var(--main-text-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </p>

                  <div class="dropdown-menu dropdown-menu-right user-profile-dropdown-menu mt-1 p-0" aria-labelledby="user-profile-more-menu-icon">
                    <a class="dropdown-item only-one-item pt-2 pb-2" 
                        onclick="event.preventDefault();openReportUserModal(\''.$user_uuid.'\',\''.$current_user_uuid.'\');" 
                        href="" 
                        aria-label="Пожаловаться">Пожаловаться</a>
                  </div>
                </div>
              </div>';
      break;

      case 'subscribed':
        echo '<div class="m-0 p-0 mt-4 d-flex flex-row justify-content-center align-items-center">
                <p class="btn btn-red user-profile-action-btn m-0 p-1 pointer" data-u="'.$user_uuid.'" data-f="'.$current_user_uuid.'" id="del-subscribed-from-user-page-btn">Отписаться</p>

                <div class="m-0 p-0" role="group">
                  <p class="m-0 ml-2 p-0 d-flex align-items-center justify-content-center border-radius-circle" id="user-profile-more-menu-icon" data-toggle="dropdown" aria-expanded="false">
                    <svg class="m-0 p-0 pointer" width="33px" height="33px" viewBox="0 0 24 24" fill="none">
                      <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="var(--main-text-color)" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M8.4707 10.7402L12.0007 14.2602L15.5307 10.7402" stroke="var(--main-text-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </p>

                  <div class="dropdown-menu dropdown-menu-right user-profile-dropdown-menu mt-1 p-0" aria-labelledby="user-profile-more-menu-icon">
                    <a class="dropdown-item only-one-item pt-2 pb-2" 
                        onclick="event.preventDefault();openReportUserModal(\''.$user_uuid.'\',\''.$current_user_uuid.'\');" 
                        href="" 
                        aria-label="Пожаловаться">Пожаловаться</a>
                  </div>
                </div>
              </div>';
      break;

      default:
      break;
    }
  }else
  {
?>
    <div class="m-0 mt-3 mb-3 p-0 pt-3 pb-3"><?= ban_user_message($current_user_uuid); ?></div>
<?
  }
?>
</div>