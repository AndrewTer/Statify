<div class="w-100 m-0 p-0 col-md-9 order-2 order-sm-2 order-md-1 order-lg-1 order-xl-1">
<?
  $sort = !empty($_GET['sort']) ? htmlspecialchars($_GET['sort']) : '';

  switch ($sort) {
    case 'rules':
      include("includes/about/rules-about-list.php");
      break;

    case 'consent':
      include("includes/about/consent.php");
      break;

    case 'updates':
      include("includes/about/updates-about-list.php");
      break;

    case 'help':
      include("includes/about/help-about-list.php");
      break;

    case 'limits':
      include("includes/about/limits-about-list.php");
      break;
      
    default:
      include("includes/about/updates-about-list.php");
      break;
  }
?>
</div>

<div class="col-md-3 section-search-and-sort mb-3 pr-0 order-1 order-sm-1 order-md-2 order-lg-2 order-xl-2"><? include("includes/about/about-sort.php"); ?></div>