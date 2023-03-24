<div class="w-100 m-0 col-md-8 p-0 h-100 order-2 order-sm-2 order-md-1 order-lg-1 order-xl-1" id="block-news">
<?
  $sort = !empty($_GET['sort']) ? htmlspecialchars($_GET['sort']) : '';

  switch ($sort) {
    case 'mine':
      include("includes/news/user-news-list.php");
      break;

    case 'friends':
      include("includes/news/friends-news-list.php");
      break;

    case 'popular':
      include("includes/news/popular-news-list.php");
      break;
        
    default:
      include("includes/news/user-news-list.php");
      break;
  }
?>
</div>

<div class="col-md-4 section-search-and-sort mb-3 h-100 order-1 order-sm-1 order-md-2 order-lg-2 order-xl-2">
<?
  include("includes/news/news-sort.php");

  if ($sort == 'popular')
  {
    include("includes/news/news-top-users.php");
    include('includes/search/search-top-tags.php');
    //include("includes/news/news-best-of-the-month.php");
  }
?>
</div>