<?php
define('mystatify', true);

if (isset($_POST["photo_uuid"]))
{
  require_once(realpath('../includes/connection.php'));
  include("../functions/database-functions.php");
  include("../functions/functions-photos.php");

  $photo_uuid = substr($_POST["photo_uuid"], 0, 8).'-'.substr($_POST["photo_uuid"], 8, 4).'-'.substr($_POST["photo_uuid"], 12, 4).'-'.substr($_POST["photo_uuid"], 16, 4).'-'.substr($_POST["photo_uuid"], 20);

  $json = json_encode(get_current_photo_tags($photo_uuid));
    
  echo $json;
}
?>