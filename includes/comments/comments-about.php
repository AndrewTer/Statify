<div class="block-search-and-sort p-0 text-center d-none d-md-block">
  <p class="fz-14 fw-700 m-0 p-2">О пользователе</p>
  <hr class="hr-user-info m-0 mb-2">

  <div class="row m-0 p-0 mt-2 mb-2 ml-3 mr-3 d-flex align-items-center justify-content-center">
<?
  $user_country = get_user_country_name($photo_user_uuid);
  $user_city = get_user_city_name($photo_user_uuid);
  $user_birthday = get_user_birthday($photo_user_uuid);
  $user_gender = get_user_gender($photo_user_uuid);
  $user_gender_preference = get_user_gender_preference($photo_user_uuid);

  $min_age_preference = get_user_minimum_age_preference($photo_user_uuid);
  $max_age_preference = get_user_maximum_age_preference($photo_user_uuid);

  switch (true)
  {
    case ($min_age_preference && $max_age_preference):
      $age_preference_text = '&nbsp;'.$min_age_preference.'-'.$max_age_preference.' лет';
      break;
    case ($min_age_preference && !$max_age_preference):
      $age_preference_text = '&nbsp;от '.$min_age_preference.' лет';
      break;
    case (!$min_age_preference && $max_age_preference):
      $age_preference_text = '&nbsp;до '.$max_age_preference.' лет';
      break;
    default:
      $age_preference_text = '';
      break;
  } 
?>
    <div class="w-100 m-0 p-0 d-flex flex-row">
      <p class="m-0 p-0 icon-about"><i class="fa fa-map-marker" aria-hidden="true"></i></p>
      <p class="w-100 m-0 ml-2 p-0 text-left"><?= ($user_city) ? $user_city : "Не указано"; ?></p>
    </div>

    <div class="w-100 m-0 mt-2 p-0 d-flex flex-row">
      <p class="m-0 p-0 icon-about"><i class="fa fa-calendar" aria-hidden="true"></i></p>
      <p class="w-100 m-0 ml-2 p-0 text-left"><?= "Возраст: ".(($user_birthday) ? calculate_age($user_birthday).'&nbsp;лет' : "Не указан"); ?></p>
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

    <div class="w-100 m-0 mt-2 p-0 d-flex flex-row">
<?
    $min_age_preference = get_user_minimum_age_preference($photo_user_uuid);
    $max_age_preference = get_user_maximum_age_preference($photo_user_uuid);

    switch (true)
    {
      case ($min_age_preference && $max_age_preference):
        $age_preference_text = '&nbsp;'.$min_age_preference.'-'.$max_age_preference.' лет';
        break;
      case ($min_age_preference && !$max_age_preference):
        $age_preference_text = '&nbsp;от '.$min_age_preference.' лет';
        break;
      case (!$min_age_preference && $max_age_preference):
        $age_preference_text = '&nbsp;до '.$max_age_preference.' лет';
        break;
      default:
        $age_preference_text = '';
        break;
    } 

    switch ($user_gender_preference) {
      case 'male':
        echo '<p class="m-0 p-0 icon-about"><i class="fa fa-star-half-o" aria-hidden="true"></i></p>
              <p class="w-100 m-0 ml-2 p-0 text-left">Интересы:'.$age_preference_text.' (<i class="fa fa-mars" aria-hidden="true"></i>)</p>';
        break;

      case 'female':
        echo '<p class="m-0 p-0 icon-about"><i class="fa fa-star-half-o" aria-hidden="true"></i></p>
              <p class="w-100 m-0 ml-2 p-0 text-left">Интересы:'.$age_preference_text.' (<i class="fa fa-venus" aria-hidden="true"></i>)</p>';
        break;

      default:
        echo '<p class="m-0 p-0 icon-about"><i class="fa fa-star-half-o" aria-hidden="true"></i></p>
              <p class="w-100 m-0 ml-2 p-0 text-left">Интересы: Отсутствуют</p>';
        break;
    }
?>
    </div>
  </div>

  <hr class='hr-user-info ml-3 mr-3'>

  <div class="row m-0 p-0 ml-3 mr-3 mb-2">
<?
  $tags_array = get_user_tags($photo_user_uuid);

  if (!is_null($tags_array))
  {
    echo '<ul class="tags-list p-0 m-0 d-flex flex-wrap">';

    for ($tags_num = 0; $tags_num < count($tags_array); $tags_num++)
      echo '<a href="search?q='.$tags_array[$tags_num].'"><li>'.$tags_array[$tags_num].'</li></a>';
    
    echo '</ul>';
  }else
    echo '<p class="fz-13 m-0 p-0 text-center w-100">Список тегов пуст</p>';
?>
  </div>
</div>