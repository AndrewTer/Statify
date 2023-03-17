<? include("requests/user-info.php"); ?>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-3 text-center person-main-info order-1 order-sm-1 order-md-1 order-lg-1 order-xl-1">
<?
  include("includes/user_page/user-info-avatar.php");
  
  if (check_email_confirmed($user_uuid))
    include("includes/user_page/user-info-avatar-update.php");

  include("includes/user_page/user-info-confirm-email.php");
  include("includes/user_page/user-info-about.php");
  include("includes/user_page/user-info-interests.php");
  include("includes/user_page/user-info-tags.php");
  include("includes/user_page/user-info-socials.php");
?>
</div>