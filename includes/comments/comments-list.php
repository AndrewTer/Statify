<?
  include("comments-current-photo.php");
  $comments_list = get_comments_list($photo_uuid);
?>

<div class="m-0 p-0" id="comments-block">
<?
  include("comments-add-new-comment.php");

  if (!check_only_friends_can_read_comments_on_photos($photo_user_uuid) ||
      ($user_uuid == $photo_user_uuid) ||
      (check_only_friends_can_read_comments_on_photos($photo_user_uuid) && user_friendly_status($user_uuid, $photo_user_uuid) == 'friend'))
  {
?>
    <hr class="hr-user-info m-0">
    <div id="user-comment-block" class="user-comment-block-show"></div>

    <div class="m-0 p-0 w-100" id="comments-list">
      <div class="m-0 p-0 pl-3 pr-3">
<?
        if ($comments_list)
        {
            function get_tree($tree, $pid, $user_uuid, $photo_user_uuid, $photo_uuid, $level, $comment_number)
            { 
              foreach ($tree as $row)
              {
                $comment_uuid = $row['uuid'];
                $comment_author_uuid = $row['author_uuid'];
                $comment_creation_date = $row['creation_date'];
                $comment_text = $row['text'];
                $level = ($level < 80) ? $level : 80;
                $comment_number++;

                $comment_user_ban_check = ban_check($comment_author_uuid);
                $comment_user_hash_modal = sha1($comment_author_uuid.$comment_uuid);
                $premium_status_comment_user = check_premium_active($comment_author_uuid);

                $author_uuid_replying_comment = get_user_uuid_by_comment_uuid_referenced($comment_uuid);

                if ($row['replying_comment_uuid'] == $pid)
                {
?>
                  <div class="d-flex flex-row align-items-start m-0 p-0 pt-2 pb-2 w-100 comment-body <?= ($comment_number == 1) ? 'comment-body-first' : ''; ?>" id="<?= preg_replace('[-]', '', $comment_uuid); ?>" style="<?= 'margin-left:'.$level.'px !important; width: calc(100% - '.$level.'px) !important;'; ?>">
<?
                  $preview_comment_author_photo_check = file_exists('users/'.$comment_author_uuid.'/'.get_latest_avatar_preview($comment_author_uuid)) ? 1 : 0;
                  
                  $mt1 = 'mt-1';
                  
                  if (!check_only_friends_can_comment_photos($photo_user_uuid) || 
                      ($user_uuid == $photo_user_uuid) ||
                      (check_only_friends_can_comment_photos($photo_user_uuid) && user_friendly_status($user_uuid, $photo_user_uuid) == 'friend'))
                    $mt1 = 'mt-1';
                  else
                    $mt1 = '';


                  if ($comment_user_ban_check == 'success')
                      if (!is_null(check_user_online_status($comment_author_uuid)))
                          if (get_latest_avatar($comment_author_uuid))
                              echo '<img class="rounded-circle online m-0 '.$mt1.' mr-3 p-0 rounded-saved-user-picture" 
                                          src="users/'.$comment_author_uuid.'/'.($preview_comment_author_photo_check == 1 ? get_latest_avatar_preview($comment_author_uuid) : get_latest_avatar($comment_author_uuid)).'" 
                                          alt="'.get_user_fullname($comment_author_uuid).'" 
                                          onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$comment_author_uuid.'\',\''.get_latest_avatar($comment_author_uuid).'\''.(($photo_user_uuid == $comment_author_uuid) ? ', 1' : '').');">';
                          else
                              echo '<img class="rounded-circle online m-0 '.$mt1.' mr-3 p-0 rounded-saved-user-picture" 
                                          src="imgs/no-avatar.png" 
                                          alt="'.get_user_fullname($comment_author_uuid).'">';
                      else
                          if (get_latest_avatar($comment_author_uuid))
                              echo '<img class="rounded-circle offline m-0 '.$mt1.' mr-3 p-0 rounded-saved-user-picture" 
                                          src="users/'.$comment_author_uuid.'/'.($preview_comment_author_photo_check == 1 ? get_latest_avatar_preview($comment_author_uuid) : get_latest_avatar($comment_author_uuid)).'" 
                                          alt="'.get_user_fullname($comment_author_uuid).'" 
                                          onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$comment_author_uuid.'\',\''.get_latest_avatar($comment_author_uuid).'\''.(($photo_user_uuid == $comment_author_uuid) ? ', 1' : '').');">';
                          else
                              echo '<img class="rounded-circle offline m-0 '.$mt1.' mr-3 p-0 rounded-saved-user-picture" 
                                          src="imgs/no-avatar.png" 
                                          alt="'.get_user_fullname($comment_author_uuid).'">';
                  else
                      if (get_latest_avatar($comment_author_uuid))
                          echo '<img class="rounded-circle offline m-0 '.$mt1.' mr-3 p-0 rounded-saved-user-picture" 
                                      src="users/'.$comment_author_uuid.'/'.($preview_comment_author_photo_check == 1 ? get_latest_avatar_preview($comment_author_uuid) : get_latest_avatar($comment_author_uuid)).'" 
                                      alt="'.get_user_fullname($comment_author_uuid).'">';
                      else
                          echo '<img class="rounded-circle offline m-0 '.$mt1.' mr-3 p-0 rounded-saved-user-picture" 
                                      src="imgs/no-avatar.png" 
                                      alt="'.get_user_fullname($comment_author_uuid).'">';
?>

                    <div class="w-100 m-0 p-0">
<?
                      if ($user_uuid == $comment_author_uuid && check_time_to_delete_comment($user_uuid, $photo_uuid, $comment_uuid) && !check_for_replies_to_comment($comment_uuid))
                        echo '<a class="delete-comment m-0 p-0" 
                                  onclick="event.preventDefault();delComment(\''.$user_uuid.'\',\''.$photo_uuid.'\',\''.$comment_uuid.'\');">
                                <i class="fa fa-times fz-13 m-0 p-1" aria-hidden="true"></i>
                              </a>';

                      if ($user_uuid != $comment_author_uuid && $comment_user_ban_check == 'success')
                        echo '<a class="report-comment m-0 p-0 d-none" 
                                  data-toggle="tooltip" data-placement="bottom" title="Пожаловаться"
                                  onclick="event.preventDefault();openReportCommentModal(\''.$user_uuid.'\',\''.$comment_author_uuid.'\',\''.$comment_uuid.'\');">
                                <i class="fa fa-ban fz-13 m-0 p-1" aria-hidden="true"></i>
                              </a>';
?>

                      <a class="w-75 m-0 p-0 d-block comment-user-fullname pointer"
                                href="./?u=<?= get_user_nickname($comment_author_uuid); ?>"
                                title="<?= get_user_fullname($comment_author_uuid); ?>">
<?
                        if ($photo_user_uuid == $comment_author_uuid)
                          if ($premium_status_comment_user)
                            echo '<p class="fz-14 m-0 p-0 w-100 text-left d-flex align-items-center"><strong class="active-star fz-14 font-weight-bold">'.get_user_fullname($comment_author_uuid).'</strong>
                                    <svg class="ml-1 premium-star active" width="13px" height="13px" viewBox="0 0 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#2ACAEA" stroke-width="0.00048000000000000007" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
                                      <defs>  
                                        <linearGradient id="premium-logo-gradient-'.$comment_user_hash_modal.'" x1="50%" y1="0%" x2="50%" y2="100%" > 
                                          <stop offset="0%" stop-color="#7A5FFF">
                                            <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
                                          </stop>
                                          <stop offset="100%" stop-color="#01FF89">
                                            <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
                                          </stop>
                                        </linearGradient> 
                                      </defs>
                                      <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8712 33.0436L15.9976 44.7036C15.9362 45.5229 16.6646 46.0872 17.3161 45.722C21.9289 43.1382 36.3783 33.6479 43.7017 12.7899C44.0376 11.8331 43.1352 10.9697 42.3646 11.5094C38.0387 14.539 28.5846 20.8006 22.7421 21.9934C22.7421 21.9934 26.4836 19.3946 28.7231 15.4053C28.9426 15.0143 28.9244 14.5136 28.6796 14.1606L20.5127 2.38925C20.0287 1.69147 19.0354 1.98057 18.8606 2.87002L16.3181 15.8073L4.38437 26.2226C3.78602 26.7446 3.90808 27.7996 4.5989 28.079L16.8712 33.0436Z" fill="url(\'#premium-logo-gradient-'.$comment_user_hash_modal.'\')"></path> 
                                      <path fill-rule="evenodd" clip-rule="evenodd" d="M37.9745 28.448C37.2188 29.5025 35.5908 31.6717 34.0876 32.9974C33.7871 33.2624 33.8276 33.7068 34.1724 33.9234L42.1145 38.909C42.5926 39.2091 43.2384 38.8529 43.1576 38.3323C42.7882 35.9496 41.7237 30.9818 39.0328 28.3741C38.7322 28.083 38.2142 28.1136 37.9745 28.448Z" fill="url(\'#premium-logo-gradient-'.$comment_user_hash_modal.'\')"></path> 
                                    </svg>
                                  </p>';
                          else
                            echo '<p class="fz-14 m-0 p-0 w-100 text-left font-weight-bold"><strong class="fz-14 font-weight-bold" style="color: var(--star-icon-color);">'.get_user_fullname($comment_author_uuid).'</strong></p>';
                        else
                          if ($premium_status_comment_user)
                            echo '<p class="fz-14 m-0 p-0 w-100 text-left d-flex align-items-center font-weight-bold">'.get_user_fullname($comment_author_uuid).'
                                    <svg class="ml-1 premium-star active" width="13px" height="13px" viewBox="0 0 48.00 48.00" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#2ACAEA" stroke-width="0.00048000000000000007" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)">
                                      <defs>  
                                        <linearGradient id="premium-logo-gradient-'.$comment_user_hash_modal.'" x1="50%" y1="0%" x2="50%" y2="100%" > 
                                          <stop offset="0%" stop-color="#7A5FFF">
                                            <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
                                          </stop>
                                          <stop offset="100%" stop-color="#01FF89">
                                            <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
                                          </stop>
                                        </linearGradient> 
                                      </defs>
                                      <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16.8712 33.0436L15.9976 44.7036C15.9362 45.5229 16.6646 46.0872 17.3161 45.722C21.9289 43.1382 36.3783 33.6479 43.7017 12.7899C44.0376 11.8331 43.1352 10.9697 42.3646 11.5094C38.0387 14.539 28.5846 20.8006 22.7421 21.9934C22.7421 21.9934 26.4836 19.3946 28.7231 15.4053C28.9426 15.0143 28.9244 14.5136 28.6796 14.1606L20.5127 2.38925C20.0287 1.69147 19.0354 1.98057 18.8606 2.87002L16.3181 15.8073L4.38437 26.2226C3.78602 26.7446 3.90808 27.7996 4.5989 28.079L16.8712 33.0436Z" fill="url(\'#premium-logo-gradient-'.$comment_user_hash_modal.'\')"></path> 
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M37.9745 28.448C37.2188 29.5025 35.5908 31.6717 34.0876 32.9974C33.7871 33.2624 33.8276 33.7068 34.1724 33.9234L42.1145 38.909C42.5926 39.2091 43.2384 38.8529 43.1576 38.3323C42.7882 35.9496 41.7237 30.9818 39.0328 28.3741C38.7322 28.083 38.2142 28.1136 37.9745 28.448Z" fill="url(\'#premium-logo-gradient-'.$comment_user_hash_modal.'\')"></path> 
                                      </g>
                                    </svg>
                                  </p>';
                          else
                            echo '<p class="fz-14 m-0 p-0 w-100 text-left font-weight-bold">'.get_user_fullname($comment_author_uuid).'</p>';
?>
                      </a>
                  
                      <p class="m-0 p-0 fz-13 font-weight-bold"><?= (($author_uuid_replying_comment) ? '<a class="m-0 p-0" href="./?u='.get_user_nickname($author_uuid_replying_comment).'"><span class="m-0 p-0 nickname-author-reply-to-comment-p">'.get_user_nickname($author_uuid_replying_comment).'</span></a>, ' : '').str_replace(array("\r\n", "\r", "\n"), '<br>', $comment_text); ?> 
                      </p>
<?
                    if (get_latest_avatar($user_uuid))
                      if (!check_only_friends_can_comment_photos($photo_user_uuid) || 
                          ($user_uuid == $photo_user_uuid) ||
                          (check_only_friends_can_comment_photos($photo_user_uuid) && user_friendly_status($user_uuid, $photo_user_uuid) == 'friend'))
                      {
?>
                      <p class="m-0 mt-2 p-0 fz-12 font-weight-bold add-reply-to-comment-p" id="add-reply-<?= preg_replace('[-]', '', $comment_uuid); ?>" onclick="event.preventDefault();addReplyToCommentBlock(<?= '\''.preg_replace('[-]', '', $user_uuid).'\',\''.preg_replace('[-]', '', $photo_uuid).'\',\''.preg_replace('[-]', '', $comment_uuid).'\''; ?>);">Ответить</p>
                      <p class="m-0 mt-2 p-0 fz-12 font-weight-bold hide-reply-to-comment-p" id="hide-reply-<?= preg_replace('[-]', '', $comment_uuid); ?>" onclick="event.preventDefault();delReplyToCommentBlock(<?= '\''.preg_replace('[-]', '', $comment_uuid).'\''; ?>);">Отмена</p>
<?
                      }
?>
                      <div class="w-100 m-0 p-0 reply-to-user-comment-block" id="reply-block-<?= preg_replace('[-]', '', $comment_uuid); ?>"></div>
                    </div>
                  </div>
<?
                  get_tree($tree, $row['uuid'], $user_uuid, $photo_user_uuid, $photo_uuid, $level+20, $comment_number);
                }
              }
            }

            get_tree($comments_list, $comments_list[0]['replying_comment_uuid'], $user_uuid, $photo_user_uuid, $photo_uuid, 0, 0);        
        }else
            echo '<p class="m-3 p-0 fz-15 text-center">Комментариев нет</p>';
?>
      </div>
    </div>
<?
  }
?>
</div>