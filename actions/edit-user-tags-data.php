<?php
define('mystatify', true);

if (isset($_POST["user_uuid"]) && isset($_POST["tags_list"])
    && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user_uuid'])))
{
    require_once(realpath('../includes/connection.php'));

    $user_uuid = $_POST['user_uuid'];
    $tags_list = $_POST['tags_list'];

    $delete_all_user_tags = pg_query("DELETE FROM tags WHERE user_uuid = '{$user_uuid}'")
                                or trigger_error(pg_last_error().$delete_all_user_tags);

    if ($tags_list != "")
    {
        $new_tags_array = explode(",", $tags_list);

        foreach($new_tags_array as $key => $value) {
            $tag_value = ltrim(rtrim($value));
            $add_user_tag = pg_query("INSERT INTO tags (user_uuid, tag_text) VALUES ('{$user_uuid}', '{$tag_value}')")
                                or trigger_error(pg_last_error().$add_user_tag);
        }

        echo 'success';
        return;
    }
}else
{
    echo 'error';
    return;
}
?>