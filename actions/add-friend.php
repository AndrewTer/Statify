<?php
defined('mystatify');

if (isset($_POST['user']) && isset($_POST['friend']) 
	&& strlen($_POST['user']) > 0 && strlen($_POST['friend']) > 0
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user']))
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['friend'])))
{
	require_once(realpath('../includes/connection.php'));
	
	$user_uuid = trim($_POST['user']);
	$friend_uuid = trim($_POST['friend']);

	$add_new_friend_query = "INSERT INTO friendship_requests (author_uuid, receiver_uuid) VALUES ('{$user_uuid}', '{$friend_uuid}')";

	$del_subsciber_query = "DELETE FROM subscribers WHERE user_uuid = '{$friend_uuid}' AND subscriber_uuid = '{$user_uuid}'";
	
	pg_query($add_new_friend_query) or trigger_error(pg_last_error().$add_new_friend_query);
	pg_query($del_subsciber_query) or trigger_error(pg_last_error().$del_subsciber_query);
}
?>