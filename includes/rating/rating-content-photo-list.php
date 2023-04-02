<?
  define('mystatify', true);
  require_once("../connection.php");
  include("../../functions/functions.php");
  include("../../functions/database-functions.php");
  include("../../functions/functions-for-check.php");
  include("../../functions/functions-user-data.php");
  include("../../functions/functions-for-rating.php");
  include("../../functions/functions-modals.php");

  $cookie_login = $_COOKIE['login'];
  $cookie_key = $_COOKIE['key'];

  $user_uuid = get_user_uuid_by_cookie($cookie_login, $cookie_key);
  $avatar_exists = get_latest_avatar($user_uuid);

  if (check_email_confirmed($user_uuid))
  {
    if ($avatar_exists)
    {
      $photo_array_for_rating = [];
      $photo_array_for_rating = get_list_of_photos_to_rate($user_uuid, 50, 0);

      if ($photo_array_for_rating)
      {
?>
<div class="m-0 p-0 rating-photo-list">
<?
        for ($photo_array_num = 0; $photo_array_num < count($photo_array_for_rating); $photo_array_num++)
        {
          $photo_name = $photo_array_for_rating[$photo_array_num]['photo_name'];
          $photo_user_uuid = $photo_array_for_rating[$photo_array_num]['user_uuid'];

          $preview_photo_check = file_exists('../../users/'.$photo_user_uuid.'/'.get_latest_avatar_preview($photo_user_uuid)) ? 1 : 0;
?>
  <div class="m-1 rating-photo-card">
    <img class="w-100 pointer" 
          src="<?= 'users/'.$photo_user_uuid.'/'.$photo_name; ?>" 
          alt="<?= get_user_fullname($photo_user_uuid); ?>"
          onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$user_uuid.'\',\''.$photo_user_uuid.'\',\''.$photo_name.'\''; ?>);">
    
    <div class="m-0 m-1 p-0 pt-1 pb-1 w-100 rating-photo-card-description">
      <a class="m-0 p-0 w-100 d-flex flex-row align-items-center pointer" href="./?u=<?= get_user_nickname($photo_user_uuid); ?>">
<?
          if (!is_null(check_user_online_status($photo_user_uuid)))
            if (get_latest_avatar($photo_user_uuid))
              echo '<img class="m-0 ml-2 mr-3 p-0 online"
                          src="users/'.$photo_user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($photo_user_uuid) : get_latest_avatar($photo_user_uuid)).'" 
                          alt="'.get_user_fullname($photo_user_uuid).'">';
            else
              echo '<img class="m-0 ml-2 mr-3 p-0 online" src="imgs/no-avatar.png" alt="'.get_user_fullname($photo_user_uuid).'">';
          else
            if (get_latest_avatar($photo_user_uuid))
              echo '<img class="m-0 ml-2 mr-3 p-0 offline"
                          src="users/'.$photo_user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($photo_user_uuid) : get_latest_avatar($photo_user_uuid)).'" 
                          alt="'.get_user_fullname($photo_user_uuid).'">';
            else
              echo '<img class="m-0 ml-2 mr-3 p-0 offline" src="imgs/no-avatar.png" alt="'.get_user_fullname($photo_user_uuid).'">';
?>
        <div class="m-0 p-0 pr-2 d-flex flex-column word-wrap">
          <p class="m-0 p-0 fz-14"><?= cut_string_to_N_character(get_user_fullname($photo_user_uuid), 20); ?></p>
          <p class="m-0 p-0 fz-11" style="font-style: italic;">@<?= get_user_nickname($photo_user_uuid); ?></p>
        </div> 
      </a>        
    </div>
  </div>
<?
        }
?>
</div>
<?
      }else
        echo '<span class="d-flex justify-content-center p-5 w-100 text-center"><strong class="h4">Некого оценивать</strong></span>';
    }else
      echo '<span class="fz-15 d-flex justify-content-center p-5 w-100 text-center">Вы не можете оценивать фотографии пользователей пока не загрузите фотографию профиля</span>';
  }else
    echo '<span class="fz-15 d-flex justify-content-center p-5 w-100 text-center">Вы не можете оценивать фотографии пользователей пока не подтвердите email</span>';
?>