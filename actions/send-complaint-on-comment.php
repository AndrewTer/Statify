<?php
defined('mystatify');

if (isset($_POST["author"]) && isset($_POST["receiver"]) && isset($_POST["comment_uuid"]) && isset($_POST["reason"]) && isset($_POST['comment'])
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['author']))
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['receiver']))
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['comment_uuid'])))
{
	require_once(realpath('../includes/connection.php'));

	$author_uuid = trim($_POST['author']);
	$receiver_uuid = trim($_POST['receiver']);
	$comment_uuid = trim($_POST['comment_uuid']);
	$reason_code = trim($_POST['reason']);
	$comment = trim($_POST['comment']);

	$add_complaint_query = pg_query("INSERT INTO users_complaints (author_uuid, receiver_uuid, comment_uuid, type, reason_code, description, date_time) VALUES ('{$author_uuid}', '{$receiver_uuid}', '{$comment_uuid}', 'comment', '{$reason_code}', '{$comment}', NOW())") or trigger_error(pg_last_error().$add_complaint_query);

	if ($add_complaint_query)
	{
		echo 'success';
		return;
	}else
	{
		echo 'error';
		return;
	}
}else
{
	echo 'error';
	return;
}
?>