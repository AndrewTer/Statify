<?php
define('mystatify', true);
session_start();

if (!empty($_POST["email"]))
{
    require_once(realpath('../includes/connection.php'));

    $user_email_value = trim($_POST['email']);

    //Поиск существующих записей с email
    $check_email_row = pg_query("SELECT Count(*) FROM users WHERE (email = '$user_email_value')") 
                    or trigger_error(pg_last_error().$check_email_row);
        
    if ($check_email_data = pg_fetch_array($check_email_row))
    {
        $check_email_row_count = $check_email_data[0];
        if($check_email_row_count > 0)
        {
            echo 'error';
            return;
        }else{
            echo 'success';
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
?>