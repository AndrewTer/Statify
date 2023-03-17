<?php
define('mystatify', true);

if (isset($_POST["email"]) && isset($_POST["old_password"]) && isset($_POST["new_password"]))
{
    require_once(realpath('../includes/connection.php'));

    $user_email = trim(htmlspecialchars($_POST['email']));
    $user_old_password = trim(htmlspecialchars($_POST['old_password']));
    $user_new_password = trim(htmlspecialchars($_POST['new_password']));

    $encrypted_password = password_hash($user_new_password, PASSWORD_BCRYPT);

    $get_user_data_query = pg_query("SELECT uuid, password FROM users WHERE (email = '{$user_email}')") 
                    or trigger_error(pg_last_error().$get_user_data_query);
        
    $get_user_data_query_count = pg_num_rows($get_user_data_query);

    if($get_user_data_query_count == 1)
    {
        if ($user_data = pg_fetch_array($get_user_data_query))
        {
            $user_data_uuid = $user_data[0];
            $user_data_password = $user_data[1];

            if (password_verify($user_old_password, $user_data_password))
            {
                $edit_password_row = "UPDATE users SET password = '{$encrypted_password}' WHERE uuid = '{$user_data_uuid}' AND email = '{$user_email}'";

                $result = pg_query($edit_password_row) or trigger_error(pg_last_error().$result);

                if (!$result)
                {
                    echo 'error';
                    return;
                }
            }else
            {
                echo 'wrong_current_password';
                return;
            }
        }else{
            echo 'error';
            return;
        }
    }else{
        echo 'wrong_current_password';
        return;
    }
}
?>