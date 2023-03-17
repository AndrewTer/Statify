<?php 
  if ($page_status)
  {
    include("requests/user-main-statistics.php");
  }
?>
<script type="text/javascript" src='js/Chart.bundle.min.js'></script>

<div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-9 person-info order-2 order-sm-2 order-md-2 order-lg-2 order-xl-2">
<? 
  include("includes/user_page/user-content-title-info.php");

  if ($page_status)
  {
    include("includes/user_page/user-content-blocks-with-amounts.php");
?>
  <div class="m-0 p-0" id="user-page-content-block">
<?
    include("includes/user_page/user-content-statistics-with-radar.php");
?>
  </div>
<?
  }else
    include("includes/user_page/registration-completion.php");
?>
</div>