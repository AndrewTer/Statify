<?php
define('mystatify', true);
include('../functions/functions-user-data.php');
include('../functions/functions-photos.php');

if (isset($_POST['photo_uuid']) && isset($_POST["tags_list"]))
{
  require_once(realpath('../includes/connection.php'));

  if (!empty($_COOKIE['login']) and !empty($_COOKIE['key']))
  {
    $cookie_login = $_COOKIE['login'];
    $cookie_key = $_COOKIE['key'];

    if (get_user_uuid_by_cookie($cookie_login, $cookie_key))
    {
      $user_uuid = get_user_uuid_by_cookie($cookie_login, $cookie_key);
      $photo_uuid = $_POST['photo_uuid'];
      $tags_list = $_POST['tags_list'];

      $delete_photo_all_tags = pg_query("DELETE FROM photos_tags WHERE photo_uuid = '{$photo_uuid}'")
                                or trigger_error(pg_last_error().$delete_photo_all_tags);

      if ($tags_list != "")
      {
        $new_tags_array = explode(",", $tags_list);

        foreach($new_tags_array as $key => $value) {
          $tag_value = strtolower(str_replace(' ', '_', preg_replace('/[^ a-zа-яё\d]/ui', '', trim($value))));

          $add_new_tags = pg_query("INSERT INTO tags (tag_text) 
                                    SELECT '{$tag_value}'
                                    WHERE NOT EXISTS (SELECT 1 FROM tags WHERE tag_text = '{$tag_value}')") or trigger_error(pg_last_error().$add_new_tags);

          if (get_tag_uuid_by_text($tag_value))
          {
            $photo_tag_uuid = get_tag_uuid_by_text($tag_value);
            $add_new_photo_tag = pg_query("INSERT INTO photos_tags (photo_uuid, tag_uuid) VALUES ('{$photo_uuid}', '{$photo_tag_uuid}')")
                                    or trigger_error(pg_last_error().$add_new_photo_tag);
          }
        }
      }

      echo 'success';
      return;

    }else
    {
      echo 'error';
      return;
    }
  }else
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
