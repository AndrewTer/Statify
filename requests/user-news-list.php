<?
$num = 20;
$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

$user_news_count_query = pg_query("SELECT COUNT(*) FROM news WHERE author_uuid = '{$user_uuid}' AND news_type != 'getAchievement'") or trigger_error(pg_last_error().$user_news_count_query);

if ($user_news_count_result = pg_fetch_row($user_news_count_query))
    $user_news_count = $user_news_count_result[0];
else
    $user_news_count = 0;

$total_count_news_pages = intval(($user_news_count - 1) / $num) + 1;

if (empty($page) || $page < 0) $page = 1;
if ($page > $total_count_news_pages) $page = $total_count_news_pages;

$start_page = $page * $num - $num;

$user_news_date_query_input = "SELECT DISTINCT dates.creation_date
                               FROM (
                                SELECT creation_date
                                FROM news
                                WHERE author_uuid = '{$user_uuid}' AND news_type != 'getAchievement'
                                ORDER BY creation_date DESC
                                LIMIT $num
                                OFFSET $start_page
                               ) as dates
                               ORDER BY dates.creation_date DESC";

$user_news_query_input = "SELECT news_type, -- 0
                                 friend_uuid, -- 1
                                 old_photo, -- 2
                                 new_photo, -- 3
                                 achievement_uuid, -- 4
                                 creation_date -- 5
                          FROM news
                          WHERE author_uuid  = '{$user_uuid}' AND news_type != 'getAchievement'
                          ORDER BY creation_date DESC, id DESC
                          LIMIT $num 
                          OFFSET $start_page";

$user_news_date_query = pg_query($user_news_date_query_input)
          or trigger_error(pg_last_error().$user_news_date_query);
$user_news_query = pg_query($user_news_query_input) 
          or trigger_error(pg_last_error().$user_news_query);
?>