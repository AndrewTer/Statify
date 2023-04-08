<?php
  define('mystatify', true);
  require_once("includes/connection.php");
  include("functions/functions.php");
  include("functions/database-functions.php");
  include("functions/functions-for-check.php");
  include("functions/functions-user-data.php");
  include("functions/functions-modals.php");
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Информация о сайте Statify">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main/main.css">
    <link rel="stylesheet" type="text/css" href="css/main/svg.css">
    <link rel="stylesheet" type="text/css" href="css/main/header-footer.css">
    <link rel="stylesheet" type="text/css" href="css/main/menu.css">
    <link rel="stylesheet" type="text/css" href="css/main/user-page.css">
    <link rel="stylesheet" type="text/css" href="css/main/about.css">
    <link rel="stylesheet" type="text/css" href="css/main/modals.css">
    <link rel="stylesheet" type="text/css" href="css/main/animation.css">
    <link rel="stylesheet" type="text/css" href="css/main/adaptive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src='js/jquery.min.js'></script>

    <noscript>
      <meta http-equiv="refresh" content="0; url=noscript">
    </noscript>

    <title>Statify</title>
  </head>
  <body>
<?
    $user_identifier = 'empty';

    session_start();
    if(session_status() !== PHP_SESSION_ACTIVE && isset($_SESSION['auth_user']) && $_SESSION['auth_user'] == 'yes_auth')
    {
      $user_uuid = $_SESSION['user_uuid'];
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
          $user_identifier = 'identifier';
        }
      }
    }

    if ($user_identifier == 'identifier')
    {
?>
      <div class="row main-header fixed-top"><? include("includes/header/header.php"); ?></div>
<?
    }else
    {
?>
      <div class="row main-header fixed-top"><? include("includes/header/header-login.php"); ?></div>
<?
    }
?>
    <div class="container-fluid main-body p-0">
      <div class="row about-block m-0">
        <div class="content container-fluid row m-0 p-0"><? include("includes/about/about-content.php"); ?></div>
      </div>
    </div>

    <div class="row main-footer w-100"><? include("includes/footer.php"); ?></div>

    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script defer type="text/javascript" src="js/main.js"></script>
  </body>
</html>