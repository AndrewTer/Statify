<?php
  $num = 20;
  $page = (isset($_GET['page'])) ? intval($_GET['page']) : 1;

  $notifications_query_input = "SELECT request.author_uuid::varchar(36) as sender_uuid, 
                                       notice.creation_date as datetime, 
                                       notice.marked_read as status
                                FROM public.notifications notice
                                     JOIN public.friendship_requests request
                                       ON notice.friendship_request_uuid = request.uuid
                                WHERE request.receiver_uuid = '{$user_uuid}'
                                ORDER BY datetime DESC";

  $all_request_notifications_count_query = pg_query($notifications_query_input)
                                                or trigger_error(pg_last_error().$all_request_notifications_count_query);

  $all_request_notifications_count = pg_num_rows($all_request_notifications_count_query);

  $total_count_notifications_pages = intval(($all_request_notifications_count - 1) / $num) + 1;

  if (empty($page) || $page < 0) $page = 1;
  if ($page > $total_count_notifications_pages) $page = $total_count_notifications_pages;

  $start_page = $page * $num - $num;

  $notifications_query_input .= "\nLIMIT $num OFFSET $start_page";

  $notifications_query = pg_query($notifications_query_input) or trigger_error(pg_last_error().$notifications_query);
?>