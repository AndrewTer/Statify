<?
  $user_fullname = get_user_fullname($user_uuid);
  $user_nickname = get_user_nickname($user_uuid);
?>
<div class="section section-user-info m-0">
  <div class="avatar-block" id="main-user-avatar">
<?
  if ($avatar_exists)
    echo '<img class="btn-md online rounded-circle" 
                id="userImg" 
                src="users/'.$user_uuid.'/'.get_latest_avatar($user_uuid).'" 
                alt="'.$user_fullname.'" 
                onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$user_uuid.'\',\''.get_latest_avatar($user_uuid).'\');">';
  else
    echo '<img class="btn-md online rounded-circle" id="userImg" src="imgs/no-avatar.png" alt="'.$user_fullname.'">';
?>
  </div>

  <div id="block-user-title-mobile" class="m-0 mt-4">
    <div class="m-0 p-0 d-flex flex-row justify-content-center align-items-center">
      <p class="card-title pointer text-hover username fz-18 d-flex justify-content-center align-items-center font-weight-bold" onclick="event.preventDefault();openUserProfileModal(<?= '\''.$user_uuid.'\',\''.$user_uuid.'\''; ?>);"><?= ($user_nickname) ? $user_fullname : ''; ?></p>
<?
    if ($user_nickname && check_email_confirmed($user_uuid))
    {
?>
      <svg class="ml-2 premium-star pointer <?= ($premium_status) ? 'active' : 'inactive'; ?>" width="18px" height="18px" viewBox="0 0 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#2ACAEA" stroke-width="0.00048000000000000007" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)" onclick="event.preventDefault();openPremiumActiveUserModal(<?= '\''.$user_uuid.'\''; ?>);">
        <defs>  
          <linearGradient id="premium-logo-gradient-mobile" x1="50%" y1="0%" x2="50%" y2="100%" > 
            <stop offset="0%" stop-color="#7A5FFF">
              <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
            </stop>
            <stop offset="100%" stop-color="#01FF89">
              <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
            </stop>
          </linearGradient> 
        </defs>
        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8712 33.0436L15.9976 44.7036C15.9362 45.5229 16.6646 46.0872 17.3161 45.722C21.9289 43.1382 36.3783 33.6479 43.7017 12.7899C44.0376 11.8331 43.1352 10.9697 42.3646 11.5094C38.0387 14.539 28.5846 20.8006 22.7421 21.9934C22.7421 21.9934 26.4836 19.3946 28.7231 15.4053C28.9426 15.0143 28.9244 14.5136 28.6796 14.1606L20.5127 2.38925C20.0287 1.69147 19.0354 1.98057 18.8606 2.87002L16.3181 15.8073L4.38437 26.2226C3.78602 26.7446 3.90808 27.7996 4.5989 28.079L16.8712 33.0436Z" fill="<?= ($premium_status) ? "url('#premium-logo-gradient-mobile')" : 'lightgray'; ?>"></path> 
        <path fill-rule="evenodd" clip-rule="evenodd" d="M37.9745 28.448C37.2188 29.5025 35.5908 31.6717 34.0876 32.9974C33.7871 33.2624 33.8276 33.7068 34.1724 33.9234L42.1145 38.909C42.5926 39.2091 43.2384 38.8529 43.1576 38.3323C42.7882 35.9496 41.7237 30.9818 39.0328 28.3741C38.7322 28.083 38.2142 28.1136 37.9745 28.448Z" fill="<?= ($premium_status) ? "url('#premium-logo-gradient-mobile')" : 'lightgray'; ?>"></path> 
      </svg>
<?
    }
?>
    </div>

    <p class="fz-12 m-0" id="nickname"><?= ($user_nickname) ? '@'.$user_nickname : ''; ?></p>
<?
    $hash_modal = sha1($user_uuid.$user_fullname);
?>
    <div class="hr-with-text w-100 mt-4 mb-2">
      <span class="fz-16 m-0">
        <i class="fa fa-star-o active-star" aria-hidden="true"></i>
        <?= (get_user_rating_among_all_users($user_uuid) != 0) ? get_user_rating_among_all_users($user_uuid) : ''; ?>
      </span>
    </div>
  </div>
</div>

<?
  if ($page_status)
    echo '<p class="btn btn-standard w-100 m-0 mt-3 btn-edit" data-href="edit">Редактировать</p>';
?>