<?php
defined('mystatify');

if(isset($_POST['current_user']) && strlen($_POST['current_user']) > 0
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['current_user'])))
{
	require_once(realpath('../includes/connection.php'));

	$current_user = $_POST['current_user'];

	$activate_premium_trial_period = pg_query("INSERT INTO premium_users (user_uuid, received_date, finish_date) VALUES ('{$current_user}', NOW(), NOW() + INTERVAL '1 MONTH')") or trigger_error(pg_last_error().$activate_premium_trial_period);
		
	echo "success";
	return;
}else
{
	echo "error";
	return;
}
?>