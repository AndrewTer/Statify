<?
  include("requests/user-news-list.php");

  if ($news_date_list = pg_fetch_row($user_news_date_query))
  {
    $news_list_count = pg_num_rows($user_news_query);
?>
    <div id="block-my-news" class="col-12 p-0">
<?
    do {
      $news_date_main = $news_date_list[0];
?>
      <div class="hr-with-text">
        <span><?= corrected_date_with_text_month($news_date_main); ?></span>
      </div>
<?
      for ($i=0; $i < $news_list_count; $i++)
      {
        $news_list = pg_fetch_array($user_news_query, $i);
        $news_type = $news_list[0];
        $creation_date = $news_list[5];

        if ($creation_date == $news_date_main)
        {
          switch ($news_type) {
            case 'addFriend':
              $friend = $news_list[1];
              new_friend_news($user_uuid, $user_uuid, $friend);
              break;

            case 'profilePhotoUpdate':
              $old_photo = $news_list[2];
              $new_photo = $news_list[3];
              new_profile_photo_news($user_uuid, $user_uuid, $old_photo, $new_photo);
              break;

            default:
              break;
          }
        }
      }
    }while ($news_date_list = pg_fetch_row($user_news_date_query));

    if ($page == $total_count_news_pages)
      echo '<p class="w-100 m-0 mb-2 p-0 text-center font-italic">Все новости прочитаны!</p>';
?>
    </div>
<?
  }else
    echo '<div id="block-user" class="p-0">
            <span class="d-flex justify-content-center p-5 w-100"><strong class="h5 text-center">У вас пока нет новостей</strong></span>
          </div>';
?>

  <div class="w-100 d-flex justify-content-center">
<?
  $page1left = $page2left = $page1right = $page2right = $pervpage = $nextpage = '';

  if ($page != 1) $pervpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="news?sort=mine&page=1" aria-label="Переход на первую страницу с новостями"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a><a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="news?sort=mine&page='. ($page - 1) .'" aria-label="Переход на предыдущую страницу с новостями"><i class="fa fa-angle-left" aria-hidden="true"></i></a>';

  // Проверяем нужны ли стрелки вперед
  if ($page != $total_count_news_pages) $nextpage = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="news?sort=mine&page='. ($page + 1) .'" aria-label="Переход на следующую страницу с новостями"><i class="fa fa-angle-right" aria-hidden="true"></i></a><a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="news?sort=mine&page=' .$total_count_news_pages. '" aria-label="Переход на последнюю страницу с новостями"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';

  // Находим две ближайшие станицы с обоих краев, если они есть
  if($page - 2 > 0) $page2left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="news?sort=mine&page='. ($page - 2) .'" aria-label="Переход на две страницы назад">'. ($page - 2) .'</a>';
  if($page - 1 > 0) $page1left = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="news?sort=mine&page='. ($page - 1) .'" aria-label="Переход на предыдущую страницу с новостями">'. ($page - 1) .'</a>';
  if($page + 2 <= $total_count_news_pages) $page2right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="news?sort=mine&page='. ($page + 2) .'" aria-label="Переход на две страницы вперёд">'. ($page + 2) .'</a>';
  if($page + 1 <= $total_count_news_pages) $page1right = '<a class="fz-13 m-2 pt-1 pb-1 page-num d-flex justify-content-center align-items-center" href="news?sort=mine&page='. ($page + 1) .'" aria-label="Переход на следующую страницу с новостями">'. ($page + 1) .'</a>';

  // Вывод меню
  if ($total_count_news_pages > 1)
    echo $pervpage.$page2left.$page1left.'<p class="fz-13 m-2 pt-1 pb-1 current-page-num d-flex justify-content-center align-items-center">'.$page.'</p>'.$page1right.$page2right.$nextpage;
?>
  </div>