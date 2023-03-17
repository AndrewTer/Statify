<div class="row m-0 p-0 col-12 col-sm-8 col-md-8 col-lg-9 col-xl-9 person-info order-1 order-sm-2 order-md-2 order-lg-2 order-xl-2" id="block-with-statistics-by-user">

  <div id="block-rating-left" class="mb-3 p-0 order-2 order-sm-1 order-md-1 order-lg-1 order-xl-1">
    <div class="block-user-content">
      
      <h5 class="position-relative fz-14 text-center">Оценки пользователей
<?
      if ($premium_status)
      {
?>
        <svg class="position-absolute svg-more-rating-statistics-icon" width="17px" height="17px" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="#000000" onclick="event.preventDefault();openRatingStatisticsForPremiumModal(<?= '\''.$user_uuid.'\''; ?>);">
          <defs>  
            <linearGradient id="premium-icon-more-rating-statistics" x1="50%" y1="0%" x2="50%" y2="100%" > 
              <stop offset="0%" stop-color="#7A5FFF">
                <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
              </stop>
              <stop offset="100%" stop-color="#01FF89">
                <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
              </stop>
            </linearGradient> 
          </defs>
          <path d="M 10 0 A 10 10 0 0 0 0 10 A 10 10 0 0 0 10 20 A 10 10 0 0 0 20 10 A 10 10 0 0 0 10 0 z M 10 1 A 9 9 0 0 1 13.755859 1.8320312 L 12.351562 4.4882812 A 6 6 0 0 0 10 4 A 6 6 0 0 0 4 10 A 6 6 0 0 0 4.1308594 11.234375 L 1.2578125 12.095703 A 9 9 0 0 1 1 10 A 9 9 0 0 1 10 1 z M 14.640625 2.3007812 A 9 9 0 0 1 17.271484 4.7148438 L 14.748047 6.3417969 A 6 6 0 0 0 13.238281 4.9492188 L 14.640625 2.3007812 z M 10 5 A 5 5 0 0 1 15 10 A 5 5 0 0 1 10 15 A 5 5 0 0 1 5 10 A 5 5 0 0 1 10 5 z M 17.8125 5.5546875 A 9 9 0 0 1 19 10 A 9 9 0 0 1 18.939453 11.005859 L 15.974609 10.503906 A 6 6 0 0 0 16 10 A 6 6 0 0 0 15.292969 7.1796875 L 17.8125 5.5546875 z M 15.806641 11.490234 L 18.767578 11.992188 A 9 9 0 0 1 13.015625 18.470703 L 12.167969 15.587891 A 6 6 0 0 0 15.806641 11.490234 z M 4.421875 12.191406 A 6 6 0 0 0 10 16 A 6 6 0 0 0 11.208984 15.876953 L 12.056641 18.75 A 9 9 0 0 1 10 19 A 9 9 0 0 1 1.5429688 13.054688 L 4.421875 12.191406 z " fill="url('#premium-icon-more-rating-statistics')"></path>
        </svg>
<?
      }
?>
      </h5>
    
      <hr class="hr-user-info">
<?
        if ($page_status)
        {
          $numbers_all = number_of_ratings_from_users($user_uuid, 0);
?>
        <div id="block-rating-content">
<?
          if ($numbers_all > 0)
          {
            $numbers_five = number_of_ratings_from_users($user_uuid, 5);
            $numbers_four = number_of_ratings_from_users($user_uuid, 4);
            $numbers_three = number_of_ratings_from_users($user_uuid, 3);
            $numbers_two = number_of_ratings_from_users($user_uuid, 2);
            $numbers_one = number_of_ratings_from_users($user_uuid, 1);
            $numbers_rows_count = 0;
?>
            <table class="table-number-of-user-ratings m-0 p-0 w-100">
              <tbody class="w-100 p-0">
<?
                if ($numbers_five > 0)
                {
                  $numbers_five_percent = round(number_of_ratings_from_users($user_uuid, 5) / number_of_ratings_from_users($user_uuid, 0) * 100, 2);
?>
                  <tr class="w-100 d-flex flex-row align-items-center">
                    <td class="col-5 text-center">
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                    </td>

                    <td class="col-4">
                      <div class="rating-user-bar-container">
                        <div class="rating-user-bar-mark" style="width: <?= $numbers_five_percent; ?>%;"></div>
                      </div>
                    </td>

                    <td class="col-3 text-center"
                      <?= ($numbers_five > 999) ? 'data-toggle="tooltip" data-placement="right" title="'.number_format($numbers_five, 0, ',', '.').'"' : ''; ?>
                    >
                      <?= rounding_number_by_places($numbers_five); ?>
                    </td>
                  </tr>
<?
                }else
                  $numbers_rows_count++;

                if ($numbers_four > 0)
                {
                  $numbers_four_percent = round(number_of_ratings_from_users($user_uuid, 4) / number_of_ratings_from_users($user_uuid, 0) * 100, 2);
?>
                  <tr class="w-100 d-flex flex-row align-items-center">
                    <td class="col-5 text-center">
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o inactive-star" aria-hidden="true"></i>
                    </td>

                    <td class="col-4">
                      <div class="rating-user-bar-container">
                        <div class="rating-user-bar-mark" style="width: <?= $numbers_four_percent; ?>%;"></div>
                      </div>
                    </td>

                    <td class="col-3 text-center"
                      <?= ($numbers_four > 999) ? 'data-toggle="tooltip" data-placement="right" title="'.number_format($numbers_four, 0, ',', '.').'"' : ''; ?>
                    >
                      <?= rounding_number_by_places($numbers_four); ?>  
                    </td>
                  </tr>
<?
                }else
                  $numbers_rows_count++;

                if ($numbers_three > 0)
                {
                  $numbers_three_percent = round(number_of_ratings_from_users($user_uuid, 3) / number_of_ratings_from_users($user_uuid, 0) * 100, 2);
?>
                  <tr class="w-100 d-flex flex-row align-items-center">
                    <td class="col-5 text-center">
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o inactive-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o inactive-star" aria-hidden="true"></i>
                    </td>

                    <td class="col-4">
                      <div class="rating-user-bar-container">
                        <div class="rating-user-bar-mark" style="width: <?= $numbers_three_percent; ?>%;"></div>
                      </div>
                    </td>

                    <td class="col-3 text-center"
                      <?= ($numbers_three > 999) ? 'data-toggle="tooltip" data-placement="right" title="'.number_format($numbers_three, 0, ',', '.').'"' : ''; ?>
                    >
                      <?= rounding_number_by_places($numbers_three); ?> 
                    </td>
                  </tr>
<?
                }else
                  $numbers_rows_count++;

                if ($numbers_two > 0)
                {
                  $numbers_two_percent = round(number_of_ratings_from_users($user_uuid, 2) / number_of_ratings_from_users($user_uuid, 0) * 100, 2);
?>
                  <tr class="w-100 d-flex flex-row align-items-center">
                    <td class="col-5 text-center">
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o inactive-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o inactive-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o inactive-star" aria-hidden="true"></i>
                    </td>

                    <td class="col-4">
                      <div class="rating-user-bar-container">
                        <div class="rating-user-bar-mark" style="width: <?= $numbers_two_percent; ?>%;"></div>
                      </div>
                    </td>

                    <td class="col-3 text-center"
                      <?= ($numbers_two > 999) ? 'data-toggle="tooltip" data-placement="right" title="'.number_format($numbers_two, 0, ',', '.').'"' : ''; ?>
                    >
                      <?= rounding_number_by_places($numbers_two); ?>
                    </td>
                  </tr>
<?
                }else
                  $numbers_rows_count++;

                if ($numbers_one > 0)
                {
                  $numbers_one_percent = round(number_of_ratings_from_users($user_uuid, 1) / number_of_ratings_from_users($user_uuid, 0) * 100, 2);
?>
                  <tr class="w-100 d-flex flex-row align-items-center">
                    <td class="col-5 text-center">
                      <i class="fa fa-star-o active-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o inactive-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o inactive-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o inactive-star" aria-hidden="true"></i>
                      <i class="fa fa-star-o inactive-star" aria-hidden="true"></i>
                    </td>

                    <td class="col-4">
                      <div class="rating-user-bar-container">
                        <div class="rating-user-bar-mark" style="width: <?= $numbers_one_percent; ?>%;"></div>
                      </div>
                    </td>

                    <td class="col-3 text-center"
                      <?= ($numbers_one > 999) ? 'data-toggle="tooltip" data-placement="right" title="'.number_format($numbers_one, 0, ',', '.').'"' : ''; ?>
                    >
                      <?= rounding_number_by_places($numbers_one); ?> 
                    </td>
                  </tr>
<?
                }else
                  $numbers_rows_count++;

                for($i=0; $i < $numbers_rows_count; $i++)
                  echo '<tr class="w-100 d-flex flex-row align-items-center">
                          <td class="col-5 text-center">
                            <i class="fa fa-star-o tr-empty-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o tr-empty-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o tr-empty-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o tr-empty-star" aria-hidden="true"></i>
                            <i class="fa fa-star-o tr-empty-star" aria-hidden="true"></i>
                          </td>
                          <td class="col-4 tr-empty-line"><p class="p-0 m-0"></p></td>
                          <td class="col-3 text-center tr-empty-number">0</td>
                        </tr>';
?>

                <tr class="w-100 tr-hr">
                  <td class="col-12" colspan="3">
                    <hr class="hr-user-info">
                  </td>
                </tr>

                <tr class="w-100 d-flex flex-row align-items-center pl-3 pr-3">
                  <td class="col-5 fz-13 fw-700">
                    Всего
                  </td>
                  <td class="col-4"></td>
                  <td class="col-3 text-right"
                    <?= (get_ratings_number_from_user($user_uuid) > 999) ? 'data-toggle="tooltip" data-placement="right" title="'.number_format(get_ratings_number_from_user($user_uuid), 0, ',', '.').'"' : ''; ?>
                  >
                    <?= rounding_number_by_places(get_ratings_number_from_user($user_uuid)); ?>
                  </td>
                </tr>

              </tbody>
            </table>

<?
          }else
            echo '<p class="fz-13 d-flex justify-content-center align-items-center" id="no-users-marks">Оценок пока нет</p>';
?>
        </div>
<?
        }else
          echo '<p class="w-100 text-center f-13 fw-700 m-0">Недоступно</p>';
?>
    </div>

    <div class="block-user-content mt-3" id="block-user-content-history">  
      <h5 class="position-relative fz-14 text-center">История оценок
<?
      if ($premium_status)
      {
?>
        <svg class="position-absolute svg-more-history-icon" width="17px" height="17px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="event.preventDefault();showUserSaveHistory();">
          <defs>  
            <linearGradient id="premium-icon-more-history" x1="50%" y1="0%" x2="50%" y2="100%" > 
              <stop offset="0%" stop-color="#7A5FFF">
                <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
              </stop>
              <stop offset="100%" stop-color="#01FF89">
                <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
              </stop>
            </linearGradient> 
          </defs>
          <path d="M3.33789 7C5.06694 4.01099 8.29866 2 12.0001 2C17.5229 2 22.0001 6.47715 22.0001 12C22.0001 17.5228 17.5229 22 12.0001 22C8.29866 22 5.06694 19.989 3.33789 17M12 16L16 12M16 12L12 8M16 12H2" stroke="url('#premium-icon-more-history')" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> 
        </svg>
<?
      }
?>
      </h5>
    
      <hr class="hr-user-info">

<?
        if ($page_status)
        {
?>
          <ul class="nav nav-tabs row m-0 p-0" id="rating-history">
            <li class="nav-item col-4 m-0 p-0">
              <a class="nav-link fz-13 p-0 text-center active" data-toggle="tab" href="#rating-history-today">Сегодня</a>
            </li>
            <li class="nav-item col-4 m-0 p-0">
              <a class="nav-link fz-13 p-0 text-center" data-toggle="tab" href="#rating-history-week">Неделя</a>
            </li>
            <li class="nav-item col-4 m-0 p-0">
              <a class="nav-link fz-13 p-0 text-center" data-toggle="tab" href="#rating-history-month">Месяц</a>
            </li>
          </ul>

          <div class="tab-content p-1">
            <div class="tab-pane fade show active" id="rating-history-today">
              <table class="table table-borderless table-user-statistics w-100 m-0">
              <tbody>
                <tr>
                  <td class="fz-12 pl-1">Поставлено оценок</td>
                  <th class="fz-12 pr-1" scope="row"><?= count_set_ratings($user_uuid, 'day'); ?></th>
                </tr>
                <tr>
                  <td class="fz-12 pl-1">Получено оценок</td>
                  <th class="fz-12 pr-1" scope="row"><?= count_get_ratings($user_uuid, 'day'); ?></th>
                </tr>
              </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="rating-history-week">
              <table class="table table-borderless table-user-statistics w-100 m-0">
              <tbody>
                <tr>
                  <td class="fz-12 pl-1">Поставлено оценок</td>
                  <th class="fz-12 pr-1" scope="row"><?= count_set_ratings($user_uuid, 'week'); ?></th>
                </tr>
                <tr>
                  <td class="fz-12 pl-1">Получено оценок</td>
                  <th class="fz-12 pr-1" scope="row"><?= count_get_ratings($user_uuid, 'week'); ?></th>
                </tr>
              </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="rating-history-month">
              <table class="table table-borderless table-user-statistics w-100 m-0">
              <tbody>
                <tr>
                  <td class="fz-12 pl-1">Поставлено оценок</td>
                  <th class="fz-12 pr-1" scope="row"><?= count_set_ratings($user_uuid, 'month'); ?></th>
                </tr>
                <tr>
                  <td class="fz-12 pl-1">Получено оценок</td>
                  <th class="fz-12 pr-1" scope="row"><?= count_get_ratings($user_uuid, 'month'); ?></th>
                </tr>
              </tbody>
              </table>
            </div>
          </div>
<?
        }else
          echo '<p class="w-100 text-center f-13 fw-700 m-0">Недоступно</p>';
?>
    </div>

  </div>

  <div id="block-rating-right" class="mb-3 p-0 order-1 order-sm-2 order-md-2 order-lg-2 order-xl-2">
    <div class="block-user-content d-flex justify-content-center row m-0">
<?
        if ($page_status)
          echo '<div class="chart radar-chart w-100 p-1 pt-4">
                  <canvas class="m-0 p-0" height="200" id="radarChartDark"></canvas>
                </div>';
        else
          echo '<p class="w-100 text-center f-13 fw-700 m-0">Диаграмма недоступна</p>';
?>
      <div class="col-12 p-0 mt-2">
<?
      if ($page_status)
      {
?>
        <table class="table table-borderless table-user-statistics w-100 m-0">
          <tbody>
            <tr>
              <td class="fz-12">Среди пользователей</td>
              <th class="fz-12" scope="row"><?= $user_among_all.'&nbsp;из&nbsp;'.$all_users; ?></th>
            </tr>
<? 
            switch ($user_gender) {
              case 'male':
                echo '<tr>
                        <td class="fz-12">Среди мужской аудитории</td>
                        <th class="fz-12" scope="row">'.$user_among_gender.'&nbsp;из&nbsp;'.$all_gender_users.'</th>
                      </tr>';
                break;

              case 'female':
                echo '<tr>
                        <td class="fz-12">Среди женской аудитории</td>
                        <th class="fz-12" scope="row">'.$user_among_gender.'&nbsp;из&nbsp;'.$all_gender_users.'</th>
                      </tr>';
                break;

              default:
                echo '';
                break;
            }
?>
            <tr>
              <td class="fz-12">Среди друзей</td>
              <th class="fz-12" scope="row"><?= $user_among_friends.'&nbsp;из&nbsp;'.$all_friends_users; ?></th>
            </tr>
            <tr>
              <td class="fz-12">По городу</td>
              <th class="fz-12" scope="row"><?= $user_among_city.'&nbsp;из&nbsp;'.$all_city_users; ?></th>  
            </tr>
            <tr>
              <td class="fz-12">По стране</td>
              <th class="fz-12" scope="row"><?= $user_among_country.'&nbsp;из&nbsp;'.$all_country_users; ?></th>
            </tr>
          </tbody>
        </table>
<?
      }else
        echo '<p class="w-100 text-center f-13 fw-700 m-0">Статистика недоступна</p>';
?>
      </div>
    </div>
  </div>

</div>

<script type="text/javascript">
  var user_gender = '<?= $user_gender; ?>',
      all_users = <?= $all_users; ?>,
      all_gender = <?= $all_gender_users; ?>,
      all_friends = <?= $all_friends_users; ?>,
      all_city = <?= $all_city_users; ?>,
      all_country = <?= $all_country_users; ?>,
      among_all = <?= $user_among_all; ?>,
      among_gender = <?= $user_among_gender; ?>,
      among_friends = <?= $user_among_friends; ?>,
      among_city = <?= $user_among_city; ?>,
      among_country = <?= $user_among_country; ?>;
</script>
<script type="text/javascript" src="js/charts.js"></script>