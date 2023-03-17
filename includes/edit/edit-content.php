<? 
  if ($page_status)
  {
?>
<div class="edit-avatar col-12 col-sm-5 col-md-5 col-lg-5 p-0">
  <div id="edit-user-avatar-info" class="p-0 w-100 m-0">
    <div class="block-edit-user-avatar m-0 p-0"><? include('includes/edit/edit-user-avatar.php'); ?></div>
    <div class="block-edit-user-fixed-info p-0"><? include('includes/edit/edit-user-fixed-info.php'); ?></div>
<?
    if (!check_email_confirmed($user_uuid))
    {
?>
      <div class="block-edit-user-confirm-email p-0"><? include('includes/edit/edit-user-confirm-email.php'); ?></div>
<?
    }
?>
  </div>
</div>

<div class="col-12 col-sm-7 col-md-7 col-lg-7 edit-user-info">
  <div class="block-edit-user-info p-0"><? include('includes/edit/edit-user-info.php'); ?></div>
  <div class="block-edit-user-interests p-0"><? include('includes/edit/edit-user-interests-info.php'); ?></div>
  <div class="block-edit-user-tags p-0"><? include('includes/edit/edit-user-tags.php'); ?></div>
</div>
<script type="text/javascript" src="js/edit.js"></script>
<?
  }else
    echo '<span class="d-flex justify-content-center p-5 w-100"><strong class="h5 text-center">Редактирование недоступно</strong></span>';
?>