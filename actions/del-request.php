<?php
defined('mystatify');

if (isset($_POST['user']) && isset($_POST['friend'])
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user']))
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['friend'])))
{
	require_once(realpath('../includes/connection.php'));

	$user_uuid = trim($_POST['user']);
	$friend_uuid = trim($_POST['friend']);

	$del_request_query = "DELETE FROM friendship_requests WHERE (author_uuid = '$user_uuid' AND receiver_uuid = '$friend_uuid')";

	$del_friend_query = "DELETE FROM friends WHERE (first_uuid = '$user_uuid' AND second_uuid = '$friend_uuid') OR (first_uuid = '$friend_uuid' AND second_uuid = '$user_uuid')";
	
	$del_subsciber_query = "DELETE FROM subscribers WHERE user_uuid = '$friend_uuid' AND subscriber_uuid = '$user_uuid'";

	pg_query($del_request_query) or trigger_error(pg_last_error().$del_request_query);
	pg_query($del_friend_query) or trigger_error(pg_last_error().$del_friend_query);
	pg_query($del_subsciber_query) or trigger_error(pg_last_error().$del_subsciber_query);
}
?>