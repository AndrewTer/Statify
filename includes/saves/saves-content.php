<?
  $saves_list = get_saves_list($user_uuid);
  $years_list = get_saves_years_list($user_uuid);

  if ($saves_list && $years_list)
  {
?>
    <div class="col-md-10 p-0 h-100 pr-md-3" id="saves-content-list">
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
      for ($saves_num = 0; $saves_num < count($saves_list); $saves_num++)
      {
        $photo_file = $saves_list[$saves_num][0];
        $photo_file_user_uuid = $saves_list[$saves_num][1];
        $photo_creation_date = $saves_list[$saves_num][2];

        if ($photo_creation_date == $year_value)
        {
          $hash_modal = sha1($user_uuid.$photo_file);

          echo '<div class="saved-card">
                  <div class="mx-auto d-block saved-picture-card">
                    <img class="offline border-radius-10 pointer" 
                          src="users/'.$photo_file_user_uuid.'/'.$photo_file.'" 
                          alt="'.get_user_fullname($photo_file_user_uuid).'" 
                          onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$photo_file_user_uuid.'\',\''.$photo_file.'\');">
                  </div>
                </div>';
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
      $total_count_saves_pages = intval((get_saves_count($user_uuid) - 1) / 60) + 1;

      if ($page != 1) $pervpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="saves?page=1"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a><a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="saves?page='. ($page - 1) .'"><i class="fa fa-angle-left" aria-hidden="true"></i></a>';

      if ($page != $total_count_saves_pages) $nextpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="saves?page='. ($page + 1) .'"><i class="fa fa-angle-right" aria-hidden="true"></i></a><a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="saves?page=' .$total_count_saves_pages. '"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';

      if ($page - 2 > 0) $page2left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="saves?page='. ($page - 2) .'">'. ($page - 2) .'</a>';
      if ($page - 1 > 0) $page1left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="saves?page='. ($page - 1) .'">'. ($page - 1) .'</a>';
      if ($page + 2 <= $total_count_saves_pages) $page2right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="saves?page='. ($page + 2) .'">'. ($page + 2) .'</a>';
      if ($page + 1 <= $total_count_saves_pages) $page1right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="saves?page='. ($page + 1) .'">'. ($page + 1) .'</a>';

      if ($total_count_saves_pages > 1)
        echo $pervpage.$page2left.$page1left.'<p class="fz-13 m-2 pt-1 pb-1 current-page-num d-flex justify-content-center align-items-center">'.$page.'</p>'.$page1right.$page2right.$nextpage;
?>
      </div>

    </div>

    <div class="col-md-2 d-none d-md-block section-search-and-sort mb-3" id="saves-menu">
<?
      include('includes/saves/saves-menu.php');
?>
    </div>
<?
  }else
  {
?>
    <div class="p-0 w-100 h-100">
      <div class="w-100 p-0">
        <span class="d-flex justify-content-center p-5 w-100">
          <strong class="h5 text-center">У вас пока нет сохранений</strong>
        </span>
      </div>
    </div>
<?
  }
?>