<?php
defined('mystatify');

if(isset($_POST["author"]) && isset($_POST["user"]) && isset($_POST["picture"]))
{
	require_once(realpath('../includes/connection.php'));
	$author_uuid = $_POST['author'];
	$user_uuid = $_POST['user'];
	$picture_name = $_POST['picture'];

	// Поиск существующих записей с данными параметрами
	$search_saved_row = pg_query("SELECT Count(*) FROM saves WHERE author_uuid = '{$author_uuid}' AND user_uuid = '{$user_uuid}' AND profile_picture = '{$picture_name}'") or trigger_error(pg_last_error().$search_saved_row);

	if ($save_data = pg_fetch_array($search_saved_row))
	{
		$search_saved_count = $save_data[0];

		switch ($search_saved_count) 
		{
			case 0:
				pg_query("INSERT INTO saves (user_uuid, profile_picture, author_uuid, creation_date) VALUES ('{$user_uuid}', '{$picture_name}', '{$author_uuid}', NOW())");
				break;

			default:
				pg_query("DELETE FROM saves WHERE user_uuid = '{$user_uuid}' AND profile_picture = '{$picture_name}' AND author_uuid = '{$author_uuid}'");
				pg_query("INSERT INTO saves (user_uuid, profile_picture, author_uuid, creation_date) VALUES ('{$user_uuid}', '{$picture_name}', '{$author_uuid}', NOW())");
				break;
		}
	}
}
?>