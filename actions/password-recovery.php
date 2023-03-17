<?php
defined('mystatify');

if (isset($_POST['email']))
{
	require_once(realpath('../includes/connection.php'));

	$received_email = trim($_POST['email']);

	$users_with_current_email = pg_query("SELECT uuid FROM users WHERE email='{$received_email}'") or trigger_error(pg_last_error().$users_with_current_email);

	$num_users_with_current_email = pg_num_rows($users_with_current_email);

	if ($num_users_with_current_email > 0)
	{
		$array_to_randomize = array("24", "32", "45", "83", "74", "4", "7", "1", "qu", "rt", "ds", "mL", "Xj", "W", "D", "Vx", "i0", "2d", "j", "Sb", "Q");
            
		$string_password = shuffle($array_to_randomize);
		
		for ($k = 0; $k < 8; $k++)
		{
			shuffle($array_to_randomize);
			$string_password = $string_password.$array_to_randomize[1];
		}

    	$encrypted_password = password_hash($string_password, PASSWORD_BCRYPT);

		$from = "support@statify.ru";
		$to = $received_email;
		$subject = "Восстановление пароля";
		$message = "Доброго времени суток!\n\nВременный пароль для входа в ваш аккаунт: $string_password \n\nПосле успешной авторизации на сайте рекомендуем вам сменить этот временный пароль на новый в разделе 'Настройки'.\n\nВсего наилучшего, администрация сервиса Statify.ru\n\nP.S. Если вы получили это письмо по ошибке, то просто проигнорируйте или удалите его.";
		$headers = "From:" . $from;
		$email_send = mail($to,$subject,$message,$headers);

		if ($email_send)
		{
			$update_password = pg_query("UPDATE users SET password = '{$encrypted_password}' WHERE email='{$received_email}'");
			
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