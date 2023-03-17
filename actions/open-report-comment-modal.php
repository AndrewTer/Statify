<?php 
	defined('mystatify');

	include("../functions/functions-modals.php");
	include("../functions/functions-user-data.php");
	include("../functions/functions-comments.php");

	if (isset($_POST['current_user']) && isset($_POST['comment_user']) && isset($_POST['comment'])
		&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['current_user']))
		&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['comment_user']))
		&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['comment'])))
	{
		require_once(realpath('../includes/connection.php'));

		$user_uuid = $_POST['current_user'];
		$comment_user_uuid = $_POST['comment_user'];
		$comment_uuid = $_POST['comment'];

		return report_comment_modal($user_uuid, $comment_user_uuid, $comment_uuid);
	}else
		return 'error';
?>