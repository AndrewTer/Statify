<?
if (user_friendly_status($user_uuid, $photo_user_uuid) == 'friend' || $user_uuid == $photo_user_uuid)
{
  $photos_list = get_photos_list($photo_user_uuid);

  if ($photos_list && count($photos_list) > 1)
  {
    echo '
    <div class="block-search-and-sort mt-3 p-0 text-center d-none d-md-block">
      <p class="fz-14 font-weight-bold m-0 p-2">Другие фотографии</p>
      <hr class="hr-user-info m-0"> 

      <div class="m-2 p-0 other-user-pictures-list">';

    $max_photos_num = (count($photos_list) > 6) ? 7 : count($photos_list);

    for ($photos_num = 0; $photos_num < $max_photos_num; $photos_num++)
    {
      $photo_file = $photos_list[$photos_num]['name'];

      if ($photo_file != $photo_name)
      {
        echo '
          <div class="other-picture-card">
            <div class="mx-auto d-block other-picture-card-img">
              <img class="offline pointer border-radius-15" 
                    src="users/'.$photo_user_uuid.'/'.$photo_file.'"
                    alt="'.get_user_fullname($photo_user_uuid).'" 
                    onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$photo_user_uuid.'\',\''.$photo_file.'\');">
            </div>
          </div>';
      }
    }
    
    echo '</div>';

    if (count($photos_list) > 6)
      echo '
        <hr class="hr-user-info m-0">
        <p class="fz-14 fw-700 m-0 p-0" id="view-all-photos">
          <a class="d-block m-0 p-2" href="./?u='.get_user_nickname($photo_user_uuid).'">Все фотографии</a>
        </p>';

    echo '</div>';
  }
}
?>