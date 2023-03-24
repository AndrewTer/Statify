<div class="m-0 mr-auto p-0 d-flex flex-column align-items-start justify-content-center" id="brief-user-info">
  <p class="m-0" id="nickname"><?= ($user_nickname) ? '@'.$user_nickname : ''; ?></p>
<?
  if (user_friendly_status($user_uuid, $current_user_uuid) == 'friend' || $current_user_uuid == $user_uuid)
  {
?>
  <span class="mt-2 fz-16">
    <i class="fa fa-star-o active-star" aria-hidden="true"></i>
    <?= (get_user_rating_among_all_users($current_user_uuid) != 0) ? get_user_rating_among_all_users($current_user_uuid) : '0 %'; ?>
  </span>
<?
  }

  if ($page_status && $current_user_uuid == $user_uuid)
  {
    $latest_avatar_date = get_latest_avatar_date_upload($user_uuid);
    
    if ($latest_avatar_date == 'success' && check_user_page_status($user_uuid) && check_email_confirmed($user_uuid))
      echo '<div class="m-0 p-0 mt-2 d-flex flex-row justify-content-center align-items-center">
              <p class="btn btn-standard user-profile-action-btn m-0 p-1" data-href="edit">Редактировать</p>

              <svg fill="var(--main-text-color)" class="m-0 p-0 ml-2 pointer" id="user-profile-add-photo-icon" width="33px" height="33px" viewBox="-1 0 19 19" xmlns="http://www.w3.org/2000/svg" data-href="edit">
                <path d="M16.5 9.5a8 8 0 1 1-8-8 8 8 0 0 1 8 8zm-2.874-2.287a.803.803 0 0 0-.8-.8h-2.054v-.251a.802.802 0 0 0-.8-.8h-2.93a.802.802 0 0 0-.8.8v.25H4.186a.802.802 0 0 0-.8.8v5.166a.802.802 0 0 0 .8.8h8.639a.803.803 0 0 0 .8-.8zm-2.692 2.582a2.427 2.427 0 1 1-2.428-2.427 2.428 2.428 0 0 1 2.428 2.427zm-4.055 0a1.627 1.627 0 1 0 1.627-1.627A1.63 1.63 0 0 0 6.88 9.795zm2.75-3.931a.4.4 0 1 0 .4.4.4.4 0 0 0-.4-.4z"></path>
              </svg>
            </div>';
    else
      echo '<p class="btn btn-standard user-profile-action-btn m-0 mt-2 p-1" data-href="edit">Редактировать</p>';
  }

  $friendly_user_status = user_friendly_status($user_uuid, $current_user_uuid);

  switch ($friendly_user_status) {
    case 'user':
      echo '<div class="m-0 p-0 mt-4 d-flex flex-row justify-content-center align-items-center">
              <p class="btn btn-standard user-profile-action-btn w-100 m-0 p-1 pointer" data-u="'.$user_uuid.'" data-f="'.$current_user_uuid.'" id="add-friend-from-user-page-btn">Добавить в друзья</p>

              <div class="m-0 p-0" role="group">
                <svg class="m-0 ml-2 pointer" id="user-profile-more-menu-icon" data-toggle="dropdown" aria-expanded="false" width="28px" height="28px" fill="var(--main-text-color)" version="1.1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                  <path d="M12,24C5.4,24,0,18.6,0,12S5.4,0,12,0s12,5.4,12,12S18.6,24,12,24z M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10 S17.5,2,12,2z"></path>
                  <circle cx="7" cy="12" r="1.5"></circle>
                  <circle cx="12" cy="12" r="1.5"></circle>
                  <circle cx="17" cy="12" r="1.5"></circle>
                </svg>

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
                <svg class="m-0 ml-2 pointer" id="user-profile-more-menu-icon" data-toggle="dropdown" aria-expanded="false" width="28px" height="28px" fill="var(--main-text-color)" version="1.1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                  <path d="M12,24C5.4,24,0,18.6,0,12S5.4,0,12,0s12,5.4,12,12S18.6,24,12,24z M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10 S17.5,2,12,2z"></path>
                  <circle cx="7" cy="12.5" r="1.5"></circle>
                  <circle cx="12" cy="12.5" r="1.5"></circle>
                  <circle cx="17" cy="12.5" r="1.5"></circle>
                </svg>

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
                <svg class="m-0 ml-2 pointer" id="user-profile-more-menu-icon" data-toggle="dropdown" aria-expanded="false" width="28px" height="28px" fill="var(--main-text-color)" version="1.1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                  <path d="M12,24C5.4,24,0,18.6,0,12S5.4,0,12,0s12,5.4,12,12S18.6,24,12,24z M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10 S17.5,2,12,2z"></path>
                  <circle cx="7" cy="12" r="1.5"></circle>
                  <circle cx="12" cy="12" r="1.5"></circle>
                  <circle cx="17" cy="12" r="1.5"></circle>
                </svg>

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
                <svg class="m-0 ml-2 pointer" id="user-profile-more-menu-icon" data-toggle="dropdown" aria-expanded="false" width="28px" height="28px" fill="var(--main-text-color)" version="1.1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                  <path d="M12,24C5.4,24,0,18.6,0,12S5.4,0,12,0s12,5.4,12,12S18.6,24,12,24z M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10 S17.5,2,12,2z"></path>
                  <circle cx="7" cy="12" r="1.5"></circle>
                  <circle cx="12" cy="12" r="1.5"></circle>
                  <circle cx="17" cy="12" r="1.5"></circle>
                </svg>

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
                <svg class="m-0 ml-2 pointer" id="user-profile-more-menu-icon" data-toggle="dropdown" aria-expanded="false" width="28px" height="28px" fill="var(--main-text-color)" version="1.1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                  <path d="M12,24C5.4,24,0,18.6,0,12S5.4,0,12,0s12,5.4,12,12S18.6,24,12,24z M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10 S17.5,2,12,2z"></path>
                  <circle cx="7" cy="12" r="1.5"></circle>
                  <circle cx="12" cy="12" r="1.5"></circle>
                  <circle cx="17" cy="12" r="1.5"></circle>
                </svg>

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
                <svg class="m-0 ml-2 pointer" id="user-profile-more-menu-icon" data-toggle="dropdown" aria-expanded="false" width="28px" height="28px" fill="var(--main-text-color)" version="1.1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64px" height="64px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                  <path d="M12,24C5.4,24,0,18.6,0,12S5.4,0,12,0s12,5.4,12,12S18.6,24,12,24z M12,2C6.5,2,2,6.5,2,12s4.5,10,10,10s10-4.5,10-10 S17.5,2,12,2z"></path>
                  <circle cx="7" cy="12" r="1.5"></circle>
                  <circle cx="12" cy="12" r="1.5"></circle>
                  <circle cx="17" cy="12" r="1.5"></circle>
                </svg>

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
?>
</div>