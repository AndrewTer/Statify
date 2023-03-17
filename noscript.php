<?php
  define('mystatify', true);
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Страница с сообщением о необходимости поддержки JavaScript на сайте Statify">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/main/main.css">
    <link rel="stylesheet" type="text/css" href="css/main/svg.css">
    <link rel="stylesheet" type="text/css" href="css/main/header-footer.css">
    <link rel="stylesheet" type="text/css" href="css/main/error-pages.css">
    <title>Используется устаревший браузер | Statify</title>
  </head>
  <body>
    <div class="row main-header fixed-top"><?php include("includes/header/header-login.php"); ?></div>

    <div class="container-fluid main-body d-flex flex-column justify-content-center align-items-center p-0">
      <div id="noscript-content">
        <p class="fz-20 w-100 m-0 p-0 text-center">Для работы необходима поддержка JavaScript</p>
      
        <hr class="hr-line w-100 m-0 mt-2 mb-2">

        <p class="fz-15 m-0">Statify не работает должным образом без JavaScript. Включите JavaScript в настройках вашего браузера, либо загрузите и установите один из этих браузеров:</p>
        <div class="m-0 mt-4 p-0 d-flex  justify-content-center">
          <a class="m-0 mr-4 p-0" href="https://www.google.com/chrome/" target="_blank">
            <div class="browser-block m-0 p-0">
              <img class="mw-100" src="imgs/noscript/chrome.png" alt="Google Chrome" />
              <p class="fz-15 fw-700 m-0 mt-2 p-0 text-center">Chrome</p>
            </div>
          </a>

          <a class="m-0 mr-4 p-0" href="https://browser.yandex.ru/" target="_blank">
            <div class="browser-block m-0 p-0">
              <img class="mw-100" src="imgs/noscript/yandex.png" alt="Яндекс.Браузер" />
              <p class="fz-15 fw-700 m-0 mt-2 p-0 text-center">Яндекс</p>
            </div>
          </a>

          <a class="m-0 mr-4 p-0" href="https://www.mozilla.org/ru/" target="_blank">
            <div class="browser-block m-0 p-0">
              <img class="mw-100" src="imgs/noscript/firefox.png" alt="Mozilla Firefox" />
              <p class="fz-15 fw-700 m-0 mt-2 p-0 text-center">Firefox</p>
            </div>
          </a>

          <a class="m-0 mr-4 p-0" href="https://www.opera.com/ru" target="_blank">
            <div class="browser-block m-0 p-0">
              <img class="mw-100" src="imgs/noscript/opera.png" alt="Opera" />
              <p class="fz-15 fw-700 m-0 mt-2 p-0 text-center">Opera</p>
            </div>
          </a>

          <a class="m-0 p-0" href="https://www.apple.com/ru/safari/" target="_blank">
            <div class="browser-block m-0 p-0">
              <img class="mw-100" src="imgs/noscript/safari.png" alt="Safari" />
              <p class="fz-15 fw-700 m-0 mt-2 p-0 text-center">Safari</p>
            </div>
          </a>
        </div>

        <p class="m-0 mt-3 text-center"><a class="fz-16" id="main-page-link" href="./">Переход на главную страницу</a></p>
      </div> 
    </div>

    <div class="row main-footer w-100"><? include("includes/footer.php"); ?></div>
  </body>
</html>