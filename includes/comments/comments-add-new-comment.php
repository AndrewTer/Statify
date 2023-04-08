<div class="m-0 p-2 pl-3 pr-3 d-flex flex-row align-items-center">
  <p class="fz-13 m-0 p-0 pt-1 pb-1 mr-auto font-weight-bold" id="comments-count">Комментарии: <?= ($comments_list) ? count($comments_list) : 0; ?></p>
<?
  if (get_latest_avatar($user_uuid))
    if ((!check_only_friends_can_comment_photos($photo_user_uuid) && !check_only_friends_can_read_comments_on_photos($photo_user_uuid)) ||
        ($user_uuid == $photo_user_uuid) ||
        (check_only_friends_can_comment_photos($photo_user_uuid) && user_friendly_status($user_uuid, $photo_user_uuid) == 'friend') ||
        (check_only_friends_can_read_comments_on_photos($photo_user_uuid) && user_friendly_status($user_uuid, $photo_user_uuid) == 'friend'))
      echo '<div class="ml-auto m-0 p-0 h-100 current-photo-menu" 
                  id="add-comment-btn" 
                  onclick="addCommentBlock(\''.$photo_uuid.'\',\''.$user_uuid.'\');">
              <div class="nav-item m-0 p-1">
                <a class="nav-link m-0 p-0 text-center d-flex flex-row justify-content-center align-items-center">
                  <i class="fa fa-commenting-o fz-18 p-1 pl-2 pr-2 m-0" id="show-comment-text-field-icon" aria-hidden="true"></i>
                  <p class="fz-13 p-1 m-0 font-weight-bold" id="show-comment-text-field-p">Добавить комментарий</p>
                </a>
              </div>
            </div>
            <div class="ml-auto m-0 p-0 h-100 current-photo-menu del-comment-btn-hide" 
                  id="del-comment-btn" 
                  onclick="delCommentBlock();">
              <div class="nav-item m-0 p-1">
                <a class="nav-link m-0 p-0 text-center d-flex flex-row justify-content-center align-items-center">
                  <i class="fa fa-times fz-18 p-1 pl-2 pr-2 m-0" id="hide-comment-text-field-icon" aria-hidden="true"></i>
                  <p class="fz-13 p-1 m-0 font-weight-bold" id="hide-comment-text-field-p">Скрыть</p>
                </a>
              </div>
            </div>';
?>
</div>
<?
  $message_for_users = '';

  if (check_only_friends_can_comment_photos($photo_user_uuid) && 
      ($user_uuid != $photo_user_uuid) && user_friendly_status($user_uuid, $photo_user_uuid) != 'friend')
    $message_for_users = '<hr class="hr-user-info m-0"><p class="w-100 fz-14 m-0 mt-2 mb-2 p-0 pl-4 pr-4 text-center font-italic">Пользователь ограничил комментирование своих фотографий</p>';
  
  if (check_only_friends_can_read_comments_on_photos($photo_user_uuid) &&
      ($user_uuid != $photo_user_uuid) && user_friendly_status($user_uuid, $photo_user_uuid) != 'friend') 
    $message_for_users = '<hr class="hr-user-info m-0"><p class="w-100 fz-14 m-0 mt-2 mb-2 p-0 pl-4 pr-4 text-center font-italic">Пользователь ограничил чтение комментариев под своими фотографиями</p>';
  
  if (check_only_friends_can_comment_photos($photo_user_uuid) && check_only_friends_can_read_comments_on_photos($photo_user_uuid) &&
      ($user_uuid != $photo_user_uuid) && user_friendly_status($user_uuid, $photo_user_uuid) != 'friend')
    $message_for_users = '<hr class="hr-user-info m-0"><p class="w-100 fz-14 m-0 mt-2 mb-2 p-0 pl-4 pr-4 text-center font-italic">Пользователь ограничил комментирование и чтение комментариев других пользователей под своими фотографиями</p>';
  
  echo $message_for_users;
?>