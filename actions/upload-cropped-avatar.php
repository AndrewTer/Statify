<?php
define('mystatify', true);
include('../functions/functions-user-data.php');
include('../classes/image_processing.php');

if (isset($_POST['user_uuid']) && isset($_POST['avatar_img']))
{
    require_once(realpath('../includes/connection.php'));

    $user_uuid = $_POST['user_uuid'];
    $avatar_img = $_POST['avatar_img'];

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

    $img = str_replace('data:image/png;base64,', '', $avatar_img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);

    // Если новая фотография успешно занесена в папку
    if (file_put_contents($new_filepath_img, $data))
    {
        $last_user_avatar = get_latest_avatar($user_uuid);

        // Если существует фотография у пользователя (последняя добавленная)
        if ($last_user_avatar)
        {
            // Занесение даты обновления для прошлой фотографии
            set_update_date_for_latest_avatar($user_uuid, $last_user_avatar);
            // Добавление данных о новой фотографии в БД
            add_new_avatar_to_db($user_uuid, $new_filename_img);
            
            // Получение имени и расширения прошлой фотографии
            $filename_old = pathinfo($last_user_avatar, PATHINFO_FILENAME);
            $sExt_old = pathinfo($last_user_avatar, PATHINFO_EXTENSION);
            // Формирование полного имени файла-превью прошлой фотографии для удаления
            $last_user_avatar_preview = $filename_old.'_90x90.'.$sExt_old;

            // Если файл-превью прошлой фотографии существует в папке пользователя, то удаление
            if (file_exists('../users/'.$user_uuid.'/'.$last_user_avatar_preview))
                unlink('../users/'.$user_uuid.'/'.$last_user_avatar_preview);
        }else
            add_new_avatar_to_db($user_uuid, $new_filename_img);

        $new_filename_img_90x90 = $new_filename_img_without_extension.'_90x90'.$sExt;
        $new_filepath_img_90x90 = '../users/'.$user_uuid.'/'.$new_filename_img_90x90;

        $image_90x90 = new Thumbs($new_filepath_img);
        $image_90x90->thumb(90, 90);
        $image_90x90->save($new_filepath_img_90x90);

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
?>
