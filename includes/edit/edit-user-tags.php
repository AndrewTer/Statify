<p class="fz-17 text-center mt-2 mb-2 font-weight-bold">Теги</p>
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
            echo '<li class="tags-field font-weight-bold d-flex flex-row align-items-center">'
                  .$user_tags_list[$tags_num]
                  .'<svg viewBox="0 0 48 48" class="svg-close-icon pointer" onclick="remove(this, \''.$user_tags_list[$tags_num].'\')">
                        <rect width="48" height="48" fill="none"></rect>
                        <path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
                    </svg>
                  </li>';
?>
      </ul>
    </div>

    <div class="tags-block-details w-100 m-0">
      <div class="w-50 p-0 m-0 d-flex justify-content-start align-items-center">
        <p class="fz-13 font-weight-bold p-0 m-0">Осталось:&nbsp;<span>5</span></p>
      </div>
      <div class="w-50 p-0 m-0 d-flex justify-content-end align-items-center">
        <p class="fz-13 p-0 m-0 btn-delete-tags">Удалить теги</p>
      </div>
    </div>
  </div>
  <input type="submit" class="btn btn-standard fz-14 w-100 m-0 mt-3" onclick="event.preventDefault();editUserTags();" value="Сохранить список тегов">
</div>