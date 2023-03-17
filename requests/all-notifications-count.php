<?php
	$notifications_query_input_all = "SELECT Count(notice.uuid)
                                  FROM public.notifications notice
                                       LEFT JOIN public.users_comments comm
                                         ON notice.comment_uuid = comm.uuid
                                       LEFT JOIN public.users_avatars pic
                                         ON comm.picture_uuid = pic.uuid
                                       LEFT JOIN public.friendship_requests request
                                         ON notice.friendship_request_uuid = request.uuid
                                  WHERE (pic.user_uuid = '{$user_uuid}' OR request.receiver_uuid = '{$user_uuid}') AND notice.marked_read != 1";

	$notifications_query_all = pg_query($notifications_query_input_all) or trigger_error(pg_last_error().$notifications_query_all);

	if($notifications_all_data = pg_fetch_array($notifications_query_all))
	{
	  $notifications_all_count = $notifications_all_data[0];
	}else
	  $notifications_all_count = 0;
?>