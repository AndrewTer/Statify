<div class="w-100 m-0 col-md-8 p-0 order-2 order-sm-2 order-md-1 order-lg-1 order-xl-1">
<? 
	$sort = !empty($_GET['sort']) ? htmlspecialchars($_GET['sort']) : '';

	switch ($sort) {
		case 'comments':
			include('includes/notifications/notifications-list-comments.php');
			break;

		case 'requests':
			include('includes/notifications/notifications-list-requests.php');
			break;

		default:
			include('includes/notifications/notifications-list-all.php');
			break;
	}

?>
</div>

<div class="col-md-4 section-search-and-sort mb-3 order-1 order-sm-1 order-md-2 order-lg-2 order-xl-2">
<? 
	include('includes/notifications/notifications-menu.php'); 
	include('includes/notifications/notifications-read-all.php');
?>
</div>