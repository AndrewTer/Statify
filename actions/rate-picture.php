<?php
    defined('mystatify');

    if(isset($_POST['author']) && isset($_POST['receiver']) && isset($_POST['photo']) && isset($_POST['mark']))
    {
        require_once(realpath('../includes/connection.php'));
        $author_uuid = $_POST['author']; 
        $receiver_uuid = $_POST['receiver'];
        $photo_name = $_POST['photo'];
        $mark = $_POST['mark'];

        $marks_list = array(1, 2, 3, 4, 5, 7);
        
        if (in_array($mark, $marks_list))
        {
            $photo_uuid_row = pg_query("SELECT uuid FROM users_photos WHERE photo_name = '{$photo_name}' LIMIT 1") 
                                or trigger_error(pg_last_error().$photo_uuid_row);

            if ($photo_uuid_data = pg_fetch_array($photo_uuid_row))
            {
                $photo_uuid = $photo_uuid_data[0];

                //Поиск существующих записей с данными параметрами
                $search_rate_row = pg_query("SELECT Count(*) FROM rating WHERE (author = '{$author_uuid}') AND (receiver = '{$receiver_uuid}') AND (photo_uuid = '{$photo_uuid}')") or trigger_error(pg_last_error().$search_rate_row);
            
                //Если существует запись, то меняем оценку, иначе создаём новую
                if ($rate_data = pg_fetch_array($search_rate_row))
                {
                    $search_rate_count = $rate_data[0];

                    switch ($search_rate_count) 
                    {
                        case 0:
                            $add_rate = "INSERT INTO rating (author, receiver, mark, photo_uuid, date_time) VALUES ('{$author_uuid}', '{$receiver_uuid}', $mark, '{$photo_uuid}', NOW())";
                            break;
                        
                        case 1:
                            $add_rate = "UPDATE rating SET mark = $mark WHERE (author = '{$author_uuid}') AND (receiver = '{$receiver_uuid}') AND (photo_uuid = '{$photo_uuid}')";
                            break;

                        default:
                            break;
                    }

                    pg_query($add_rate);

                    switch($mark)
                    {
                        case 1:
                            $mark_text = "one_star_count = one_star_count + 1";
                            break;

                        case 2:
                            $mark_text = "two_star_count = two_star_count + 1";
                            break;

                        case 3:
                            $mark_text = "three_star_count = three_star_count + 1";
                            break;

                        case 4:
                            $mark_text = "four_star_count = four_star_count + 1";
                            break;

                        case 5:
                            $mark_text = "five_star_count = five_star_count + 1";
                            break;

                        default:
                            $mark_text = "photo_uuid = '{$photo_uuid}'";
                            break;
                    }

                    $search_statistics_row = pg_query("SELECT 1 FROM users_photos_statistics 
                                                        WHERE user_uuid = '{$receiver_uuid}' 
                                                                AND photo_uuid = '{$photo_uuid}'")
                                                or trigger_error(pg_last_error().$search_statistics_row);

                    $search_statistics_row_check = pg_num_rows($search_statistics_row);

                    if ($search_statistics_row_check == 1)
                    {
                        $update_avatar_statistics = pg_query("UPDATE users_photos_statistics 
                                                                SET $mark_text
                                                                WHERE user_uuid = '{$receiver_uuid}'
                                                                        AND photo_uuid = '{$photo_uuid}'");
                    }else
                    {
                        $add_avatar_statistics = pg_query("INSERT INTO users_photos_statistics (user_uuid, photo_uuid) 
                                                    VALUES ('{$receiver_uuid}', '{$photo_uuid}')") 
                                            or trigger_error(pg_last_error().$add_avatar_statistics);

                        $update_avatar_statistics = pg_query("UPDATE users_photos_statistics 
                                                                SET $mark_text
                                                                WHERE user_uuid = '{$receiver_uuid}'
                                                                        AND photo_uuid = '{$photo_uuid}'");
                    }
                }
            }

            echo $mark;
            return;
        }else
        {
          echo 'empty';
          return;
        }
    }
?>