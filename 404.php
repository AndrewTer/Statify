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
    <link rel="stylesheet" type="text/css" href="css/main/login.css">
    <script type="text/javascript" src='js/jquery-3.6.4.js'></script>
    <title>Страница не найдена | Statify</title>
  </head>
  <body>
    <div class="row main-header fixed-top"><?php include("includes/header/header-login.php"); ?></div>

    <div class="container-fluid main-body d-flex flex-column justify-content-center align-items-center p-0">
      <div class="m-4 p-4" id="error-content">
        <p class="fz-60 w-100 m-0 p-0 text-center font-weight-bold">404</p>
      
        <hr class="hr-user-info w-100 m-0 mt-2 mb-2">

        <p class="fz-17 m-0 text-center font-weight-bold">К сожалению, запрашиваемая вами страница не найдена</p>
        <p class="fz-16 m-0 mt-3 font-weight-bold">Почему?</p>
        <span class="m-0 mt-1 ml-2 d-flex flex-row align-items-center">
          <p class="m-0 p-0">
            <svg fill="var(--main-menu-icon-color)" width="15px" height="15px" viewBox="0 0 24 24">
              <path d="M12.265.002a11.911 11.911 0 00-2.437.204c13.876 1.704 10.27 17.94 1.717 17.819 0 0 12.453 1.625 11.673-10.215A11.911 11.911 0 0012.265.002zM8.213.827c-.2.002-.402.008-.61.016A11.856 11.856 0 00.146 13.608C2.93-.421 18.805 4.122 17.9 12.688c0 0 2.85-12.014-9.688-11.861zm1.454 5.035C6.002 5.886.691 7.45.816 16.344a12.013 12.013 0 002.897 4.33c.052.051.108.1.162.149a12.02 12.02 0 001.137.926c.061.044.12.092.181.135a11.93 11.93 0 001.312.779c.132.068.266.13.4.193a11.854 11.854 0 001.199.486c.1.034.195.077.297.109a11.874 11.874 0 001.49.353c.153.027.307.05.461.07a12.016 12.016 0 001.578.123l.06.003c.4 0 .792-.021 1.18-.06-13.949-3.327-8.645-18.924-.114-17.68 0 0-1.469-.41-3.389-.398zm2.436 2.762a3.355 3.355 0 103.354 3.356 3.355 3.355 0 00-3.354-3.356zm-5.95 2.192S2.82 23.09 16.172 23.196a11.978 11.978 0 007.743-9.992c.033-.319.043-.644.05-.97.001-.085.013-.168.013-.255 0-.371-.023-.737-.056-1.1-3.527 13.887-19.132 8.448-17.77-.063z"></path>
            </svg>
          </p>
          <p class="m-0 ml-3 p-0 fz-15">Ссылка, по которой вы перешли, неверна</p>
        </span>
        <span class="m-0 mt-1 ml-2 d-flex flex-row align-items-center">
          <p class="m-0 p-0">
            <svg fill="var(--main-menu-icon-color)" width="15px" height="15px" viewBox="0 0 24 24">
              <path d="M12.265.002a11.911 11.911 0 00-2.437.204c13.876 1.704 10.27 17.94 1.717 17.819 0 0 12.453 1.625 11.673-10.215A11.911 11.911 0 0012.265.002zM8.213.827c-.2.002-.402.008-.61.016A11.856 11.856 0 00.146 13.608C2.93-.421 18.805 4.122 17.9 12.688c0 0 2.85-12.014-9.688-11.861zm1.454 5.035C6.002 5.886.691 7.45.816 16.344a12.013 12.013 0 002.897 4.33c.052.051.108.1.162.149a12.02 12.02 0 001.137.926c.061.044.12.092.181.135a11.93 11.93 0 001.312.779c.132.068.266.13.4.193a11.854 11.854 0 001.199.486c.1.034.195.077.297.109a11.874 11.874 0 001.49.353c.153.027.307.05.461.07a12.016 12.016 0 001.578.123l.06.003c.4 0 .792-.021 1.18-.06-13.949-3.327-8.645-18.924-.114-17.68 0 0-1.469-.41-3.389-.398zm2.436 2.762a3.355 3.355 0 103.354 3.356 3.355 3.355 0 00-3.354-3.356zm-5.95 2.192S2.82 23.09 16.172 23.196a11.978 11.978 0 007.743-9.992c.033-.319.043-.644.05-.97.001-.085.013-.168.013-.255 0-.371-.023-.737-.056-1.1-3.527 13.887-19.132 8.448-17.77-.063z"></path>
            </svg>
          </p>
          <p class="m-0 ml-3 p-0 fz-15">Вы неправильно указали путь или название страницы</p>
        </span>
        <span class="m-0 mt-1 ml-2 d-flex flex-row align-items-center">
          <p class="m-0 p-0">
            <svg fill="var(--main-menu-icon-color)" width="15px" height="15px" viewBox="0 0 24 24">
              <path d="M12.265.002a11.911 11.911 0 00-2.437.204c13.876 1.704 10.27 17.94 1.717 17.819 0 0 12.453 1.625 11.673-10.215A11.911 11.911 0 0012.265.002zM8.213.827c-.2.002-.402.008-.61.016A11.856 11.856 0 00.146 13.608C2.93-.421 18.805 4.122 17.9 12.688c0 0 2.85-12.014-9.688-11.861zm1.454 5.035C6.002 5.886.691 7.45.816 16.344a12.013 12.013 0 002.897 4.33c.052.051.108.1.162.149a12.02 12.02 0 001.137.926c.061.044.12.092.181.135a11.93 11.93 0 001.312.779c.132.068.266.13.4.193a11.854 11.854 0 001.199.486c.1.034.195.077.297.109a11.874 11.874 0 001.49.353c.153.027.307.05.461.07a12.016 12.016 0 001.578.123l.06.003c.4 0 .792-.021 1.18-.06-13.949-3.327-8.645-18.924-.114-17.68 0 0-1.469-.41-3.389-.398zm2.436 2.762a3.355 3.355 0 103.354 3.356 3.355 3.355 0 00-3.354-3.356zm-5.95 2.192S2.82 23.09 16.172 23.196a11.978 11.978 0 007.743-9.992c.033-.319.043-.644.05-.97.001-.085.013-.168.013-.255 0-.371-.023-.737-.056-1.1-3.527 13.887-19.132 8.448-17.77-.063z"></path>
            </svg>
          </p>
          <p class="m-0 ml-3 p-0 fz-15">Страница была удалена со времени вашего последнего посещения</p>
        </span>

        <p class="fz-15 m-0 mt-3 text-center">Для продолжения работы с сайтом вы можете перейти на <a class="fz-16 text-white font-weight-bold" href="./">главную страницу</a>.</p>
      </div>
    </div>

    <div class="row main-footer w-100"><? include("includes/footer.php"); ?></div>
  </body>
</html>