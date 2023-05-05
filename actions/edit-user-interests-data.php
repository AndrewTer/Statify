<?php
define('mystatify', true);

if (isset($_POST["interests_list"]))
{
  require_once(realpath('../includes/connection.php'));
  include("../functions/functions-user-data.php");

  if (!empty($_COOKIE['login']) and !empty($_COOKIE['key']))
  {
    $cookie_login = $_COOKIE['login'];
    $cookie_key = $_COOKIE['key'];

    if (get_user_uuid_by_cookie($cookie_login, $cookie_key))
    {
      $user_uuid = get_user_uuid_by_cookie($cookie_login, $cookie_key);
      $interests_list = $_POST['interests_list'];

      $delete_all_user_interests = pg_query("DELETE FROM users_interests WHERE user_uuid = '{$user_uuid}'")
                                or trigger_error(pg_last_error().$delete_all_user_interests);

      if ($interests_list != "")
      {
          $new_interests_array = explode(",", $interests_list);

          foreach($new_interests_array as $key => $value) {
              $interest_value = ltrim(rtrim($value));
              $add_user_interest = pg_query("INSERT INTO users_interests (user_uuid, interest_uuid) 
                                              VALUES ('{$user_uuid}'
                                                      ,(SELECT uuid FROM interests_types WHERE value = '{$interest_value}'))")
                                  or trigger_error(pg_last_error().$add_user_interest);
          }

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
}else
{
  echo 'error';
  return;
}
?>