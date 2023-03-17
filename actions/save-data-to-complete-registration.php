<?php
	define('mystatify', true);

	if (isset($_POST['user_nickname']) && isset($_POST['user_date_born']) 
			&& isset($_POST['user_gender']) && isset($_POST['user_uuid']))
	{
		require_once(realpath('../includes/connection.php'));

		$user_uuid = $_POST['user_uuid'];
		$user_nickname = str_replace(' ', '_', $_POST['user_nickname']);;
		$user_date_born = $_POST['user_date_born'];
		$user_gender = $_POST['user_gender'];

		$nickname_verification_query = pg_query("SELECT 1 FROM users WHERE nickname = '$user_nickname'")
																				or trigger_error(pg_last_error().$nickname_verification_query);

		$nickname_verification_count = pg_num_rows($nickname_verification_query);

		if ($nickname_verification_count == 0)
		{
			$gender_uuid_query = pg_query("SELECT uuid FROM genders WHERE title = '$user_gender' LIMIT 1")
																or trigger_error(pg_last_error().$gender_uuid_query);

			$gender_uuid_count = pg_num_rows($gender_uuid_query);

			if ($gender_uuid_count == 1)
			{
				if ($gender_uuid_data = pg_fetch_array($gender_uuid_query))
				{
					$user_gender_uuid = $gender_uuid_data[0];

					$save_data_query = "UPDATE users SET nickname = '$user_nickname', birthday = '$user_date_born', gender = '$user_gender_uuid' WHERE uuid = '$user_uuid'";

					$save_data_result = pg_query($save_data_query) or trigger_error(pg_last_error().$save_data_result);

					if ($save_data_result)
					{
						$user_page_activation = pg_query("UPDATE users_technical_data SET completed = true, nickname_change_date = NOW() WHERE user_uuid = '$user_uuid'") or trigger_error(pg_last_error().$user_page_activation);

						if ($user_page_activation)
						{
							echo 'success';
							return;
						}else
						{
							echo 'error';
							return;
						}
					}else
					{
						echo 'error';
						return;
					}
				}else
				{
					echo 'error';
					return;
				}
			}else
			{
				echo 'error';
				return;
			}
		}else
		{
			echo 'nickname';
			return;
		}
	}
?>