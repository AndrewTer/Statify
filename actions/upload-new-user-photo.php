<?php
define('mystatify', true);
include('../functions/functions-user-data.php');
include('../functions/functions-photos.php');
include('../classes/image_processing.php');

if (isset($_POST['new_photo']) && isset($_POST["tags_list"]))
{
  require_once(realpath('../includes/connection.php'));

  if (!empty($_COOKIE['login']) and !empty($_COOKIE['key']))
  {
    $cookie_login = $_COOKIE['login'];
    $cookie_key = $_COOKIE['key'];

    if (get_user_uuid_by_cookie($cookie_login, $cookie_key))
    {
      $user_uuid = get_user_uuid_by_cookie($cookie_login, $cookie_key);
      $new_photo = $_POST['new_photo'];
      $tags_list = $_POST['tags_list'];

      // Проверка на наличие папки пользователя
      if (!is_dir('../users/'.$user_uuid))
      {
          // Создание папки для фотографий пользователя при первой загрузке фотографии и перевод кодировок для понятия названий ОС
          $directory = mkdir("../users/".$user_uuid, 0777);

          if ($directory)
          {
              pg_query("UPDATE users_technical_data SET folder = '{$user_uuid}' WHERE user_uuid = '{$user_uuid}'");
          }else
          {
              echo 'error';
              return;
          }
      }

      // Расширение для новой фотографии
      $sExt = '.jpg';

      // Формирование имени и пути для новой фотографии
      $new_filename_img_without_extension = md5(time().rand());
      $new_filename_img = $new_filename_img_without_extension.$sExt;
      $new_filepath_img = '../users/'.$user_uuid.'/'.$new_filename_img;

      // Занесение фотографии в папку
      @chmod($new_filepath_img, 0644);

      $img = str_replace('data:image/png;base64,', '', $new_photo);
      $img = str_replace(' ', '+', $img);
      $data = base64_decode($img);

      // Если новая фотография успешно занесена в папку
      if (file_put_contents($new_filepath_img, $data))
      {
        add_new_user_photo_to_db($user_uuid, $new_filename_img);

        $new_photo_uuid = get_photo_uuid_by_name($new_filename_img);

        if ($tags_list != "")
        {
          $new_tags_array = explode(",", $tags_list);

          foreach($new_tags_array as $key => $value) {
            $tag_value = strtolower(str_replace(' ', '_', preg_replace('/[^ a-zа-яё\d]/ui', '', trim($value))));

            $add_new_tag = pg_query("INSERT INTO tags (tag_text) 
                                      SELECT '{$tag_value}'
                                      WHERE NOT EXISTS (SELECT 1 FROM tags WHERE tag_text = '{$tag_value}')") or trigger_error(pg_last_error().$add_new_tag);

            if (get_tag_uuid_by_text($tag_value))
            {
              $photo_tag_uuid = get_tag_uuid_by_text($tag_value);
              $add_new_photo_tag = pg_query("INSERT INTO photos_tags (photo_uuid, tag_uuid) VALUES ('{$new_photo_uuid}', '{$photo_tag_uuid}')")
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
}else
{
    echo 'error';
    return;
}
?>
