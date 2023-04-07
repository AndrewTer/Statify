<div class="m-0 mr-0 ml-auto p-0 w-60 position-relative d-flex align-items-center" id="user-general-values">
  <div class="w-100 m-0 ml-1 mr-1 p-0" id="block-general-values">
<?
  if ($current_user_uuid == $user_uuid)
  {
?>
    <a class="m-0 p-0" href="friends?sort=all-friends">
      <p class="m-0 mr-1 p-0 fz-20 font-weight-bold pointer d-flex flex-column align-items-center user-profile-general-values letter-spacing-05">
        <?= all_friends_count($current_user_uuid); ?>
        <span class="font-weight-normal font-style-normal fz-13 text-center">Друзья</span>
      </p>
    </a>

    <div class="vr vr-user-info"></div>

    <p class="m-0 mr-1 p-0 fz-20 font-weight-bold pointer d-flex flex-column align-items-center user-profile-general-values letter-spacing-05" id="general-values-photos-p">
      <?= get_photos_count($current_user_uuid); ?>
      <span class="font-weight-normal font-style-none fz-13 text-center">Фотографии</span>
    </p>

    <div class="vr vr-user-info"></div>

    <p class="m-0 mr-1 p-0 fz-20 font-weight-bold pointer d-flex flex-column align-items-center user-profile-general-values letter-spacing-05" id="general-values-saves-p">
      <?= get_saves_count($current_user_uuid); ?>
      <span class="font-weight-normal font-style-none fz-13 text-center">Сохранения</span>
    </p>

    <div class="vr vr-user-info"></div>

    <p class="m-0 p-0 fz-20 font-weight-bold pointer d-flex flex-column align-items-center user-profile-general-values letter-spacing-05" id="general-values-comments-p">
      <?= count(get_current_user_comments_list($current_user_uuid)); ?>
      <span class="font-weight-normal font-style-none fz-13 text-center">Комментарии</span>
    </p>
<?
  }else
  {
    $mutual_friends_array = get_mutual_friends_list($user_uuid, $current_user_uuid);
    $mutual_friends_count = ($mutual_friends_array) ? count($mutual_friends_array) : 0;
?>
    <p class="m-0 mr-1 p-0 fz-20 font-weight-bold d-flex flex-column align-items-center user-profile-general-values letter-spacing-05">
      <?= all_friends_count($current_user_uuid); ?>
      <span class="font-weight-normal font-style-normal fz-13 text-center">Друзья</span>
    </p>

    <div class="vr vr-user-info"></div>

    <p class="m-0 mr-1 p-0 fz-20 font-weight-bold pointer d-flex flex-column align-items-center user-profile-general-values letter-spacing-05"
        onclick="event.preventDefault();openMutualFriendsModal(<?= '\''.$user_uuid.'\',\''.$current_user_uuid.'\''; ?>)">
      <?= $mutual_friends_count; ?>
      <span class="font-weight-normal font-style-normal fz-13 text-center">Общие друзья</span>
    </p>

    <div class="vr vr-user-info"></div>

    <p class="m-0 p-0 fz-20 font-weight-bold d-flex flex-column align-items-center user-profile-general-values letter-spacing-05
        <?= (user_friendly_status($user_uuid, $current_user_uuid) == 'friend') ? 'pointer' : ''; ?>" 
      <?= (user_friendly_status($user_uuid, $current_user_uuid) == 'friend') ? 'id="general-values-photos-p"' : ''; ?>>
      <?= get_photos_count($current_user_uuid); ?>
      <span class="font-weight-normal font-style-none fz-13 text-center">Фотографии</span>
    </p>
<?
  }
?>
  </div>
</div>