<div class="block-user-content mt-3 <?= (!check_user_page_status($user_uuid)) ? 'page-not-completed-user-info-hide' : ''; ?>" id="user-info-interests">
  <h5 class="title-user-info">Интересы</h5>
  <hr class="hr-user-info">

<? 
  if ($page_status)
  {
    $user_gender_preference = get_user_gender_preference($user_uuid);
    $user_minimum_age_preference = get_user_minimum_age_preference($user_uuid);
    $user_maximum_age_preference = get_user_maximum_age_preference($user_uuid);
?>

  <div class="w-100 m-0 mt-2 p-0 d-flex flex-row">
<?
  switch ($user_gender_preference) {
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

  <div class="w-100 m-0 mt-2 p-0 d-flex flex-row">
    <p class="m-0 p-0 icon-about"><i class="fa fa-calendar" aria-hidden="true"></i></p>
    <p class="w-100 m-0 ml-2 p-0 text-left">Возраст: 
      <?
        if ($user_minimum_age_preference && $user_maximum_age_preference)
          echo "от ".$user_minimum_age_preference." до ".$user_maximum_age_preference;
        elseif ($user_minimum_age_preference && !$user_maximum_age_preference) 
          echo "от ".$user_minimum_age_preference;
        elseif ($user_maximum_age_preference && !$user_minimum_age_preference)
          echo "до ".$user_maximum_age_preference;
        else
          echo "Не указан";
      ?>
    </p>
  </div>
<?
  }else
    echo '<p class="w-100 text-center f-13 m-0">Отсутствуют</p>';
?>
</div>