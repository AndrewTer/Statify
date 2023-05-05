<div class="block-user-content mt-3" id="block-user-content-history">  
  <h5 class="position-relative fz-15 text-center font-weight-bold">История оценок
<?
  if ($premium_status)
    echo '
      <svg class="position-absolute svg-more-history-icon" width="17px" height="17px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="event.preventDefault();showUserSaveHistory();">
        <defs>  
          <linearGradient id="premium-icon-more-history" x1="50%" y1="0%" x2="50%" y2="100%" > 
            <stop offset="0%" stop-color="#7A5FFF"><animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate></stop>
            <stop offset="100%" stop-color="#01FF89"><animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate></stop>
          </linearGradient> 
        </defs>
        <path d="M3.33789 7C5.06694 4.01099 8.29866 2 12.0001 2C17.5229 2 22.0001 6.47715 22.0001 12C22.0001 17.5228 17.5229 22 12.0001 22C8.29866 22 5.06694 19.989 3.33789 17M12 16L16 12M16 12L12 8M16 12H2" stroke="url(\'#premium-icon-more-history\')" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> 
      </svg>';
?>
  </h5>
    
  <hr class="hr-user-info">

<?
  if ($page_status)
    echo '<ul class="nav nav-tabs row m-0 p-0" id="rating-history">
            <li class="nav-item col-4 m-0 p-0">
              <a class="nav-link fz-13 p-0 text-center font-weight-bold active" data-toggle="tab" href="#rating-history-today">Сегодня</a>
            </li>
            <li class="nav-item col-4 m-0 p-0">
              <a class="nav-link fz-13 p-0 text-center font-weight-bold" data-toggle="tab" href="#rating-history-week">Неделя</a>
            </li>
            <li class="nav-item col-4 m-0 p-0">
              <a class="nav-link fz-13 p-0 text-center font-weight-bold" data-toggle="tab" href="#rating-history-month">Месяц</a>
            </li>
          </ul>

          <div class="tab-content p-1">
            <div class="tab-pane fade show active" id="rating-history-today">
              <table class="table table-borderless table-user-statistics w-100 m-0">
              <tbody>
                <tr>
                  <td class="fz-12 pl-1 font-weight-bold">Поставлено оценок</td>
                  <th class="fz-12 pr-1" scope="row">'.count_set_ratings($user_uuid, 'day').'</th>
                </tr>
                <tr>
                  <td class="fz-12 pl-1 font-weight-bold">Получено оценок</td>
                  <th class="fz-12 pr-1" scope="row">'.count_get_ratings($user_uuid, 'day').'</th>
                </tr>
              </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="rating-history-week">
              <table class="table table-borderless table-user-statistics w-100 m-0">
              <tbody>
                <tr>
                  <td class="fz-12 pl-1 font-weight-bold">Поставлено оценок</td>
                  <th class="fz-12 pr-1" scope="row">'.count_set_ratings($user_uuid, 'week').'</th>
                </tr>
                <tr>
                  <td class="fz-12 pl-1 font-weight-bold">Получено оценок</td>
                  <th class="fz-12 pr-1" scope="row">'.count_get_ratings($user_uuid, 'week').'</th>
                </tr>
              </tbody>
              </table>
            </div>

            <div class="tab-pane fade" id="rating-history-month">
              <table class="table table-borderless table-user-statistics w-100 m-0">
              <tbody>
                <tr>
                  <td class="fz-12 pl-1 font-weight-bold">Поставлено оценок</td>
                  <th class="fz-12 pr-1" scope="row">'.count_set_ratings($user_uuid, 'month').'</th>
                </tr>
                <tr>
                  <td class="fz-12 pl-1 font-weight-bold">Получено оценок</td>
                  <th class="fz-12 pr-1" scope="row">'.count_get_ratings($user_uuid, 'month').'</th>
                </tr>
              </tbody>
              </table>
            </div>
          </div>';
  else
    echo '<p class="w-100 text-center f-13 font-weight-bold m-0">Недоступно</p>';
?>
</div>