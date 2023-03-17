<?php
defined('mystatify');

if (isset($_POST['subscriber']) && isset($_POST['user'])
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user']))
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['subscriber'])))
{
	require_once(realpath('../includes/connection.php'));

	$subscriber_uuid = trim($_POST['subscriber']);
	$user_uuid = trim($_POST['user']);

	$del_subscribed_query = "DELETE FROM subscribers WHERE subscriber_uuid = '$subscriber_uuid' AND user_uuid = '$user_uuid'";
	
	pg_query($del_subscribed_query) or trigger_error(pg_last_error().$del_subscribed_query);
}
?>