<div class="row search-result-list col-12 col-md-8 p-0 m-0" id="block-search-result">
<?
  if ($page_status)
  {
    $search_text = !empty($_GET['q']) ? htmlspecialchars($_GET['q']) : '';
    $search_parameter = !empty($_GET['p']) ? htmlspecialchars($_GET['p']) : '';

    $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;
?>
  <div id="block-search">
    <div class="col-12 p-0">
      <div class="search-card ml-0 mr-0 mt-0 pb-0" id="all-search-card">
        <div class="w-100 m-0 d-flex flex-row align-items-center">
          <p class="m-0 p-0 mr-2">
            <svg width="18px" height="18px" viewBox="0 0 24 24" fill="none">
              <circle cx="10" cy="10" r="6" stroke="var(--main-text-color)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></circle>
              <path d="M14.5 14.5L19 19" stroke="var(--main-text-color)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </p>
          <input type="text" class="fz-14 w-100 p-1 input-field" id="search-users-field" placeholder="Поиск" autocomplete="off" value="<?= $search_text; ?>">
          <div class="m-0 p-0 pl-2">
            <input type="submit" class="btn btn-standard user-profile-action-btn w-100 h-100 m-0 p-1 fz-14" onclick="event.preventDefault();searchUsers();" value="Найти">
          </div>
        </div>
        
        <div class="m-0 mt-2 p-0 d-flex flex-row justify-content-center align-items-center" id="search-parameters-menu">
          <a class="m-0 p-2 fz-15 font-weight-bold pointer <?= ($search_parameter == '' || $search_parameter == 'users') ? 'active' : '';?>" id="search-parameter-users" href="<?= 'search?p=users'.(!empty($_GET['q']) ? '&q='.$search_text : ''); ?>">Пользователи</a>
          <a class="m-0 ml-4 p-2 fz-15 font-weight-bold pointer <?= ($search_parameter == 'tags') ? 'active' : '';?>" id="search-parameter-tags" href="<?= 'search?p=tags'.(!empty($_GET['q']) ? '&q='.$search_text : ''); ?>">Теги</a>
        </div>
      </div>
    </div>

    <div class="col-12 p-0 block-search-result-content">
<?
    if ($search_parameter == '' || $search_parameter == 'users')
    {
      $num = 40;
      include("includes/search/search-content-users.php");
    }

    if ($search_parameter == 'tags')
    {
      $num = 60;

      if ($search_text == '')
        include("includes/search/search-content-top-tags.php");
      else
        include("includes/search/search-content-photos-by-tag.php");
    }
?>
    </div>

    <div class="w-100 d-flex justify-content-center">
<?
    if ($search_parameter == 'tags' && $search_text != '')
      if (!empty($total_count_search_pages) && $page < $total_count_search_pages)
        echo '<a data-page="'.$page.'" data-max="'.$total_count_search_pages.'" data-p="tags" data-q="'.(!empty($_GET['q']) ? $search_text : '').'" id="showmore-search-tags-button" href="#" class="m-0 mt-2 p-0 fz-14 text-center show-more-btn">Показать еще</a>';

    if ($search_parameter == '' || $search_parameter == 'users')
      if (!empty($total_count_search_pages) && $page < $total_count_search_pages)
        echo '<a data-page="'.$page.'" data-max="'.$total_count_search_pages.'" data-p="users" data-q="'.(!empty($_GET['q']) ? $search_text : '').'" id="showmore-search-users-button" href="#" class="m-0 p-0 fz-14 text-center show-more-btn">Показать еще</a>';
?>
    </div>

    <script type="text/javascript" src="js/friendship.js"></script>
  </div>
<?
  }else
    echo '<span class="d-flex justify-content-center p-5 w-100 text-center"><strong class="h5">Поиск недоступен</strong></span>';
?>
</div>

<div class="col-12 col-md-4 section-search-and-sort mb-3"><? include('includes/search/search-top-tags.php'); ?></div>

