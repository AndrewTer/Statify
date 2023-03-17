<div class="row search-result-list col-12 col-md-8 p-0 m-0" id="block-search-result">
<?
  if ($page_status)
  {
?>
  <div id="block-search">

    <div class="col-12 p-0">
      <div class="search-card ml-0 mr-0 mt-0" id="all-search-card">
        <div class="row m-0 input-with-icon">
          <i class="fa fa-search" aria-hidden="true"></i>
          <input type="text" class="fz-14 w-100 p-1 input-field col-9 col-sm-10" id="search-users-field" placeholder="Поиск" autocomplete="off">
          <div class="col-3 col-sm-2 m-0 p-0 pl-2">
            <input type="submit" class="btn btn-standard w-100 h-100 m-0 p-0" onclick="event.preventDefault();searchUsers();" value="Найти">
          </div>
        </div>
      </div>
    </div>

<?
      $search_text = !empty($_GET['q']) ? htmlspecialchars($_GET['q']) : '';

      include("requests/search-result.php");
?>

    <div class="col-12 p-0 block-search-result-content">
<?
        if ($result_list = pg_fetch_array($search_query))
        {
          do {
            $search_uuid = $result_list[0];
            $search_nickname = '@'.get_user_nickname($search_uuid);

            $friendly_user_status = user_friendly_status($user_uuid, $search_uuid);

            switch ($friendly_user_status) {
              case 'friend':
                include("includes/search/search-content-friend.php");
                break;

              default:
                include("includes/search/search-content-user.php");
                break;
            }
          }while ($result_list = pg_fetch_array($search_query));
        }else
          echo '<span class="d-flex justify-content-center p-5 w-100 text-center"><strong class="h5" id="search-notification">Поиск не дал результатов</strong></span>';
?>
      <div class="w-100 d-flex justify-content-center">
<?
      $page1left = $page2left = $page1right = $page2right = $pervpage = $nextpage = '';
      
      ($search_text != '') ? $url_text = "search?q=".$search_text."&page=" : $url_text = "search?page=";

      if ($page != 1) $pervpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="'.$url_text.'1"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a><a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="'.$url_text.($page - 1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a>';

      if ($page != $total_count_search_pages) $nextpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="'.$url_text.($page + 1).'"><i class="fa fa-angle-right" aria-hidden="true"></i></a><a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="'.$url_text.$total_count_search_pages.'"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';

      if($page - 2 > 0) $page2left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="'.$url_text.($page - 2).'">'.($page - 2).'</a>';
      if($page - 1 > 0) $page1left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="'.$url_text.($page - 1).'">'.($page - 1).'</a>';
      if($page + 2 <= $total_count_search_pages) $page2right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="'.$url_text.($page + 2).'">'.($page + 2).'</a>';
      if($page + 1 <= $total_count_search_pages) $page1right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="'.$url_text.($page + 1).'">'.($page + 1).'</a>';

      if ($total_count_search_pages > 1)
        echo $pervpage.$page2left.$page1left.'<p class="fz-13 m-2 pt-1 pb-1 current-page-num d-flex justify-content-center align-items-center">'.$page.'</p>'.$page1right.$page2right.$nextpage;
?>
      </div>

    </div>
    <script type="text/javascript" src="js/friendship.js"></script>

  </div>
<?
  }else
  {
?>
  <span class="d-flex justify-content-center p-5 w-100 text-center"><strong class="h5">Поиск недоступен</strong></span>
<?
  }
?>

</div>

<div class="col-12 col-md-4 section-search-and-sort mb-3">
<?
  include('includes/search/search-top-tags.php');
?>
</div>