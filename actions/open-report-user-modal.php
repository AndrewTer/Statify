<?php 
	defined('mystatify');

	include("../functions/functions-modals.php");
	include("../functions/functions-user-data.php");

	if (isset($_POST['current_user']) && isset($_POST['user'])
		&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['current_user']))
		&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user'])))
	{
		require_once(realpath('../includes/connection.php'));

		$user_uuid = $_POST['current_user'];
		$friend_uuid = $_POST['user'];
		$friend_name = get_user_fullname($_POST['user']);

		return report_user_modal($user_uuid, $friend_uuid, $friend_name);
	}else
		return 'error';
?>