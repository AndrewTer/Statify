<?php
$notifications_query_input_comments = "SELECT Count(*)
                                       FROM public.notifications notice
                                            JOIN public.users_comments comm
                                              ON notice.comment_uuid = comm.uuid
                                            JOIN public.users_avatars pic
                                              ON comm.picture_uuid = pic.uuid
                                       WHERE pic.user_uuid = '{$user_uuid}' AND notice.marked_read != 1";

$notifications_query_input_requests = "SELECT Count(*)
                                       FROM public.notifications notice
                                            JOIN public.friendship_requests request
                                              ON notice.friendship_request_uuid = request.uuid
                                       WHERE request.receiver_uuid = '{$user_uuid}' AND notice.marked_read != 1";

$notifications_query_comments = pg_query($notifications_query_input_comments) or trigger_error(pg_last_error().$notifications_query_comments);
$notifications_query_requests = pg_query($notifications_query_input_requests) or trigger_error(pg_last_error().$notifications_query_requests);

if($notifications_comments_data = pg_fetch_array($notifications_query_comments))
{
  $notifications_comments_count = $notifications_comments_data[0];
}else
  $notifications_comments_count = 0;

if($notifications_requests_data = pg_fetch_array($notifications_query_requests))
{
  $notifications_requests_count = $notifications_requests_data[0];
}else
  $notifications_requests_count = 0;
?>