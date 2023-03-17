<?php
define('mystatify', true);

$errors = 0;

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username']) && isset($_POST['usersurname']))
{
    require_once(realpath('../includes/connection.php'));
    include(realpath('../functions/functions.php'));

    $user_email = htmlspecialchars($_POST['email']);
    $user_password = htmlspecialchars($_POST['password']);
    $user_name = htmlspecialchars($_POST['username']);
    $user_surname = htmlspecialchars($_POST['usersurname']);

    $encrypted_password = password_hash($user_password, PASSWORD_BCRYPT);

    //date_default_timezone_set('Europe/Moscow');

    $registration_query = pg_query("INSERT INTO users (password, email, name, surname, creation_date) VALUES ('{$encrypted_password}', '{$user_email}', '{$user_name}', '{$user_surname}', CURRENT_DATE)")
                            or trigger_error(pg_last_error().$registration_query);

    if ($registration_query)
    {
        $get_user_data_query = pg_query("SELECT uuid FROM users WHERE email = '{$user_email}' AND password = '{$encrypted_password}'")
                                or trigger_error(pg_last_error().$get_user_data_query);

        if ($get_user_data_result = pg_fetch_array($get_user_data_query))
        {
            $user_uuid_value = $get_user_data_result[0];

            $add_technical_data_query = pg_query("INSERT INTO users_technical_data (user_uuid, deleted_status, folder, completed) VALUES ('{$user_uuid_value}', false, '', false)")
                                                or trigger_error(pg_last_error().$add_technical_data_query);

            if ($add_technical_data_query)
            {
                // Создание сессии
                session_start();
                $_SESSION['user_uuid'] = $user_uuid_value;
                $_SESSION['auth_user'] = 'yes_auth';

                setcookie('login', '', time()); //удаляем логин
                setcookie('key', '', time()); //удаляем ключ
                        
                $cookie_key_value = generateRandomString();
                setcookie('login', $user_email, time()+60*60*24*30, '/'); // на месяц
                setcookie('key', $cookie_key_value, time()+60*60*24*30, '/'); // на месяц

                pg_query("UPDATE users_technical_data SET cookie = '{$cookie_key_value}' WHERE user_uuid = '{$user_uuid_value}'");

                // Переадресация
                header("Location: ../index.php");
            }else
            {
                $delete_user_query = pg_query("DELETE FROM users WHERE email = '{$user_email}' AND password = '{$encrypted_password}'");
                $errors++;
            }
        }else
        {
            $delete_user_query = pg_query("DELETE FROM users WHERE email = '{$user_email}' AND password = '{$encrypted_password}'");
            $errors++;
        }

    }else
    {
        $delete_user_query = pg_query("DELETE FROM users WHERE email = '{$user_email}' AND password = '{$encrypted_password}'");
        $errors++;
    }
        
}else
    $errors++;

if ($errors != 0)
    echo 'error';
?>