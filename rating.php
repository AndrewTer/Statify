<?php
  define('mystatify', true);
  require_once("includes/connection.php");
  include("functions/functions.php");
  include("functions/database-functions.php");
  include("functions/functions-for-check.php");
  include("functions/functions-user-data.php");
  include("functions/functions-for-rating.php");
  include("functions/functions-modals.php");

  $user_identifier = 'empty';

  session_start();
  if(session_status() !== PHP_SESSION_ACTIVE && $_SESSION['auth_user'] == 'yes_auth')
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
    $user_gender_preference = get_user_gender_preference($user_uuid);
    $user_preference_min_age = get_user_minimum_age_preference($user_uuid);
    $user_preference_max_age = get_user_maximum_age_preference($user_uuid);

    switch (true)
    {
      case ($user_preference_min_age && $user_preference_max_age):
        $age_preference_text = $user_preference_min_age.'-'.$user_preference_max_age.' лет';
        break;

      case ($user_preference_min_age && !$user_preference_max_age):
        $age_preference_text = 'от '.$user_preference_min_age.' лет';
        break;

      case (!$user_preference_min_age && $user_preference_max_age):
        $age_preference_text = 'до '.$user_preference_max_age.' лет';
        break;

      default:
        $age_preference_text = '';
        break;
    }
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Страница оценивания пользователей сайта Statify">
    <meta name="Keywords" content="сервис, оценка, оценивание, знакомства, просмотр статистики, достижения, внешность, оценка внешности, рейтинг">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main/main.css">
    <link rel="stylesheet" type="text/css" href="css/main/svg.css">
    <link rel="stylesheet" type="text/css" href="css/main/header-footer.css">
    <link rel="stylesheet" type="text/css" href="css/main/menu.css">
    <link rel="stylesheet" type="text/css" href="css/main/user-page.css">
    <link rel="stylesheet" type="text/css" href="css/main/modals.css">
    <link rel="stylesheet" type="text/css" href="css/main/animation.css">
    <link rel="stylesheet" type="text/css" href="css/main/rating.css">
    <link rel="stylesheet" type="text/css" href="css/main/adaptive.css">
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
      <div class="row main-body m-0">
        <div class="main-menu d-none d-lg-block col-lg-2 col-xl-2 navbar-container"><? include("includes/menu.php"); ?></div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10" id="main-rating-card-block">
          <div class="content container-fluid m-0 p-0">
            <div class="m-0 mb-1 p-0 d-flex flex-row align-items-center" id="rating-menu-block">
<?
            switch ($user_gender_preference) {
              case 'male':
                echo '<p class="m-0 mr-auto p-0 fz-15"><i class="fa fa-star-half-o fz-16" id="rating-menu-star-icon" aria-hidden="true"></i>&nbsp;&nbsp;'.$age_preference_text.' (<i class="fa fa-mars fz-15" aria-hidden="true"></i>)</td></tr>';
                break;

              case 'female':
                echo '<p class="m-0 mr-auto p-0 fz-15"><i class="fa fa-star-half-o fz-16" id="rating-menu-star-icon" aria-hidden="true"></i>&nbsp;&nbsp;'.$age_preference_text.' (<i class="fa fa-venus fz-15" aria-hidden="true"></i>)</td></tr>';
                break;

              default:
                echo '<p class="m-0 mr-auto p-0 fz-15"><i class="fa fa-star-half-o fz-16" id="rating-menu-star-icon" aria-hidden="true"></i>&nbsp;&nbsp;Интересы: Отсутствуют</p>';
                break;
            }
?>
              <div class="p-0 m-0 ml-auto d-flex justify-content-end align-items-center">
                <div class="radio_btn rating_photos_view_btn m-0 mr-1">
                  <input id="rating-photos-view-solo" type="radio" name="rating-photos-view" value="solo" checked>
                  <label class="m-0 text-center border-0" for="rating-photos-view-solo">
                    <svg width="20px" height="20px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none" id="rating-photos-view-solo-svg">
                      <path fill="var(--main-text-color)" d="M3.25 1A2.25 2.25 0 001 3.25v9.5A2.25 2.25 0 003.25 15h9.5A2.25 2.25 0 0015 12.75v-9.5A2.25 2.25 0 0012.75 1h-9.5z"></path>
                    </svg>
                  </label>
                </div>
                 
                <div class="radio_btn rating_photos_view_btn m-0">
                  <input id="rating-photos-view-list" type="radio" name="rating-photos-view" value="list">
                  <label class="m-0 text-center border-0" for="rating-photos-view-list">
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" id="rating-photos-view-list-svg">
                      <path d="M3 2C2.44772 2 2 2.44772 2 3V10C2 10.5523 2.44772 11 3 11H10C10.5523 11 11 10.5523 11 10V3C11 2.44772 10.5523 2 10 2H3Z" fill="var(--main-text-color)"></path>
                      <path d="M14 2C13.4477 2 13 2.44772 13 3V10C13 10.5523 13.4477 11 14 11H21C21.5523 11 22 10.5523 22 10V3C22 2.44772 21.5523 2 21 2H14Z" fill="var(--main-text-color)"></path>
                      <path d="M14 13C13.4477 13 13 13.4477 13 14V21C13 21.5523 13.4477 22 14 22H21C21.5523 22 22 21.5523 22 21V14C22 13.4477 21.5523 13 21 13H14Z" fill="var(--main-text-color)"></path>
                      <path d="M3 13C2.44772 13 2 13.4477 2 14V21C2 21.5523 2.44772 22 3 22H10C10.5523 22 11 21.5523 11 21V14C11 13.4477 10.5523 13 10 13H3Z" fill="var(--main-text-color)"></path>
                    </svg>
                  </label>
                </div>
              </div>
            </div>

            <hr class="hr-user-info m-0">

            <div class="m-0 p-0" id="rating-photos-container"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="row main-footer w-100"><? include("includes/footer.php"); ?></div>

    <script defer type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src='js/rating.js'></script>
  </body>
</html>
<?
  } else
    header("Location: login");
?>