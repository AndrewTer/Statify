<?php
defined('mystatify');

if (isset($_POST['user']) && isset($_POST['friend'])
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user']))
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['friend'])))
{
	require_once(realpath('../includes/connection.php'));

	$user_uuid = trim($_POST['user']);
	$friend_uuid = trim($_POST['friend']);

	$del_friend_query = "DELETE FROM friends WHERE (first_uuid = '$user_uuid' AND second_uuid = '$friend_uuid') OR (first_uuid = '$friend_uuid' AND second_uuid = '$user_uuid')";

	$del_request_query = "DELETE FROM friendship_requests WHERE author_uuid = '$user_uuid' AND receiver_uuid = '$friend_uuid'";
	
	$add_subscriber_query = "INSERT INTO subscribers (user_uuid, subscriber_uuid) VALUES ('$user_uuid', '$friend_uuid')";

	$del_news_query = "DELETE FROM news WHERE (author_uuid = '$user_uuid' AND friend_uuid = '$friend_uuid' AND news_type = 'addFriend') OR (author_uuid = '$friend_uuid' AND friend_uuid = '$user_uuid' AND news_type = 'addFriend')";

	pg_query($del_friend_query) or trigger_error(pg_last_error().$del_friend_query);
	pg_query($del_request_query) or trigger_error(pg_last_error().$del_request_query);
	pg_query($add_subscriber_query) or trigger_error(pg_last_error().$add_subscriber_query);
	pg_query($del_news_query) or trigger_error(pg_last_error().$del_news_query);
}
?>