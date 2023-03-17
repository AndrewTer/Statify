<?php
  set_online_status($user_uuid);
  include("requests/all-notifications-count.php");

  $page_status = check_user_page_status($user_uuid);
  $avatar_exists = get_latest_avatar($user_uuid);
  $user_fullname = get_user_fullname($user_uuid);

  $premium_status = check_premium_active($user_uuid);
?>
<div class="header w-100 container-fluid m-0 p-0 d-flex justify-content-center align-items-center" id="main-header-block" data-attr="<?= $user_uuid; ?>">

  <div class="header-mobile w-100 row m-0 h-100 d-sm-flex d-lg-none d-xl-none">
    
    <div class="col-2 navbar-menu p-0">
      <div class="nav-menu-container d-flex justify-content-start align-items-center m-0 p-0 w-100 h-100">
        <input class="checkbox-menu" type="checkbox" id="mobile-menu-checkbox" aria-label="Меню" />       
        <div class="hamburger-lines d-flex flex-column justify-content-between">
          <span class="line line1"></span>
          <span class="line line2"></span>
          <span class="line line3"></span>
        </div>
      </div>
    </div>

    <div class="col-8 d-flex justify-content-center align-items-center header-logo">
<?
    if (date("m") == 12 || date("m") == 1 || date("m") == 2)
    {
      if ((date("m") == 12 && date("d") > 20) || (date("m") == 1 && date("d") < 11))
      {
        echo '<img class="mr-1" width="30" src="imgs/christmas_tree.webp">'; 
      }else
      {
        echo '<i class="fa fa-snowflake-o fz-20 mr-2 pt-1" aria-hidden="true" style="color: cyan;"></i>';
      }
    }
?>
      <a class="m-0 p-0" href="rate">
        <img width="80" src="imgs/logo.png">
      </a>
    </div>

    <div class="col-2 p-0 m-0 d-flex justify-content-end align-items-center user-header-menu">
      <a class="m-0 p-1 mr-3 d-flex justify-content-center align-items-center" href="notifications" aria-label="Переход на страницу с уведомлениями">
        <svg fill="var(--header-footer-text-color)" height="22px" width="22px" version="1.2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 448 512" xml:space="preserve">
          <path d="M222.987,510c31.418,0,57.529-22.646,62.949-52.5H160.038C165.458,487.354,191.569,510,222.987,510z"></path>
          <path d="M432.871,352.059c-22.25-22.25-49.884-32.941-49.884-141.059c0-79.394-57.831-145.269-133.663-157.83h-4.141 c4.833-5.322,7.779-12.389,7.779-20.145c0-16.555-13.42-29.975-29.975-29.975s-29.975,13.42-29.975,29.975 c0,7.755,2.946,14.823,7.779,20.145h-4.141C120.818,65.731,62.987,131.606,62.987,211c0,108.118-27.643,118.809-49.893,141.059 C-17.055,382.208,4.312,434,47.035,434H398.93C441.568,434,463.081,382.269,432.871,352.059z"></path> 
        </svg>
<?
        if ($notifications_all_count > 0)
          echo '<p class="fz-12 p-0 pr-2 pl-2 notifications-count" id="notification-count">'.(($notifications_all_count > 99) ? '99+' : $notifications_all_count).'</p>';
?>        
      </a>
<?
      if ($avatar_exists) 
      {
        $preview_photo_check = file_exists('users/'.$user_uuid.'/'.get_latest_avatar_preview($user_uuid)) ? 1 : 0;

        echo '<img class="rounded-circle m-0 p-0 user-header-menu-picture" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($user_uuid) : get_latest_avatar($user_uuid)).'" alt="'.$user_fullname.'">';
      }else
        echo '<img class="rounded-circle m-0 p-0 user-header-menu-picture" src="imgs/no-avatar.png" alt="'.$user_fullname.'">';
?>
    </div>
    
  </div>

  <div class="mobile-menu-items m-0 pt-3 pb-5 pl-4 pr-4 d-flex flex-column justify-content-start overflow-auto">
    <div class="m-0 p-0 w-100 d-flex flex-column justify-content-center align-items-center">
      <div class="mobile-menu-avatar-block avatar-mobile-menu mb-3" id="main-user-avatar">
<?
      if ($avatar_exists)
        echo '<img class="btn-md online rounded-circle" 
                id="userImg" 
                src="users/'.$user_uuid.'/'.get_latest_avatar($user_uuid).'" 
                alt="'.$user_fullname.'" 
                onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$user_uuid.'\',\''.get_latest_avatar($user_uuid).'\');">';
      else
        echo '<img class="btn-md online rounded-circle" id="userImg" src="imgs/no-avatar.png" alt="'.$user_fullname.'">';
?>
      </div>

      <a class="m-0 p-0" href="./">
        <p class="card-title username w-100 fz-15 d-flex justify-content-center align-items-center font-weight-bold text-center"><?= (get_user_nickname($user_uuid)) ? $user_fullname : ''; ?></p>
        <p class="fz-12 m-0 text-center"><?= (get_user_nickname($user_uuid)) ? '@'.get_user_nickname($user_uuid) : ''; ?></p>
      </a>

      <div class="hr-with-text w-100 m-0 mt-3 mb-1">
        <span class="fz-13 m-0">
          <i class="fa fa-star-o active-star" aria-hidden="true"></i>
          <?= (get_user_rating_among_all_users($user_uuid) != 0) ? get_user_rating_among_all_users($user_uuid) : ''; ?>
        </span>
      </div>
    </div>

<?
    if (!check_user_page_status($user_uuid))
    {
?>
    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row font-weight-bold" href="./" aria-label="Профиль">
      <p class="fz-14 m-0 p-0 pt-1 pb-1 icon-mobile-menu text-center"><i class="fa fa-user-o" aria-hidden="true"></i></p>
      <p class="fz-14 w-100 m-0 ml-2 p-0 pt-1 pb-1 text-left">Профиль</p>
    </a>
<?
    }
?>
    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row font-weight-bold" href="news?sort=popular" aria-label="Новости">
        <p class="fz-14 m-0 p-0 pt-1 pb-1 icon-mobile-menu text-center"><i class="fa fa-newspaper-o" aria-hidden="true"></i></p>
        <p class="fz-14 w-100 m-0 ml-2 p-0 pt-1 pb-1 text-left">Новости</p>
    </a>

    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row font-weight-bold" href="friends?sort=all-friends" aria-label="Друзья">
        <p class="fz-14 m-0 p-0 pt-1 pb-1 icon-mobile-menu text-center"><i class="fa fa-users" aria-hidden="true"></i></p>
        <p class="fz-14 w-100 m-0 ml-2 p-0 pt-1 pb-1 text-left">Друзья</p>
    </a>

    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row font-weight-bold" href="search" aria-label="Поиск">
        <p class="fz-14 m-0 p-0 pt-1 pb-1 icon-mobile-menu text-center"><i class="fa fa-search" aria-hidden="true"></i></p>
        <p class="fz-14 w-100 m-0 ml-2 p-0 pt-1 pb-1 text-left">Поиск</p>
    </a>

    <div class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row font-weight-bold">
        <p class="fz-14 m-0 p-0 icon-mobile-menu"></p>
        <hr class="fz-14 w-75 m-0 p-0 hr-user-info">
    </div>

    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row font-weight-bold" href="rate" aria-label="Оценить">
        <p class="fz-14 m-0 p-0 pt-1 pb-1 icon-mobile-menu text-center"><i class="fa fa-star-o" aria-hidden="true"></i></p>
        <p class="fz-14 w-100 m-0 ml-2 p-0 pt-1 pb-1 text-left">Оценить</p>
    </a>
  </div>

  <div class="header-full w-100 row m-0 h-100 d-none d-sm-none d-md-none d-lg-flex d-xl-flex justify-content-between">

    <div class="m-0 ml-2 mr-auto d-flex justify-content-center align-items-center header-logo">
      <a class="m-0 p-0 pb-1" href="rate">
        <img width="90" src="imgs/logo.png">
      </a>
    </div>

    <div class="m-0 p-0 input-with-icon d-flex flex-row align-items-center position-relative" id="header-search">
      <i class="fa fa-search fz-14" aria-hidden="true"></i>
      <input type="text" class="fz-14 w-100 mt-2 mb-2 p-0 input-field d-flex align-items-center" id="header-search-input" placeholder="Поиск" autocomplete="off">    
    </div>

    <div class="m-0 ml-auto p-0 d-flex justify-content-end align-items-center user-header-menu">
      <a class="m-0 p-1 mr-3 d-flex justify-content-center align-items-center" href="notifications" aria-label="Переход на страницу с уведомлениями">
        <svg fill="var(--header-footer-text-color)" height="22px" width="22px" version="1.2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 448 512" xml:space="preserve">
          <path d="M222.987,510c31.418,0,57.529-22.646,62.949-52.5H160.038C165.458,487.354,191.569,510,222.987,510z"></path>
          <path d="M432.871,352.059c-22.25-22.25-49.884-32.941-49.884-141.059c0-79.394-57.831-145.269-133.663-157.83h-4.141 c4.833-5.322,7.779-12.389,7.779-20.145c0-16.555-13.42-29.975-29.975-29.975s-29.975,13.42-29.975,29.975 c0,7.755,2.946,14.823,7.779,20.145h-4.141C120.818,65.731,62.987,131.606,62.987,211c0,108.118-27.643,118.809-49.893,141.059 C-17.055,382.208,4.312,434,47.035,434H398.93C441.568,434,463.081,382.269,432.871,352.059z"></path> 
        </svg>
<?
        if ($notifications_all_count > 0)
          echo '<p class="fz-12 p-0 pr-2 pl-2 notifications-count" id="notification-count">'.(($notifications_all_count > 99) ? '99+' : $notifications_all_count).'</p>';
?>
      </a>
<? 
      if ($avatar_exists) 
      {
        $preview_photo_check = file_exists('users/'.$user_uuid.'/'.get_latest_avatar_preview($user_uuid)) ? 1 : 0;

        echo '<img class="rounded-circle m-0 p-0 user-header-menu-picture" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_latest_avatar_preview($user_uuid) : get_latest_avatar($user_uuid)).'" alt="'.$user_fullname.'">';
      }else
        echo '<img class="rounded-circle m-0 p-0 user-header-menu-picture" src="imgs/no-avatar.png" alt="'.$user_fullname.'">';
        
      include("includes/header/settings-menu.php"); 
?>
    </div>

  </div>

<? include("includes/header/settings-menu-mobile.php"); ?>
</div>

<div class="toast m-0 pl-2 pr-2" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
  <div class="toast-body fz-14"></div>
</div>

<script type="text/javascript" src="js/header.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('*[data-href]').on('click', function() {
        window.location = $(this).data("href");
    });
});
</script>