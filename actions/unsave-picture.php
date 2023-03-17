<?php
defined('mystatify');

if(isset($_POST["author"]) && isset($_POST["user"]) && isset($_POST["picture"]))
{
	require_once(realpath('../includes/connection.php'));
	$author_uuid = $_POST['author'];
	$user_uuid = $_POST['user'];
	$picture_name = $_POST['picture'];

	pg_query("DELETE FROM saves WHERE user_uuid = '{$user_uuid}' AND profile_picture = '{$picture_name}' AND author_uuid = '{$author_uuid}'");
}
?>