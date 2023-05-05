<?php
  define('mystatify', true);
  require_once("includes/connection.php");
  include("functions/functions.php");
  include("functions/database-functions.php");
  include("functions/functions-for-check.php");
  include("functions/functions-user-data.php");
  include("functions/functions-comments.php");
  include("functions/functions-photos.php");

  $user_identifier = 'empty';

  session_start();
  if (session_status() !== PHP_SESSION_ACTIVE && $_SESSION['auth_user'] == 'yes_auth')
  {
    $user_uuid = $_SESSION['user_uuid'];
    $ban_check = ban_check($user_uuid);

    if ($ban_check == 'permanent' || $ban_check == 'ban')
      header("Location: ban");
    elseif ($ban_check == 'logout')
      header("Location: login");
    else
      $user_identifier = 'identifier';
  }else
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
    if (isset($_GET['p']) && !empty($_GET['p']))
      $photo_uuid_from_url = htmlspecialchars($_GET['p']);
    else
      header("Location: ./");

    $photo_uuid = substr($photo_uuid_from_url, 0, 8).'-'.substr($photo_uuid_from_url, 8, 4).'-'.substr($photo_uuid_from_url, 12, 4).'-'.substr($photo_uuid_from_url, 16, 4).'-'.substr($photo_uuid_from_url, 20);

    if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $photo_uuid))
      header("Location: ./");
    
    $photo_name = get_photo_name_by_uuid($photo_uuid);
    $photo_user_uuid = get_user_uuid_by_photo_uuid($photo_uuid);
    $ban_check = ban_check($photo_user_uuid);

    if ($photo_uuid && $photo_user_uuid && $ban_check == 'success')
    {
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Комментарии к фотографии пользователя сайта">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main/main.css">
    <link rel="stylesheet" type="text/css" href="css/main/svg.css">
    <link rel="stylesheet" type="text/css" href="css/main/header-footer.css">
    <link rel="stylesheet" type="text/css" href="css/main/menu.css">
    <link rel="stylesheet" type="text/css" href="css/main/user-page.css">
    <link rel="stylesheet" type="text/css" href="css/main/comments.css">
    <link rel="stylesheet" type="text/css" href="css/main/friends.css">
    <link rel="stylesheet" type="text/css" href="css/main/modals.css">
    <link rel="stylesheet" type="text/css" href="css/main/animation.css">
    <link rel="stylesheet" type="text/css" href="css/main/adaptive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src='js/libs/jquery-3.6.4.js'></script>

    <noscript>
      <meta http-equiv="refresh" content="0; url=noscript">
    </noscript>

    <title>Комментарии | Statify</title>
  </head>
  <body>
    <div class="row main-header fixed-top"><? include("includes/header/header.php"); ?></div>

    <div class="container-fluid main-body p-0">
      <div class="row main-block m-0">

        <div class="main-menu d-none d-lg-block col-lg-2 col-xl-2 navbar-container"><? include("includes/menu.php"); ?></div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 main-content-comments">
          <div class="content container-fluid row m-0 p-0"><? include("includes/comments/comments-content.php"); ?></div>
        </div>
      </div>
    </div>

    <div class="row main-footer w-100"><? include("includes/footer.php"); ?></div>

    <script defer type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/comments.js"></script>
    <script defer type="text/javascript" src="js/friendship.js"></script>
    <script type="text/javascript" src="js/libs/popper.min.js"></script>
    <script type="text/javascript" src="js/libs/bootstrap.min.js"></script>
  </body>
</html>
<?
    }else
      header("Location: ./");
  }else
    header("Location: login");
?>