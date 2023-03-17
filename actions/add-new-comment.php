<?php
defined('mystatify');

if (isset($_POST['photo']) && isset($_POST['author']) && isset($_POST['text'])
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['author']))
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['photo'])))
{
	require_once(realpath('../includes/connection.php'));

	$author_uuid = trim($_POST['author']);
	$photo_uuid = trim($_POST['photo']);
	$text_comment = trim($_POST['text']);

	$add_new_comment = "INSERT INTO users_comments (picture_uuid, author_uuid, creation_date, text) VALUES ('$photo_uuid', '$author_uuid', NOW(), '$text_comment')";

	pg_query($add_new_comment) or trigger_error(pg_last_error());
}
?>