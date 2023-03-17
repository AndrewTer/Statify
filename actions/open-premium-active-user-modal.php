<?php 
	defined('mystatify');
	include("../functions/functions-modals.php");

	if (isset($_POST['current_user']) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['current_user'])))
	{
		require_once(realpath('../includes/connection.php'));

		$current_user_uuid = $_POST['current_user'];

		return premium_active_user_modal($current_user_uuid);
	}else
		return 'error';
?>