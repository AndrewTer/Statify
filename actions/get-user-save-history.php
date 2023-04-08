<?php
defined('mystatify');

include("../functions/functions-for-check.php");
include("../functions/functions-user-data.php");

if (isset($_POST['user_uuid']) && strlen($_POST['user_uuid']) > 0 && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user_uuid'])))
{
	require_once(realpath('../includes/connection.php'));
	
	$user_uuid = trim($_POST['user_uuid']);
	$premium_status = check_premium_active($user_uuid);
  $page_status = check_user_page_status($user_uuid);

  if ($premium_status)
    if ($page_status)
    	echo '<h5 class="position-relative fz-14 text-center font-weight-bold">
              <svg class="position-absolute svg-hide-history-icon" width="17px" height="17px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="event.preventDefault();hideUserSaveHistory();">
                <defs>  
                  <linearGradient id="premium-icon-hide-history" x1="50%" y1="0%" x2="50%" y2="100%" > 
                    <stop offset="0%" stop-color="#7A5FFF">
                      <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
                    </stop>
                    <stop offset="100%" stop-color="#01FF89">
                      <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
                    </stop>
                  </linearGradient> 
                </defs>
                <path d="M20.6622 17C18.9331 19.989 15.7014 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C15.7014 2 18.9331 4.01099 20.6622 7M12.0001 8L8.00007 12M8.00007 12L12.0001 16M8.00007 12H22.0001" stroke="url(\'#premium-icon-hide-history\')" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
              История сохранений
            </h5>
          	<hr class="hr-user-info">
          	<ul class="nav nav-tabs row m-0 p-0" id="saves-history">
              <li class="nav-item col-4 m-0 p-0">
                <a class="nav-link fz-13 p-0 text-center font-weight-bold active" data-toggle="tab" href="#saves-history-today">Сегодня</a>
              </li>
              <li class="nav-item col-4 m-0 p-0">
                <a class="nav-link fz-13 p-0 text-center font-weight-bold" data-toggle="tab" href="#saves-history-week">Неделя</a>
              </li>
              <li class="nav-item col-4 m-0 p-0">
                <a class="nav-link fz-13 p-0 text-center font-weight-bold" data-toggle="tab" href="#saves-history-month">Месяц</a>
              </li>
            </ul>

            <div class="tab-content p-1">
              <div class="tab-pane fade show active" id="saves-history-today">
                <table class="table table-borderless table-user-statistics w-100 m-0">
                  <tbody>
                    <tr>
                      <td class="fz-12 pl-1 text-left font-weight-bold">Мои сохранения</td>
                      <th class="fz-12 pr-1" scope="row">'.count_saves_by_user($user_uuid, 'day').'</th>
                    </tr>
                    <tr>
                    	<td colspan="2"><hr class="hr-user-info m-0"></td>
                    </tr>
                    <tr>
                      <td class="fz-12 pl-1 text-left font-weight-bold">Мужская аудитория</td>
                      <th class="fz-12 pr-1" scope="row">'.count_get_saves_by_genders_and_date($user_uuid, 'male', 'day').'</th>
                    </tr>
                    <tr>
                      <td class="fz-12 pl-1 text-left font-weight-bold">Женская аудитория</td>
                      <th class="fz-12 pr-1" scope="row">'.count_get_saves_by_genders_and_date($user_uuid, 'female', 'day').'</th>
                    </tr>
                    <tr>
                      <td class="fz-12 pl-1 text-left font-weight-bold">Иная аудитория</td>
                      <th class="fz-12 pr-1" scope="row">'.count_get_saves_by_genders_and_date($user_uuid, 'other', 'day').'</th>
                    </tr>
                  </tbody>
                </table>
            	</div>

              <div class="tab-pane fade" id="saves-history-week">
                <table class="table table-borderless table-user-statistics w-100 m-0">
                  <tbody>
                    <tr>
                      <td class="fz-12 pl-1 text-left font-weight-bold">Мои сохранения</td>
                      <th class="fz-12 pr-1" scope="row">'.count_saves_by_user($user_uuid, 'week').'</th>
                    </tr>
                    <tr>
                    	<td colspan="2"><hr class="hr-user-info m-0"></td>
                    </tr>
                    <tr>
                      <td class="fz-12 pl-1 text-left font-weight-bold">Мужская аудитория</td>
                      <th class="fz-12 pr-1" scope="row">'.count_get_saves_by_genders_and_date($user_uuid, 'male', 'week').'</th>
                    </tr>
                    <tr>
                      <td class="fz-12 pl-1 text-left font-weight-bold">Женская аудитория</td>
                      <th class="fz-12 pr-1" scope="row">'.count_get_saves_by_genders_and_date($user_uuid, 'female', 'week').'</th>
                    </tr>
                    <tr>
                      <td class="fz-12 pl-1 text-left font-weight-bold">Иная аудитория</td>
                      <th class="fz-12 pr-1" scope="row">'.count_get_saves_by_genders_and_date($user_uuid, 'other', 'week').'</th>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="tab-pane fade" id="saves-history-month">
                <table class="table table-borderless table-user-statistics w-100 m-0">
                  <tbody>
                    <tr>
                      <td class="fz-12 pl-1 text-left font-weight-bold">Мои сохранения</td>
                      <th class="fz-12 pr-1" scope="row">'.count_saves_by_user($user_uuid, 'month').'</th>
                    </tr>
                    <tr>
                    	<td colspan="2"><hr class="hr-user-info m-0"></td>
                    </tr>
                    <tr>
                      <td class="fz-12 pl-1 text-left font-weight-bold">Мужская аудитория</td>
                      <th class="fz-12 pr-1" scope="row">'.count_get_saves_by_genders_and_date($user_uuid, 'male', 'month').'</th>
                    </tr>
                    <tr>
                      <td class="fz-12 pl-1 text-left font-weight-bold">Женская аудитория</td>
                      <th class="fz-12 pr-1" scope="row">'.count_get_saves_by_genders_and_date($user_uuid, 'female', 'month').'</th>
                    </tr>
                    <tr>
                      <td class="fz-12 pl-1 text-left font-weight-bold">Иная аудитория</td>
                      <th class="fz-12 pr-1" scope="row">'.count_get_saves_by_genders_and_date($user_uuid, 'other', 'month').'</th>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>';
    else
      echo '<p class="w-100 text-center f-13 fw-700 m-0">Недоступно</p>';
  else
    echo 'not-premium';

	return;
}
?>