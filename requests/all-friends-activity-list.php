<?
$num = 20;
$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

$friends_activity_count_query = pg_query("SELECT COUNT(*) FROM news 
                                          WHERE author_uuid IN (SELECT first_uuid FROM friends WHERE second_uuid = '{$user_uuid}')
                                                  OR author_uuid IN (SELECT second_uuid FROM friends WHERE first_uuid = '{$user_uuid}')") 
                                              or trigger_error(pg_last_error().$friends_activity_count_query);

if ($friends_activity_count_result = pg_fetch_row($friends_activity_count_query))
    $friends_activity_count = $friends_activity_count_result[0];
else
    $friends_activity_count = 0;

$total_count_activity_pages = intval(($friends_activity_count - 1) / $num) + 1;

if (empty($page) || $page < 0) $page = 1;
if ($page > $total_count_activity_pages) $page = $total_count_activity_pages;

$start_page = $page * $num - $num;

$friends_activity_date_query_input = "SELECT DISTINCT dates.creation_date
                                      FROM (
                                        SELECT
                                          creation_date
                                        FROM news
                                        WHERE author_uuid IN (SELECT first_uuid FROM friends WHERE second_uuid = '{$user_uuid}')
                                              OR author_uuid IN (SELECT second_uuid FROM friends WHERE first_uuid = '{$user_uuid}')
                                        ORDER BY creation_date DESC
                                        LIMIT $num
                                        OFFSET $start_page
                                      ) as dates
                                      ORDER BY dates.creation_date DESC";

$friends_activity_query_input = "SELECT author_uuid, -- 0 
                                        news_type, -- 1
                                        friend_uuid, -- 2
                                        old_avatar_uuid, -- 3
                                        new_avatar_uuid, -- 4
                                        creation_date -- 5
                                 FROM news
                                 WHERE author_uuid IN (SELECT first_uuid FROM friends WHERE second_uuid = '{$user_uuid}')
                                       OR author_uuid IN (SELECT second_uuid FROM friends WHERE first_uuid = '{$user_uuid}')
                                 ORDER BY creation_date DESC, id DESC
                                 LIMIT $num
                                 OFFSET $start_page";

$friends_activity_date_query = pg_query($friends_activity_date_query_input)
          or trigger_error(pg_last_error().$friends_activity_date_query);
$friends_activity_query = pg_query($friends_activity_query_input) 
          or trigger_error(pg_last_error().$friends_activity_query);
?>