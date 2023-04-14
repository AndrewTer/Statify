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
		$message = '<html>
						<body style="width: 60%;    
									 margin-right: auto;
									 margin-left: auto;
									 padding: 15px;">
							<h2 style="width: 100%; text-align: center;">Доброго времени суток!</h2>
							<h4>Временный пароль для входа в ваш аккаунт: <span style="font-weight: bold; color: #6495ED; font-size: 20px;">'.$string_password.'</h4>
							<h4>После успешной авторизации на сайте рекомендуем вам сменить этот временный пароль на новый в разделе "Настройки".</h4>
							<h4>Всего наилучшего, администрация сервиса 
								<a href="statify.ru" style="color: #6495ED; text-decoration: none; font-weight: bold;">Statify.ru</a>
							</h4>
							<hr/>
							<h4>P.S. Если вы получили это письмо по ошибке, то просто проигнорируйте или удалите его.</h4>
						</body> 
					</html>';
		$headers = "MIME-Version: 1.0" . "\r\n"; 
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
		$headers .= "From: ".$from."\r\n".
								"Reply-To: ".$from."\r\n".
								"X-Mailer: PHP/".phpversion();
		$sub = '=?UTF-8?B?'.base64_encode($subject).'?=';
		$email_send = mail($to,$sub,$message,$headers);

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
