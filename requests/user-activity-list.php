<?
$num = 20;
$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

$user_activity_count_query = pg_query("SELECT COUNT(*) FROM news WHERE author_uuid = '{$user_uuid}'") or trigger_error(pg_last_error().$user_activity_count_query);

if ($user_activity_count_result = pg_fetch_row($user_activity_count_query))
    $user_activity_count = $user_activity_count_result[0];
else
    $user_activity_count = 0;

$total_count_activity_pages = intval(($user_activity_count - 1) / $num) + 1;

if (empty($page) || $page < 0) $page = 1;
if ($page > $total_count_activity_pages) $page = $total_count_activity_pages;

$start_page = $page * $num - $num;

$user_activity_date_query_input = "SELECT DISTINCT dates.creation_date
                                   FROM (
                                    SELECT creation_date
                                    FROM news
                                    WHERE author_uuid = '{$user_uuid}'
                                    ORDER BY creation_date DESC
                                    LIMIT $num
                                    OFFSET $start_page
                                   ) as dates
                                   ORDER BY dates.creation_date DESC";

$user_activity_query_input = "SELECT news_type, -- 0
                                     friend_uuid, -- 1
                                     old_avatar_uuid, -- 2
                                     new_avatar_uuid, -- 3
                                     creation_date -- 4
                              FROM news
                              WHERE author_uuid  = '{$user_uuid}'
                              ORDER BY creation_date DESC, id DESC
                              LIMIT $num 
                              OFFSET $start_page";

$user_activity_date_query = pg_query($user_activity_date_query_input)
          or trigger_error(pg_last_error().$user_activity_date_query);
$user_activity_query = pg_query($user_activity_query_input) 
          or trigger_error(pg_last_error().$user_activity_query);
?>