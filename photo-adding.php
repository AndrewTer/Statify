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
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Statify - это сервис для оценивания фотографий, где любой желающий может выложить свою фотографию! Делитесь своими фотографиями, оценивайте фотографии других пользователей, сохраняйте понравившиеся, формируйте свой рейтинг, комментируйте, добавляйте новых друзей!">
    <meta name="Keywords" content="фотографии, сохранения, статистика, комментарии, сервис, оценка, оценивание, рейтинг">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main/main.css">
    <link rel="stylesheet" type="text/css" href="css/main/svg.css">
    <link rel="stylesheet" type="text/css" href="css/main/header-footer.css">
    <link rel="stylesheet" type="text/css" href="css/main/menu.css">
    <link rel="stylesheet" type="text/css" href="css/main/user-page.css">
    <link rel="stylesheet" type="text/css" href="css/main/notifications.css">
    <link rel="stylesheet" type="text/css" href="css/main/photo.css">
    <link rel="stylesheet" type="text/css" href="css/main/modals.css">
    <link rel="stylesheet" type="text/css" href="css/main/animation.css">
    <link rel="stylesheet" type="text/css" href="css/main/adaptive.css">
    <link rel="stylesheet" type="text/css" href="css/cropper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src='js/libs/jquery-3.6.4.js'></script>

    <noscript>
      <meta http-equiv="refresh" content="0; url=noscript">
    </noscript>

    <title>Новая фотография | Statify</title>
  </head>
  <body>
    <div class="row main-header fixed-top"><? include("includes/header/header.php"); ?></div>

    <div class="container-fluid main-body p-0">
      <div class="row main-block m-0">
        <div class="main-menu d-none d-lg-block col-lg-2 col-xl-2 navbar-container"><? include("includes/menu.php"); ?></div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 main-content">
          <div class="content container-fluid m-0 p-0">
            <div class="block-user-content w-100 m-0 p-0">
              <p class="title-awards-info fz-17 text-center mt-2 mb-2 font-weight-bold">Загрузка новой фотографии</p>
              <hr class="hr-user-info mb-0">

              <section class="m-0 p-0 add-new-photo-section d-flex flex-row align-items-stretch">
                <div class="w-50 m-0 p-4 add-new-photo-block" id="block-upload-user-photo">
                  <img id="new-user-photo" src="imgs/no-avatar.png" alt="<?= $user_fullname; ?>">

                  <div class="modal fade" id="crop-user-photo-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h5 class="modal-title text-center font-weight-bold" id="modalLabel">Выбор миниатюры</h5>
                          <p class="modal-close" data-dismiss="modal" aria-label="Close">
                            <svg viewBox="0 0 48 48" width="25px" height="25px" class="svg-close-icon">
                              <rect width="48" height="48" fill="none"></rect>
                              <path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
                            </svg>
                          </p>
                        </div>

                        <div class="modal-body">
                          <div class="img-container">
                            <img id="selected-new-user-photo">
                          </div>
                        </div>

                        <div class="modal-footer p-2">
                          <button type="button" class="btn btn-standard fz-14 w-100 m-0" id="crop">Обрезать</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="m-0 p-4 w-50 d-flex flex-column justify-content-center add-new-photo-block" id="block-upload-user-photo-input">
<?
                $latest_user_photo_date_upload = get_latest_user_photo_date_upload($user_uuid);

                if (check_email_confirmed($user_uuid))
                {
                  if ($latest_user_photo_date_upload == 'success' && $page_status)
                  {
?>
                  <div class="tags-block w-100 m-0 mt-0 mb-auto p-0">
                    <div class="tags-block-content m-0">
                      <input class="input-field w-100" id="new-photo-tags-add" type="text" spellcheck="false" placeholder="Введите теги через Enter или через запятую">

                      <div class="tags-block-details w-100 m-0 mt-3 d-flex flex-row">
                        <div class="p-0 m-0 ml-2 mr-auto d-flex justify-content-start align-items-center">
                          <p class="fz-13 font-weight-bold p-0 m-0">Осталось:&nbsp;<span>15</span></p>
                        </div>
                        <div class="p-0 m-0 mr-2 ml-auto d-flex justify-content-end align-items-center">
                          <p class="fz-13 p-0 m-0 btn-delete-tags">Удалить теги</p>
                        </div>
                      </div>

                      <ul class="p-0 mt-3 mb-3 d-flex flex-wrap" id="new-tags-list"></ul>
                    </div>
                  </div>

                  <div class="m-0 mb-0 mt-auto p-0 w-100 d-flex flex-column" id="upload-new-user-photo-group-btn">
                    <div class="w-100 m-0 p-0" id="save-uploaded-photo">
                      <input type="submit" class="btn btn-standard w-100 m-0 fz-14" id="btn-save-new-photo" value="Завершить загрузку" onclick="event.preventDefault();saveNewUserPhoto();">
                    </div>

                    <div class="w-100 m-0 mt-2 p-0 btn btn-skip pointer" id="upload-new-photo">
                      <label class="fz-14 font-weight-bold w-100 text-center m-0" data-toggle="modal" data-target="#addNewPhotoModal" for="input-new-user-photo">Выбрать фотографию</label>
                      <input type="file" name="image" id="input-new-user-photo" accept="image/jpeg, image/jpg, image/png, image/webp, image/bmp">
                    </div>
                  </div>
<?
                  }else
                    echo '<div class="w-100 m-0 p-2">
                            <div class="error-upload-user-photo-text text-center fz-16">Для добавления новой фотографии с момента последней загрузки должна пройти как минимум неделя</div>
                          </div>';
                }else
                  echo '<div class="w-100 m-0 p-2">
                          <div class="error-upload-user-photo-text text-center fz-16">Для добавления фотографии у вас должен быть подтверждённый email</div>
                        </div>';
?>
                </div>
              </section>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row main-footer w-100"><? include("includes/footer.php"); ?></div>

    <script type="text/javascript" src="js/libs/crop/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/libs/crop/cropper.js"></script>
    <script defer type="text/javascript" src="js/photo_add.js"></script>
    <script defer type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/libs/popper.min.js"></script>
    <script type="text/javascript" src="js/libs/bootstrap.min.js"></script>
    <script>
      window.addEventListener('DOMContentLoaded', function () {
        var newPhoto = document.getElementById('new-user-photo');
        var image = document.getElementById('selected-new-user-photo');
        var inputNewUserPhoto = document.getElementById('input-new-user-photo');
        var $saveBtn = $('#save-uploaded-photo');
        var $modal = $('#crop-user-photo-modal');
        var cropper;

        if (inputNewUserPhoto)
        {
          inputNewUserPhoto.addEventListener('change', function (e) {
            var files = e.target.files;
            var done = function (url) {
              inputNewUserPhoto.value = '';
              image.src = url;
              $saveBtn.hide();
              $modal.modal({backdrop: "static"});
              $modal.modal('show');
            };

            var reader;
            var file;
            var url;

            if (files && files.length > 0) {
              file = files[0];

              if (URL) {
                done(URL.createObjectURL(file));
              } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                  done(reader.result);
                };
                reader.readAsDataURL(file);
              }
            }
          });
        }

        $modal.on('shown.bs.modal', function () {
          cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
          });
        }).on('hidden.bs.modal', function () {
          cropper.destroy();
          cropper = null;
        });

        document.getElementById('crop').addEventListener('click', function () {
          var initialPhotoURL;
          var canvas;

          $modal.modal('hide');

          if (cropper) {
            canvas = cropper.getCroppedCanvas({
              width: 700,
              height: 700,
            });

            newPhoto.src = canvas.toDataURL();
            $saveBtn.show();
          }
        });
      });
    </script>
  </body>
</html>
<?
  } else
    header("Location: login");
?>