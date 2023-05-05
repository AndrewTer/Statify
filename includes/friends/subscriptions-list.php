<ul id="block-subscriber" class="p-0">
  <div class="w-100 p-0">
    <div class="friend-card ml-0 mr-0 mt-0" id="friend-search-card">
      <div class="w-100 m-0 d-flex flex-row align-items-center">
        <p class="m-0 p-0 mr-2">
          <svg width="18px" height="18px" viewBox="0 0 24 24" fill="none">
            <circle cx="10" cy="10" r="6" stroke="var(--main-text-color)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></circle>
            <path d="M14.5 14.5L19 19" stroke="var(--main-text-color)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </p>
        <input type="text" class="fz-14 w-100 p-1 input-field" id="subscriberslist-search" placeholder="Поиск подписок">
      </div>
    </div>
  </div>

<?
$subscriptions_list = get_subscriptions_list($user_uuid);

if($subscriptions_list)
{
  for ($subscriptions_num = 0; $subscriptions_num < count($subscriptions_list); $subscriptions_num++)
  {
    $subscription_uuid = $subscriptions_list[$subscriptions_num];
    $subscription_nickname = '@'.get_user_nickname($subscription_uuid);

    $mutual_friends_array = get_mutual_friends_list($user_uuid, $subscription_uuid);
    $mutual_friends_count = ($mutual_friends_array) ? count($mutual_friends_array) : 0;

    $ban_check = ban_check($subscription_uuid);
    $hash_modal = sha1($subscription_uuid.$subscription_nickname);
    $premium_status = check_premium_active($subscription_uuid);
?>
    <li class="w-100 p-0 user-card" id="friends-block-<?= $hash_modal; ?>">
      
      <div class="friend-card m-0 mb-3 p-2 pl-3 pr-3" id="friends-block-content-<?= $hash_modal; ?>">
        <div class="dropdown-action-menu m-0 dropdown" role="group">
          <p id="dropdown-action-menu-btn" data-toggle="dropdown" aria-expanded="false">
            <svg fill="var(--main-text-color)" width="22px" height="22px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M2,12a2,2,0,1,1,2,2A2,2,0,0,1,2,12Zm10,2a2,2,0,1,0-2-2A2,2,0,0,0,12,14Zm8-4a2,2,0,1,0,2,2A2,2,0,0,0,20,10Z"></path>
            </svg>
          </p>

          <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="dropdown-action-menu-btn">
<?
            if ($ban_check == 'success')
              echo '<a class="dropdown-item pt-2 pb-2 first-item font-weight-bold" 
                        href="" 
                        onclick="event.preventDefault();delSubscribedFromSubscriptionsList(\''.$user_uuid.'\',\''.$subscription_uuid.'\');">Отписаться</a>
                    <hr class="hr-user-info m-0">
                    <a class="dropdown-item pt-2 pb-2 last-item font-weight-bold" 
                        onclick="event.preventDefault();openReportUserModal(\''.$user_uuid.'\',\''.$subscription_uuid.'\');"
                        href="">Пожаловаться</a>';
            else
              echo '<a class="dropdown-item pt-2 pb-2 only-one-item font-weight-bold" 
                        href="" 
                        onclick="event.preventDefault();delSubscribedFromSubscriptionsList(\''.$user_uuid.'\',\''.$subscription_uuid.'\');">Отписаться</a>';
?>
          </div>
        </div>

        <div class="w-100 m-0 p-1 d-flex flex-row subscriber-card-header">

          <div class="d-flex align-items-start justify-content-start p-0 mr-3">
<?
          $preview_photo_check = file_exists('users/'.$subscription_uuid.'/'.get_user_avatar_preview($subscription_uuid)) ? 1 : 0;
          if ($ban_check == 'success')
            if (!is_null(check_user_online_status($subscription_uuid)))
              if (get_user_avatar($subscription_uuid))
                echo '<img class="rounded-circle online m-0 p-0 pointer" width="70px" height="70px" 
                            src="users/'.$subscription_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($subscription_uuid) : get_user_avatar($subscription_uuid)).'" 
                            alt="'.get_user_fullname($subscription_uuid).'" 
                            onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$subscription_uuid.'\',\''.get_user_avatar($subscription_uuid).'\');">';
              else
                echo '<img class="rounded-circle online m-0 p-0" width="70px" height="70px" src="imgs/no-avatar.png" alt="'.get_user_fullname($subscription_uuid).'">';
            else
              if (get_user_avatar($subscription_uuid))
                echo '<img class="rounded-circle offline m-0 p-0 pointer" width="70px" height="70px" 
                            src="users/'.$subscription_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($subscription_uuid) : get_user_avatar($subscription_uuid)).'" 
                            alt="'.get_user_fullname($subscription_uuid).'" 
                            onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$subscription_uuid.'\',\''.get_user_avatar($subscription_uuid).'\');">';
              else
                echo '<img class="rounded-circle offline m-0 p-0" width="70px" height="70px" src="imgs/no-avatar.png" alt="'.get_user_fullname($subscription_uuid).'">';
          else
            if (get_user_avatar($subscription_uuid))
              echo '<img class="rounded-circle offline m-0 p-0 pointer" width="70px" height="70px" 
                          src="users/'.$subscription_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($subscription_uuid) : get_user_avatar($subscription_uuid)).'" 
                          alt="'.get_user_fullname($subscription_uuid).'" 
                          onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$subscription_uuid.'\',\''.get_user_avatar($subscription_uuid).'\');">';
            else
              echo '<img class="rounded-circle offline m-0 p-0" width="70px" height="70px" src="imgs/no-avatar.png" alt="'.get_user_fullname($subscription_uuid).'">';
?>
          </div>
          
          <div class="w-100 m-0 p-0">
            <div class="w-75 m-0 p-0">
              <a class="m-0 p-0" href="./?u=<?= get_user_nickname($subscription_uuid); ?>">
<?
            if ($premium_status)
            {
?>
                <p class="username pointer text-hover search-content w-100 fz-16 d-flex align-items-center font-weight-bold"><?= get_user_fullname($subscription_uuid); ?>
                  <svg class="ml-2 premium-star active" width="15px" height="15px" viewBox="0 0 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#2ACAEA" stroke-width="0.00048000000000000007" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
                    <defs>  
                      <linearGradient id="premium-logo-gradient-<?= $hash_modal; ?>" x1="50%" y1="0%" x2="50%" y2="100%" > 
                        <stop offset="0%" stop-color="#7A5FFF">
                          <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
                        </stop>
                        <stop offset="100%" stop-color="#01FF89">
                          <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
                        </stop>
                      </linearGradient> 
                    </defs>
                    <g>
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8712 33.0436L15.9976 44.7036C15.9362 45.5229 16.6646 46.0872 17.3161 45.722C21.9289 43.1382 36.3783 33.6479 43.7017 12.7899C44.0376 11.8331 43.1352 10.9697 42.3646 11.5094C38.0387 14.539 28.5846 20.8006 22.7421 21.9934C22.7421 21.9934 26.4836 19.3946 28.7231 15.4053C28.9426 15.0143 28.9244 14.5136 28.6796 14.1606L20.5127 2.38925C20.0287 1.69147 19.0354 1.98057 18.8606 2.87002L16.3181 15.8073L4.38437 26.2226C3.78602 26.7446 3.90808 27.7996 4.5989 28.079L16.8712 33.0436Z" fill="url('#premium-logo-gradient-<?= $hash_modal; ?>')"></path> 
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M37.9745 28.448C37.2188 29.5025 35.5908 31.6717 34.0876 32.9974C33.7871 33.2624 33.8276 33.7068 34.1724 33.9234L42.1145 38.909C42.5926 39.2091 43.2384 38.8529 43.1576 38.3323C42.7882 35.9496 41.7237 30.9818 39.0328 28.3741C38.7322 28.083 38.2142 28.1136 37.9745 28.448Z" fill="url('#premium-logo-gradient-<?= $hash_modal; ?>')"></path> 
                    </g>
                  </svg>
                </p>
<?
            }else
            {
?>
                <p class="username pointer text-hover w-100 fz-16 m-0 search-content font-weight-bold"><?= get_user_fullname($subscription_uuid); ?></p>
<?
            }
?>
              </a>

              <p class="w-100 fz-12 m-0 mb-2" id="nickname"><?= $subscription_nickname; ?></p>
              <a class="fz-12 m-0 mutual-friends-modal-link" onclick="event.preventDefault();openMutualFriendsModal(<?= '\''.$user_uuid.'\',\''.$subscription_uuid.'\''; ?>)">Общие друзья: <?= $mutual_friends_count; ?></a>
            </div>
<?
            if ($ban_check != 'success')
            {
?>
            <div class="m-0 p-0"><hr class="hr-user-info mt-2 mb-3"><?= ban_user_message($subscription_uuid); ?></div>
<?
            }
?>
          </div>

        </div>
      </div> 
      
    </li>
<?
  }
}else
  echo '<span class="d-flex justify-content-center p-5 w-100"><strong class="h5">У вас нет подписок</strong></span>';
?>
</ul>

<script type="text/javascript" src="js/friendship.js"></script>