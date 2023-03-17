<?php
  include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Авторизация на сайте Statify! Оценивайте других пользователей, просматривайте свою статистику, оставляйте комментарии, добавляйте друзей!">
    <meta name="Keywords" content="сервис, оценка, оценивание, просмотр статистики, фотографии, рейтинг, авторизация, регистрация">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main/main.css">
    <link rel="stylesheet" type="text/css" href="css/main/svg.css">
    <link rel="stylesheet" type="text/css" href="css/main/header-footer.css">
    <link rel="stylesheet" type="text/css" href="css/main/menu.css">
    <link rel="stylesheet" type="text/css" href="css/main/login.css">
    <link rel="stylesheet" type="text/css" href="css/main/modals.css">
    <link rel="stylesheet" type="text/css" href="css/main/animation.css">
    <link rel="stylesheet" type="text/css" href="css/main/adaptive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <noscript>
      <meta http-equiv="refresh" content="0; url=noscript">
    </noscript>

    <title>Statify</title>
  </head>
  <body>

    <div class="row main-header fixed-top"><? include("includes/header/header-login.php"); ?></div>

    <div class="container-fluid main-body p-0">
      <div class="login-content text-white">
        <div class="row" style="min-height: 88vh;">

          <div class="col-12 col-sm-7 col-md-8 col-lg-8 col-xl-8 content-section h-100 justify-content-center align-self-center">
            <p class="fz-16 m-0"><strong id="service-name" class="fz-20 text-white">Statify</strong> - сервис для оценивания фотографий людей.</p>
            <hr class="hr-user-info mt-2 mb-2">
            <p><i class="fa fa-dot-circle-o pl-2 pr-2" aria-hidden="true"></i>&#32;Делись своими фотографиями</p>
            <p><i class="fa fa-dot-circle-o pl-2 pr-2" aria-hidden="true"></i>&#32;Оценивай фотографии других пользователей</p>
            <p><i class="fa fa-dot-circle-o pl-2 pr-2" aria-hidden="true"></i>&#32;Формируй свой рейтинг</p>
            <p><i class="fa fa-dot-circle-o pl-2 pr-2" aria-hidden="true"></i>&#32;Добавляй новых друзей</p>
            <div class="m-0 p-0 d-flex justify-content-center">
              <img class="m-0 p-0 w-60" id="login-img" src="imgs/login_cover.png" alt="Обложка для страницы авторизации">
            </div>
          </div>

          <div class="col-12 col-sm-5 col-md-4 col-lg-4 col-xl-4 logreg-section h-100 justify-content-center align-self-center">
            <div class="col-12 login-section">
              <h2 class="fz-25 text-white">Авторизация</h2>

              <form name="loginform" class="login-form m-0" action="" method="POST" onSubmit="return loginValidation();">      
                <div class="form-group m-0 mb-2">
                  <label class="fz-13 font-weight-bold">Email</label>
                  <input type="email" id="email-login" name="loginEmail" class="form-control" placeholder="example@mail.ru">
                  <em class="m-0 p-0" id="email-login-message"></em>             
                </div>

                <div class="form-group m-0 mb-3">
                  <label class="fz-13 font-weight-bold">Пароль</label>
                  <input type="password" id="password-login" name="loginPassword" class="form-control" placeholder="***********">
                  <em id="password-login-message"></em>
                </div>
                    
                <input type="submit" class="btn btn-standard w-100 m-0 fz-15" name="login" value="Войти">

                <div class="text-center mt-2">
                  <a class="fz-15 font-weight-bold text-white pe-auto recovery-link" onclick="event.preventDefault();openRecoveryPasswordModal();">Забыли пароль?</a>
                </div>
              </form>
            </div>

            <div class="col-12 reg-section">
              <h2 class="fz-25 text-white">Регистрация</h2>

              <form name="regform" action="" method="POST" onSubmit="return regValidation();">
                <div class="form-group m-0">
                  <div class="input-group mt-2">
                    <input type="email" name="regEmail" id="email-reg" class="form-control" placeholder="Введите ваш email">
                    <div class="input-group-append"><button type="button" class="btn btn-standard m-0 border-0" onClick="return emailCheck();"><i class="fa fa-envelope text-white"></i></button></div>
                  </div>
                  <em id="email-reg-message"></em>
                </div>

                <div id="full-reg-form" class="collapse m-0">
                  <div class="form-group m-0 mt-3 mb-2">
                    <label class="fz-13 font-weight-bold">Ваше имя</label>
                    <input type="text" name="regUsername" id="username-reg" class="form-control">
                    <em id="username-reg-message"></em>
                  </div>
                  
                  <div class="form-group m-0 mb-2">
                    <label class="fz-13 font-weight-bold">Ваша фамилия</label>
                    <input type="text" name="regUsersurname" id="usersurname-reg" class="form-control">
                    <em id="usersurname-reg-message"></em>
                  </div>
                  
                  <div class="form-group m-0 mb-2">
                    <label class="fz-13 font-weight-bold">Пароль</label>
                    <input type="password" name="regPassword" id="userpassword-reg" class="form-control" placeholder="*******">
                    <em id="userpassword-reg-message"></em>
                  </div>
                  
                  <div class="form-group m-0 mb-2">
                    <label class="fz-13 font-weight-bold">Подтвердить пароль</label>
                    <input type="password" name="regConfirm" id="userconfirm-reg" class="form-control" placeholder="*******">
                    <em id="userconfirm-reg-message"></em>
                  </div>
                  
                  <div class="form-group m-0 mb-2 p-0">
                    <p class="m-0 fz-13 text-center">Создавая аккаунт, я соглашаюсь с <a id="login-link" href="about?sort=rules" target="_blank">правилами сайта</a> и даю согласие на <a id="login-link" href="about?sort=consent" target="_blank">обработку персональных данных</a>.</p>
                  </div>
                  
                  <input type="submit" class="btn btn-success w-100 m-0 fz-15" name="registration" value="Зарегистрироваться">
                </div> 
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row main-footer w-100"><? include("includes/footer.php"); ?></div>
  </body>

  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/login.js"></script>
</html>