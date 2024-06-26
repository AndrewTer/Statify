<?
  define('mystatify', true);
  require_once("../connection.php");
  include("../../functions/functions.php");
  include("../../functions/database-functions.php");
  include("../../functions/functions-for-check.php");
  include("../../functions/functions-user-data.php");
  include("../../functions/functions-for-rating.php");
  include("../../functions/functions-modals.php");
  include("../../functions/functions-photos.php");

  $cookie_login = $_COOKIE['login'];
  $cookie_key = $_COOKIE['key'];

  $user_uuid = get_user_uuid_by_cookie($cookie_login, $cookie_key);

  if (check_email_confirmed($user_uuid))
  {
    if (get_photos_list($user_uuid))
    {
      $photo_array_for_rating = [];
      $photo_array_for_rating = get_list_of_photos_to_rate($user_uuid, 60, 0);

      if ($photo_array_for_rating)
      {
?>
<div class="m-0 p-0 rating-photo-list">
<?
        for ($photo_array_num = 0; $photo_array_num < count($photo_array_for_rating); $photo_array_num++)
        {
          $photo_name = $photo_array_for_rating[$photo_array_num]['photo_name'];
          $photo_user_uuid = $photo_array_for_rating[$photo_array_num]['user_uuid'];

          $preview_photo_check = file_exists('../../users/'.$photo_user_uuid.'/'.get_user_avatar_preview($photo_user_uuid)) ? 1 : 0;
?>
  <div class="m-1 rating-photo-card">
    <img class="w-100 pointer p-2" 
          src="<?= 'users/'.$photo_user_uuid.'/'.$photo_name; ?>" 
          alt="<?= get_user_fullname($photo_user_uuid); ?>"
          onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$user_uuid.'\',\''.$photo_user_uuid.'\',\''.$photo_name.'\''; ?>);">
    
    <div class="m-1 p-0 w-100 rating-photo-card-description">
      <a class="m-0 p-0 pl-2 pr-2 pb-2 w-100 d-flex flex-row align-items-center pointer" href="./?u=<?= get_user_nickname($photo_user_uuid); ?>">
<?
          if (!is_null(check_user_online_status($photo_user_uuid)))
            if (get_user_avatar($photo_user_uuid))
              echo '<img class="m-0 mr-3 p-0 online"
                          src="users/'.$photo_user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($photo_user_uuid) : get_user_avatar($photo_user_uuid)).'" 
                          alt="'.get_user_fullname($photo_user_uuid).'">';
            else
              echo '<img class="m-0 mr-3 p-0 online" src="imgs/no-avatar.png" alt="'.get_user_fullname($photo_user_uuid).'">';
          else
            if (get_user_avatar($photo_user_uuid))
              echo '<img class="m-0 mr-3 p-0 offline"
                          src="users/'.$photo_user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($photo_user_uuid) : get_user_avatar($photo_user_uuid)).'" 
                          alt="'.get_user_fullname($photo_user_uuid).'">';
            else
              echo '<img class="m-0 mr-3 p-0 offline" src="imgs/no-avatar.png" alt="'.get_user_fullname($photo_user_uuid).'">';
?>
        <div class="m-0 p-0 pr-2 d-flex flex-column word-wrap">
          <p class="m-0 p-0 fz-15 font-weight-bold"><?= cut_string_to_N_character(get_user_fullname($photo_user_uuid), 20); ?></p>
          <p class="m-0 p-0 fz-12" style="font-style: italic;">@<?= get_user_nickname($photo_user_uuid); ?></p>
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
      echo '<span class="fz-15 d-flex justify-content-center p-5 w-100 text-center">Вы не можете оценивать фотографии пользователей пока не загрузите хотя бы одну фотографию</span>';
  }else
    echo '<span class="fz-15 d-flex justify-content-center p-5 w-100 text-center">Вы не можете оценивать фотографии пользователей пока не подтвердите email</span>';
?>