<?php
defined('mystatify');

if (isset($_POST["current_photo"]))
{
	require_once(realpath('../includes/connection.php'));
	include('../functions/functions-user-data.php');
	include('../functions/functions-photos.php');
	include('../classes/image_processing.php');

	if (!empty($_COOKIE['login']) and !empty($_COOKIE['key']))
  {
    $cookie_login = $_COOKIE['login'];
    $cookie_key = $_COOKIE['key'];

    if (get_user_uuid_by_cookie($cookie_login, $cookie_key))
    {
      $user_uuid = get_user_uuid_by_cookie($cookie_login, $cookie_key);
			$photo_uuid = $_POST['current_photo'];

			$current_user_avatar = get_user_avatar($user_uuid);
			$current_user_avatar_uuid = get_photo_uuid_by_name($current_user_avatar);

			// Если у пользователя на данный момент имеется фотография профиля
			if ($current_user_avatar)
			{
				// Получение имени и расширения текущей фотографии профиля
        $filename_current = pathinfo($current_user_avatar, PATHINFO_FILENAME);
        $sExt_current = pathinfo($current_user_avatar, PATHINFO_EXTENSION);
        
        // Формирование полного имени файла-превью текущей фотографии профиля для удаления
        $current_user_avatar_preview = $filename_current.'_90x90.'.$sExt_current;

         // Если файл-превью текущей фотографии профиля существует в папке пользователя, то происходит удаление
        if (file_exists('../users/'.$user_uuid.'/'.$current_user_avatar_preview))
          unlink('../users/'.$user_uuid.'/'.$current_user_avatar_preview);
			}

			// Получение имени и расширения новой фотографии профиля
			$new_user_avatar = get_photo_name_by_uuid($photo_uuid);

      $filename_new = pathinfo($new_user_avatar, PATHINFO_FILENAME);
      $sExt_new = pathinfo($new_user_avatar, PATHINFO_EXTENSION);

      // Формирование полного имени и пути для новой фотографии профиля
      $new_filepath_img = '../users/'.$user_uuid.'/'.$new_user_avatar;

      // Формирование полного имени и пути для фотографии профиля-превью
			$new_filename_img_90x90 = $filename_new.'_90x90.'.$sExt_new;
      $new_filepath_img_90x90 = '../users/'.$user_uuid.'/'.$new_filename_img_90x90;

      // Загрузка нового фото-превью в папку пользователя
      $image_90x90 = new Thumbs($new_filepath_img);
      $image_90x90->thumb(90, 90);
      $image_90x90->save($new_filepath_img_90x90);

			// Смена аватара пользователя в БД
			pg_query("UPDATE users SET avatar_uuid = '{$photo_uuid}' WHERE uuid = '{$user_uuid}'");

			// Создание записи о смене фотографии профиля
			if ($current_user_avatar_uuid)
				pg_query("INSERT INTO news (author_uuid, news_type, old_avatar_uuid, new_avatar_uuid, creation_date) 
									VALUES ('{$user_uuid}', 'profilePhotoUpdate', '{$current_user_avatar_uuid}', '{$photo_uuid}', NOW())");
			else
				pg_query("INSERT INTO news (author_uuid, news_type, new_avatar_uuid, creation_date) 
									VALUES ('{$user_uuid}', 'profilePhotoUpdate', '{$photo_uuid}', NOW())");


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