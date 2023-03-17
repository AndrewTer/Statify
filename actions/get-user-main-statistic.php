<?
  define('mystatify', true);

  if (isset($_POST['current_user']) && (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $_POST['current_user'])))
  {
    require_once("../includes/connection.php");
    include("../functions/functions.php");
    include("../functions/database-functions.php");
    include("../functions/functions-for-check.php");
    include("../functions/functions-user-data.php");
?>
    <script type="text/javascript" src='js/Chart.bundle.min.js'></script>
<?

    $user_uuid = $_POST['current_user'];
    $user_country = get_user_country_name($user_uuid);
    $user_city = get_user_city_name($user_uuid);
    $user_gender = get_user_gender($user_uuid);

    $page_status = check_user_page_status($user_uuid);
    $premium_status = check_premium_active($user_uuid);
    $avatar_exists = get_latest_avatar($user_uuid);

    include("../requests/user-info.php");
    include("../requests/user-main-statistics.php");
    include("../requests/top-five-friends.php");

    echo '<div class="m-0 mt-1 p-0" id="block-with-main-user-statistic">';

    include("../includes/user_page/user-content-statistics-with-radar.php");
    include("../includes/user_page/user-content-top-friends.php");

    echo '</div>';
  }
?>