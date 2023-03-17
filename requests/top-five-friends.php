<?
    $top_five_query_input = "SELECT result.friend_uuid, -- 0
                                    result.friend_name, -- 1
                                    result.friend_surname, -- 2
                                    result.score as rating_mark, -- 3
                                    ROW_NUMBER() OVER (ORDER BY COALESCE(
                                                             NULLIF(
                                                                   result.score
                                                                   , 0), 0
                                                            )
                                                       DESC) as position -- 4
                             FROM (
                                SELECT u.uuid as friend_uuid,
                                       u.name as friend_name,
                                       u.surname as friend_surname,
                                       us.maximum_user_score as score
                                FROM friends f
                                    LEFT JOIN users u
                                            ON u.uuid = f.second_uuid
                                    LEFT JOIN users_statistics us
                                            ON u.uuid = us.user_uuid
                                WHERE f.first_uuid = '{$user_uuid}'
                                UNION ALL
                                SELECT u.uuid as friend_uuid,
                                       u.name as friend_name,
                                       u.surname as friend_surname,
                                       us.maximum_user_score as score
                                FROM friends f
                                    LEFT JOIN users u
                                            ON u.uuid = f.first_uuid
                                    LEFT JOIN users_statistics us
                                            ON u.uuid = us.user_uuid
                                WHERE f.second_uuid = '{$user_uuid}'
                                UNION ALL
                                SELECT u.uuid as friend_uuid,
                                       u.name as friend_name,
                                       u.surname as friend_surname,
                                       us.maximum_user_score as score
                                FROM users u
                                    LEFT JOIN users_statistics us
                                            ON u.uuid = us.user_uuid
                                WHERE u.uuid = '{$user_uuid}'
                                ) result
                             LIMIT 5";

    $top_five_query = pg_query($top_five_query_input) 
              or trigger_error(pg_last_error().$top_five_query);
?>