<div class="block-user-content">
  <h5 class="position-relative fz-15 text-center font-weight-bold">Оценки пользователей
<?
  if ($premium_status)
    echo '
      <svg class="position-absolute svg-more-rating-statistics-icon" width="17px" height="17px" viewBox="0 0 20 20" fill="#000000" onclick="event.preventDefault();openRatingStatisticsForPremiumModal(\''.$user_uuid.'\');">
        <defs>  
          <linearGradient id="premium-icon-more-rating-statistics" x1="50%" y1="0%" x2="50%" y2="100%"> 
            <stop offset="0%" stop-color="#7A5FFF"><animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate></stop>
            <stop offset="100%" stop-color="#01FF89"><animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate></stop>
          </linearGradient> 
        </defs>
        <path d="M 10 0 A 10 10 0 0 0 0 10 A 10 10 0 0 0 10 20 A 10 10 0 0 0 20 10 A 10 10 0 0 0 10 0 z M 10 1 A 9 9 0 0 1 13.755859 1.8320312 L 12.351562 4.4882812 A 6 6 0 0 0 10 4 A 6 6 0 0 0 4 10 A 6 6 0 0 0 4.1308594 11.234375 L 1.2578125 12.095703 A 9 9 0 0 1 1 10 A 9 9 0 0 1 10 1 z M 14.640625 2.3007812 A 9 9 0 0 1 17.271484 4.7148438 L 14.748047 6.3417969 A 6 6 0 0 0 13.238281 4.9492188 L 14.640625 2.3007812 z M 10 5 A 5 5 0 0 1 15 10 A 5 5 0 0 1 10 15 A 5 5 0 0 1 5 10 A 5 5 0 0 1 10 5 z M 17.8125 5.5546875 A 9 9 0 0 1 19 10 A 9 9 0 0 1 18.939453 11.005859 L 15.974609 10.503906 A 6 6 0 0 0 16 10 A 6 6 0 0 0 15.292969 7.1796875 L 17.8125 5.5546875 z M 15.806641 11.490234 L 18.767578 11.992188 A 9 9 0 0 1 13.015625 18.470703 L 12.167969 15.587891 A 6 6 0 0 0 15.806641 11.490234 z M 4.421875 12.191406 A 6 6 0 0 0 10 16 A 6 6 0 0 0 11.208984 15.876953 L 12.056641 18.75 A 9 9 0 0 1 10 19 A 9 9 0 0 1 1.5429688 13.054688 L 4.421875 12.191406 z " fill="url(\'#premium-icon-more-rating-statistics\')"></path>
      </svg>';
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
        echo '<tr class="w-100 d-flex flex-row align-items-center">
                <td class="col-5 d-flex flex-row align-items-center justify-content-center">'.$content_stat_active_star.$content_stat_active_star.$content_stat_active_star.$content_stat_active_star.$content_stat_active_star.'</td>
                <td class="col-4"><div class="rating-user-bar-container"><div class="rating-user-bar-mark" style="width:'.$numbers_five_percent.'%;"></div></div></td>
                <td class="col-3 text-center font-weight-bold"'.(($numbers_five > 999) ? 'data-toggle="tooltip" data-placement="right" title="'.number_format($numbers_five, 0, ',', '.').'"' : '').'>'.rounding_number_by_places($numbers_five).'</td>
              </tr>';
      }else
        $numbers_rows_count++;

      if ($numbers_four > 0)
      {
        $numbers_four_percent = round(number_of_ratings_from_users($user_uuid, 4) / number_of_ratings_from_users($user_uuid, 0) * 100, 2);
        echo '<tr class="w-100 d-flex flex-row align-items-center">
                <td class="col-5 d-flex flex-row align-items-center justify-content-center">'.$content_stat_active_star.$content_stat_active_star.$content_stat_active_star.$content_stat_active_star.$content_stat_inactive_star.'</td>
                <td class="col-4"><div class="rating-user-bar-container"><div class="rating-user-bar-mark" style="width:'.$numbers_four_percent.'%;"></div></div></td>
                <td class="col-3 text-center font-weight-bold"'.(($numbers_four > 999) ? 'data-toggle="tooltip" data-placement="right" title="'.number_format($numbers_four, 0, ',', '.').'"' : '').'>'.rounding_number_by_places($numbers_four).'</td>
              </tr>';
      }else
        $numbers_rows_count++;

      if ($numbers_three > 0)
      {
        $numbers_three_percent = round(number_of_ratings_from_users($user_uuid, 3) / number_of_ratings_from_users($user_uuid, 0) * 100, 2);
        echo '<tr class="w-100 d-flex flex-row align-items-center">
                <td class="col-5 d-flex flex-row align-items-center justify-content-center">'.$content_stat_active_star.$content_stat_active_star.$content_stat_active_star.$content_stat_inactive_star.$content_stat_inactive_star.'</td>
                <td class="col-4"><div class="rating-user-bar-container"><div class="rating-user-bar-mark" style="width:'.$numbers_three_percent.'%;"></div></div></td>
                <td class="col-3 text-center font-weight-bold"'.(($numbers_three > 999) ? 'data-toggle="tooltip" data-placement="right" title="'.number_format($numbers_three, 0, ',', '.').'"' : '').'>'.rounding_number_by_places($numbers_three).'</td>
              </tr>';
      }else
        $numbers_rows_count++;

      if ($numbers_two > 0)
      {
        $numbers_two_percent = round(number_of_ratings_from_users($user_uuid, 2) / number_of_ratings_from_users($user_uuid, 0) * 100, 2);
        echo '<tr class="w-100 d-flex flex-row align-items-center">
                <td class="col-5 d-flex flex-row align-items-center justify-content-center">'.$content_stat_active_star.$content_stat_active_star.$content_stat_inactive_star.$content_stat_inactive_star.$content_stat_inactive_star.'</td>
                <td class="col-4"><div class="rating-user-bar-container"><div class="rating-user-bar-mark" style="width:'.$numbers_two_percent.'%;"></div></div></td>
                <td class="col-3 text-center font-weight-bold"'.(($numbers_two > 999) ? 'data-toggle="tooltip" data-placement="right" title="'.number_format($numbers_two, 0, ',', '.').'"' : '').'>'.rounding_number_by_places($numbers_two).'</td>
              </tr>';
      }else
        $numbers_rows_count++;

      if ($numbers_one > 0)
      {
        $numbers_one_percent = round(number_of_ratings_from_users($user_uuid, 1) / number_of_ratings_from_users($user_uuid, 0) * 100, 2);
        echo '<tr class="w-100 d-flex flex-row align-items-center">
                <td class="col-5 d-flex flex-row align-items-center justify-content-center">'.$content_stat_active_star.$content_stat_inactive_star.$content_stat_inactive_star.$content_stat_inactive_star.$content_stat_inactive_star.'</td>
                <td class="col-4"><div class="rating-user-bar-container"><div class="rating-user-bar-mark" style="width:'.$numbers_one_percent.'%;"></div></div></td>
                <td class="col-3 text-center font-weight-bold"'.(($numbers_one > 999) ? 'data-toggle="tooltip" data-placement="right" title="'.number_format($numbers_one, 0, ',', '.').'"' : '').'>'.rounding_number_by_places($numbers_one).'</td>
              </tr>';
      }else
        $numbers_rows_count++;

      for($i=0; $i < $numbers_rows_count; $i++)
        echo '<tr class="w-100 d-flex flex-row align-items-center">
                <td class="col-5 d-flex flex-row align-items-center justify-content-center">'.$content_stat_inactive_star.$content_stat_inactive_star.$content_stat_inactive_star.$content_stat_inactive_star.$content_stat_inactive_star.'</td>
                <td class="col-4 tr-empty-line"><p class="p-0 m-0"></p></td>
                <td class="col-3 text-center tr-empty-number font-weight-bold">0</td>
              </tr>';
?>

        <tr class="w-100 tr-hr"><td class="col-12" colspan="3"><hr class="hr-user-info"></td></tr>
        <tr class="w-100 d-flex flex-row align-items-center pl-3 pr-3">
          <td class="col-5 fz-13 font-weight-bold">Всего</td>
          <td class="col-4"></td>
          <td class="col-3 text-right font-weight-bold"<?= (get_ratings_number_from_user($user_uuid) > 999) ? 'data-toggle="tooltip" data-placement="right" title="'.number_format(get_ratings_number_from_user($user_uuid), 0, ',', '.').'"' : ''; ?>>
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
    echo '<p class="w-100 text-center f-13 font-weight-bold m-0">Недоступно</p>';
?>
</div>