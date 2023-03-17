<?
  $user_fullname = get_user_fullname($current_user_uuid);
  $user_nickname = get_user_nickname($current_user_uuid);
?>
<div class="section section-user-info m-0">
  <div class="avatar-block">
<?
  if ($ban_check == 'success')
    if (!is_null(check_user_online_status($current_user_uuid)))
      if (get_latest_avatar($current_user_uuid))
        echo '<img class="btn-md rounded-circle online pointer"
                    id="userImg"
                    src="users/'.$current_user_uuid.'/'.get_latest_avatar($current_user_uuid).'" 
                    alt="'.$user_fullname.'" 
                    onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$current_user_uuid.'\',\''.get_latest_avatar($current_user_uuid).'\');">';
      else
        echo '<img class="btn-md rounded-circle online" src="imgs/no-avatar.png" alt="'.$user_fullname.'">';
    else
      if (get_latest_avatar($current_user_uuid))
        echo '<img class="btn-md rounded-circle offline pointer"
                    id="userImg"
                    src="users/'.$current_user_uuid.'/'.get_latest_avatar($current_user_uuid).'" 
                    alt="'.$user_fullname.'" 
                    onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$current_user_uuid.'\',\''.get_latest_avatar($current_user_uuid).'\');">';
      else
        echo '<img class="btn-md rounded-circle offline" src="imgs/no-avatar.png" alt="'.$user_fullname.'">';
  else
    if (get_latest_avatar($current_user_uuid))
      echo '<img class="btn-md rounded-circle offline pointer"
                  id="userImg"
                  src="users/'.$current_user_uuid.'/'.get_latest_avatar($current_user_uuid).'" 
                  alt="'.$user_fullname.'"
                  onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$current_user_uuid.'\',\''.get_latest_avatar($current_user_uuid).'\');">';
    else
      echo '<img class="btn-md rounded-circle offline" id="userImg" src="imgs/no-avatar.png" alt="'.$user_fullname.'">';
?>
  </div>
</div>