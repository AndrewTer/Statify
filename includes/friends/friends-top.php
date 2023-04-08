<?
  if ($top_five_result = pg_fetch_row($top_five_query))
  {
    if (pg_num_rows($top_five_query) > 1)
    {
?>
  <div class="block-user-content mb-3">
    <div class="w-100 m-0 p-0 d-flex flex-row align-items-center">
      <p class="m-0 ml-auto mr-auto p-0 fz-15 d-flex flex-row align-items-center font-weight-bold">
        <svg class="mr-2" fill="var(--main-text-color)" width="15px" height="15px" viewBox="0 -32 576 576">
          <path d="M552 64H448V24c0-13.3-10.7-24-24-24H152c-13.3 0-24 10.7-24 24v40H24C10.7 64 0 74.7 0 88v56c0 35.7 22.5 72.4 61.9 100.7 31.5 22.7 69.8 37.1 110 41.7C203.3 338.5 240 360 240 360v72h-48c-35.3 0-64 20.7-64 56v12c0 6.6 5.4 12 12 12h296c6.6 0 12-5.4 12-12v-12c0-35.3-28.7-56-64-56h-48v-72s36.7-21.5 68.1-73.6c40.3-4.6 78.6-19 110-41.7 39.3-28.3 61.9-65 61.9-100.7V88c0-13.3-10.7-24-24-24zM99.3 192.8C74.9 175.2 64 155.6 64 144v-16h64.2c1 32.6 5.8 61.2 12.8 86.2-15.1-5.2-29.2-12.4-41.7-21.4zM512 144c0 16.1-17.7 36.1-35.3 48.8-12.5 9-26.7 16.2-41.8 21.4 7-25 11.8-53.6 12.8-86.2H512v16z"></path>
        </svg>
        Топ 5
      </p>
    </div>

    <hr class="hr-user-info">

    <div class="row w-100 m-0 justify-content-center">
<?
      do {
        $friend_uuid = $top_five_result[0];
        $friend_name = $top_five_result[1].' '.$top_five_result[2];

        $ban_check = ban_check($friend_uuid);

        $preview_photo_check = file_exists('users/'.$friend_uuid.'/'.get_latest_avatar_preview($friend_uuid)) ? 1 : 0;

        if ($friend_uuid == $user_uuid) 
        {
?>
      <div class="friends-card p-2">
        <div class="mx-auto d-block friends-card-avatar">
<?
          if ($avatar_exists) 
            echo '<img class="rounded-circle current-user-line top-friend" src="users/'.$friend_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($friend_uuid) : get_latest_avatar($friend_uuid)).'" alt="'.$friend_name.'" onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$friend_uuid.'\',\''.get_latest_avatar($friend_uuid).'\');">';
          else
            echo '<img class="rounded-circle current-user-line top-friend" src="imgs/no-avatar.png" alt="'.$friend_name.'">';
?>
        </div>
      </div>
<?
        }else 
        {
?>
      <div class="friends-card p-2">
        <div class="mx-auto d-block friends-card-avatar">
<?
        if ($ban_check == 'success')
          if (!is_null(check_user_online_status($friend_uuid)))
            if (($preview_photo_check == 1 ? get_latest_avatar_preview($friend_uuid) : get_latest_avatar($friend_uuid)))
              echo '<img class="rounded-circle online top-friend" src="users/'.$friend_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($friend_uuid) : get_latest_avatar($friend_uuid)).'" alt="'.$friend_name.'" onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$friend_uuid.'\',\''.get_latest_avatar($friend_uuid).'\');">';
            else
              echo '<img class="rounded-circle online top-friend" src="imgs/no-avatar.png" alt="'.$friend_name.'">';
          else
            if (($preview_photo_check == 1 ? get_latest_avatar_preview($friend_uuid) : get_latest_avatar($friend_uuid)))
              echo '<img class="rounded-circle offline top-friend" src="users/'.$friend_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($friend_uuid) : get_latest_avatar($friend_uuid)).'" alt="'.$friend_name.'" onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$friend_uuid.'\',\''.get_latest_avatar($friend_uuid).'\');">';
            else
              echo '<img class="rounded-circle offline top-friend" src="imgs/no-avatar.png" alt="'.$friend_name.'">';
        else
          if (($preview_photo_check == 1 ? get_latest_avatar_preview($friend_uuid) : get_latest_avatar($friend_uuid)))
            echo '<img class="rounded-circle offline top-friend" src="users/'.$friend_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($friend_uuid) : get_latest_avatar($friend_uuid)).'" alt="'.$friend_name.'"
              onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$friend_uuid.'\',\''.get_latest_avatar($friend_uuid).'\');">';
          else
            echo '<img class="rounded-circle online top-friend" src="imgs/no-avatar.png" alt="'.$friend_name.'">';
?>
        </div>
        <!--<p class="friends-card-name"><?= $friend_name; ?></p>-->
      </div>
<?
        }
      } while ($top_five_result = pg_fetch_row($top_five_query));    
?>      
    </div>
  </div>
<?
    }
  }
?>