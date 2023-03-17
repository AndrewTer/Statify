<div class="block-search-and-sort news-top-block p-0 text-center mt-3 mb-3">
<?
  $photo_user_uuid = '';

  $top_commentator_query = pg_query("SELECT u.uuid, u.nickname, Count(uc.uuid)
                                      FROM users u
                                         LEFT JOIN public.users_comments uc
                                            ON u.uuid = uc.author_uuid
                                      WHERE uc.deleted = 0
                                            AND uc.creation_date > DATE_TRUNC('month', CURRENT_DATE - interval '1 month')
                                      GROUP BY u.uuid
                                      ORDER BY Count(uc.uuid) DESC
                                      LIMIT 1")
                             or trigger_error($pg_last_error().$top_commentator_query);

  if ($top_commentator_result = pg_fetch_array($top_commentator_query))
  {
    $photo_user_uuid = $top_commentator_result[0];
  }

  $photo_user_name = get_user_fullname($photo_user_uuid);
  $photo_name = get_latest_avatar($photo_user_uuid);
?>
  <div class="m-0 p-0 justify-content-center">
    <div class="popular-picture-card">
      <img class="w-100" src="<?= 'users/'.$photo_user_uuid.'/'.$photo_name; ?>" alt="<?= $photo_user_name; ?>" onclick="event.preventDefault();openProfilePictureModal(<?= '\''.$user_uuid.'\',\''.$photo_user_uuid.'\',\''.$photo_name.'\''; ?>);">

      <p class="m-0 mt-2 mb-2 p-0 fz-17">Комментатор месяца</p>
    </div>
  </div>

</div>