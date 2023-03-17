<div class="m-0 ml-5 mr-5 p-0 d-flex flex-row align-items-center justify-content-center">
<?
  if ($current_user_uuid == $user_uuid)
  {
?>
  <a class="m-0 p-0" href="friends?sort=all-friends">
    <p class="m-0 p-0 fz-20 font-weight-bold pointer d-flex flex-column align-items-center user-profile-general-values">
      <?= all_friends_count($current_user_uuid); ?>
      <span class="font-weight-normal font-style-normal fz-15">Друзья</span>
    </p>
  </a>

  <p class="m-0 ml-5 p-0 fz-20 font-weight-bold pointer d-flex flex-column align-items-center user-profile-general-values" id="general-values-photos-p">
    <?= get_photos_count($current_user_uuid); ?>
    <span class="font-weight-normal font-style-none fz-15">Фотографии</span>
  </p>

  <p class="m-0 ml-5 p-0 fz-20 font-weight-bold pointer d-flex flex-column align-items-center user-profile-general-values" id="general-values-saves-p">
    <?= get_saves_count($current_user_uuid); ?>
    <span class="font-weight-normal font-style-none fz-15">Сохранения</span>
  </p>

  <p class="m-0 ml-5 p-0 fz-20 font-weight-bold pointer d-flex flex-column align-items-center user-profile-general-values" id="general-values-comments-p">
    <?= count(get_current_user_comments_list($current_user_uuid)); ?>
    <span class="font-weight-normal font-style-none fz-15">Комментарии</span>
  </p>
<?
  }else
  {
    $mutual_friends_array = get_mutual_friends_list($user_uuid, $current_user_uuid);
    $mutual_friends_count = ($mutual_friends_array) ? count($mutual_friends_array) : 0;
?>
  <p class="m-0 p-0 fz-20 font-weight-bold d-flex flex-column align-items-center user-profile-general-values">
    <?= all_friends_count($current_user_uuid); ?>
    <span class="font-weight-normal font-style-normal fz-15">Друзья</span>
  </p>

  <p class="m-0 ml-5 p-0 fz-20 font-weight-bold pointer d-flex flex-column align-items-center user-profile-general-values"
      onclick="event.preventDefault();openMutualFriendsModal(<?= '\''.$user_uuid.'\',\''.$current_user_uuid.'\''; ?>)">
    <?= $mutual_friends_count; ?>
    <span class="font-weight-normal font-style-normal fz-15">Общие друзья</span>
  </p>

  <p class="m-0 ml-5 p-0 fz-20 font-weight-bold d-flex flex-column align-items-center user-profile-general-values
      <?= (user_friendly_status($user_uuid, $current_user_uuid) == 'friend') ? 'pointer' : ''; ?>" 
    <?= (user_friendly_status($user_uuid, $current_user_uuid) == 'friend') ? 'id="general-values-photos-p"' : ''; ?>>
    <?= get_photos_count($current_user_uuid); ?>
    <span class="font-weight-normal font-style-none fz-15">Фотографии</span>
  </p>
<?
  }
?>
</div>