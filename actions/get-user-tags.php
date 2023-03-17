<?php
define('mystatify', true);

if (isset($_POST["user_uuid"]) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user_uuid'])))
{
    require_once(realpath('../includes/connection.php'));
    include("../functions/database-functions.php");
    include("../functions/functions-user-data.php");

    $user_uuid = $_POST['user_uuid'];

    $json = json_encode(get_user_tags($user_uuid));
    
    echo $json;
}
?>