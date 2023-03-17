<?php
defined('mystatify');

if (isset($_POST["user_uuid"]) && isset($_POST["who_can_rate_photos"]) && isset($_POST["who_can_comment_photos"]) && isset($_POST["who_can_read_comments_on_photos"])
    && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user_uuid'])))
{
    require_once(realpath('../includes/connection.php'));

    $user_uuid = trim(htmlspecialchars($_POST['user_uuid'], ENT_QUOTES));
    $who_can_rate_photos = trim(htmlspecialchars($_POST['who_can_rate_photos'], ENT_QUOTES));
    $who_can_comment_photos = trim(htmlspecialchars($_POST['who_can_comment_photos'], ENT_QUOTES));
    $who_can_read_comments_on_photos = trim(htmlspecialchars($_POST['who_can_read_comments_on_photos'], ENT_QUOTES));

    $rate_photos_for_only_friends = '';
    $comment_photos_for_only_friends = '';
    $read_comments_on_photos_for_only_friends = '';

    switch ($who_can_rate_photos) {
        case 'all':
            $rate_photos_for_only_friends = 'rate_photos_for_only_friends = false';
            break;

        case 'friends':
            $rate_photos_for_only_friends = 'rate_photos_for_only_friends = true';
            break;
        
        default:
            $rate_photos_for_only_friends = 'rate_photos_for_only_friends = false';
            break;
    }

    switch ($who_can_comment_photos) {
        case 'all':
            $comment_photos_for_only_friends = ', comment_photos_for_only_friends = false';
            break;

        case 'friends':
            $comment_photos_for_only_friends = ', comment_photos_for_only_friends = true';
            break;
        
        default:
            $comment_photos_for_only_friends = ', comment_photos_for_only_friends = false';
            break;
    }

    switch ($who_can_read_comments_on_photos) {
        case 'all':
            $read_comments_on_photos_for_only_friends = ', read_comments_on_photos_for_only_friends = false';
            break;

        case 'friends':
            $read_comments_on_photos_for_only_friends = ', read_comments_on_photos_for_only_friends = true';
            break;
        
        default:
            $read_comments_on_photos_for_only_friends = ', read_comments_on_photos_for_only_friends = false';
            break;
    }

    $edit_data_row = "UPDATE users_technical_data SET $rate_photos_for_only_friends $comment_photos_for_only_friends $read_comments_on_photos_for_only_friends WHERE user_uuid = '{$user_uuid}'";

    $data_result = pg_query($edit_data_row) or trigger_error(pg_last_error().$data_result);

    if (!$data_result)
    {
        echo 'error';
        return;
    }
}else
{
    echo 'error';
    return;
}
?>