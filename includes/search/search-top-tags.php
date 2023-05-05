<div class="block-user-content m-0 text-center d-none d-md-block">
  <h5 class="title-user-info fz-15 font-weight-bold m-0 p-1 text-center">Популярные теги</h5>
  <hr class="hr-user-info">

  <div class="row m-0 p-0">
<?
  $tags_array = get_top_tags(10);

  if (!is_null($tags_array))
  {
?>
    <ul class="tags-list p-0 m-0 d-flex flex-wrap">
<?
    for ($tags_num = 0; $tags_num < count($tags_array); $tags_num++)
    {
        echo '<a href="search?p=tags&q='.$tags_array[$tags_num]['tag_text'].'">
                <li class="font-weight-bold d-flex flex-row align-items-center">#'.$tags_array[$tags_num]['tag_text'].'&nbsp;&nbsp;
                  <p class="m-0 p-2 d-flex align-items-center justify-content-center" style="border: 1px solid var(--text-border-color); border-radius: 15px; height: 20px; min-width: 20px; background: var(--content-block-bg-color);">'.$tags_array[$tags_num]['tag_count'].'</p>
                </li>
              </a>';
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