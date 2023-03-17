<?php
  define('mystatify', true);
  require_once("includes/connection.php");
  include("functions/functions.php");
  include("functions/database-functions.php");
  include("functions/functions-for-check.php");
  include("functions/functions-user-data.php");
  include("functions/functions-modals.php");
  include("functions/functions-photos.php");
  include("functions/functions-saves.php");
  include("functions/functions-comments.php");
  include("functions/functions-friends.php");

  $user_identifier = 'empty';

  session_start();
  if (session_status() !== PHP_SESSION_ACTIVE && $_SESSION['auth_user'] == "yes_auth")
  {
    $user_uuid = $_SESSION['user_uuid'];
    $ban_check = ban_check($user_uuid);

    if ($ban_check == 'permanent' || $ban_check == 'ban')
      header("Location: ban");
    elseif ($ban_check == 'logout')
      header("Location: login");
    else
      $user_identifier = 'identifier';
  } else
  {
    if (!empty($_COOKIE['login']) and !empty($_COOKIE['key']))
    {
      $cookie_login = $_COOKIE['login'];
      $cookie_key = $_COOKIE['key'];

      if (get_user_uuid_by_cookie($cookie_login, $cookie_key))
      {
        $user_uuid = get_user_uuid_by_cookie($cookie_login, $cookie_key);
        $ban_check = ban_check($user_uuid);

        if ($ban_check == 'permanent' || $ban_check == 'ban')
          header("Location: ban");
        elseif ($ban_check == 'logout')
          header("Location: login");
        else
          $user_identifier = 'identifier';
      }else
        header("Location: login");
    }else
      header("Location: login");
  }

  if ($user_identifier == 'identifier')
  {
    $current_user_nickname = !empty($_GET['u']) ? htmlspecialchars($_GET['u'], ENT_QUOTES) : '';
    $current_user_uuid = ($current_user_nickname == '') ? $user_uuid : get_user_uuid_by_nickname($current_user_nickname);
    $current_user_uuid = ($current_user_nickname == 'null' || $current_user_uuid == $user_uuid) ? $user_uuid : $current_user_uuid;
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Statify - сервис для оценивания фотографий людей! Оценивайте фотографии других пользователей, просматривайте свою статистику, сохраняйте понравившиеся фотографии и добавляйте друзей!">
    <meta name="Keywords" content="сервис, оценка, оценивание, рейтинг, просмотр статистики, фотографии, комментарии">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main/main.css">
    <link rel="stylesheet" type="text/css" href="css/main/svg.css">
    <link rel="stylesheet" type="text/css" href="css/main/header-footer.css">
    <link rel="stylesheet" type="text/css" href="css/main/menu.css">
    <link rel="stylesheet" type="text/css" href="css/main/user-page.css">
    <link rel="stylesheet" type="text/css" href="css/main/modals.css">
    <link rel="stylesheet" type="text/css" href="css/main/notifications.css">
    <link rel="stylesheet" type="text/css" href="css/main/animation.css">
    <link rel="stylesheet" type="text/css" href="css/main/adaptive.css">
    <link rel="stylesheet" type="text/css" href="css/main/photo.css">
    <link rel="stylesheet" type="text/css" href="css/main/saves.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src='js/jquery.min.js'></script>

    <noscript>
      <meta http-equiv="refresh" content="0; url=noscript">
    </noscript>

    <title>Statify</title>
  </head>
  <body>
    <div class="row main-header fixed-top"><? include("includes/header/header.php"); ?></div>

    <div class="container-fluid main-body p-0">
      <div class="row main-block m-0">

        <div class="main-menu d-none d-lg-block col-lg-2 col-xl-2 navbar-container"><? include("includes/menu.php"); ?></div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 main-content">
          <div class="content container-fluid m-0">
            <div class="row">
<?
              include("includes/user_page/user-info.php");
              include("includes/user_page/user-content.php");
?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row main-footer w-100"><? include("includes/footer.php"); ?></div>

    <script type="text/javascript" src="js/statistics.js"></script>
    <script type="text/javascript" src="js/user_page.js"></script>
    <script defer type="text/javascript" src="js/main.js"></script>
  </body>
</html>
<?
  } else
    header("Location: login");
?>