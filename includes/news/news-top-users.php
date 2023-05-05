<div class="block-search-and-sort mb-3 p-0 text-center">
  <p class="fz-15 m-0 p-2 font-weight-bold">Топ 10 пользователей</p>
  <hr class="hr-user-info m-0 mb-2">
<?
    $top_ten_users_list = get_top_ten_users();

    for ($top_ten_users_num = 0; $top_ten_users_num < 3; $top_ten_users_num++)
    {
      $top_ten_user_fullname = $top_ten_users_list[$top_ten_users_num][1].' '.$top_ten_users_list[$top_ten_users_num][2];
      $top_ten_user_nickname = $top_ten_users_list[$top_ten_users_num][3];
      $top_ten_user_position = $top_ten_users_list[$top_ten_users_num][4];
      $top_ten_user_uuid = $top_ten_users_list[$top_ten_users_num][0];

      $preview_photo_check = file_exists('users/'.$top_ten_user_uuid.'/'.get_user_avatar_preview($top_ten_user_uuid)) ? 1 : 0;

      switch ($top_ten_user_position) {
          case 1:
?>
            <div class="w-100 m-0 mt-2 mb-2 p-0 pl-3 pr-3 d-flex align-items-center">
              <div class="top-ten-num p-0 fz-12 m-0 font-weight-bold text-center first-text"><?= $top_ten_user_position; ?></div>

              <div class="top-ten-card-avatar m-0 ml-3 p-0">
<?
              if (get_user_avatar($top_ten_user_uuid))
                echo '<img class="rounded-circle first-line m-0 p-0 w-100" 
                            src="users/'.$top_ten_user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($top_ten_user_uuid) : get_user_avatar($top_ten_user_uuid)).'" 
                            alt="'.$top_ten_user_fullname.'"
                            onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$top_ten_user_uuid.'\',\''.get_user_avatar($top_ten_user_uuid).'\');">';
              else
                echo '<img class="rounded-circle first-line m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$top_ten_user_fullname.'">';
?>
              </div>   

              <div class="first-text w-100 m-0 ml-3 mr-1 p-0 text-left">
                <a class="first-text pointer" href="./?u=<?= get_user_nickname($top_ten_user_uuid); ?>"><?= $top_ten_user_fullname; ?></a>
              </div>

              <div class="text-center first-text m-0 ml-auto p-0 font-weight-bold"><?= round((int)get_user_rating_among_all_users($top_ten_user_uuid)).'%'; ?></div>
            </div>

            <hr class='hr-user-info ml-3 mr-3'>
<?
          break;

          case 2:
?>
            <div class="w-100 m-0 mt-2 mb-2 p-0 pl-3 pr-3 d-flex align-items-center">
              <div class="top-ten-num p-0 fz-12 m-0 font-weight-bold text-center second-text"><?= $top_ten_user_position; ?></div>

              <div class="top-ten-card-avatar m-0 ml-3 p-0">
<?
              if (get_user_avatar($top_ten_user_uuid))
                echo '<img class="rounded-circle second-line m-0 p-0 w-100" 
                            src="users/'.$top_ten_user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($top_ten_user_uuid) : get_user_avatar($top_ten_user_uuid)).'" 
                            alt="'.$top_ten_user_fullname.'"
                            onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$top_ten_user_uuid.'\',\''.get_user_avatar($top_ten_user_uuid).'\');">';
              else
                echo '<img class="rounded-circle second-line m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$top_ten_user_fullname.'">';
?>
              </div>

              <div class="second-text w-100 m-0 ml-3 mr-1 p-0 text-left">
                <a class="second-text pointer" href="./?u=<?= get_user_nickname($top_ten_user_uuid); ?>"><?= $top_ten_user_fullname; ?></a>
              </div>
              
              <div class="text-center second-text m-0 ml-auto p-0 font-weight-bold"><?= round((int)get_user_rating_among_all_users($top_ten_user_uuid)).'%'; ?></div>
            </div>

            <hr class='hr-user-info ml-3 mr-3'>
<?
          break;

          case 3:
?>
            <div class="w-100 m-0 mt-2 mb-2 p-0 pl-3 pr-3 d-flex align-items-center">
              <div class="top-ten-num p-0 fz-12 m-0 font-weight-bold text-center third-text"><?= $top_ten_user_position; ?></div>

              <div class="top-ten-card-avatar m-0 ml-3 p-0">
<?
              if (get_user_avatar($top_ten_user_uuid))
                echo '<img class="rounded-circle third-line m-0 p-0 w-100" 
                            src="users/'.$top_ten_user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($top_ten_user_uuid) : get_user_avatar($top_ten_user_uuid)).'" 
                            alt="'.$top_ten_user_fullname.'"
                            onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$top_ten_user_uuid.'\',\''.get_user_avatar($top_ten_user_uuid).'\');">';
              else
                echo '<img class="rounded-circle third-line m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$top_ten_user_fullname.'">';
?>
              </div>

              <div class="third-text w-100 m-0 ml-3 mr-1 p-0 text-left">
                <a class="third-text pointer" href="./?u=<?= get_user_nickname($top_ten_user_uuid); ?>"><?= $top_ten_user_fullname; ?></a>
              </div>

              <div class="text-center third-text m-0 ml-auto p-0 font-weight-bold"><?= round((int)get_user_rating_among_all_users($top_ten_user_uuid)).'%'; ?></div>
            </div>
<?
          break;

          default:
          break;
        }
    }
?>

  <div id="topTenUserList" class="collapse">
    <hr class='hr-user-info m-0 ml-3 mr-3'>
<?
    for ($top_ten_users_num = 3; $top_ten_users_num < count($top_ten_users_list); $top_ten_users_num++)
    {
      $top_ten_user_fullname = $top_ten_users_list[$top_ten_users_num][1].' '.$top_ten_users_list[$top_ten_users_num][2];
      $top_ten_user_nickname = $top_ten_users_list[$top_ten_users_num][3];
      $top_ten_user_position = $top_ten_users_list[$top_ten_users_num][4];
      $top_ten_user_uuid = $top_ten_users_list[$top_ten_users_num][0];

      $preview_photo_check = file_exists('users/'.$top_ten_user_uuid.'/'.get_user_avatar_preview($top_ten_user_uuid)) ? 1 : 0;
?>
      <div class="w-100 m-0 mt-2 mb-2 p-0 pl-3 pr-3 d-flex align-items-center">
        <div class="top-ten-num p-0 fz-12 m-0 font-weight-bold text-center"><?= $top_ten_user_position; ?></div>

        <div class="top-ten-card-avatar m-0 ml-3 p-0">
<?
          if (get_user_avatar($top_ten_user_uuid))
            echo '<img class="rounded-circle offline m-0 p-0 w-100" 
                    src="users/'.$top_ten_user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($top_ten_user_uuid) : get_user_avatar($top_ten_user_uuid)).'" 
                    alt="'.$top_ten_user_fullname.'"
                     onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$top_ten_user_uuid.'\',\''.get_user_avatar($top_ten_user_uuid).'\');">';
          else
            echo '<img class="rounded-circle offline m-0 p-0 w-100" src="imgs/no-avatar.png" alt="'.$top_ten_user_fullname.'">';
?>
        </div>

        <div class="w-100 m-0 ml-3 mr-1 p-0 text-left">
          <a class="pointer" href="./?u=<?= get_user_nickname($top_ten_user_uuid); ?>"><?= $top_ten_user_fullname; ?></a>
        </div>

        <div class="text-center m-0 ml-auto p-0 font-weight-bold"><?= round((int)get_user_rating_among_all_users($top_ten_user_uuid)).'%'; ?></div>
      </div>
<?

      if ($top_ten_user_position > 3 && $top_ten_user_position != count($top_ten_users_list))
        echo "<hr class='hr-user-info ml-3 mr-3'>";
    }
?>

  </div>

  <hr class="hr-user-info m-0">
  <p id="view-all-top-ten-users" class="fz-14 m-0 p-2" data-toggle="collapse" role="button" href="#topTenUserList" aria-expanded="false" aria-controls="topTenUserList">Показать всех</p>

</div>

<script type="text/javascript" src="js/news.js"></script>