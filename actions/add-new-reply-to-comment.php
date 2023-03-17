<?php
defined('mystatify');

if (isset($_POST['photo']) && isset($_POST['author']) && isset($_POST['comment_uuid']) && isset($_POST['text']))
{
	require_once(realpath('../includes/connection.php'));

	$author_uuid = trim($_POST['author']);
	$photo_uuid = trim($_POST['photo']);
	$comment_uuid = trim($_POST['comment_uuid']);
	$text_comment = trim($_POST['text']);

	$add_new_reply_to_comment = "INSERT INTO users_comments (picture_uuid, author_uuid, replying_comment_uuid, creation_date, text) VALUES ('$photo_uuid', '$author_uuid', '$comment_uuid', NOW(), '$text_comment')";

	pg_query($add_new_reply_to_comment) or trigger_error(pg_last_error());
}
?>