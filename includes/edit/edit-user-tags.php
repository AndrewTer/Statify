<p class="fz-17 text-center mt-2 mb-2">Теги</p>
<hr class="hr-user-info"> 
<div class="modal-body">
  <div class="tags-block">
    <div class="tags-block-content">
      <input class="input-field w-100" id="tags-edit" type="text" spellcheck="false" placeholder="Введите теги через Enter или через запятую">
      <ul class="p-0 mt-3 mb-3 d-flex flex-wrap" id="new-tags-list">
<?
        $user_tags_list = get_user_tags($user_uuid);

        if (!is_null($user_tags_list))
          for ($tags_num = 0; $tags_num < count($user_tags_list); $tags_num++)
            echo '<li class="tags-field">'.$user_tags_list[$tags_num].'<i class="fa fa-times" onclick="remove(this, \''.$user_tags_list[$tags_num].'\')"></i></li>';
?>
      </ul>
    </div>

    <div class="tags-block-details row m-0">
      <div class="col-6 p-0 m-0 d-flex justify-content-start align-items-center">
        <p class="fz-12 fw-700 p-0 m-0">Осталось:&nbsp;<span>5</span></p>
      </div>
      <div class="col-6 p-0 m-0 d-flex justify-content-end align-items-center">
        <p class="fz-13 p-0 m-0 btn-delete-tags">Удалить теги</p>
      </div>
    </div>
  </div>
  <input type="submit" class="btn btn-standard w-100 m-0 mt-2" onclick="event.preventDefault();editUserTags();" value="Сохранить список тегов">
</div>