<?php 
	defined('mystatify');

	include("../functions/functions.php");
	include("../functions/functions-modals.php");
	include("../functions/functions-user-data.php");
	include("../functions/functions-for-check.php");

	if (isset($_POST['nickname']))
	{
		require_once(realpath('../includes/connection.php'));
		$user_nickname = $_POST['nickname'];
		$user_uuid = get_user_uuid_by_nickname($user_nickname);

		$current_user_login = $_COOKIE['login'];
    $current_user_key = $_COOKIE['key'];
    $current_user_uuid = get_user_uuid_by_cookie($current_user_login, $current_user_key);

    $user_uuid = ($user_nickname == 'null' || $user_uuid == $current_user_uuid) ? $current_user_uuid : $user_uuid;

		return more_info_user_modal($user_uuid, $current_user_uuid);
	}else
		return 'error';
?>