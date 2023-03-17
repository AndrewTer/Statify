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
    $svg_more_history_icon = '<svg class="position-absolute svg-more-history-icon" width="17px" height="17px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="event.preventDefault();showUserSaveHistory();">
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
                                <g stroke-width="0"></g>
                                <path d="M3.33789 7C5.06694 4.01099 8.29866 2 12.0001 2C17.5229 2 22.0001 6.47715 22.0001 12C22.0001 17.5228 17.5229 22 12.0001 22C8.29866 22 5.06694 19.989 3.33789 17M12 16L16 12M16 12L12 8M16 12H2" stroke="url(\'#premium-icon-more-history\')" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> 
                              </svg>';
  else
    $svg_more_history_icon = '';

  if ($page_status)
    echo '<h5 class="position-relative fz-14 text-center">История оценок '.$svg_more_history_icon.'</h5>
    
          <hr class="hr-user-info">

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
                  <th class="fz-12 pr-1" scope="row">'.count_set_ratings($user_uuid, 'day').'</th>
                </tr>
                <tr>
                  <td class="fz-12 pl-1">Получено оценок</td>
                  <th class="fz-12 pr-1" scope="row">'.count_get_ratings($user_uuid, 'day').'</th>
                </tr>
              </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="rating-history-week">
              <table class="table table-borderless table-user-statistics w-100 m-0">
              <tbody>
                <tr>
                  <td class="fz-12 pl-1">Поставлено оценок</td>
                  <th class="fz-12 pr-1" scope="row">'.count_set_ratings($user_uuid, 'week').'</th>
                </tr>
                <tr>
                  <td class="fz-12 pl-1">Получено оценок</td>
                  <th class="fz-12 pr-1" scope="row">'.count_get_ratings($user_uuid, 'week').'</th>
                </tr>
              </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="rating-history-month">
              <table class="table table-borderless table-user-statistics w-100 m-0">
              <tbody>
                <tr>
                  <td class="fz-12 pl-1">Поставлено оценок</td>
                  <th class="fz-12 pr-1" scope="row">'.count_set_ratings($user_uuid, 'month').'</th>
                </tr>
                <tr>
                  <td class="fz-12 pl-1">Получено оценок</td>
                  <th class="fz-12 pr-1" scope="row">'.count_get_ratings($user_uuid, 'month').'</th>
                </tr>
              </tbody>
              </table>
            </div>
          </div>';
  else
    echo '<p class="w-100 text-center f-13 fw-700 m-0">Недоступно</p>';

	return;
}
?>