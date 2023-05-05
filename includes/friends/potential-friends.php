<?
  $potential_friends_list = get_potential_friends_list($user_uuid, 'random');

  if ($potential_friends_list)
  {
?>
<div class="block-search-and-sort suggestions-top-block p-0 text-center d-none d-md-block">
  <p class="fz-15 font-weight-bold letter-spacing-05 m-0 p-2">Возможные друзья</p>
  <hr class="hr-user-info m-0 mb-2">
<?
    for ($potential_friends_num = 0; $potential_friends_num < count($potential_friends_list); $potential_friends_num++)
    {
      $potential_friend_uuid = $potential_friends_list[$potential_friends_num][0];
      $potential_friend_number_mutual_friends = $potential_friends_list[$potential_friends_num][1];
      $premium_status = check_premium_active($potential_friend_uuid);

      if ($potential_friends_num > 0)
        echo "<hr class='hr-user-info ml-3 mr-3'>";
?>
  <div class="w-100 m-0 mt-2 mb-2 pl-3 pr-3 d-flex align-items-center justify-content-center">

    <div class="potential-card-avatar d-flex align-items-center justify-content-center m-0 p-0">
<?
    $preview_photo_check = file_exists('users/'.$potential_friend_uuid.'/'.get_user_avatar_preview($potential_friend_uuid)) ? 1 : 0;
    if (!is_null(check_user_online_status($potential_friend_uuid)))
      if (get_user_avatar($potential_friend_uuid))
        echo '<img class="rounded-circle online m-0 p-0 w-100"
                    src="users/'.$potential_friend_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($potential_friend_uuid) : get_user_avatar($potential_friend_uuid)).'" 
                    alt="'.get_user_fullname($potential_friend_uuid).'"
                    onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\', \''.$potential_friend_uuid,'\', \''.get_user_avatar($potential_friend_uuid).'\');">';
      else
        echo '<img class="rounded-circle online m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.get_user_fullname($potential_friend_uuid).'">';
    else
      if (get_user_avatar($potential_friend_uuid))
        echo '<img class="rounded-circle offline m-0 p-0 w-100" 
                    src="users/'.$potential_friend_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($potential_friend_uuid) : get_user_avatar($potential_friend_uuid)).'" 
                    alt="'.get_user_fullname($potential_friend_uuid).'" 
                    onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$potential_friend_uuid.'\',\''.get_user_avatar($potential_friend_uuid).'\');">';
      else
        echo '<img class="rounded-circle offline m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.get_user_fullname($potential_friend_uuid).'">';
?>
    </div>

    <div class="w-100 d-flex flex-column m-0 p-0 pl-3">
<?
    if ($premium_status)
    {
?>
      <a class="m-0 text-break text-left friends-user-fullname pointer font-weight-bold" href="./?u=<?= get_user_nickname($potential_friend_uuid); ?>">
        <p class="fz-14 m-0 p-0 d-flex align-items-center"><?= get_user_fullname($potential_friend_uuid); ?>
          <svg class="ml-1 premium-star active" width="12px" height="12px" viewBox="0 0 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#2ACAEA" stroke-width="0.00048000000000000007" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
            <defs>  
              <linearGradient id="premium-logo-gradient-<?= $potential_friends_num; ?>" x1="50%" y1="0%" x2="50%" y2="100%" > 
                <stop offset="0%" stop-color="#7A5FFF">
                  <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
                </stop>
                <stop offset="100%" stop-color="#01FF89">
                  <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
                </stop>
              </linearGradient> 
            </defs>
            <g>
              <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8712 33.0436L15.9976 44.7036C15.9362 45.5229 16.6646 46.0872 17.3161 45.722C21.9289 43.1382 36.3783 33.6479 43.7017 12.7899C44.0376 11.8331 43.1352 10.9697 42.3646 11.5094C38.0387 14.539 28.5846 20.8006 22.7421 21.9934C22.7421 21.9934 26.4836 19.3946 28.7231 15.4053C28.9426 15.0143 28.9244 14.5136 28.6796 14.1606L20.5127 2.38925C20.0287 1.69147 19.0354 1.98057 18.8606 2.87002L16.3181 15.8073L4.38437 26.2226C3.78602 26.7446 3.90808 27.7996 4.5989 28.079L16.8712 33.0436Z" fill="url('#premium-logo-gradient-<?= $potential_friends_num; ?>')"></path> 
              <path fill-rule="evenodd" clip-rule="evenodd" d="M37.9745 28.448C37.2188 29.5025 35.5908 31.6717 34.0876 32.9974C33.7871 33.2624 33.8276 33.7068 34.1724 33.9234L42.1145 38.909C42.5926 39.2091 43.2384 38.8529 43.1576 38.3323C42.7882 35.9496 41.7237 30.9818 39.0328 28.3741C38.7322 28.083 38.2142 28.1136 37.9745 28.448Z" fill="url('#premium-logo-gradient-<?= $potential_friends_num; ?>')"></path> 
            </g>
          </svg>
        </p>
      </a>
<?
    }else
    {
?>
      <a class="m-0 text-break text-left friends-user-fullname pointer font-weight-bold" href="./?u=<?= get_user_nickname($potential_friend_uuid); ?>">
        <p class="fz-14 m-0 p-0"><?= get_user_fullname($potential_friend_uuid); ?></p>
      </a>
<?
    }
?>

      <a class="fz-12 m-0 text-break text-left mutual-friends-modal-link" onclick="event.preventDefault();openMutualFriendsModal(<?= '\''.$user_uuid.'\',\''.$potential_friend_uuid.'\''; ?>)">Общие друзья: <?= $potential_friend_number_mutual_friends; ?></a>
    </div>

  </div>
<?
    }
?>
  <!--<hr class="hr-user-info m-0">
  <p id="view-all-potential-friends" class="fz-14 m-0 p-2" role="button" href="search">Показать всех</p>-->
</div>
<?
  }
?>