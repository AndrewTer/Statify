<?php
defined('mystatify');

if (!empty($_POST['user']) && !empty($_POST['subscriber'])
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user']))
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['subscriber'])))
{
	require_once(realpath('../includes/connection.php'));

	$user_uuid = trim($_POST['user']);
	$subscriber_uuid = trim($_POST['subscriber']);

	$add_new_subscriber_query = "INSERT INTO subscribers (user_uuid, subscriber_uuid) VALUES ('$user_uuid', '$subscriber_uuid')";

	$del_request_query = "DELETE FROM friendship_requests WHERE (receiver_uuid = '$user_uuid' AND author_uuid = '$subscriber_uuid') OR (receiver_uuid = '$subscriber_uuid' AND author_uuid = '$user_uuid')";

	pg_query($add_new_subscriber_query) or trigger_error(pg_last_error().$add_new_subscriber_query);
	pg_query($del_request_query) or trigger_error(pg_last_error().$del_request_query);
}
?>