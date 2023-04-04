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
      <a class="m-0 p-0" href="rate">
        <img width="80" src="imgs/logo.png">
      </a>
    </div>

    <div class="col-2 p-0 m-0 d-flex justify-content-end align-items-center user-header-menu">
      <a class="m-0 p-1 mr-3 d-flex justify-content-center align-items-center" href="notifications" aria-label="Переход на страницу с уведомлениями" data-toggle="tooltip" data-placement="bottom" title="Уведомления">
        <svg fill="var(--header-footer-text-color)" height="22px" width="22px" viewBox="0 0 448 512">
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

  <div class="mobile-menu-items main-menu m-0 pt-3 pb-5 pl-4 pr-4 d-flex flex-column justify-content-start overflow-auto">
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
        <span class="m-0">
          <div class="fz-15 m-0 p-0 d-flex align-items-center">
            <svg class="m-0 mr-2 p-0 active-star" width="18px" height="18px" viewBox="0 0 24 24" fill="none">
              <path d="M11.0748 3.25583C11.4141 2.42845 12.5859 2.42845 12.9252 3.25583L14.6493 7.45955C14.793 7.80979 15.1221 8.04889 15.4995 8.07727L20.0303 8.41798C20.922 8.48504 21.2841 9.59942 20.6021 10.1778L17.1369 13.1166C16.8482 13.3614 16.7225 13.7483 16.8122 14.1161L17.8882 18.5304C18.1 19.3992 17.152 20.0879 16.3912 19.618L12.5255 17.2305C12.2034 17.0316 11.7966 17.0316 11.4745 17.2305L7.60881 19.618C6.84796 20.0879 5.90001 19.3992 6.1118 18.5304L7.18785 14.1161C7.2775 13.7483 7.1518 13.3614 6.86309 13.1166L3.3979 10.1778C2.71588 9.59942 3.07796 8.48504 3.96971 8.41798L8.50046 8.07727C8.87794 8.04889 9.20704 7.80979 9.35068 7.45955L11.0748 3.25583Z" stroke-width="2"></path>
            </svg>

            <?= (get_user_rating_among_all_users($user_uuid) != 0) ? get_user_rating_among_all_users($user_uuid) : ''; ?>
          </div>
        </span>
      </div>
    </div>

<?
    if (!check_user_page_status($user_uuid))
    {
?>
    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" href="./" aria-label="Профиль">
      <svg class="m-0 p-0 svg-main-menu-icon" width="22px" height="22px" viewBox="0 0 24 24" fill="none">
        <path d="M12 11.796C14.7189 11.796 16.9231 9.60308 16.9231 6.89801C16.9231 4.19294 14.7189 2.00005 12 2.00005C9.28106 2.00005 7.07692 4.19294 7.07692 6.89801C7.07692 9.60308 9.28106 11.796 12 11.796Z"></path>
        <path d="M14.5641 13.8369H9.4359C6.46154 13.8369 4 16.2859 4 19.245C4 19.9593 4.30769 20.5716 4.92308 20.8777C5.84615 21.3879 7.89744 22.0001 12 22.0001C16.1026 22.0001 18.1538 21.3879 19.0769 20.8777C19.5897 20.5716 20 19.9593 20 19.245C20 16.1838 17.5385 13.8369 14.5641 13.8369Z"></path>
      </svg>
      <p class="fz-14 w-100 m-0 ml-3 p-0 text-left">Профиль</p>
    </a>
<?
    }
?>
    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" href="news?sort=popular" aria-label="Новости">
      <svg class="m-0 p-0 svg-main-menu-icon" width="22px" height="22px" viewBox="0 0 24 24">
        <path d="M19.875 3H4.125C2.953 3 2 3.897 2 5v14c0 1.103.953 2 2.125 2h15.75C21.047 21 22 20.103 22 19V5c0-1.103-.953-2-2.125-2zm0 16H4.125c-.057 0-.096-.016-.113-.016-.007 0-.011.002-.012.008L3.988 5.046c.007-.01.052-.046.137-.046h15.75c.079.001.122.028.125.008l.012 13.946c-.007.01-.052.046-.137.046z"></path>
        <path d="M6 7h6v6H6zm7 8H6v2h12v-2h-4zm1-4h4v2h-4zm0-4h4v2h-4z"></path>
      </svg>
      <p class="fz-14 w-100 m-0 ml-3 p-0 text-left">Новости</p>
    </a>

    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" href="friends?sort=all-friends" aria-label="Друзья">
      <svg class="m-0 p-0 svg-main-menu-icon" width="22px" height="22px" viewBox="0 0 24 24" fill="none">
        <path d="M15.5385 11.4899C17.7949 11.4899 19.641 9.65316 19.641 7.40826C19.641 5.16336 17.7949 3.32663 15.5385 3.32663C15.4359 3.32663 15.3334 3.32663 15.2308 3.32663C15.8462 4.34704 16.2564 5.57153 16.2564 6.79602C16.2564 8.53071 15.5385 10.1634 14.4103 11.3879C14.718 11.4899 15.1282 11.4899 15.5385 11.4899Z"></path>
        <path d="M17.2821 13.6326H16.2565C17.7949 14.9591 18.8206 17 18.8206 19.2448C18.8206 19.7551 18.718 20.1632 18.6154 20.5714C19.9488 20.3673 20.7693 20.0612 21.2821 19.7551C21.7949 19.4489 22.0001 18.9387 22.0001 18.3265C22.0001 15.7755 19.8462 13.6326 17.2821 13.6326Z"></path>
        <path d="M9.38459 11.4898C10.6154 11.4898 11.641 11.0817 12.5641 10.2654C13.5897 9.44903 14.1025 8.1225 14.1025 6.79597C14.1025 5.77556 13.7948 4.75515 13.1795 4.04087C12.3589 2.81638 11.0256 2.00005 9.38459 2.00005C6.82049 2.00005 4.66664 4.14291 4.66664 6.69393C4.66664 9.34699 6.82049 11.4898 9.38459 11.4898Z"></path>
        <path d="M12.1538 13.9389C11.8462 13.9389 11.641 13.8369 11.3333 13.8369H7.4359C4.46154 13.8369 2 16.2859 2 19.245C2 19.9593 2.30769 20.4695 2.82051 20.8777C3.64103 21.3879 5.58974 22.0001 9.38461 22.0001C13.1795 22.0001 15.0256 21.3879 15.9487 20.8777C15.9487 20.8777 16.0513 20.7757 16.1538 20.7757C16.5641 20.4695 16.8718 19.9593 16.8718 19.245C16.7692 16.592 14.8205 14.3471 12.1538 13.9389Z"></path>
      </svg>
      <p class="fz-14 w-100 m-0 ml-3 p-0 text-left">Друзья</p>
    </a>

    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" href="search" aria-label="Поиск">
      <svg class="m-0 p-0 svg-search-main-menu-icon" width="22px" height="22px" viewBox="0 0 24 24" fill="none">
        <circle cx="10" cy="10" r="6" stroke="var(--header-element-hover-border-color)" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></circle>
        <path d="M14.5 14.5L19 19" stroke="var(--header-element-hover-border-color)" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
      <p class="fz-14 w-100 m-0 ml-3 p-0 text-left">Поиск</p>
    </a>

    <div class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row">
      <p class="fz-22 w-20 m-0 p-0"></p>
      <hr class="fz-14 w-80 m-0 p-0 hr-user-info">
    </div>

    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" href="rate" aria-label="Оценить">
      <svg class="m-0 p-0 svg-rate-main-menu-icon" width="22px" height="22px" viewBox="0 0 24 24" fill="none">
        <path d="M11.0748 3.25583C11.4141 2.42845 12.5859 2.42845 12.9252 3.25583L14.6493 7.45955C14.793 7.80979 15.1221 8.04889 15.4995 8.07727L20.0303 8.41798C20.922 8.48504 21.2841 9.59942 20.6021 10.1778L17.1369 13.1166C16.8482 13.3614 16.7225 13.7483 16.8122 14.1161L17.8882 18.5304C18.1 19.3992 17.152 20.0879 16.3912 19.618L12.5255 17.2305C12.2034 17.0316 11.7966 17.0316 11.4745 17.2305L7.60881 19.618C6.84796 20.0879 5.90001 19.3992 6.1118 18.5304L7.18785 14.1161C7.2775 13.7483 7.1518 13.3614 6.86309 13.1166L3.3979 10.1778C2.71588 9.59942 3.07796 8.48504 3.96971 8.41798L8.50046 8.07727C8.87794 8.04889 9.20704 7.80979 9.35068 7.45955L11.0748 3.25583Z" stroke-width="2"></path>
      </svg>
      <p class="fz-14 w-100 m-0 ml-3 p-0 text-left">Оценить</p>
    </a>
  </div>

  <div class="header-full w-100 row m-0 h-100 d-none d-sm-none d-md-none d-lg-flex d-xl-flex justify-content-between">

    <div class="m-0 ml-2 mr-auto d-flex justify-content-center align-items-center header-logo">
      <a class="m-0 p-0 pb-1" href="rate">
        <img width="90" src="imgs/logo.png">
      </a>
    </div>

    <div class="m-0 p-0 input-with-icon d-flex flex-row align-items-center position-relative" id="header-search">
      <svg class="position-absolute" width="17px" height="17px" viewBox="0 0 24 24" fill="none">
        <circle cx="10" cy="10" r="6" stroke="var(--header-element-hover-border-color)" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></circle>
        <path d="M14.5 14.5L19 19" stroke="var(--header-element-hover-border-color)" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
      <input type="text" class="fz-14 w-100 mt-2 mb-2 p-0 input-field d-flex align-items-center" id="header-search-input" placeholder="Поиск" autocomplete="off">    
    </div>

    <div class="m-0 ml-auto p-0 d-flex justify-content-end align-items-center user-header-menu">
      <a class="m-0 p-1 mr-3 d-flex justify-content-center align-items-center" href="notifications" aria-label="Переход на страницу с уведомлениями" data-toggle="tooltip" data-placement="bottom" title="Уведомления">
        <svg fill="var(--header-footer-text-color)" height="22px" width="22px" viewBox="0 0 448 512">
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