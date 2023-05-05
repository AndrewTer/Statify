<div class="block-user-content d-flex justify-content-center row m-0">
<?
  if ($page_status)
    echo '<div class="chart radar-chart w-100 p-1 pt-4"><canvas class="m-0 p-0" height="200" id="radarChartDark"></canvas></div>';
  else
    echo '<p class="w-100 text-center f-13 font-weight-bold m-0">Диаграмма недоступна</p>';
?>
  <div class="col-12 p-0 mt-2">
<?
    if ($page_status)
    {
?>
    <table class="table table-borderless table-user-statistics w-100 m-0">
      <tbody>
        <tr><td class="fz-12 font-weight-bold">Среди пользователей</td><th class="fz-12" scope="row"><?= $user_among_all.'&nbsp;из&nbsp;'.$all_users; ?></th></tr>
<? 
        switch ($user_gender) {
          case 'male':
            echo '<tr><td class="fz-12 font-weight-bold">Среди мужской аудитории</td><th class="fz-12" scope="row">'.$user_among_gender.'&nbsp;из&nbsp;'.$all_gender_users.'</th></tr>';
            break;

          case 'female':
            echo '<tr><td class="fz-12 font-weight-bold">Среди женской аудитории</td><th class="fz-12" scope="row">'.$user_among_gender.'&nbsp;из&nbsp;'.$all_gender_users.'</th></tr>';
            break;

          default:
            echo '';
            break;
        }
?>
        <tr><td class="fz-12 font-weight-bold">Среди друзей</td><th class="fz-12" scope="row"><?= $user_among_friends.'&nbsp;из&nbsp;'.$all_friends_users; ?></th></tr>
        <tr><td class="fz-12 font-weight-bold">По городу</td><th class="fz-12" scope="row"><?= $user_among_city.'&nbsp;из&nbsp;'.$all_city_users; ?></th>  </tr>
        <tr><td class="fz-12 font-weight-bold">По стране</td><th class="fz-12" scope="row"><?= $user_among_country.'&nbsp;из&nbsp;'.$all_country_users; ?></th></tr>
      </tbody>
    </table>
<?
    }else
      echo '<p class="w-100 text-center f-13 font-weight-bold m-0">Статистика недоступна</p>';
?>
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