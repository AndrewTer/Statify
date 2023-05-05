<?php
define('mystatify', true);

require_once(realpath('../includes/connection.php'));
include("../functions/functions-user-data.php");

if (!empty($_COOKIE['login']) and !empty($_COOKIE['key']))
{
  $cookie_login = $_COOKIE['login'];
  $cookie_key = $_COOKIE['key'];

  if (get_user_uuid_by_cookie($cookie_login, $cookie_key))
  {
    $user_uuid = get_user_uuid_by_cookie($cookie_login, $cookie_key);
      

    $remove_user_avatar_query = "UPDATE users SET avatar_uuid = NULL WHERE uuid = '$user_uuid'";

    $remove_user_avatar_result = pg_query($remove_user_avatar_query) or trigger_error(pg_last_error().$remove_user_avatar_result);

    if ($remove_user_avatar_result)
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
?>