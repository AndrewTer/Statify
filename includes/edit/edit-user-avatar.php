<? include("requests/user-info-for-statistics.php"); ?>
<p class="title-awards-info fz-17 text-center mt-2 mb-2 font-weight-bold">Фотография профиля</p>
<hr class="hr-user-info">
<?
if ($avatar_exists) 
  echo '<div class="container" id="block-edit-user-avatar">
          <img id="user-avatar" src="users/'.$user_uuid.'/'.get_user_avatar($user_uuid).'" alt="'.$user_fullname.'">
        </div>
        <div class="m-0 p-0" id="del-user-avatar-block">
          <hr class="hr-user-info mb-0">
          <div class="m-0 p-2">
            <p class="btn btn-red fz-14 w-100 m-0 pointer" onclick="event.preventDefault();delUserAvatar();">Удалить</p>
          </div>
        </div>';
else
  echo '<div class="container" id="block-edit-user-avatar">
          <img id="user-avatar" src="imgs/no-avatar.png" alt="'.$user_fullname.'">
        </div>';
?>