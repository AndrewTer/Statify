<?php
define('mystatify', true);

include("../functions/functions-user-data.php");

if (isset($_POST["user_nickname"]))
{
  require_once(realpath('../includes/connection.php'));

  if (!empty($_COOKIE['login']) and !empty($_COOKIE['key']))
  {
    $cookie_login = $_COOKIE['login'];
    $cookie_key = $_COOKIE['key'];

    if (get_user_uuid_by_cookie($cookie_login, $cookie_key))
    {
      $user_uuid = get_user_uuid_by_cookie($cookie_login, $cookie_key);
      $new_user_nickname = trim(htmlspecialchars($_POST['user_nickname']));
      $old_user_nickname = get_user_nickname($user_uuid);

      $nickname_verification_query = pg_query("SELECT 1 FROM users WHERE nickname = '$new_user_nickname'") or trigger_error(pg_last_error().$nickname_verification_query);

      $nickname_verification_count = pg_num_rows($nickname_verification_query);

      if ($nickname_verification_count == 0)
      {
        $change_nickname_query = "UPDATE users SET nickname = '$new_user_nickname' WHERE uuid = '$user_uuid'";

        $change_nickname_result = pg_query($change_nickname_query) or trigger_error(pg_last_error().$change_nickname_result);

        if ($change_nickname_result)
        {
          $new_nickname_change_date_result = pg_query("UPDATE users_technical_data SET nickname_change_date = NOW() WHERE user_uuid = '$user_uuid'") or trigger_error(pg_last_error().$new_nickname_change_date_result);

          if ($new_nickname_change_date_result)
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
        echo 'exists';
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