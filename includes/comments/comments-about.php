<div class="block-search-and-sort p-0 text-center d-none d-md-block">
  <p class="fz-14 fw-700 letter-spacing-05 m-0 p-2">О пользователе</p>
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
    <div class="w-100 m-0 p-0 d-flex flex-row align-items-center">
<?
    if ($user_country && $user_city)
      echo '<p class="m-0 p-0">
              <svg class="m-0 p-0" width="14px" height="14px" viewBox="0 0 16 16" fill="var(--main-text-color)">
                <path d="m 8 0 c -3.3125 0 -6 2.6875 -6 6 c 0.007812 0.710938 0.136719 1.414062 0.386719 2.078125 l -0.015625 -0.003906 c 0.636718 1.988281 3.78125 5.082031 5.625 6.929687 h 0.003906 v -0.003906 c 1.507812 -1.507812 3.878906 -3.925781 5.046875 -5.753906 c 0.261719 -0.414063 0.46875 -0.808594 0.585937 -1.171875 l -0.019531 0.003906 c 0.25 -0.664063 0.382813 -1.367187 0.386719 -2.078125 c 0 -3.3125 -2.683594 -6 -6 -6 z m 0 3.691406 c 1.273438 0 2.308594 1.035156 2.308594 2.308594 s -1.035156 2.308594 -2.308594 2.308594 c -1.273438 -0.003906 -2.304688 -1.035156 -2.304688 -2.308594 c -0.003906 -1.273438 1.03125 -2.304688 2.304688 -2.308594 z m 0 0" fill="var(--main-text-color)"></path>
              </svg>
            </p>
            <p class="w-100 m-0 ml-3 p-0 text-left">'.$user_country.', '.$user_city.'</p>';
    elseif ($user_country && !$user_city)
      echo '<p class="m-0 p-0">
              <svg class="m-0 p-0" width="14px" height="14px" viewBox="0 0 16 16" fill="var(--main-text-color)">
                <path d="m 8 0 c -3.3125 0 -6 2.6875 -6 6 c 0.007812 0.710938 0.136719 1.414062 0.386719 2.078125 l -0.015625 -0.003906 c 0.636718 1.988281 3.78125 5.082031 5.625 6.929687 h 0.003906 v -0.003906 c 1.507812 -1.507812 3.878906 -3.925781 5.046875 -5.753906 c 0.261719 -0.414063 0.46875 -0.808594 0.585937 -1.171875 l -0.019531 0.003906 c 0.25 -0.664063 0.382813 -1.367187 0.386719 -2.078125 c 0 -3.3125 -2.683594 -6 -6 -6 z m 0 3.691406 c 1.273438 0 2.308594 1.035156 2.308594 2.308594 s -1.035156 2.308594 -2.308594 2.308594 c -1.273438 -0.003906 -2.304688 -1.035156 -2.304688 -2.308594 c -0.003906 -1.273438 1.03125 -2.304688 2.304688 -2.308594 z m 0 0" fill="var(--main-text-color)"></path>
              </svg>
            <p>
            <p class="w-100 m-0 ml-3 p-0 text-left">'.$user_country.'</p>';
    else
      echo '<p class="m-0 p-0">
              <svg class="m-0 p-0" width="14px" height="14px" viewBox="0 0 16 16" fill="var(--main-text-color)">
                <path d="m 8 0 c -1.894531 0 -3.582031 0.882812 -4.679688 2.257812 l -1.789062 -1.789062 l -1.0625 1.0625 l 14 14 l 1.0625 -1.0625 l -3.652344 -3.652344 c 0.449219 -0.546875 0.855469 -1.082031 1.167969 -1.570312 c 0.261719 -0.414063 0.46875 -0.808594 0.585937 -1.171875 l -0.019531 0.003906 c 0.25 -0.664063 0.382813 -1.367187 0.386719 -2.078125 c 0.003906 -3.3125 -2.6875 -6 -6 -6 z m 0 3.695312 c 1.273438 -0.003906 2.308594 1.03125 2.308594 2.304688 c 0 0.878906 -0.492188 1.640625 -1.214844 2.03125 l -3.125 -3.125 c 0.390625 -0.722656 1.152344 -1.210938 2.03125 -1.210938 z m -5.9375 1.429688 c -0.039062 0.289062 -0.0625 0.578125 -0.0625 0.875 c 0.003906 0.710938 0.136719 1.414062 0.386719 2.082031 l -0.015625 -0.007812 c 0.636718 1.988281 3.78125 5.082031 5.628906 6.925781 v 0.003906 v -0.003906 c 0.5625 -0.5625 1.25 -1.253906 1.945312 -1.992188 z m 0 0" fill="var(--main-text-color)"></path>
              </svg>
            </p>
            <p class="w-100 m-0 ml-3 p-0 text-left">Не указано</p>';
?>
    </div>

    <div class="w-100 m-0 mt-2 p-0 d-flex flex-row align-items-center">
<?
    if ($user_birthday)
      echo '<p class="m-0 p-0">
              <svg class="m-0 p-0" width="14px" height="14px" fill="var(--main-text-color)" viewBox="0 0 32 32">
                <path d="M28 4.75h-0.75v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-17.5v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-0.75c-1.794 0.002-3.248 1.456-3.25 3.25v19.998c0.002 1.794 1.456 3.248 3.25 3.25h24c1.794-0.001 3.249-1.456 3.25-3.25v-19.998c-0.002-1.794-1.456-3.248-3.25-3.25h-0zM14.75 13.25v3.5h-5.5v-3.5zM22.75 13.25v3.5h-5.5v-3.5zM28.75 13.25v3.5h-3.5v-3.5zM6.75 16.75h-3.5v-3.5h3.5zM3.25 19.25h3.5v3.5h-3.5zM9.25 19.25h5.5v3.5h-5.5zM14.75 25.25v3.498h-5.5v-3.498zM17.25 25.25h5.5v3.498h-5.5zM17.25 22.75v-3.5h5.5v3.5zM25.25 19.25h3.5v3.5h-3.5zM4 7.25h24c0.414 0 0.75 0.336 0.75 0.75v2.75h-25.5v-2.75c0.001-0.414 0.336-0.749 0.75-0.75h0zM3.25 27.998v-2.748h3.5v3.498h-2.75c-0.414-0-0.75-0.336-0.75-0.75v-0zM28 28.748h-2.75v-3.498h3.5v2.748c-0 0.414-0.336 0.75-0.75 0.75v0z"></path>
              </svg>
            </p>
            <p class="w-100 m-0 ml-3 p-0 text-left">Возраст: '.calculate_age($user_birthday).'</p>';
    else
      echo '<p class="m-0 p-0">
              <svg class="m-0 p-0" width="14px" height="14px" fill="var(--main-text-color)" viewBox="0 0 32 32">
                <path d="M28 4.75h-0.75v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-17.5v-2.75c0-0.69-0.56-1.25-1.25-1.25s-1.25 0.56-1.25 1.25v0 2.75h-0.75c-1.794 0.002-3.248 1.456-3.25 3.25v19.998c0.002 1.794 1.456 3.248 3.25 3.25h24c1.794-0.001 3.249-1.456 3.25-3.25v-19.998c-0.002-1.794-1.456-3.248-3.25-3.25h-0zM4 7.25h24c0.414 0 0.75 0.336 0.75 0.75v2.75h-25.5v-2.75c0.001-0.414 0.336-0.749 0.75-0.75h0zM28 28.748h-24c-0.414-0-0.75-0.336-0.75-0.75v-14.748h25.5v14.748c-0 0.414-0.336 0.75-0.75 0.75v0zM19.896 17.31c-0.226-0.226-0.539-0.366-0.884-0.366s-0.658 0.14-0.884 0.366l-2.129 2.13-2.13-2.13c-0.226-0.226-0.539-0.366-0.884-0.366-0.69 0-1.25 0.559-1.25 1.25 0 0.345 0.14 0.657 0.366 0.883l2.131 2.132-2.131 2.132c-0.227 0.226-0.368 0.539-0.368 0.885 0 0.69 0.559 1.249 1.249 1.249 0.346 0 0.66-0.141 0.886-0.369l2.13-2.13 2.129 2.13c0.226 0.227 0.539 0.367 0.885 0.367 0.69 0 1.25-0.56 1.25-1.25 0-0.345-0.14-0.657-0.365-0.883l-2.131-2.132 2.131-2.132c0.226-0.226 0.365-0.538 0.365-0.882s-0.14-0.658-0.367-0.884l-0-0z"></path>
              </svg>
            </p>
            <p class="w-100 m-0 ml-3 p-0 text-left">Возраст: Не указан</p>';
?>
    </div>

    <div class="w-100 m-0 mt-2 p-0 d-flex flex-row align-items-center">
<?
  switch ($user_gender) {
    case 'male':
      echo '<p class="m-0 p-0">
              <svg class="m-0 p-0" width="14px" height="14px" fill="var(--main-text-color)" viewBox="0 0 256 256">
                <path d="M227.9978,39.95557q-.00219-.56984-.05749-1.13819c-.018-.18408-.05237-.36279-.07849-.54443-.02979-.20557-.05371-.41211-.09424-.61621-.04029-.20362-.09607-.40088-.14649-.60059-.04541-.18017-.08484-.36084-.13867-.53906-.05884-.19434-.13159-.38135-.19971-.57129-.06445-.17969-.12353-.36084-.19677-.5376-.07349-.17724-.15967-.34668-.24109-.51953-.08582-.18213-.16687-.36621-.26257-.54492-.088-.16455-.18824-.32031-.2837-.48047-.10534-.17627-.2052-.355-.32031-.52685-.11572-.17334-.24475-.33545-.369-.502-.11-.14746-.21252-.29834-.3302-.4414-.23462-.28614-.4834-.55957-.74316-.82227-.01782-.01807-.03247-.03809-.05054-.05615-.01953-.01953-.041-.03565-.06067-.05469-.26123-.25781-.53271-.50537-.81653-.73828-.14794-.12158-.30383-.22754-.45605-.34082-.16138-.12061-.31885-.24561-.48645-.35791-.17725-.11865-.36108-.22168-.54309-.33008-.15442-.0918-.30518-.189-.46411-.27392-.18311-.09815-.37134-.18116-.55811-.269-.16846-.07959-.334-.16357-.50659-.23486-.18042-.0752-.36475-.13525-.54785-.20068-.18652-.0669-.37073-.13868-.56152-.19629-.18189-.05518-.3667-.09571-.55066-.14161-.19568-.04931-.389-.10449-.58851-.144-.20935-.041-.42077-.06592-.63171-.09619-.17688-.02539-.351-.05908-.53027-.07666q-.56837-.05567-1.13953-.05762c-.01465,0-.02893-.002-.0437-.002H168a12,12,0,0,0,0,24h19.02905l-32.7334,32.7334a83.9988,83.9988,0,1,0,16.971,16.97021L204,68.9707V88a12,12,0,0,0,24,0V40C228,39.98486,227.9978,39.97021,227.9978,39.95557ZM146.42627,194.42676a59.97169,59.97169,0,1,1,0-84.85352A60.06666,60.06666,0,0,1,146.42627,194.42676Z"></path>
              </svg>
            </p>
            <p class="w-100 m-0 ml-3 p-0 text-left">Пол: Мужской</p>';
      break;

    case 'female':
      echo '<p class="m-0 p-0">
              <svg class="m-0 p-0" width="14px" height="14px" fill="var(--main-text-color)" viewBox="0 0 256 256">
                <path d="M212,96a84,84,0,1,0-96,83.12891V196H88a12,12,0,0,0,0,24h28v20a12,12,0,0,0,24,0V220h28a12,12,0,0,0,0-24H140V179.12891A84.119,84.119,0,0,0,212,96ZM68,96a60,60,0,1,1,60,60A60.06812,60.06812,0,0,1,68,96Z"></path>
              </svg>
            </p>
            <p class="w-100 m-0 ml-3 p-0 text-left">Пол: Женский</p>';
      break;

    default:
      echo '<p class="m-0 p-0">
              <svg class="m-0 p-0" width="14px" height="14px" fill="var(--main-text-color)" viewBox="0 0 256 256">
                <path d="M212,104a84,84,0,1,0-96,83.12891V232a12,12,0,0,0,24,0V187.12891A84.119,84.119,0,0,0,212,104Zm-84,60a60,60,0,1,1,60-60A60.06812,60.06812,0,0,1,128,164Z"></path>
              </svg>
            </p>
            <p class="w-100 m-0 ml-3 p-0 text-left">Пол: Не указан</p>';
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
        echo '<p class="m-0 p-0">
                <svg class="m-0 p-0" width="14px" height="14px" viewBox="0 0 24 24" fill="none">
                  <path d="M11.0748 3.25583C11.4141 2.42845 12.5859 2.42845 12.9252 3.25583L14.6493 7.45955C14.793 7.80979 15.1221 8.04889 15.4995 8.07727L20.0303 8.41798C20.922 8.48504 21.2841 9.59942 20.6021 10.1778L17.1369 13.1166C16.8482 13.3614 16.7225 13.7483 16.8122 14.1161L17.8882 18.5304C18.1 19.3992 17.152 20.0879 16.3912 19.618L12.5255 17.2305C12.2034 17.0316 11.7966 17.0316 11.4745 17.2305L7.60881 19.618C6.84796 20.0879 5.90001 19.3992 6.1118 18.5304L7.18785 14.1161C7.2775 13.7483 7.1518 13.3614 6.86309 13.1166L3.3979 10.1778C2.71588 9.59942 3.07796 8.48504 3.96971 8.41798L8.50046 8.07727C8.87794 8.04889 9.20704 7.80979 9.35068 7.45955L11.0748 3.25583Z" stroke="var(--main-text-color)" stroke-width="2"></path>
                </svg>
                <p class="w-100 m-0 ml-3 p-0 text-left">Интересы:'.$age_preference_text.' (
                  <svg class="m-0 p-0" width="14px" height="14px" fill="var(--main-text-color)" viewBox="0 0 256 256">
                    <path d="M227.9978,39.95557q-.00219-.56984-.05749-1.13819c-.018-.18408-.05237-.36279-.07849-.54443-.02979-.20557-.05371-.41211-.09424-.61621-.04029-.20362-.09607-.40088-.14649-.60059-.04541-.18017-.08484-.36084-.13867-.53906-.05884-.19434-.13159-.38135-.19971-.57129-.06445-.17969-.12353-.36084-.19677-.5376-.07349-.17724-.15967-.34668-.24109-.51953-.08582-.18213-.16687-.36621-.26257-.54492-.088-.16455-.18824-.32031-.2837-.48047-.10534-.17627-.2052-.355-.32031-.52685-.11572-.17334-.24475-.33545-.369-.502-.11-.14746-.21252-.29834-.3302-.4414-.23462-.28614-.4834-.55957-.74316-.82227-.01782-.01807-.03247-.03809-.05054-.05615-.01953-.01953-.041-.03565-.06067-.05469-.26123-.25781-.53271-.50537-.81653-.73828-.14794-.12158-.30383-.22754-.45605-.34082-.16138-.12061-.31885-.24561-.48645-.35791-.17725-.11865-.36108-.22168-.54309-.33008-.15442-.0918-.30518-.189-.46411-.27392-.18311-.09815-.37134-.18116-.55811-.269-.16846-.07959-.334-.16357-.50659-.23486-.18042-.0752-.36475-.13525-.54785-.20068-.18652-.0669-.37073-.13868-.56152-.19629-.18189-.05518-.3667-.09571-.55066-.14161-.19568-.04931-.389-.10449-.58851-.144-.20935-.041-.42077-.06592-.63171-.09619-.17688-.02539-.351-.05908-.53027-.07666q-.56837-.05567-1.13953-.05762c-.01465,0-.02893-.002-.0437-.002H168a12,12,0,0,0,0,24h19.02905l-32.7334,32.7334a83.9988,83.9988,0,1,0,16.971,16.97021L204,68.9707V88a12,12,0,0,0,24,0V40C228,39.98486,227.9978,39.97021,227.9978,39.95557ZM146.42627,194.42676a59.97169,59.97169,0,1,1,0-84.85352A60.06666,60.06666,0,0,1,146.42627,194.42676Z"></path>
                  </svg>
                )</p>
              </p>';
        break;

      case 'female':
        echo '<p class="m-0 p-0">
                <svg class="m-0 p-0" width="14px" height="14px" viewBox="0 0 24 24" fill="none">
                  <path d="M11.0748 3.25583C11.4141 2.42845 12.5859 2.42845 12.9252 3.25583L14.6493 7.45955C14.793 7.80979 15.1221 8.04889 15.4995 8.07727L20.0303 8.41798C20.922 8.48504 21.2841 9.59942 20.6021 10.1778L17.1369 13.1166C16.8482 13.3614 16.7225 13.7483 16.8122 14.1161L17.8882 18.5304C18.1 19.3992 17.152 20.0879 16.3912 19.618L12.5255 17.2305C12.2034 17.0316 11.7966 17.0316 11.4745 17.2305L7.60881 19.618C6.84796 20.0879 5.90001 19.3992 6.1118 18.5304L7.18785 14.1161C7.2775 13.7483 7.1518 13.3614 6.86309 13.1166L3.3979 10.1778C2.71588 9.59942 3.07796 8.48504 3.96971 8.41798L8.50046 8.07727C8.87794 8.04889 9.20704 7.80979 9.35068 7.45955L11.0748 3.25583Z" stroke="var(--main-text-color)" stroke-width="2"></path>
                </svg>
              </p>
              <p class="w-100 m-0 ml-3 p-0 text-left">Интересы:'.$age_preference_text.' (
                <svg class="m-0 p-0" width="14px" height="14px" fill="var(--main-text-color)" viewBox="0 0 256 256">
                  <path d="M212,96a84,84,0,1,0-96,83.12891V196H88a12,12,0,0,0,0,24h28v20a12,12,0,0,0,24,0V220h28a12,12,0,0,0,0-24H140V179.12891A84.119,84.119,0,0,0,212,96ZM68,96a60,60,0,1,1,60,60A60.06812,60.06812,0,0,1,68,96Z"></path>
                </svg>
              )</p>';
        break;

      default:
        echo '<p class="m-0 p-0">
                <svg class="m-0 p-0" width="14px" height="14px" viewBox="0 0 24 24" fill="none">
                  <path d="M11.0748 3.25583C11.4141 2.42845 12.5859 2.42845 12.9252 3.25583L14.6493 7.45955C14.793 7.80979 15.1221 8.04889 15.4995 8.07727L20.0303 8.41798C20.922 8.48504 21.2841 9.59942 20.6021 10.1778L17.1369 13.1166C16.8482 13.3614 16.7225 13.7483 16.8122 14.1161L17.8882 18.5304C18.1 19.3992 17.152 20.0879 16.3912 19.618L12.5255 17.2305C12.2034 17.0316 11.7966 17.0316 11.4745 17.2305L7.60881 19.618C6.84796 20.0879 5.90001 19.3992 6.1118 18.5304L7.18785 14.1161C7.2775 13.7483 7.1518 13.3614 6.86309 13.1166L3.3979 10.1778C2.71588 9.59942 3.07796 8.48504 3.96971 8.41798L8.50046 8.07727C8.87794 8.04889 9.20704 7.80979 9.35068 7.45955L11.0748 3.25583Z" stroke="var(--main-text-color)" stroke-width="2"></path>
                </svg>
              </p>
              <p class="w-100 m-0 ml-3 p-0 text-left">Интересы: Отсутствуют</p>';
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
      echo '<a href="search?q='.$tags_array[$tags_num].'"><li class="font-weight-bold">'.$tags_array[$tags_num].'</li></a>';
    
    echo '</ul>';
  }else
    echo '<p class="fz-13 m-0 p-0 text-center w-100">Список тегов пуст</p>';
?>
  </div>
</div>