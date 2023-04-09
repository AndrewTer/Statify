<?php
  define('mystatify', true);
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Сообщение о запрещённом доступе на сайте Statify">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/main/main.css">
    <link rel="stylesheet" type="text/css" href="css/main/svg.css">
    <link rel="stylesheet" type="text/css" href="css/main/header-footer.css">
    <link rel="stylesheet" type="text/css" href="css/main/error-pages.css">
    <title>Доступ запрещён | Statify</title>
  </head>
  <body>
    <div class="row main-header fixed-top"><?php include("includes/header/header-login.php"); ?></div>

    <div class="container-fluid main-body d-flex flex-column justify-content-center align-items-center p-0">
      <div id="noscript-content">
        <p class="fz-60 font-weight-bold w-100 m-0 p-0 text-center">403</p>
      
        <hr class="hr-line w-100 m-0 mt-2 mb-2">

        <p class="fz-17 m-0 text-center font-weight-bold">Доступ запрещён</p>
        <p class="fz-15 m-0 mt-3">У вас нет доступа к данной информации</p>

        <p class="m-0 mt-3 text-center font-weight-bold"><a class="fz-16" id="main-page-link" href="./">Переход на главную страницу</a></p>
      </div>
    </div>

    <div class="row main-footer w-100"><? include("includes/footer.php"); ?></div>
  </body>
</html>