<?php 
	defined('mystatify');

	include("../functions/functions-modals.php");
	include("../functions/functions-user-data.php");
	include("../functions/functions-friends.php");
	include("../functions/functions-for-check.php");

	if (isset($_POST['current_user']) && isset($_POST['another_user'])
		&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['current_user']))
		&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['another_user'])))
	{
		require_once(realpath('../includes/connection.php'));

		$current_user_uuid = $_POST['current_user'];
		$another_user_uuid = $_POST['another_user'];

		return mutual_friends_modal($current_user_uuid, $another_user_uuid);
	}else
		return 'error';
?>