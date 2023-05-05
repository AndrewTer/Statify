<div class="w-100 m-0 col-md-8 p-0 h-100 order-2 order-sm-2 order-md-1 order-lg-1 order-xl-1 block-user-content">
<? include("includes/comments/comments-list.php"); ?>
</div>

<div class="col-md-4 section-search-and-sort mb-3 order-1 order-sm-1 order-md-2 order-lg-2 order-xl-2">
<?
  include("includes/comments/comments-user-about.php");

  if ($user_uuid != $photo_user_uuid)
  {
    if ($avatar_exists && check_email_confirmed($user_uuid) && (user_friendly_status($user_uuid, $photo_user_uuid) == 'friend' || !check_only_friends_can_rate_photos($photo_user_uuid)))
    {
      include("includes/comments/comments-other-photos.php");
      include("includes/comments/comments-rating.php");
    }
  }else
  {
    include("includes/comments/comments-statistics.php");
    include("includes/comments/comments-other-photos.php");
  }
?>
</div>