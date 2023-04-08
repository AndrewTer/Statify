<?php include("requests/all-notifications-list.php"); ?>

<div class="m-0 p-0" id="notifications-list">
<?php
	if($notifications_data = pg_fetch_array($notifications_query))
	{
		do {
			$notification_type = $notifications_data[6];

			switch ($notification_type) {
				case 'comment':
					$author = $notifications_data[0];
					$picture = $notifications_data[1];
					$comment = $notifications_data[2];
					$datetime = $notifications_data[4];
					$status = $notifications_data[5];
					comment_notification($author, $user_uuid, $picture, $comment, $datetime, $status);
					break;

				case 'request':
					$sender = $notifications_data[3];
					$datetime = $notifications_data[4];
					$status = $notifications_data[5];
					request_notification($user_uuid, $sender, $datetime, $status);
					break;
				
				default:
					break;
			}

		}while ($notifications_data = pg_fetch_row($notifications_query));
	}else
		echo '<div id="block-user" class="p-0">
		  			<span class="d-flex justify-content-center p-5 w-100"><strong class="h5 text-center">У вас пока нет уведомлений</strong></span>
					</div>';
?>
</div>

<div class="w-100 d-flex justify-content-center">
<?
	$page1left = $page2left = $page1right = $page2right = $pervpage = $nextpage = '';

	if ($page != 1) $pervpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="notifications?page=1"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a><a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="notifications?page='. ($page - 1) .'"><i class="fa fa-angle-left" aria-hidden="true"></i></a>';

	if ($page != $total_count_notifications_pages) $nextpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="notifications?page='. ($page + 1) .'"><i class="fa fa-angle-right" aria-hidden="true"></i></a><a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="notifications?page=' .$total_count_notifications_pages. '"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';

	if ($page - 2 > 0) $page2left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="notifications?page='. ($page - 2) .'">'. ($page - 2) .'</a>';
	if ($page - 1 > 0) $page1left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="notifications?page='. ($page - 1) .'">'. ($page - 1) .'</a>';
	if ($page + 2 <= $total_count_notifications_pages) $page2right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="notifications?page='. ($page + 2) .'">'. ($page + 2) .'</a>';
	if ($page + 1 <= $total_count_notifications_pages) $page1right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center font-weight-bold" href="notifications?page='. ($page + 1) .'">'. ($page + 1) .'</a>';

	if ($total_count_notifications_pages > 1)
		echo $pervpage.$page2left.$page1left.'<p class="fz-13 m-2 pt-1 pb-1 current-page-num d-flex justify-content-center align-items-center font-weight-bold">'.$page.'</p>'.$page1right.$page2right.$nextpage;
?>
</div>