<?
  include("requests/all-friends-activity-list.php");

  if ($activity_date_list = pg_fetch_row($friends_activity_date_query))
  {
    $activity_list_count = pg_num_rows($friends_activity_query);
?>
    <div id="block-my-activity" class="col-12 p-0">
<?
    do {
      $activity_date_main = $activity_date_list[0];
?>
      <div class="col-12 m-0 p-0 mb-4">
        <div class="w-100 framed-text-title d-flex flex-row align-items-center justify-content-center">
          <span class="fz-14 m-0 p-1 pl-3 pr-3 font-weight-bold text-center"><?= corrected_date_with_text_month($activity_date_main); ?></span>
        </div>

        <div class="activity-block mt-3 pt-1">
<?
      $activity_num = 0;

      for ($i = 0; $i < $activity_list_count; $i++)
      {
        $activity_list = pg_fetch_array($friends_activity_query, $i);
        $activity_type = $activity_list[1];
        $creation_date = $activity_list[5];

        if ($creation_date == $activity_date_main)
        {
          switch ($activity_type) {
            case 'addFriend':
              $author = $activity_list[0];
              $friend = $activity_list[2];
              new_friend_activity($user_uuid, $author, $friend, $activity_num);
              break;
            case 'profilePhotoUpdate':
              $author = $activity_list[0];
              $old_photo = $activity_list[3];
              $new_photo = $activity_list[4];
              new_profile_photo_activity($user_uuid, $author, $old_photo, $new_photo, $activity_num);
              break;
            default:
              break;
          }

          $activity_num++;
        }
      }
?>
        </div>
      </div>
<?
    }while ($activity_date_list = pg_fetch_row($friends_activity_date_query));

    if ($page == $total_count_activity_pages)
      echo '<p class="w-100 m-0 mb-3 p-0 text-center font-italic">Всё прочитано!</p>';
?>
    </div>
<?
  }else
    echo '<div id="block-user" class="p-0">
            <span class="d-flex justify-content-center p-5 w-100"><strong class="h5 text-center">У вас пока нет активности</strong></span>
          </div>';
?>