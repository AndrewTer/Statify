<?
  if (user_friendly_status($user_uuid, $photo_user_uuid) == 'friend' || !check_only_friends_can_rate_photos($photo_user_uuid))
  {
?>
<div class="block-search-and-sort mt-3 p-0 text-center d-none d-md-block" id="comments-block-user-rating">
  <div class="m-0 p-0" id="comments-rating-area">
    <p class="fz-14 font-weight-bold m-0 p-2">Моя оценка</p>
    <hr class="hr-user-info m-0 mb-2">
<?
    $current_photo_rating_value = get_user_rating_from_current_user($user_uuid, $photo_user_uuid, $photo_uuid);

    if ($current_photo_rating_value >= 1 && $current_photo_rating_value <= 5)
    {
      echo '<div class="row m-0 p-0 mt-2 mb-2 ml-3 mr-3 d-flex align-items-center justify-content-center">';

      for ($stars_count = 0; $stars_count < 5; $stars_count++)
        if ($stars_count <= $current_photo_rating_value - 1)
          echo '<i class="fa fa-star-o active-star fz-18 p-1" aria-hidden="true"></i>';
        else
          echo '<i class="fa fa-star-o inactive-star fz-18 p-1" aria-hidden="true"></i>';
    
      echo '</div>';
    }else
      if (get_latest_avatar($user_uuid))
        echo '
          <div class="row m-0 p-0 mt-2 mb-2 ml-3 mr-3 d-flex align-items-center justify-content-center">
            <div class="rating-area m-0 p-0 d-flex flex-row-reverse justify-content-center" id="rate-user">
              <input type="radio" class="rating-radio p-1" id="star-5" name="rating" value="5">
              <label for="star-5" class="fz-18 m-0 p-1 pl-2 pr-2" title="Оценка «5»"><i class="fa fa-star-o"></i></label>

              <input type="radio" class="rating-radio p-1 pl-2 pr-2" id="star-4" name="rating" value="4">
              <label for="star-4" class="fz-18 m-0 p-1 pl-2 pr-2" title="Оценка «4»"><i class="fa fa-star-o"></i></label>

              <input type="radio" class="rating-radio p-1 pl-2 pr-2" id="star-3" name="rating" value="3">
              <label for="star-3" class="fz-18 m-0 p-1 pl-2 pr-2" title="Оценка «3»"><i class="fa fa-star-o"></i></label>

              <input type="radio" class="rating-radio p-1 pl-2 pr-2" id="star-2" name="rating" value="2">
              <label for="star-2" class="fz-18 m-0 p-1 pl-2 pr-2" title="Оценка «2»"><i class="fa fa-star-o"></i></label>

              <input type="radio" class="rating-radio p-1" id="star-1" name="rating" value="1">
              <label for="star-1" class="fz-18 m-0 p-1 pl-2 pr-2" title="Оценка «1»"><i class="fa fa-star-o"></i></label>
            </div>
          </div>

          <hr class="hr-user-info m-0">

          <p class="fz-14 fw-700 m-0 p-0" id="view-all-photos">
            <a class="d-block m-0 p-2" 
                onclick="event.preventDefault();addRatingInComments(\''.$user_uuid.'\', \''.$photo_user_uuid.'\', \''.$photo_name.'\');">Оценить</a>
          </p>';
?>
  </div>
</div>
<?
  }
?>