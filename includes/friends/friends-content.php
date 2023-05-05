<div class="row w-100 m-0 col-md-8 p-0 order-2 order-sm-2 order-md-1 order-lg-1 order-xl-1" id="block-friends">
<?
  switch ($sort) {
    case 'all-friends':
      include("includes/friends/friends-list.php");
      break;
    case 'online':
      include("includes/friends/online-list.php");
      break;
    case 'subscribers':
      include("includes/friends/subscribers-list.php");
      break;
    case 'subscriptions':
      include("includes/friends/subscriptions-list.php");
      break;
    case 'received':
      include("includes/friends/received-list.php");
      break;
    case 'submitted':
      include("includes/friends/submitted-list.php");
      break;
    default:
      include("includes/friends/friends-list.php");
      break;
  }
?>
</div>

<div class="col-md-4 section-search-and-sort mb-3 order-1 order-sm-1 order-md-2 order-lg-2 order-xl-2">
<?
  include('includes/friends/friends-menu.php');
  include('includes/friends/potential-friends.php');
?>
</div>
<script type="text/javascript" src="js/friends.js"></script>