<div class="m-0 mr-auto p-0 d-flex flex-column align-items-start justify-content-center">
  <p class="m-0" id="nickname"><?= ($user_nickname) ? '@'.$user_nickname : ''; ?></p>
<?
  if (user_friendly_status($user_uuid, $current_user_uuid) == 'friend' || $current_user_uuid == $user_uuid)
  {
?>
  <span class="mt-2 fz-16">
    <i class="fa fa-star-o active-star" aria-hidden="true"></i>
    <?= (get_user_rating_among_all_users($current_user_uuid) != 0) ? get_user_rating_among_all_users($current_user_uuid) : '0 %'; ?>
  </span>
<?
  }

  if ($page_status && $current_user_uuid == $user_uuid)
    echo '<p class="btn btn-standard w-100 m-0 mt-2 p-1" id="btn-edit" data-href="edit">Редактировать</p>';

  $friendly_user_status = user_friendly_status($user_uuid, $current_user_uuid);

  switch ($friendly_user_status) {
    case 'user':
      echo '<p class="btn btn-standard w-100 m-0 mt-4 p-1 pointer" id="btn-edit">Добавить в друзья</p>';
    break;

    case 'friend':
      echo '<p class="btn btn-red w-100 m-0 mt-4 p-1 pointer" id="btn-edit">Убрать из друзей</p>';
    break;

    case 'submitter':
      echo '<p class="btn btn-red w-100 m-0 mt-4 p-1 pointer" id="btn-edit">Отменить заявку</p>';
    break;

    case 'receiver':
      echo '<p class="btn btn-standard w-100 m-0 mt-4 p-1 pointer" id="btn-edit">Принять заявку</p>
            <p class="btn btn-red w-100 m-0 mt-2 p-1 pointer" id="btn-edit">Отклонить заявку</p>';
    break;

    case 'subscriber':
      echo '<p class="btn btn-standard w-100 m-0 mt-4 p-1 pointer" id="btn-edit">Добавить в друзья</p>';
    break;

    case 'subscribed':
            echo '<p class="btn btn-red w-100 m-0 mt-4 p-1 pointer" id="btn-edit">Отписаться</p>';
    break;

    default:
    break;
  }
?>
</div>