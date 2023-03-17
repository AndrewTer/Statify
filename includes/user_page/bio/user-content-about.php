<div class="block-user-content <?= (!check_user_page_status($user_uuid)) ? 'page-not-completed-user-info-hide' : ''; ?>" id="user-info-about">
  <h5 class="title-user-info">Личные данные</h5>
  <hr class="hr-user-info">

<? 
  if ($page_status)
  {
    $user_country = get_user_country_name($user_uuid);
    $user_city = get_user_city_name($user_uuid);
    $user_birthday = get_user_birthday($user_uuid);
    $user_gender = get_user_gender($user_uuid);
?>

  <div class="w-100 m-0 p-0 d-flex flex-row">
    <p class="m-0 p-0 icon-about"><i class="fa fa-map-marker" aria-hidden="true"></i></p>
    <p class="w-100 m-0 ml-2 p-0 text-left"><?= ($user_city) ? $user_city : "Не указано"; ?></p>
  </div>

  <div class="w-100 m-0 mt-2 p-0 d-flex flex-row">
    <p class="m-0 p-0 icon-about"><i class="fa fa-calendar" aria-hidden="true"></i></p>
    <p class="w-100 m-0 ml-2 p-0 text-left"><?= "Возраст: ".(($user_birthday) ? calculate_age($user_birthday) : "Не указан"); ?></p>
  </div>

  <div class="w-100 m-0 mt-2 p-0 d-flex flex-row">
<?
  switch ($user_gender) {
    case 'male':
      echo '<p class="m-0 p-0 icon-about"><i class="fa fa-mars" aria-hidden="true"></i></p>
            <p class="w-100 m-0 ml-2 p-0 text-left">Пол: Мужской</p>';
      break;

    case 'female':
      echo '<p class="m-0 p-0 icon-about"><i class="fa fa-venus" aria-hidden="true"></i></p>
            <p class="w-100 m-0 ml-2 p-0 text-left">Пол: Женский</p>';
      break;

    default:
      echo '<p class="m-0 p-0 icon-about"><i class="fa fa-genderless" aria-hidden="true"></i></p>
            <p class="w-100 m-0 ml-2 p-0 text-left">Пол: Не указан</p>';
      break;
  }
?>
  </div>
<?
  }else
    echo '<p class="w-100 text-center f-13 m-0">Отсутствуют</p>';
?>
</div>