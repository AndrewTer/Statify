<?php 
  $page_status = check_user_page_status($current_user_uuid);
  $premium_status = check_premium_active($current_user_uuid);

  include("../requests/user-info.php");

  if (ban_check($user_uuid) == 'success')
  {
  
    if ($page_status && $current_user_uuid == $user_uuid)
      include("../requests/user-main-statistics.php");
?>
<script type="text/javascript" src='js/Chart.bundle.min.js'></script>

<?
    if ($current_user_uuid == $user_uuid)
    {
      echo '<div class="m-0 p-0 d-flex flex-column col-12 col-sm-4 col-md-4 col-lg-3 col-xl-3 text-center person-main-info order-2 order-sm-1 order-md-1 order-lg-1 order-xl-1" id="block-with-info-by-user">';
      include("../includes/user_page/bio/user-content-about.php");
      include("../includes/user_page/bio/user-content-interests.php");
      include("../includes/user_page/bio/user-content-tags.php");
      include("../includes/user_page/bio/user-content-socials.php");
      echo '</div>';
    }else
    {
      echo '<div class="m-0 p-0 row col-12 text-center person-main-info" id="block-with-info-by-user">
              <div class="m-0 mb-3 p-0 col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">';
      include("../includes/user_page/bio/user-content-about.php");
      include("../includes/user_page/bio/user-content-tags.php");
      echo '  </div>
              <div class="m-0 p-0 col-12 col-sm-6 col-md-6 col-lg-6 col-xl-6 person-info">';
      include("../includes/user_page/bio/user-content-interests.php");
      include("../includes/user_page/bio/user-content-socials.php");
      echo '  </div>
            </div>';
    }

    if ($page_status && $current_user_uuid == $user_uuid)
    {
      include("user-content-statistics-with-radar.php");
    }else
      include("registration-completion.php");
  }
?>