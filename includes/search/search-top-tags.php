<div class="block-user-content m-0 text-center d-none d-md-block">
  <h5 class="title-user-info fz-14 font-weight-bold m-0 p-1 text-center">Популярные теги</h5>
  <hr class="hr-user-info">

  <div class="row m-0 p-0">
<?
    $tags_array = get_top_tags($user_uuid);

    if (!is_null($tags_array))
    {
?>
    <ul class="tags-list p-0 m-0 d-flex flex-wrap">
<?
      for ($tags_num = 0; $tags_num < count($tags_array); $tags_num++)
      {
        echo '<a href="search?q='.$tags_array[$tags_num].'"><li class="font-weight-bold">'.$tags_array[$tags_num].'</li></a>';
      }
?>
    </ul>
<?
    }else
    {
?>
    <p class="fz-13 m-0 p-0 text-center w-100">Список тегов пуст</p>
<?
    }
?>
  </div>
</div>