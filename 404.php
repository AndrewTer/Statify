<?php
  define('mystatify', true);
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Сообщение об отсутствии страницы на сайте Statify">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/main/main.css">
    <link rel="stylesheet" type="text/css" href="css/main/svg.css">
    <link rel="stylesheet" type="text/css" href="css/main/header-footer.css">
    <link rel="stylesheet" type="text/css" href="css/main/error-pages.css">
    <title>Страница не найдена | Statify</title>
  </head>
  <body>
    <div class="row main-header fixed-top"><?php include("includes/header/header-login.php"); ?></div>

    <div class="container-fluid main-body d-flex flex-column justify-content-center align-items-center p-0">
      <div id="noscript-content">
        <p class="fz-20 w-100 m-0 p-0 text-center">Ошибка 404</p>
      
        <hr class="hr-line w-100 m-0 mt-2 mb-2">

        <p class="fz-15 m-0">К сожалению, запрашиваемая вами страница не найдена</p>
        <p class="fz-15 m-0 mt-2">Почему?</p>
        <p class="fz-15 m-0 mt-1 ml-2"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Ссылка, по которой вы перешли, неверна</p>
        <p class="fz-15 m-0 mt-1 ml-2"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Вы неправильно указали путь или название страницы</p>
        <p class="fz-15 m-0 mt-1 ml-2"><i class="fa fa-dot-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Страница была удалена со времени вашего последнего посещения</p>

        <p class="fz-15 m-0 mt-3 text-center">Для продолжения работы с сайтом вы можете перейти на <a class="fz-16 text-white" href="./">главную страницу</a>.</p>
      </div>
    </div>

    <div class="row main-footer w-100"><? include("includes/footer.php"); ?></div>
  </body>
</html>