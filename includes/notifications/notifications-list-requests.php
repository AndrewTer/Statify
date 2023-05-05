<? include("requests/all-requests-notifications-list.php"); ?>

<div class="m-0 p-0" id="notifications-list">
<?
	if ($notifications_data = pg_fetch_array($notifications_query))
	{
		do {
			$sender = $notifications_data[0];
			$datetime = $notifications_data[1];
			$status = $notifications_data[2];
			
			request_notification($user_uuid, $sender, $datetime, $status);
		}while ($notifications_data = pg_fetch_row($notifications_query));
	} else
			echo '<div id="block-user" class="p-0">
		  				<span class="d-flex justify-content-center p-5 w-100"><strong class="h5 text-center">У вас пока нет уведомлений</strong></span>
						</div>';
?>
</div>

<div class="w-100 d-flex justify-content-center">
<?
	$page1left = $page2left = $page1right = $page2right = $pervpage = $nextpage = '';

	if ($page != 1) 
		$pervpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="notifications?sort=requests&page=1">'
								.'<p class="m-0 p-0 d-flex align-items-center justify-content-center">
                    <svg width="20px" height="20px" viewBox="0 0 48 48" fill="var(--main-text-color)">
                      <path d="M15.8,24,26.4,34.6a1.9,1.9,0,0,1-.2,3,2.1,2.1,0,0,1-2.7-.2l-11.9-12a1.9,1.9,0,0,1,0-2.8l11.9-12a2.1,2.1,0,0,1,2.7-.2,1.9,1.9,0,0,1,.2,3Z"></path>
                      <path d="M27.8,24,38.4,34.6a1.9,1.9,0,0,1-.2,3,2.1,2.1,0,0,1-2.7-.2l-11.9-12a1.9,1.9,0,0,1,0-2.8l11.9-12a2.1,2.1,0,0,1,2.7-.2,1.9,1.9,0,0,1,.2,3Z"></path>
                    </svg>
                  </p>'
								.'</a>'
								.'<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="notifications?sort=requests&page='.($page - 1).'">'
								.'<p class="m-0 p-0">
                    <svg width="20px" height="20px" viewBox="0 0 48 48" fill="var(--main-text-color)">
                      <path d="M20.8,24,31.4,13.4a1.9,1.9,0,0,0-.2-3,2.1,2.1,0,0,0-2.7.2l-11.9,12a1.9,1.9,0,0,0,0,2.8l11.9,12a2.1,2.1,0,0,0,2.7.2,1.9,1.9,0,0,0,.2-3Z"></path>
                    </svg>
                  </p>'
								.'</a>';

	if ($page != $total_count_notifications_pages) 
		$nextpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="notifications?sort=requests&page='.($page + 1).'">'
								.'<p class="m-0 p-0">
                    <svg width="20px" height="20px" viewBox="0 0 48 48" fill="var(--main-text-color)">
                      <path d="M27.2,24,16.6,34.6a1.9,1.9,0,0,0,.2,3,2.1,2.1,0,0,0,2.7-.2l11.9-12a1.9,1.9,0,0,0,0-2.8l-11.9-12a2.1,2.1,0,0,0-2.7-.2,1.9,1.9,0,0,0-.2,3Z"></path>
                    </svg>
                  </p>'
								.'</a>'
								.'<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="notifications?sort=requests&page='.$total_count_notifications_pages.'">'
								.'<p class="m-0 p-0">
                    <svg width="20px" height="20px" viewBox="0 0 48 48" fill="var(--main-text-color)">
                      <path d="M33.2,24,22.6,34.6a1.9,1.9,0,0,0,.2,3,2.1,2.1,0,0,0,2.7-.2l11.9-12a1.9,1.9,0,0,0,0-2.8l-11.9-12a2.1,2.1,0,0,0-2.7-.2,1.9,1.9,0,0,0-.2,3Z"></path>
                      <path d="M21.2,24,10.6,34.6a1.9,1.9,0,0,0,.2,3,2.1,2.1,0,0,0,2.7-.2l11.9-12a1.9,1.9,0,0,0,0-2.8l-11.9-12a2.1,2.1,0,0,0-2.7-.2,1.9,1.9,0,0,0-.2,3Z"></path>
                    </svg>
                  </p>'
								.'</a>';

	if ($page - 2 > 0) $page2left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="notifications?sort=requests&page='.($page - 2).'">'.($page - 2).'</a>';
	if ($page - 1 > 0) $page1left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="notifications?sort=requests&page='.($page - 1).'">'.($page - 1).'</a>';
	if ($page + 2 <= $total_count_notifications_pages) $page2right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="notifications?sort=requests&page='.($page + 2).'">'.($page + 2).'</a>';
	if ($page + 1 <= $total_count_notifications_pages) $page1right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="notifications?sort=requests&page='.($page + 1).'">'.($page + 1).'</a>';

	if ($total_count_notifications_pages > 1)
		echo $pervpage.$page2left.$page1left.'<p class="fz-13 m-2 pt-1 pb-1 current-page-num d-flex justify-content-center align-items-center font-weight-bold">'.$page.'</p>'.$page1right.$page2right.$nextpage;
?>
</div>