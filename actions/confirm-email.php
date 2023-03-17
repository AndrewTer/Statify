<?php
defined('mystatify');

if (isset($_POST['user_email']) && isset($_POST['user_uuid']) && isset($_POST['confirmation_code'])
	&& strlen($_POST['user_email']) > 0 && strlen($_POST['user_uuid']) > 0 && strlen($_POST['confirmation_code'])
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user_uuid'])))
{
	require_once(realpath('../includes/connection.php'));

	$user_email = trim($_POST['user_email']);
	$user_uuid = $_POST['user_uuid'];
	$confirmation_code = $_POST['confirmation_code'];

	$verification_code_query = pg_query("SELECT verification_code FROM email_verification WHERE user_uuid='{$user_uuid}' AND email='{$user_email}'") or trigger_error(pg_last_error().$verification_code_query);

	if ($verification_code_result = pg_fetch_array($verification_code_query))
	{
		$verification_code = $verification_code_result[0];

		if ($verification_code == $confirmation_code)
		{
			pg_query("DELETE FROM email_verification WHERE user_uuid='{$user_uuid}'");
			pg_query("UPDATE users_technical_data SET email_confirmed = true WHERE user_uuid = '{$user_uuid}'");

			echo "success";
			return;
		}else
		{
			echo "unequal";
			return;
		}
	}else
	{
		echo "error";
		return;
	}
}else
{
	echo "error";
	return;
}
?>