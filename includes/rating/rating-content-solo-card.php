<?
  define('mystatify', true);
  require_once("../connection.php");
  include("../../functions/functions.php");
  include("../../functions/database-functions.php");
  include("../../functions/functions-for-check.php");
  include("../../functions/functions-user-data.php");
  include("../../functions/functions-for-rating.php");
  include("../../functions/functions-modals.php");

  $cookie_login = $_COOKIE['login'];
  $cookie_key = $_COOKIE['key'];

  $user_uuid = get_user_uuid_by_cookie($cookie_login, $cookie_key);
  $avatar_exists = get_latest_avatar($user_uuid);
?>
<div class="m-0 p-0 d-flex justify-content-center align-items-center" id="solo-rating-card-block">
  <div class="row m-0">
    <div class="container d-flex justify-content-center p-0" id="rating-block">
<?
    if (check_email_confirmed($user_uuid))
    {
      if ($avatar_exists)
      {
        $rate_photo_name = get_new_rating_card($user_uuid);
        $rate_user_uuid = get_user_uuid_by_rating_photo($rate_photo_name);

        if($rate_user_uuid)
        {
?>
        <div class="card p-3 rating-card">
          <div class="d-flex flex-column align-items-center">
            <img src="users/<?= $rate_user_uuid.'/'.$rate_photo_name; ?>" class="rounded rating-card-photo" id="rating-user-photo" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$user_uuid.'\',\''.$rate_user_uuid.'\',\''.$rate_photo_name.'\', 1'; ?>);" alt="<?= get_user_fullname($rate_user_uuid); ?>">
            
            <div class="rating-area solo m-0 mt-3 mb-3 p-0 text-center" onclick="getActive();">
              <input type="radio" class="rating-radio" id="star-5" name="rating" value="5">
              <label for="star-5" class="fz-25 m-0" title="Оценка «5»"><i class="fa fa-star-o"></i></label> 
              <input type="radio" class="rating-radio" id="star-4" name="rating" value="4">
              <label for="star-4" class="fz-25 m-0" title="Оценка «4»"><i class="fa fa-star-o"></i></label>    
              <input type="radio" class="rating-radio" id="star-3" name="rating" value="3">
              <label for="star-3" class="fz-25 m-0" title="Оценка «3»"><i class="fa fa-star-o"></i></label>  
              <input type="radio" class="rating-radio" id="star-2" name="rating" value="2">
              <label for="star-2" class="fz-25 m-0" title="Оценка «2»"><i class="fa fa-star-o"></i></label>    
              <input type="radio" class="rating-radio" id="star-1" name="rating" value="1">
              <label for="star-1" class="fz-25 m-0" title="Оценка «1»"><i class="fa fa-star-o"></i></label>
            </div>
                
            <div class="button d-flex flex-row align-items-center"> 
              <button class="btn btn-sm btn-skip mr-2 fz-13 skip-rate-btn" id="skip-rate-btn" onclick="event.preventDefault();skipRating(<?= '\''.$user_uuid.'\', \''.$rate_user_uuid.'\', \''.$rate_photo_name.'\''; ?>);">Пропустить</button>
              <button class="btn btn-sm btn-standard ml-2 fz-13" id="rate-btn" onclick="event.preventDefault();addRating(<?= '\''.$user_uuid.'\', \''.$rate_user_uuid.'\', \''.$rate_photo_name.'\''; ?>);" disabled>Оценить</button> 
            </div>
          </div>
        </div>
<?
        } else 
            echo '<span class="d-flex justify-content-center p-5 w-100 text-center"><strong class="h4">Некого оценивать</strong></span>';
      } else
          echo '<span class="fz-15 d-flex justify-content-center p-5 w-100 text-center">Вы не можете оценивать фотографии пользователей пока не загрузите фотографию профиля</span>';
    } else
      echo '<span class="fz-15 d-flex justify-content-center p-5 w-100 text-center">Вы не можете оценивать фотографии пользователей пока не подтвердите email</span>';
?>
    </div>
  </div>
</div>

<script type="text/javascript" src="js/rating.js"></script>