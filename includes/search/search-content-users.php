<?
$search_text_for_users_list = ($search_text) ? $search_text : null;
$search_users_list = get_search_result_of_users_list($search_text_for_users_list, $page, $num);

if ($search_users_list)
{
  $total_count_search_pages = $search_users_list[0]['total_count_search_pages'];
  for ($search_users_list_num = 0; $search_users_list_num < count($search_users_list); $search_users_list_num++)
  {
    $search_uuid = $search_users_list[$search_users_list_num]['user_uuid'];
    $search_nickname = '@'.get_user_nickname($search_uuid);

    $friendly_user_status = user_friendly_status($user_uuid, $search_uuid);

    switch ($friendly_user_status) {
      case 'friend':
        include("includes/search/search-content-users-friend-card.php");
        break;

      default:
        include("includes/search/search-content-users-user-card.php");
        break;
    }
  }
}else
  echo '<span class="d-flex justify-content-center p-5 w-100 text-center"><strong class="h5" id="search-notification">Поиск не дал результатов</strong></span>';
?>