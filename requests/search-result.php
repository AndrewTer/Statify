<?
       $num = 40;
       $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

       if ($search_text)
       {

              $search_text_query = trim(htmlspecialchars($search_text, ENT_QUOTES));
              $user_uuid_query = trim(htmlspecialchars($user_uuid, ENT_QUOTES));

              $search_count_query = pg_query("SELECT Count(*)
                                              FROM users
                                                   LEFT JOIN users_technical_data
                                                          ON users.uuid = users_technical_data.user_uuid
                                                   LEFT JOIN tags ON users.uuid = tags.user_uuid
                                              WHERE (upper(users.name) = upper('{$search_text_query}')
                                                        OR upper(users.surname) = upper('{$search_text_query}')
                                                        OR upper(users.nickname) = upper('{$search_text_query}')
                                                        OR upper(tags.tag_text) = upper('{$search_text_query}'))
                                                        AND users.uuid != '{$user_uuid_query}' 
                                                        AND users_technical_data.completed = true")
                                          or trigger_error(pg_last_error().$search_count_query);

              if ($search_count_result = pg_fetch_row($search_count_query))
                     $search_count = $search_count_result[0];
              else
                     $search_count = 0;

              $total_count_search_pages = intval(($search_count - 1) / $num) + 1;

              if (empty($page) || $page < 0) $page = 1;
              if ($page > $total_count_search_pages) $page = $total_count_search_pages;

              $start_page = $page * $num - $num;

              $search_query = pg_query("SELECT DISTINCT 
                                               users.uuid
                                        FROM users
                                             LEFT JOIN users_technical_data
                                                    ON users.uuid = users_technical_data.user_uuid
                                             LEFT JOIN tags ON users.uuid = tags.user_uuid
                                             LEFT JOIN genders AS g
                                                    ON g.uuid = users.gender
                                             LEFT JOIN genders AS gl
                                                    ON gl.uuid = users.gender_preference
                                             LEFT JOIN countries AS c
                                                    ON c.uuid = users.country_uuid
                                             LEFT JOIN cities AS cc
                                                    ON cc.uuid = users.city_uuid
                                        WHERE (upper(users.name) = upper('{$search_text_query}')
                                               OR upper(users.surname) = upper('{$search_text_query}')
                                               OR upper(users.nickname) = upper('{$search_text_query}')
                                               OR upper(tags.tag_text) = upper('{$search_text_query}'))
                                               AND users.uuid != '{$user_uuid_query}'
                                               AND users_technical_data.completed = true
                                        LIMIT $num
                                        OFFSET $start_page")
                                   or trigger_error(pg_last_error().$search_query);
       }else
       {
              $user_uuid_query = trim(htmlspecialchars($user_uuid, ENT_QUOTES));

              $search_count_query = pg_query("SELECT Count(users.*)
                                              FROM users
                                                    LEFT JOIN users_technical_data
                                                           ON users.uuid = users_technical_data.user_uuid
                                              WHERE users.uuid != '{$user_uuid_query}' 
                                                    AND users_technical_data.completed = true")
                                          or trigger_error(pg_last_error().$search_count_query);

              if ($search_count_result = pg_fetch_row($search_count_query))
                     $search_count = $search_count_result[0];
              else
                     $search_count = 0;

              $total_count_search_pages = intval(($search_count - 1) / $num) + 1;

              if (empty($page) || $page < 0) $page = 1;
              if ($page > $total_count_search_pages) $page = $total_count_search_pages;

              $start_page = $page * $num - $num;

              $search_query = pg_query("SELECT DISTINCT 
                                               users.uuid
                                        FROM users
                                             LEFT JOIN users_technical_data
                                                    ON users.uuid = users_technical_data.user_uuid
                                             LEFT JOIN tags ON users.uuid = tags.user_uuid
                                             LEFT JOIN genders AS g
                                                    ON g.uuid = users.gender
                                             LEFT JOIN genders AS gl
                                                    ON gl.uuid = users.gender_preference
                                             LEFT JOIN countries AS c
                                                    ON c.uuid = users.country_uuid
                                             LEFT JOIN cities AS cc
                                                    ON cc.uuid = users.city_uuid
                                        WHERE users.uuid != '{$user_uuid_query}'
                                              AND users_technical_data.completed = true
                                        LIMIT $num
                                        OFFSET $start_page")
                                   or trigger_error(pg_last_error().$search_query);
       }
?>