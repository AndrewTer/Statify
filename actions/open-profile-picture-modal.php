<?php 
	defined('mystatify');

	include("../functions/functions-modals.php");
	include("../functions/functions-user-data.php");

	if (isset($_POST['current_user']) && isset($_POST['user']) && isset($_POST['photo']) && isset($_POST['type'])
		&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['current_user']))
		&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user'])))
	{
		require_once(realpath('../includes/connection.php'));

		$current_user_uuid = $_POST['current_user'];
		$author_photo_uuid = $_POST['user'];
		$photo_name = $_POST['photo'];
		$type = $_POST['type'];

		return profile_picture_modal($current_user_uuid, $author_photo_uuid, $photo_name, $type);
	}else
		return 'error';
?>