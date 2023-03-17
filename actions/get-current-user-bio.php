<?
	defined('mystatify');

  require_once("../includes/connection.php");
  include("../functions/functions.php");
  include("../functions/database-functions.php");
  include("../functions/functions-for-check.php");
  include("../functions/functions-user-data.php");

  if ($_POST['nickname'])
  {
    $user_nickname = $_POST['nickname'];
    $user_uuid = get_user_uuid_by_nickname($user_nickname);

    $current_user_login = $_COOKIE['login'];
    $current_user_key = $_COOKIE['key'];
    $current_user_uuid = get_user_uuid_by_cookie($current_user_login, $current_user_key);

    $page_status = check_user_page_status($current_user_uuid);

    $user_uuid = ($user_nickname == 'null' || $user_uuid == $current_user_uuid) ? $current_user_uuid : $user_uuid;

    include("../includes/user_page/bio/bio-content.php");
  }
?>