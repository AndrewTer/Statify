<?php
define('mystatify', true);

if (isset($_POST["new_email"]) && isset($_POST["current_email"]) && isset($_POST["password"]))
{
    require_once(realpath('../includes/connection.php'));

    $user_new_email = trim(htmlspecialchars($_POST['new_email']));
    $user_current_email = trim(htmlspecialchars($_POST['current_email']));
    $user_password = trim(htmlspecialchars($_POST['password']));

    $get_user_data_query = pg_query("SELECT uuid, password FROM users WHERE (email = '{$user_current_email}')") 
                    or trigger_error(pg_last_error().$get_user_data_query);
        
    $get_user_data_query_count = pg_num_rows($get_user_data_query);

    if($get_user_data_query_count == 1)
    {
        if ($user_data = pg_fetch_array($get_user_data_query))
        {
            $user_data_uuid = $user_data[0];
            $user_data_password = $user_data[1];

            if (password_verify($user_password, $user_data_password))
            {
                $edit_email_row = "UPDATE users SET email = '{$user_new_email}' WHERE uuid = '{$user_data_uuid}'";

                $result = pg_query($edit_email_row) or trigger_error(pg_last_error().$result);

                if (!$result)
                {
                    echo 'update_error';
                    return;
                }else
                {
                    pg_query("UPDATE users_technical_data SET email_confirmed = false WHERE user_uuid = '{$user_data_uuid}'");

                    setcookie('login', '', time()); //удаляем логин
                    setcookie('login', $user_new_email, time()+60*60*24*30, '/'); // на месяц
                }
            }else
            {
                echo 'password_error';
                return;
            }
        }else{
            echo 'error';
            return;
        }
    }else{
        echo 'email_error';
        return;
    }
}
?>