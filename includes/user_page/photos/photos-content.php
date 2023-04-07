<script defer type="text/javascript" src="js/photo.js"></script>
<?
  if (ban_check($current_user_uuid) == 'success')
  {
    $photos_list = get_photos_list($current_user_uuid);
    $years_list = get_photos_years_list($current_user_uuid);

    if ($photos_list && $years_list)
    {
?>
      <div class="col-md-10 p-0 h-100 pr-md-3" id="block-with-photos-by-user">
<?
      for ($years_num = 0; $years_num < count($years_list); $years_num++)
      {
        $year_value = $years_list[$years_num][0];
?>
        <div class="col-12 p-0">
          <div class="hr-with-text">
            <span class="m-0" id="<?= $year_value; ?>"><?= $year_value.'&nbsp;год'; ?></span>
          </div>

          <div class="row m-0 mt-3 mb-3 p-2 justify-content-start block-search-and-sort">
<?
        for ($photos_num = 0; $photos_num < count($photos_list); $photos_num++)
        {
          $photo_file = $photos_list[$photos_num][0];
          $photo_creation_date = $photos_list[$photos_num][1];

          if ($photo_creation_date == $year_value)
          {
            $hash_modal = sha1($current_user_uuid.$photo_file);
?>
            <div class="profile-picture-card">
              <div class="mx-auto d-block profile-picture-card-avatar">
                <img class="offline border-radius-15 pointer" src="<?= 'users/'.$current_user_uuid.'/'.$photo_file; ?>" alt="<?= get_user_fullname($current_user_uuid); ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$user_uuid.'\',\''.$current_user_uuid.'\',\''.$photo_file.'\''; ?>);">
              </div>
            </div>
<?
          }
        }
?>
          </div>
        </div>
<?
      }
?>
        <div class="w-100 d-flex justify-content-center">
<?
        $page1left = $page2left = $page1right = $page2right = $pervpage = $nextpage = '';
        
        $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
        $total_count_photo_pages = intval((get_photos_count($user_uuid) - 1) / 1000) + 1;

        if ($page != 1) $pervpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="photos?page=1"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a><a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="photos?page='. ($page - 1) .'"><i class="fa fa-angle-left" aria-hidden="true"></i></a>';

        if ($page != $total_count_photo_pages) $nextpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="photos?page='. ($page + 1) .'"><i class="fa fa-angle-right" aria-hidden="true"></i></a><a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="photos?page=' .$total_count_photo_pages. '"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';

        if ($page - 2 > 0) $page2left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="photos?page='. ($page - 2) .'">'. ($page - 2) .'</a>';
        if ($page - 1 > 0) $page1left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="photos?page='. ($page - 1) .'">'. ($page - 1) .'</a>';
        if ($page + 2 <= $total_count_photo_pages) $page2right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="photos?page='. ($page + 2) .'">'. ($page + 2) .'</a>';
        if ($page + 1 <= $total_count_photo_pages) $page1right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="photos?page='. ($page + 1) .'">'. ($page + 1) .'</a>';

        if ($total_count_photo_pages > 1)
          echo $pervpage.$page2left.$page1left.'<p class="fz-13 m-2 pt-1 pb-1 current-page-num d-flex justify-content-center align-items-center">'.$page.'</p>'.$page1right.$page2right.$nextpage;
?>
        </div>

      </div>

      <div class="col-md-2 d-none d-md-block section-search-and-sort mb-3 p-0" id="photo-menu">
<?
        include('photos-menu.php');
?>
      </div>
<?
    }else
      echo '
      <div class="p-0 w-100 h-100">
        <div class="w-100 p-0">
          <span class="d-flex justify-content-center p-5 w-100">
            <strong class="h5 text-center">'.(($user_uuid == $current_user_uuid) ? 'У вас пока нет фотографий' : 'У пользователя нет фотографий').'</strong>
          </span>
        </div>
      </div>';
  }else
  {
?>
    <div class="w-100 m-0 p-0"><?= ban_user_message($current_user_uuid); ?></div>
<?
  }
?>