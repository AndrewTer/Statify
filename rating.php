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
    <script type="text/javascript" src='js/jquery-3.6.4.js'></script>

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
            <div class="m-0 mb-1 d-flex flex-row align-items-center block-user-content" id="rating-menu-block">
<?
            switch ($user_gender_preference) {
              case 'male':
                echo '<div class="m-0 mr-auto p-0 d-flex flex-row align-items-center">
                        <p class="m-0 p-0">
                          <svg class="m-0 mb-1 p-0" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1467 4.13112C12.7115 3.12752 11.2883 3.12751 10.8531 4.13112L8.87333 8.69665L3.91947 9.16869C2.83051 9.27246 2.3907 10.626 3.2107 11.3501L6.94099 14.6438L5.85911 19.501C5.62129 20.5688 6.77271 21.4053 7.7147 20.8492L11.9999 18.3193L16.2851 20.8492C17.2271 21.4053 18.3785 20.5688 18.1407 19.501L17.0588 14.6438L20.7891 11.3501C21.6091 10.626 21.1693 9.27246 20.0804 9.16869L15.1265 8.69665L13.1467 4.13112ZM12 15.9968L12.5083 16.2969L15.8125 18.2477L14.9783 14.5023L14.85 13.9261L15.2925 13.5353L18.1689 10.9956L14.3491 10.6316L13.7613 10.5756L13.5265 10.034L12 6.51388V15.9968Z" fill="var(--star-icon-color)"></path>
                          </svg>
                        </p>
                        <p class="m-0 ml-2 p-0 fz-15 font-weight-bold">'.$age_preference_text.' (</p>
                        <p class="m-0 p-0 font-weight-bold">
                          <svg class="m-0 p-0" width="14px" height="14px" fill="var(--main-text-color)" viewBox="0 0 256 256">
                            <path d="M227.9978,39.95557q-.00219-.56984-.05749-1.13819c-.018-.18408-.05237-.36279-.07849-.54443-.02979-.20557-.05371-.41211-.09424-.61621-.04029-.20362-.09607-.40088-.14649-.60059-.04541-.18017-.08484-.36084-.13867-.53906-.05884-.19434-.13159-.38135-.19971-.57129-.06445-.17969-.12353-.36084-.19677-.5376-.07349-.17724-.15967-.34668-.24109-.51953-.08582-.18213-.16687-.36621-.26257-.54492-.088-.16455-.18824-.32031-.2837-.48047-.10534-.17627-.2052-.355-.32031-.52685-.11572-.17334-.24475-.33545-.369-.502-.11-.14746-.21252-.29834-.3302-.4414-.23462-.28614-.4834-.55957-.74316-.82227-.01782-.01807-.03247-.03809-.05054-.05615-.01953-.01953-.041-.03565-.06067-.05469-.26123-.25781-.53271-.50537-.81653-.73828-.14794-.12158-.30383-.22754-.45605-.34082-.16138-.12061-.31885-.24561-.48645-.35791-.17725-.11865-.36108-.22168-.54309-.33008-.15442-.0918-.30518-.189-.46411-.27392-.18311-.09815-.37134-.18116-.55811-.269-.16846-.07959-.334-.16357-.50659-.23486-.18042-.0752-.36475-.13525-.54785-.20068-.18652-.0669-.37073-.13868-.56152-.19629-.18189-.05518-.3667-.09571-.55066-.14161-.19568-.04931-.389-.10449-.58851-.144-.20935-.041-.42077-.06592-.63171-.09619-.17688-.02539-.351-.05908-.53027-.07666q-.56837-.05567-1.13953-.05762c-.01465,0-.02893-.002-.0437-.002H168a12,12,0,0,0,0,24h19.02905l-32.7334,32.7334a83.9988,83.9988,0,1,0,16.971,16.97021L204,68.9707V88a12,12,0,0,0,24,0V40C228,39.98486,227.9978,39.97021,227.9978,39.95557ZM146.42627,194.42676a59.97169,59.97169,0,1,1,0-84.85352A60.06666,60.06666,0,0,1,146.42627,194.42676Z"></path>
                          </svg>
                        </p>
                        <p class="m-0 p-0 fz-15 font-weight-bold">)</p>
                      </div>';
                break;

              case 'female':
                echo '<div class="m-0 mr-auto p-0 d-flex flex-row align-items-center">
                        <p class="m-0 p-0">
                          <svg class="m-0 mb-1 p-0" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1467 4.13112C12.7115 3.12752 11.2883 3.12751 10.8531 4.13112L8.87333 8.69665L3.91947 9.16869C2.83051 9.27246 2.3907 10.626 3.2107 11.3501L6.94099 14.6438L5.85911 19.501C5.62129 20.5688 6.77271 21.4053 7.7147 20.8492L11.9999 18.3193L16.2851 20.8492C17.2271 21.4053 18.3785 20.5688 18.1407 19.501L17.0588 14.6438L20.7891 11.3501C21.6091 10.626 21.1693 9.27246 20.0804 9.16869L15.1265 8.69665L13.1467 4.13112ZM12 15.9968L12.5083 16.2969L15.8125 18.2477L14.9783 14.5023L14.85 13.9261L15.2925 13.5353L18.1689 10.9956L14.3491 10.6316L13.7613 10.5756L13.5265 10.034L12 6.51388V15.9968Z" fill="var(--star-icon-color)"></path>
                          </svg>
                        </p>
                        <p class="m-0 ml-2 p-0 fz-15 font-weight-bold">'.$age_preference_text.' (</p>
                        <p class="m-0 p-0 font-weight-bold">
                          <svg class="m-0 p-0" width="14px" height="14px" fill="var(--main-text-color)" viewBox="0 0 256 256">
                            <path d="M212,96a84,84,0,1,0-96,83.12891V196H88a12,12,0,0,0,0,24h28v20a12,12,0,0,0,24,0V220h28a12,12,0,0,0,0-24H140V179.12891A84.119,84.119,0,0,0,212,96ZM68,96a60,60,0,1,1,60,60A60.06812,60.06812,0,0,1,68,96Z"></path>
                          </svg>
                        </p>
                        <p class="m-0 p-0 fz-15 font-weight-bold">)</p>
                      </div>';
                break;

              default:
                echo '<div class="m-0 mr-auto p-0 d-flex flex-row align-items-center">
                        <p class="m-0 p-0">
                          <svg class="m-0 mb-1 p-0" width="20px" height="20px" viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.1467 4.13112C12.7115 3.12752 11.2883 3.12751 10.8531 4.13112L8.87333 8.69665L3.91947 9.16869C2.83051 9.27246 2.3907 10.626 3.2107 11.3501L6.94099 14.6438L5.85911 19.501C5.62129 20.5688 6.77271 21.4053 7.7147 20.8492L11.9999 18.3193L16.2851 20.8492C17.2271 21.4053 18.3785 20.5688 18.1407 19.501L17.0588 14.6438L20.7891 11.3501C21.6091 10.626 21.1693 9.27246 20.0804 9.16869L15.1265 8.69665L13.1467 4.13112ZM12 15.9968L12.5083 16.2969L15.8125 18.2477L14.9783 14.5023L14.85 13.9261L15.2925 13.5353L18.1689 10.9956L14.3491 10.6316L13.7613 10.5756L13.5265 10.034L12 6.51388V15.9968Z" fill="var(--star-icon-color)"></path>
                          </svg>
                        </p>
                        <p class="m-0 ml-2 p-0 fz-15 font-weight-bold">Интересы: Отсутствуют</p>
                      </div>';
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