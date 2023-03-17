<?php
define('mystatify', true);

if (isset($_POST["country"]))
{
    require_once(realpath('../includes/connection.php'));
    include("../functions/database-functions.php");

    $country_value = $_POST['country'];

    $json = json_encode(get_cities_list_in_country($country_value));
    
    echo $json;
}
?>