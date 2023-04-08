<div class="row m-0 p-0 p-3">
  <div class="mr-auto d-flex flex-row align-items-center">
<?
  $preview_author_photo_check = file_exists('users/'.$photo_user_uuid.'/'.get_latest_avatar_preview($photo_user_uuid)) ? 1 : 0;
  $premium_status_author_photo = check_premium_active($photo_user_uuid);

  if (!is_null(check_user_online_status($photo_user_uuid)))
    echo '<img class="rounded-circle online m-0 p-0 rounded-saved-user-picture" 
                src="users/'.$photo_user_uuid.'/'.($preview_author_photo_check == 1 ? get_latest_avatar_preview($photo_user_uuid) : get_latest_avatar($photo_user_uuid)).'" 
                alt="'.get_user_fullname($photo_user_uuid).'" 
                onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$photo_user_uuid.'\',\''.get_latest_avatar($photo_user_uuid).'\', 1);">';
  else
    echo '<img class="rounded-circle offline m-0 p-0 rounded-saved-user-picture" 
                src="users/'.$photo_user_uuid.'/'.($preview_author_photo_check == 1 ? get_latest_avatar_preview($photo_user_uuid) : get_latest_avatar($photo_user_uuid)).'" 
                alt="'.get_user_fullname($photo_user_uuid).'" 
                onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$photo_user_uuid.'\',\''.get_latest_avatar($photo_user_uuid).'\', 1);">';
?>

    <a class="comment-user-fullname m-0 p-0 ml-3 pointer text-hover" 
        href="./?u=<?= get_user_nickname($photo_user_uuid); ?>"
        title="<?= get_user_fullname($photo_user_uuid); ?>">
<?
    if ($premium_status_author_photo)
    {
?>
      <p class="fz-16 m-0 w-100 text-left d-flex align-items-center font-weight-bold"><?= get_user_fullname($photo_user_uuid); ?>
        <svg class="ml-2 premium-star active" width="15px" height="15px" viewBox="0 0 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#2ACAEA" stroke-width="0.00048000000000000007" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
          <defs>  
            <linearGradient id="premium-logo-gradient-author-photo" x1="50%" y1="0%" x2="50%" y2="100%" > 
              <stop offset="0%" stop-color="#7A5FFF">
                <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
              </stop>
              <stop offset="100%" stop-color="#01FF89">
                <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
              </stop>
            </linearGradient> 
          </defs>
          <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8712 33.0436L15.9976 44.7036C15.9362 45.5229 16.6646 46.0872 17.3161 45.722C21.9289 43.1382 36.3783 33.6479 43.7017 12.7899C44.0376 11.8331 43.1352 10.9697 42.3646 11.5094C38.0387 14.539 28.5846 20.8006 22.7421 21.9934C22.7421 21.9934 26.4836 19.3946 28.7231 15.4053C28.9426 15.0143 28.9244 14.5136 28.6796 14.1606L20.5127 2.38925C20.0287 1.69147 19.0354 1.98057 18.8606 2.87002L16.3181 15.8073L4.38437 26.2226C3.78602 26.7446 3.90808 27.7996 4.5989 28.079L16.8712 33.0436Z" fill="url('#premium-logo-gradient-author-photo')"></path> 
          <path fill-rule="evenodd" clip-rule="evenodd" d="M37.9745 28.448C37.2188 29.5025 35.5908 31.6717 34.0876 32.9974C33.7871 33.2624 33.8276 33.7068 34.1724 33.9234L42.1145 38.909C42.5926 39.2091 43.2384 38.8529 43.1576 38.3323C42.7882 35.9496 41.7237 30.9818 39.0328 28.3741C38.7322 28.083 38.2142 28.1136 37.9745 28.448Z" fill="url('#premium-logo-gradient-author-photo')"></path> 
        </svg>
      </p>
<?
    }else
      echo '<p class="fz-16 m-0 w-100 text-left font-weight-bold">'.get_user_fullname($photo_user_uuid).'</p>';
?>
      <p class="fz-12 m-0 w-100 text-left" id="nickname"><?= '@'.get_user_nickname($photo_user_uuid); ?></p>
    </a>
  </div>

<?
  if ($user_uuid != $photo_user_uuid)
  {
?>
  <div class="m-0 p-0" id="user-menu-block">
    <div class="friend-menu m-0 dropdown" id="user-menu" role="group">
      <p id="friend-menu-btn" data-toggle="dropdown" aria-expanded="false">
        <svg fill="var(--main-text-color)" width="24px" height="24px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M2,12a2,2,0,1,1,2,2A2,2,0,0,1,2,12Zm10,2a2,2,0,1,0-2-2A2,2,0,0,0,12,14Zm8-4a2,2,0,1,0,2,2A2,2,0,0,0,20,10Z"></path>
        </svg>
      </p>

      <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="friend-menu-btn">
        <a class="dropdown-item pt-2 pb-2 first-item font-weight-bold" 
            onclick="event.preventDefault();openMutualFriendsModal(<?= '\''.$user_uuid.'\',\''.$photo_user_uuid.'\''; ?>)" 
            href="" 
            aria-label="Общие друзей">Общие друзья</a>
<?
        $friendly_user_status = user_friendly_status($user_uuid, $photo_user_uuid);

        switch ($friendly_user_status) {
          case 'user':
            echo '<hr class="hr-user-info m-0">
                  <a class="dropdown-item pt-2 pb-2 font-weight-bold"
                      href="" 
                      onclick="event.preventDefault();addFriendFromComments(\''.$user_uuid.'\',\''.$photo_user_uuid.'\');">Добавить в друзья</a>';
          break;

          case 'friend':
            echo '<hr class="hr-user-info m-0">
                  <a class="dropdown-item pt-2 pb-2 font-weight-bold" 
                      href="" 
                      onclick="event.preventDefault();delFriendFromComments(\''.$user_uuid.'\',\''.$photo_user_uuid.'\');">Убрать из друзей</a>';
          break;

          case 'submitter':
            echo '<hr class="hr-user-info m-0">
                  <a class="dropdown-item pt-2 pb-2 font-weight-bold" 
                      href="" 
                      onclick="event.preventDefault();delRequestFromComments(\''.$user_uuid.'\',\''.$photo_user_uuid.'\');">Отменить заявку</a>';
          break;

          case 'receiver':
            echo '<hr class="hr-user-info m-0">
                  <a class="dropdown-item pt-2 pb-2 font-weight-bold" 
                      href="" 
                      onclick="event.preventDefault();acceptFriendRequestFromComments(\''.$user_uuid.'\',\''.$photo_user_uuid.'\');">Принять заявку</a>
                  <hr class="hr-user-info m-0">
                  <a class="dropdown-item pt-2 pb-2 font-weight-bold" 
                      href="" 
                      onclick="event.preventDefault();declineFriendRequestFromComments(\''.$user_uuid.'\',\''.$photo_user_uuid.'\');">Отклонить заявку</a>';
          break;

          case 'subscriber':
            echo '<hr class="hr-user-info m-0">
                  <a class="dropdown-item pt-2 pb-2 font-weight-bold" 
                      href="" 
                      onclick="event.preventDefault();addFriendFromSubscriberFromComments(\''.$user_uuid.'\',\''.$photo_user_uuid.'\');">Добавить в друзья</a>';
          break;

          case 'subscribed':
            echo '<hr class="hr-user-info m-0">
                  <a class="dropdown-item pt-2 pb-2 font-weight-bold" 
                      href="" 
                      onclick="event.preventDefault();delSubscribedFromComments(\''.$user_uuid.'\',\''.$photo_user_uuid.'\');">Отписаться</a>';
          break;

          default:
            echo '<hr class="hr-user-info m-0">
                  <a class="dropdown-item pt-2 pb-2 font-weight-bold" 
                      href="" 
                      onclick="event.preventDefault();addFriendFromComments(\''.$user_uuid.'\',\''.$photo_user_uuid.'\');">Добавить в друзья</a>';
          break;
        }
?>
        <hr class="hr-user-info m-0">
        <a class="dropdown-item pt-2 pb-2 last-item font-weight-bold" onclick="event.preventDefault();openReportUserModal(<?= '\''.$user_uuid.'\',\''.$photo_user_uuid.'\''; ?>);" href="" aria-label="Пожаловаться">Пожаловаться</a>
      </div>
    </div>
  </div>
<?
  }
?>
</div>

<hr class="hr-user-info m-0">
<img class="w-100" id="userImg" src="users/<?= $photo_user_uuid.'/'.$photo_name; ?>" alt="<?= get_user_fullname($photo_user_uuid); ?>">
<hr class="hr-user-info m-0">