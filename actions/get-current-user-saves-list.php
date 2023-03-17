<?php 
	defined('mystatify');
	include("../functions/functions.php");
  include("../functions/database-functions.php");
  include("../functions/functions-saves.php");
  include("../functions/functions-for-check.php");
  include("../functions/functions-user-data.php");
  include("../functions/functions-modals.php");
  require_once(realpath('../includes/connection.php'));

	$result = '';

	$current_user_nickname = trim($_POST['nickname']);
	$cookie_login = $_COOKIE['login'];
	$cookie_key = $_COOKIE['key']; 

	$user_uuid = get_user_uuid_by_cookie($cookie_login, $cookie_key);

	echo '<div class="col-12 row m-0 p-0 main-content-saves">';
	include("../includes/user_page/saves/saves-content.php");
	echo '</div>';
?>