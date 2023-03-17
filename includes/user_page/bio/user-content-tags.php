<div class="block-user-content mt-3 <?= (!check_user_page_status($user_uuid)) ? 'page-not-completed-user-info-hide' : ''; ?>" id="user-info-tags">
<?
  if ($page_status)
  {
?>
  <h5 class="title-user-info">Теги</h5>
  <hr class="hr-user-info">

  <div class="row m-0 p-0">
<?
    $tags_array = get_user_tags($user_uuid);

    if (!is_null($tags_array))
    {
      echo '<ul class="tags-list p-0 m-0 d-flex flex-wrap">';

      for ($tags_num = 0; $tags_num < count($tags_array); $tags_num++)
        echo '<a href="search?q='.$tags_array[$tags_num].'"><li>'.$tags_array[$tags_num].'</li></a>';

      echo '</ul>';
    }else
      echo '<p class="fz-13 m-0 p-0 text-center w-100">Список тегов пуст</p>';
?>
  </div>
<?
  }else
    echo '<h5 class="title-user-info">Теги</h5>
          <hr class="hr-user-info">
          <div class="row m-0 p-0">
            <p class="w-100 text-center f-13 m-0">Отсутствуют</p>
          </div>';
?>
</div>