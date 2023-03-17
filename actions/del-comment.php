<?php
defined('mystatify');

if (isset($_POST['author']) && isset($_POST['photo']) &&  isset($_POST['comment'])
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['author']))
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['photo'])))
{
	require_once(realpath('../includes/connection.php'));

	$author_uuid = trim($_POST['author']);
	$photo_uuid = trim($_POST['photo']);
	$comment_uuid = trim($_POST['comment']);

	$del_comment = "UPDATE users_comments 
					SET deleted = 1 
					WHERE uuid = '{$comment_uuid}'
						  AND picture_uuid = '{$photo_uuid}' 
						  AND author_uuid = '{$author_uuid}' 
						  AND creation_date > NOW() - INTERVAL '1 DAY' 
						  AND (deleted != 1 OR deleted IS NULL)";

	pg_query($del_comment) or trigger_error(pg_last_error());
}
?>