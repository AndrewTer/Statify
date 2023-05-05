<?php
defined('mystatify');

if (isset($_POST["user_uuid"]) && isset($_POST["user_gender_preference"]) && isset($_POST["user_age_preference"])
    && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['user_uuid'])))
{
    require_once(realpath('../includes/connection.php'));
    include("../functions/functions.php");
    include("../functions/functions-user-data.php");

    $user_uuid = trim(htmlspecialchars($_POST['user_uuid'], ENT_QUOTES));
    $user_gender_preference = trim(htmlspecialchars($_POST['user_gender_preference'], ENT_QUOTES));
    $user_age_preference = trim(htmlspecialchars($_POST['user_age_preference'], ENT_QUOTES));
    $user_age = (get_user_birthday($user_uuid)) ? calculate_age(get_user_birthday($user_uuid)) : 1;

    $gender_preference_uuid_query = pg_query("SELECT uuid FROM genders WHERE title = '{$user_gender_preference}' LIMIT 1")
                                        or trigger_error(pg_last_error().$gender_preference_uuid_query);

    $gender_preference_uuid_count = pg_num_rows($gender_preference_uuid_query);
    
    if ($gender_preference_uuid_count == 1)
    {
        if ($gender_preference_uuid_data = pg_fetch_array($gender_preference_uuid_query))
        {
            $user_gender_preference_query_text = "gender_preference = '{$gender_preference_uuid_data[0]}'";
        }else
            $user_gender_preference_query_text = '';
    } else
        $user_gender_preference_query_text = '';

    if ($user_age && $user_age_preference)
    {
        if ($user_age < 18)
        {
            $min_age_preference_value = 16;
            $max_age_preference_value = 18;

            $user_age_preference_query_text = ", minimum_age_preference = ".$min_age_preference_value.", maximum_age_preference = ".$max_age_preference_value;
        }else
        {
            switch ($user_age_preference) {
                case 3:
                    $min_age_preference_value = ($user_age - 3) > 18 ? $user_age - 3 : 18;
                    $max_age_preference_value = $user_age + 3;
                    break;

                case 5:
                    $min_age_preference_value = ($user_age - 5) > 18 ? $user_age - 5 : 18;
                    $max_age_preference_value = $user_age + 5;
                    break;

                case 10:
                    $min_age_preference_value = ($user_age - 10) > 18 ? $user_age - 10 : 18;
                    $max_age_preference_value = $user_age + 10;
                    break;

                case 15:
                    $min_age_preference_value = ($user_age - 15) > 18 ? $user_age - 15 : 18;
                    $max_age_preference_value = $user_age + 15;
                    break;

                case 20:
                    $min_age_preference_value = ($user_age - 20) > 18 ? $user_age - 20 : 18;
                    $max_age_preference_value = $user_age + 20;
                    break;

                case 25:
                    $min_age_preference_value = ($user_age - 25) > 18 ? $user_age - 25 : 18;
                    $max_age_preference_value = $user_age + 25;
                    break;
                
                default:
                    $min_age_preference_value = ($user_age - 5) > 18 ? $user_age - 5 : 18;
                    $max_age_preference_value = $user_age + 5;
                    break;
            }

            $user_age_preference_query_text = ", minimum_age_preference = ".$min_age_preference_value.", maximum_age_preference = ".$max_age_preference_value;
        }
    } else
        $user_age_preference_query_text = '';

    $edit_data_row = "UPDATE users SET $user_gender_preference_query_text $user_age_preference_query_text WHERE uuid = '{$user_uuid}'";

    $data_result = pg_query($edit_data_row) or trigger_error(pg_last_error().$data_result);

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