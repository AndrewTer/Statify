<?php 
  $page_status = check_user_page_status($current_user_uuid);
  $premium_status = check_premium_active($current_user_uuid);

  include("../requests/user-info-for-statistics.php");

  if (ban_check($user_uuid) == 'success')
  {
  
    if ($page_status && $current_user_uuid == $user_uuid)
      include("../requests/user-main-statistics.php");
?>
<script type="text/javascript" src='js/Chart.bundle.min.js'></script>

<?
    if ($page_status && $current_user_uuid == $user_uuid)
    {
      $user_gender = get_user_gender($user_uuid);

      include("user-content-statistics-with-radar.php");
    }else
      include("registration-completion.php");
  }
?>