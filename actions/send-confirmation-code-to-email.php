<?php
defined('mystatify');

if (isset($_POST['user_email']) && isset($_POST['user_uuid']) 
	&& strlen($_POST['user_email']) > 0 && strlen($_POST['user_uuid']) > 0
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user_uuid'])))
{
	require_once(realpath('../includes/connection.php'));

	$user_email = trim($_POST['user_email']);
	$user_uuid = $_POST['user_uuid'];

	$users_with_current_email_and_uuid = pg_query("SELECT uuid FROM users WHERE uuid='{$user_uuid}' AND email='{$user_email}'") or trigger_error(pg_last_error().$users_with_current_email_and_uuid);

	$num_users_with_current_email_and_uuid = pg_num_rows($users_with_current_email_and_uuid);

	if ($num_users_with_current_email_and_uuid > 0)
	{
		$array_to_randomize = array("2", "3", "5", "8", "4", "7", "1", "q", "t", "d", "L", "X", "W", "N", "V", "j", "S", "Q", "n", "m");
            
		$string_verification_code = shuffle($array_to_randomize);
		
		for ($k = 0; $k < 8; $k++)
		{
			shuffle($array_to_randomize);
			$string_verification_code = $string_verification_code.$array_to_randomize[1];
		}

		pg_query("DELETE FROM email_verification WHERE user_uuid='{$user_uuid}'");

		$from = "support@statify.ru";
		$to = $user_email;
		$subject = "Подтверждение адреса электронной почты";
		$message = "Доброго времени суток!\n\nВаш адрес электронной почты был указан при использовании аккаунта на сайте Statify.ru\n\n
		Для использования всех функций аккаунта вам следует подтвердить данный адрес электронный почты.\n\n
		Код для подтверждения: $string_verification_code\n\n
		Всего наилучшего, администрация сервиса Statify.ru\n\nP.S. Если вы получили это письмо по ошибке, то просто проигнорируйте или удалите его.";
		$headers = "From:" . $from;
		$email_send = mail($to,$subject,$message,$headers);

		if ($email_send)
		{
			pg_query("INSERT INTO email_verification (user_uuid, email, verification_code) VALUES ('{$user_uuid}', '{$user_email}', '{$string_verification_code}')");
			
			echo "success";
    	return;
		}else
		{
			echo "error";
			return;
		}
	}else
	{
		echo "empty";
		return;
	}
}else
{
	echo "error";
	return;
}
?>