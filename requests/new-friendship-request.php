<?
if(!empty($_GET["uuid"]))
{
  $friendship_request_uuid = $_GET["uuid"];
  $friendship_request_query = pg_query("SELECT uuid, name, surname, nickname FROM users WHERE uuid = '{$friendship_request_uuid}'") or trigger_error(pg_last_error().$friendship_request_query);

  $friendship_request_count = pg_num_rows($friendship_request_query);

  if($friendship_request_count == 1)
  {
    if($friendship_data = pg_fetch_array($friendship_request_query))
    {
      $friendship_user_uuid = $friendship_data[0];
      $friendship_user_fullname = $friendship_data[1].' '.$friendship_data[2];
      $friendship_user_nickname = '@'.$friendship_data[3];
      $friendship_user_picture = get_latest_avatar($friendship_user_uuid);
    }else
    {
      header("Location: index.php");
    }
  }else
  {
    header("Location: index.php");
  }

}else
{
  header("Location: index.php");
}
?>