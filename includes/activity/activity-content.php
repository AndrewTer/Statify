<div class="w-100 m-0 col-md-8 p-0 h-100 order-2 order-sm-2 order-md-1 order-lg-1 order-xl-1" id="block-activity">
<?
  $sort = !empty($_GET['sort']) ? htmlspecialchars($_GET['sort']) : 'friends';

  switch ($sort) {
    case 'mine':
      include("includes/activity/user-activity-list.php");
      break;
    case 'friends':
      include("includes/activity/friends-activity-list.php");
      break; 
    default:
      include("includes/activity/friends-activity-list.php");
      break;
  }
?>

  <div class="w-100 d-flex justify-content-center">
<?
  $page1left = $page2left = $page1right = $page2right = $pervpage = $nextpage = '';
  if ($page != 1) 
    $pervpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="activity?sort='.$sort.'&page=1" aria-label="Переход на первую страницу с активностью">'
                  .'<p class="m-0 p-0 d-flex align-items-center justify-content-center">
                      <svg width="20px" height="20px" viewBox="0 0 48 48" fill="var(--main-text-color)">
                        <path d="M15.8,24,26.4,34.6a1.9,1.9,0,0,1-.2,3,2.1,2.1,0,0,1-2.7-.2l-11.9-12a1.9,1.9,0,0,1,0-2.8l11.9-12a2.1,2.1,0,0,1,2.7-.2,1.9,1.9,0,0,1,.2,3Z"></path>
                        <path d="M27.8,24,38.4,34.6a1.9,1.9,0,0,1-.2,3,2.1,2.1,0,0,1-2.7-.2l-11.9-12a1.9,1.9,0,0,1,0-2.8l11.9-12a2.1,2.1,0,0,1,2.7-.2,1.9,1.9,0,0,1,.2,3Z"></path>
                      </svg>
                    </p>'
                .'</a>'
                .'<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="activity?sort='.$sort.'&page='.($page - 1).'" aria-label="Переход на предыдущую страницу с активностью">'
                  .'<p class="m-0 p-0">
                      <svg width="20px" height="20px" viewBox="0 0 48 48" fill="var(--main-text-color)">
                        <path d="M20.8,24,31.4,13.4a1.9,1.9,0,0,0-.2-3,2.1,2.1,0,0,0-2.7.2l-11.9,12a1.9,1.9,0,0,0,0,2.8l11.9,12a2.1,2.1,0,0,0,2.7.2,1.9,1.9,0,0,0,.2-3Z"></path>
                      </svg>
                    </p>'
                .'</a>';

  if ($page != $total_count_activity_pages) 
    $nextpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="activity?sort='.$sort.'&page='.($page + 1).'" aria-label="Переход на следующую страницу с активностью">'
                  .'<p class="m-0 p-0">
                      <svg width="20px" height="20px" viewBox="0 0 48 48" fill="var(--main-text-color)">
                        <path d="M27.2,24,16.6,34.6a1.9,1.9,0,0,0,.2,3,2.1,2.1,0,0,0,2.7-.2l11.9-12a1.9,1.9,0,0,0,0-2.8l-11.9-12a2.1,2.1,0,0,0-2.7-.2,1.9,1.9,0,0,0-.2,3Z"></path>
                      </svg>
                    </p>'
                .'</a>'
                .'<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="activity?sort='.$sort.'&page='.$total_count_activity_pages.'" aria-label="Переход на последнюю страницу с активностью">'
                  .'<p class="m-0 p-0">
                      <svg width="20px" height="20px" viewBox="0 0 48 48" fill="var(--main-text-color)">
                        <path d="M33.2,24,22.6,34.6a1.9,1.9,0,0,0,.2,3,2.1,2.1,0,0,0,2.7-.2l11.9-12a1.9,1.9,0,0,0,0-2.8l-11.9-12a2.1,2.1,0,0,0-2.7-.2,1.9,1.9,0,0,0-.2,3Z"></path>
                        <path d="M21.2,24,10.6,34.6a1.9,1.9,0,0,0,.2,3,2.1,2.1,0,0,0,2.7-.2l11.9-12a1.9,1.9,0,0,0,0-2.8l-11.9-12a2.1,2.1,0,0,0-2.7-.2,1.9,1.9,0,0,0-.2,3Z"></path>
                      </svg>
                    </p>'
                .'</a>';

  if($page - 2 > 0) $page2left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="activity?sort='.$sort.'&page='.($page - 2).'" aria-label="Переход на две страницы назад">'.($page - 2).'</a>';
  if($page - 1 > 0) $page1left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="activity?sort='.$sort.'&page='.($page - 1).'" aria-label="Переход на предыдущую страницу с активностью">'.($page - 1).'</a>';
  if($page + 2 <= $total_count_activity_pages) $page2right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="activity?sort='.$sort.'&page='. ($page + 2) .'" aria-label="Переход на две страницы вперёд">'.($page + 2).'</a>';
  if($page + 1 <= $total_count_activity_pages) $page1right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="activity?sort='.$sort.'&page='. ($page + 1) .'" aria-label="Переход на следующую страницу с активностью">'.($page + 1).'</a>';

  if ($total_count_activity_pages > 1)
    echo $pervpage.$page2left.$page1left.'<p class="fz-13 m-2 pt-1 pb-1 current-page-num d-flex justify-content-center align-items-center font-weight-bold">'.$page.'</p>'.$page1right.$page2right.$nextpage;
?>
  </div>
</div>

<div class="col-md-4 section-search-and-sort mb-3 h-100 order-1 order-sm-1 order-md-2 order-lg-2 order-xl-2">
<?
  include("includes/activity/activity-menu.php");
?>
</div>