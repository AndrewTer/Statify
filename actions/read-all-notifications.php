<?php
defined('mystatify');

if(isset($_POST['user']) && strlen($_POST['user']) > 0
	&& (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user'])))
{
	require_once(realpath('../includes/connection.php'));
	$user_uuid = $_POST['user'];

	$read_all_notifications_query = "UPDATE public.notifications SET marked_read = 1
																	 WHERE uuid IN (
																	 		SELECT notice.uuid
				                              FROM public.notifications notice
				                                   JOIN public.users_comments comm
				                                     ON notice.comment_uuid = comm.uuid
				                                   JOIN public.users_avatars pic
				                                     ON comm.picture_uuid = pic.uuid
				                              WHERE pic.user_uuid = '{$user_uuid}'
				                              UNION ALL
				                              SELECT notice.uuid
				                              FROM public.notifications notice
				                                   JOIN public.friendship_requests request
				                                     ON notice.friendship_request_uuid = request.uuid
				                              WHERE request.receiver_uuid = '{$user_uuid}'
																	 )";
	
	pg_query($read_all_notifications_query) or trigger_error(pg_last_error().$read_all_notifications_query);
}
?>