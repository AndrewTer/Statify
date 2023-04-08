<?php 
	defined('mystatify');
  include("../functions/functions.php");
  include("../functions/database-functions.php");
  include("../functions/functions-photos.php");
  include("../functions/functions-for-check.php");
  include("../functions/functions-user-data.php");
  include("../functions/functions-modals.php");
  require_once(realpath('../includes/connection.php'));

	$result = '';

	$cookie_login = $_COOKIE['login'];
	$cookie_key = $_COOKIE['key']; 

	$user_uuid = get_user_uuid_by_cookie($cookie_login, $cookie_key);
	$page_status = check_user_page_status($user_uuid);

	$current_user_nickname = trim($_POST['nickname']);
	$current_user_uuid = ($current_user_nickname == '') ? $user_uuid : get_user_uuid_by_nickname($current_user_nickname);
	$current_user_uuid = ($current_user_nickname == 'null' || $current_user_uuid == $user_uuid) ? $user_uuid : $current_user_uuid;

	if ($current_user_uuid == $user_uuid || user_friendly_status($user_uuid, $current_user_uuid) == 'friend')
	{
		if ($page_status)
		{
			echo '<div class="col-12 row m-0 p-0 main-content-photo">
							<div class="content container-fluid row m-0 p-0">';
			include("../includes/user_page/photos/photos-content.php");
			echo '	</div>
						</div>';
		}else{
			include("../includes/user_page/registration-completion.php");
		}
	}
?>