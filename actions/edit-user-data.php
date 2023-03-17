<?php
defined('mystatify');

if (isset($_POST["user_name"]) && isset($_POST["user_surname"]) && isset($_POST["user_date_born"])
    && isset($_POST["user_country"]) && isset($_POST["user_city"])
    && isset($_POST["vk_link"]) && isset($_POST["inst_link"]) && isset($_POST["ok_link"])
    && isset($_POST["user_uuid"])
    && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user_uuid'])))
{
    require_once(realpath('../includes/connection.php'));

    $user_uuid = trim(htmlspecialchars($_POST['user_uuid'], ENT_QUOTES));
    $user_name = trim(htmlspecialchars($_POST['user_name'], ENT_QUOTES));
    $user_surname = trim(htmlspecialchars($_POST['user_surname'], ENT_QUOTES));
    $user_date_born = trim(htmlspecialchars($_POST['user_date_born'], ENT_QUOTES));
    $user_country = trim(htmlspecialchars($_POST['user_country'], ENT_QUOTES));
    $user_city = trim(htmlspecialchars($_POST['user_city'], ENT_QUOTES));
    $vk_link = trim(htmlspecialchars($_POST['vk_link'], ENT_QUOTES));
    $inst_link = trim(htmlspecialchars($_POST['inst_link'], ENT_QUOTES));
    $ok_link = trim(htmlspecialchars($_POST['ok_link'], ENT_QUOTES));

    if ($user_country != 'Other')
    {
        if ($user_city != 'Other')
        {
            $country_and_city_uuid_query = pg_query("SELECT countries.uuid, cities.uuid
                                                    FROM cities 
                                                    INNER JOIN countries
                                                            ON cities.country = countries.uuid
                                                    WHERE cities.value = '{$user_city}' AND countries.value = '{$user_country}'")
                                            or trigger_error(pg_last_error().$city_uuid_query);

            $country_and_city_uuid_count = pg_num_rows($country_and_city_uuid_query);

            if ($country_and_city_uuid_count == 1)
            {
                if ($country_and_city_uuid_data = pg_fetch_array($country_and_city_uuid_query))
                {
                    $country_and_city_uuid = ", country_uuid = '{$country_and_city_uuid_data[0]}', city_uuid = '{$country_and_city_uuid_data[1]}'";
                }else
                    $country_and_city_uuid = '';
            }else
                $country_and_city_uuid = '';
        }else
            $country_and_city_uuid = ", country_uuid = '{$country_and_city_uuid_data[0]}', city_uuid = NULL";
    }else
        $country_and_city_uuid = ", country_uuid = NULL, city_uuid = NULL";


    $edit_data_row = "UPDATE users SET name = '{$user_name}', surname = '{$user_surname}', birthday = '{$user_date_born}' $country_and_city_uuid WHERE uuid = '{$user_uuid}'";

    $data_result = pg_query($edit_data_row) or trigger_error(pg_last_error().$data_result);

    $check_social_networks = pg_query("SELECT 1 FROM social_networks WHERE user_uuid = '{$user_uuid}'") or trigger_error(pg_last_error().$check_social_networks);

    $check_social_networks_count = pg_num_rows($check_social_networks);

    if ($vk_link || $inst_link || $ok_link)
    {
        $vk_link_str = ($vk_link) ? '\''.$vk_link.'\'' : 'null';
        $inst_link_str = ($inst_link) ? '\''.$inst_link.'\'' : 'null';
        $ok_link_str = ($ok_link) ? '\''.$ok_link.'\'' : 'null';

        if ($check_social_networks_count == 1)
        {
            $edit_social_networks_row = "UPDATE social_networks SET vk_link = $vk_link_str, instagram_link = $inst_link_str, ok_link = $ok_link_str WHERE user_uuid = '{$user_uuid}'";
            $social_networks_result = pg_query($edit_social_networks_row) or trigger_error(pg_last_error().$social_networks_result);
        }else
        {
            pg_query("DELETE FROM social_networks WHERE user_uuid = '{$user_uuid}'") or trigger_error(pg_last_error());

            $add_social_networks_row = "INSERT INTO social_networks (vk_link, instagram_link, ok_link, user_uuid) VALUES ($vk_link_str, $inst_link_str, $ok_link_str, '{$user_uuid}')";

            $social_networks_result = pg_query($add_social_networks_row) or trigger_error(pg_last_error().$social_networks_result);
        }
    }else {
        pg_query("DELETE FROM social_networks WHERE user_uuid = '{$user_uuid}'") or trigger_error(pg_last_error());
    }

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