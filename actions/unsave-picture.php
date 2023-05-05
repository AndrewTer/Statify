<?php
defined('mystatify');

if(isset($_POST["author"]) && isset($_POST["user"]) && isset($_POST["picture"]))
{
	require_once(realpath('../includes/connection.php'));
	include('../functions/functions-photos.php');

	$author_uuid = $_POST['author'];
	$user_uuid = $_POST['user'];
	$photo_name = $_POST['picture'];
	$photo_uuid = get_photo_uuid_by_name($photo_name);

	pg_query("DELETE FROM saves WHERE user_uuid = '{$user_uuid}' AND photo_uuid = '{$photo_uuid}' AND author_uuid = '{$author_uuid}'");
}
?>