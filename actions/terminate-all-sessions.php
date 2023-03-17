<?php
defined('mystatify');
include('../functions/functions.php');
include('../functions/functions-user-data.php');

if(isset($_POST["user"]))
{
	require_once(realpath('../includes/connection.php'));
	$user_uuid = $_POST['user'];

	$user_email = get_user_email($user_uuid);
	$cookie_key_value = generateRandomString();

	setcookie('login', $user_email, time()+60*60*24*30, '/'); // на месяц
	setcookie('key', $cookie_key_value, time()+60*60*24*30, '/'); // на месяц

	pg_query("UPDATE users_technical_data SET cookie = '{$cookie_key_value}' WHERE user_uuid = '{$user_uuid}'");

	echo 'success';
	return;
}else
{
	echo 'error';
	return;
}
?>