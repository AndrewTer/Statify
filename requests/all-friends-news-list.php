<?
$num = 20;
$page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

$friends_news_count_query = pg_query("SELECT COUNT(*) FROM news 
                                      WHERE (author_uuid IN (SELECT first_uuid FROM friends WHERE second_uuid = '{$user_uuid}')
                                            OR author_uuid IN (SELECT second_uuid FROM friends WHERE first_uuid = '{$user_uuid}'))
                                            AND news_type != 'getAchievement'") 
                                    or trigger_error(pg_last_error().$friends_news_count_query);

if ($friends_news_count_result = pg_fetch_row($friends_news_count_query))
    $friends_news_count = $friends_news_count_result[0];
else
    $friends_news_count = 0;

$total_count_news_pages = intval(($friends_news_count - 1) / $num) + 1;

if (empty($page) || $page < 0) $page = 1;
if ($page > $total_count_news_pages) $page = $total_count_news_pages;

$start_page = $page * $num - $num;

$friends_news_date_query_input = "SELECT DISTINCT dates.creation_date
                                  FROM (
                                    SELECT
                                      creation_date
                                    FROM news
                                    WHERE (author_uuid IN (SELECT first_uuid FROM friends WHERE second_uuid = '{$user_uuid}')
                                          OR author_uuid IN (SELECT second_uuid FROM friends WHERE first_uuid = '{$user_uuid}'))
                                          AND news_type != 'getAchievement'
                                    ORDER BY creation_date DESC
                                    LIMIT $num
                                    OFFSET $start_page
                                  ) as dates
                                  ORDER BY dates.creation_date DESC";

$friends_news_query_input = "SELECT author_uuid, -- 0 
                                    news_type, -- 1
                                    friend_uuid, -- 2
                                    old_photo, -- 3
                                    new_photo, -- 4
                                    achievement_uuid, -- 5
                                    creation_date -- 6
                             FROM news
                             WHERE (author_uuid IN (SELECT first_uuid FROM friends WHERE second_uuid = '{$user_uuid}')
                                   OR author_uuid IN (SELECT second_uuid FROM friends WHERE first_uuid = '{$user_uuid}'))
                                   AND news_type != 'getAchievement'
                             ORDER BY creation_date DESC, id DESC
                             LIMIT $num
                             OFFSET $start_page";

$friends_news_date_query = pg_query($friends_news_date_query_input)
          or trigger_error(pg_last_error().$friends_news_date_query);
$friends_news_query = pg_query($friends_news_query_input) 
          or trigger_error(pg_last_error().$friends_news_query);
?>