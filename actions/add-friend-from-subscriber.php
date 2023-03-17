<?php
defined('mystatify');

if (!empty($_POST['user']) && !empty($_POST['friend'])
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user']))
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['friend'])))
{
	require_once(realpath('../includes/connection.php'));

	$user_uuid = trim($_POST['user']);
	$friend_uuid = trim($_POST['friend']);

	$add_new_friend_query = "INSERT INTO friends (first_uuid, second_uuid) VALUES ('$user_uuid', '$friend_uuid')";
	$del_subscriber_query = "DELETE FROM subscribers WHERE (user_uuid = '$user_uuid' AND subscriber_uuid = '$friend_uuid') OR (user_uuid = '$friend_uuid' AND subscriber_uuid = '$user_uuid')";
	$add_news_query_first = "INSERT INTO news (author_uuid, news_type, friend_uuid, creation_date) VALUES ('$user_uuid', 'addFriend', '$friend_uuid', NOW())";
	$add_news_query_second = "INSERT INTO news (author_uuid, news_type, friend_uuid, creation_date) VALUES ('$friend_uuid', 'addFriend', '$user_uuid', NOW())";
	
	pg_query($add_new_friend_query) or trigger_error(pg_last_error().$add_new_friend_query);
	pg_query($del_subscriber_query) or trigger_error(pg_last_error().$del_subscriber_query);
	pg_query($add_news_query_first) or trigger_error(pg_last_error().$add_news_query_first);
	pg_query($add_news_query_second) or trigger_error(pg_last_error().$add_news_query_second);
}
?>