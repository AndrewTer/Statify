<?php
define('mystatify', true);

if(isset($_POST["email"]) && isset($_POST["password"]) && strlen($_POST["email"])>0 && strlen($_POST["password"])>0)
{
    require_once(realpath('../includes/connection.php'));
    include("../functions/functions.php");

    $user_email = htmlspecialchars($_POST['email']);
    $user_password = htmlspecialchars($_POST['password']);

    //Поиск существующих записей с данными параметрами
    $login_row = pg_query("SELECT uuid, password FROM users WHERE (email = '{$user_email}')") 
                    or trigger_error(pg_last_error().$login_row);
        
    $login_row_count = pg_num_rows($login_row);

    //Если существует запись, то создаём сессию
    if($login_row_count == 1)
    {
        if ($login_data = pg_fetch_array($login_row))
        {
            if (password_verify($user_password, $login_data[1]))
            {
                // Создание сессии
                session_start();
                $_SESSION['user_uuid'] = $login_data[0];
                $_SESSION['auth_user'] = 'yes_auth';

                // Проверка на наличие cookie
                $check_cookie_row = pg_query("SELECT cookie FROM users_technical_data WHERE user_uuid = '{$login_data[0]}'")
                                        or trigger_error(pg_last_error().$check_cookie_row);

                if ($check_cookie_data = pg_fetch_array($check_cookie_row))
                {
                    if (is_null($check_cookie_data[0]))
                    {
                        setcookie('login', '', time()); //удаляем логин
                        setcookie('key', '', time()); //удаляем ключ
                        
                        $cookie_key_value = generateRandomString();
                        setcookie('login', $user_email, time()+60*60*24*30, '/'); // на месяц
                        setcookie('key', $cookie_key_value, time()+60*60*24*30, '/'); // на месяц

                        pg_query("UPDATE users_technical_data SET cookie = '{$cookie_key_value}' WHERE user_uuid = '{$login_data[0]}'");
                    }else
                    {
                        setcookie('login', '', time()); //удаляем логин
                        setcookie('key', '', time()); //удаляем ключ

                        setcookie('login', $user_email, time()+60*60*24*30, '/'); // на месяц
                        setcookie('key', $check_cookie_data[0], time()+60*60*24*30, '/'); // на месяц
                    }
                }

                // Переадресация
                header("Location: ../index.php");
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
}
?>