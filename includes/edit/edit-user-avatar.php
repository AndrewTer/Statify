<?
  include("requests/user-info.php");
?>
<p class="title-awards-info fz-17 text-center mt-2 mb-2">Фотография профиля</p>
<hr class="hr-user-info">

<div class="container" id="block-upload-user-avatar">
<?
  if ($avatar_exists) 
    echo '<img id="user-avatar" src="users/'.$user_uuid.'/'.get_latest_avatar($user_uuid).'" alt="'.$user_fullname.'">';
  else
    echo '<img id="user-avatar" src="imgs/no-avatar.png" alt="'.$user_fullname.'">';
?>
  <div class="modal fade" id="crop-user-avatar-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title text-center" id="modalLabel">Выбор миниатюры</h5>
          <p class="modal-close" data-dismiss="modal" aria-label="Close">
            <svg viewBox="0 0 48 48" width="25px" height="25px" xmlns="http://www.w3.org/2000/svg" class="svg-close-icon">
              <rect width="48" height="48" fill="none"></rect>
              <path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
            </svg>
          </p>
        </div>

        <div class="modal-body">
          <div class="img-container">
            <img id="selected-avatar-image" >
          </div>
        </div>

        <div class="modal-footer p-2">
          <button type="button" class="btn btn-standard w-100 m-0" id="crop">Обрезать</button>
        </div>
      </div>
    </div>
  </div>
</div>

<hr class="hr-user-info mb-0">

<div class="m-0 p-0" id="edit-user-profile-group-btn">
<?
  $latest_avatar_date = get_latest_avatar_date_upload($user_uuid);
  
  if (check_email_confirmed($user_uuid))
    if ($latest_avatar_date == 'success' && $page_status)
      echo '<div class="col-12 m-0 p-2" id="save-uploaded-avatar">
              <input type="submit" class="btn btn-standard w-100 m-0" id="btn-save-new-avatar" value="Сохранить фотографию" onclick="event.preventDefault();saveNewUserAvatar();">
            </div>

            <div class="col-12 m-0 p-0" id="upload-new-avatar">
              <label class="upload-user-photo-label w-100 text-center m-0" data-toggle="modal" data-target="#updateUserProfilePhotoModal" for="input-new-user-avatar">Выбрать фотографию</label>
              <input type="file" name="image" id="input-new-user-avatar" accept="image/jpeg, image/jpg, image/png, image/webp, image/bmp">
            </div>';
    else
      echo '<div class="col-12 m-0 p-2">
              <div class="error-upload-user-photo-text text-center">Для обновления фотографии профиля с момента последнего обновления должна пройти неделя</div>
            </div>';
  else
    echo '<div class="col-12 m-0 p-2">
              <div class="error-upload-user-photo-text text-center">Для обновления фотографии профиля у вас должен быть подтверждённый email</div>
            </div>';
?>
</div>

<script type="text/javascript" src="js/crop/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/crop/cropper.js"></script>
<script>
  window.addEventListener('DOMContentLoaded', function () {
    var avatar = document.getElementById('user-avatar');
    var image = document.getElementById('selected-avatar-image');
    var inputNewUserAvatar = document.getElementById('input-new-user-avatar');
    var $saveBtn = $('#save-uploaded-avatar');
    var $modal = $('#crop-user-avatar-modal');
    var cropper;

    if (inputNewUserAvatar)
    {
      inputNewUserAvatar.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
          inputNewUserAvatar.value = '';
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
      var initialAvatarURL;
      var canvas;

      $modal.modal('hide');

      if (cropper) {
        canvas = cropper.getCroppedCanvas({
          width: 500,
          height: 500,
        });

        avatar.src = canvas.toDataURL();
        $saveBtn.show();
      }
    });
  });
</script>