<?php
  set_online_status($user_uuid);
  include("requests/all-notifications-count.php");

  $page_status = check_user_page_status($user_uuid);
  $avatar_exists = get_user_avatar($user_uuid);
  $user_fullname = get_user_fullname($user_uuid);
  $premium_status = check_premium_active($user_uuid);
  $user_latest_photo_date = get_latest_user_photo_date_upload($user_uuid);
?>
<div class="header w-100 container-fluid m-0 p-0 d-flex justify-content-center align-items-center" id="main-header-block" data-attr="<?= $user_uuid; ?>">

  <div class="header-mobile w-100 row m-0 h-100 d-sm-flex d-lg-none d-xl-none">
    <div class="navbar-menu m-0 p-0">
      <div class="nav-menu-container d-flex justify-content-start align-items-center m-0 p-0 w-100 h-100">
        <input class="checkbox-menu" type="checkbox" id="mobile-menu-checkbox" aria-label="Меню" />       
        <div class="hamburger-lines d-flex flex-column justify-content-between">
          <span class="line line1"></span>
          <span class="line line2"></span>
          <span class="line line3"></span>
        </div>
      </div>
    </div>

    <div class="m-0 ml-5 p-0 d-flex justify-content-start align-items-center header-logo">
      <a class="m-0 p-0 pb-1" href="rate">
        <img width="80" src="imgs/logo.png" alt="Statify">
      </a>
    </div>

    <div class="p-0 m-0 ml-auto d-flex justify-content-end align-items-center user-header-menu">
      <a class="m-0 p-1 mr-2 d-flex justify-content-center align-items-center" href="activity" aria-label="Переход на страницу с активностью" data-toggle="tooltip" data-placement="bottom" title="Активность">
        <p class="m-0 p-0">
          <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none">
            <path d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2ZM17.26 9.96L14.95 12.94C14.66 13.31 14.25 13.55 13.78 13.6C13.31 13.66 12.85 13.53 12.48 13.24L10.65 11.8C10.58 11.74 10.5 11.74 10.46 11.75C10.42 11.75 10.35 11.77 10.29 11.85L7.91 14.94C7.76 15.13 7.54 15.23 7.32 15.23C7.16 15.23 7 15.18 6.86 15.07C6.53 14.82 6.47 14.35 6.72 14.02L9.1 10.93C9.39 10.56 9.8 10.32 10.27 10.26C10.73 10.2 11.2 10.33 11.57 10.62L13.4 12.06C13.47 12.12 13.54 12.12 13.59 12.11C13.63 12.11 13.7 12.09 13.76 12.01L16.07 9.03C16.32 8.7 16.8 8.64 17.12 8.9C17.45 9.17 17.51 9.64 17.26 9.96Z" fill="var(--header-footer-text-color)"></path>
          </svg>
        </p>
      </a>

      <a class="m-0 p-1 mr-3 d-flex justify-content-center align-items-center" href="notifications" aria-label="Переход на страницу с уведомлениями" data-toggle="tooltip" data-placement="bottom" title="Уведомления">
        <p class="m-0 p-0">
          <svg fill="var(--header-footer-text-color)" height="22px" width="22px" viewBox="0 0 448 512">
            <path d="M222.987,510c31.418,0,57.529-22.646,62.949-52.5H160.038C165.458,487.354,191.569,510,222.987,510z"></path>
            <path d="M432.871,352.059c-22.25-22.25-49.884-32.941-49.884-141.059c0-79.394-57.831-145.269-133.663-157.83h-4.141 c4.833-5.322,7.779-12.389,7.779-20.145c0-16.555-13.42-29.975-29.975-29.975s-29.975,13.42-29.975,29.975 c0,7.755,2.946,14.823,7.779,20.145h-4.141C120.818,65.731,62.987,131.606,62.987,211c0,108.118-27.643,118.809-49.893,141.059 C-17.055,382.208,4.312,434,47.035,434H398.93C441.568,434,463.081,382.269,432.871,352.059z"></path> 
          </svg>
        </p>
<?
        if ($notifications_all_count > 0)
          echo '<p class="fz-12 p-0 pr-2 pl-2 notifications-count" id="notification-count">'.(($notifications_all_count > 99) ? '99+' : $notifications_all_count).'</p>';
?>        
      </a>
<?
      if ($user_latest_photo_date == 'success' && check_user_page_status($user_uuid) && check_email_confirmed($user_uuid))
      {
?>

        <button class="btn mr-3 p-1 d-flex flex-row align-items-center justify-content-center" id="header-btn-add-new-photo-mobile" data-toggle="tooltip" data-placement="bottom" title="Добавить фотографию" data-href="add-photo">
          <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none">
            <path d="M21 11V18C21 19.1046 20.1046 20 19 20H5C3.89543 20 3 19.1046 3 18V9C3 7.89543 3.89543 7 5 7H6.5C7.12951 7 7.72229 6.70361 8.1 6.2L9.15 4.8C9.52771 4.29639 10.1205 4 10.75 4H13.25" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M18.5 4V6.5M18.5 9V6.5M18.5 6.5H16M18.5 6.5H21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <circle cx="12" cy="13" r="4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle>
          </svg>
        </button>
<?
      }

      if ($avatar_exists) 
      {
        $preview_photo_check = file_exists('users/'.$user_uuid.'/'.get_user_avatar_preview($user_uuid)) ? 1 : 0;

        echo '<img class="rounded-circle m-0 p-0 user-header-menu-picture" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($user_uuid) : get_user_avatar($user_uuid)).'" alt="'.$user_fullname.'">';
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
                src="users/'.$user_uuid.'/'.get_user_avatar($user_uuid).'" 
                alt="'.$user_fullname.'" 
                onclick="event.preventDefault();openProfilePictureModal(\''.$user_uuid.'\',\''.$user_uuid.'\',\''.get_user_avatar($user_uuid).'\');">';
      else
        echo '<img class="btn-md online rounded-circle" id="userImg" src="imgs/no-avatar.png" alt="'.$user_fullname.'">';
?>
      </div>

      <a class="m-0 p-0" href="./">
        <p class="card-title username w-100 fz-15 d-flex justify-content-center align-items-center font-weight-bold letter-spacing-05 text-center"><?= (get_user_nickname($user_uuid)) ? $user_fullname : ''; ?></p>
        <p class="fz-12 m-0 text-center font-italic"><?= (get_user_nickname($user_uuid)) ? '@'.get_user_nickname($user_uuid) : ''; ?></p>
      </a>

      <div class="hr-with-text w-100 m-0 mt-3 mb-2">
        <span class="m-0">
          <div class="m-0 p-0 d-flex align-items-stretch">
            <p class="m-0 p-0">
              <svg class="active-star" width="18px" height="18px" viewBox="0 0 24 24" fill="none">
                <path d="M17.2 20.7501C17.0776 20.7499 16.9573 20.7189 16.85 20.6601L12 18.1101L7.14999 20.6601C7.02675 20.7262 6.88746 20.7566 6.74786 20.7478C6.60825 20.7389 6.47391 20.6912 6.35999 20.6101C6.24625 20.5267 6.15796 20.4133 6.10497 20.2826C6.05199 20.1519 6.03642 20.0091 6.05999 19.8701L6.99999 14.4701L3.05999 10.6501C2.96124 10.5512 2.89207 10.4268 2.86027 10.2907C2.82846 10.1547 2.83529 10.0124 2.87999 9.88005C2.92186 9.74719 3.00038 9.62884 3.10652 9.53862C3.21266 9.4484 3.34211 9.38997 3.47999 9.37005L8.89999 8.58005L11.33 3.67005C11.3991 3.55403 11.4973 3.45795 11.6147 3.39123C11.7322 3.32451 11.8649 3.28943 12 3.28943C12.1351 3.28943 12.2678 3.32451 12.3853 3.39123C12.5027 3.45795 12.6008 3.55403 12.67 3.67005L15.1 8.58005L20.52 9.37005C20.6579 9.38997 20.7873 9.4484 20.8935 9.53862C20.9996 9.62884 21.0781 9.74719 21.12 9.88005C21.1647 10.0124 21.1715 10.1547 21.1397 10.2907C21.1079 10.4268 21.0387 10.5512 20.94 10.6501L17 14.4701L17.93 19.8701C17.9536 20.0091 17.938 20.1519 17.885 20.2826C17.832 20.4133 17.7437 20.5267 17.63 20.6101C17.5034 20.6976 17.3539 20.7463 17.2 20.7501ZM12 16.5201C12.121 16.5215 12.2403 16.5488 12.35 16.6001L16.2 18.6001L15.47 14.3101C15.4502 14.1897 15.4589 14.0664 15.4953 13.9501C15.5318 13.8337 15.595 13.7275 15.68 13.6401L18.8 10.6401L14.49 10.0001C14.3708 9.98109 14.2578 9.93401 14.1605 9.86271C14.0631 9.79141 13.9841 9.69795 13.93 9.59005L12 5.69005L10.07 9.60005C10.0159 9.70795 9.9369 9.80141 9.83952 9.87271C9.74214 9.94401 9.62918 9.99109 9.50999 10.0101L5.19999 10.6401L8.31999 13.6401C8.40493 13.7275 8.46817 13.8337 8.50464 13.9501C8.54111 14.0664 8.54979 14.1897 8.52999 14.3101L7.79999 18.6301L11.65 16.6301C11.7573 16.5683 11.8767 16.5308 12 16.5201Z"></path>
              </svg>
            </p>
<?
          if (get_user_rating_among_all_users($user_uuid) != 0)
            echo '<p class="fz-15 m-0 ml-2 p-0 font-weight-bold">'.get_user_rating_among_all_users($user_uuid).'</p>';
?>
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
      <p class="fz-14 letter-spacing-05 w-100 m-0 ml-3 p-0 text-left">Профиль</p>
    </a>
<?
    }
?>
    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" href="news" aria-label="Новости">
      <svg class="m-0 p-0 svg-main-menu-icon" width="22px" height="22px" viewBox="0 0 24 24">
        <path d="M19.875 3H4.125C2.953 3 2 3.897 2 5v14c0 1.103.953 2 2.125 2h15.75C21.047 21 22 20.103 22 19V5c0-1.103-.953-2-2.125-2zm0 16H4.125c-.057 0-.096-.016-.113-.016-.007 0-.011.002-.012.008L3.988 5.046c.007-.01.052-.046.137-.046h15.75c.079.001.122.028.125.008l.012 13.946c-.007.01-.052.046-.137.046z"></path>
        <path d="M6 7h6v6H6zm7 8H6v2h12v-2h-4zm1-4h4v2h-4zm0-4h4v2h-4z"></path>
      </svg>
      <p class="fz-14 letter-spacing-05 w-100 m-0 ml-3 p-0 text-left">Новости</p>
    </a>

    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" href="friends" aria-label="Друзья">
      <svg class="m-0 p-0 svg-main-menu-icon" width="22px" height="22px" viewBox="0 0 24 24" fill="none">
        <path d="M15.5385 11.4899C17.7949 11.4899 19.641 9.65316 19.641 7.40826C19.641 5.16336 17.7949 3.32663 15.5385 3.32663C15.4359 3.32663 15.3334 3.32663 15.2308 3.32663C15.8462 4.34704 16.2564 5.57153 16.2564 6.79602C16.2564 8.53071 15.5385 10.1634 14.4103 11.3879C14.718 11.4899 15.1282 11.4899 15.5385 11.4899Z"></path>
        <path d="M17.2821 13.6326H16.2565C17.7949 14.9591 18.8206 17 18.8206 19.2448C18.8206 19.7551 18.718 20.1632 18.6154 20.5714C19.9488 20.3673 20.7693 20.0612 21.2821 19.7551C21.7949 19.4489 22.0001 18.9387 22.0001 18.3265C22.0001 15.7755 19.8462 13.6326 17.2821 13.6326Z"></path>
        <path d="M9.38459 11.4898C10.6154 11.4898 11.641 11.0817 12.5641 10.2654C13.5897 9.44903 14.1025 8.1225 14.1025 6.79597C14.1025 5.77556 13.7948 4.75515 13.1795 4.04087C12.3589 2.81638 11.0256 2.00005 9.38459 2.00005C6.82049 2.00005 4.66664 4.14291 4.66664 6.69393C4.66664 9.34699 6.82049 11.4898 9.38459 11.4898Z"></path>
        <path d="M12.1538 13.9389C11.8462 13.9389 11.641 13.8369 11.3333 13.8369H7.4359C4.46154 13.8369 2 16.2859 2 19.245C2 19.9593 2.30769 20.4695 2.82051 20.8777C3.64103 21.3879 5.58974 22.0001 9.38461 22.0001C13.1795 22.0001 15.0256 21.3879 15.9487 20.8777C15.9487 20.8777 16.0513 20.7757 16.1538 20.7757C16.5641 20.4695 16.8718 19.9593 16.8718 19.245C16.7692 16.592 14.8205 14.3471 12.1538 13.9389Z"></path>
      </svg>
      <p class="fz-14 letter-spacing-05 w-100 m-0 ml-3 p-0 text-left">Друзья</p>
    </a>

    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" href="search" aria-label="Поиск">
      <svg class="m-0 p-0 svg-search-main-menu-icon" width="22px" height="22px" viewBox="0 0 24 24" fill="none">
        <circle cx="10" cy="10" r="6" stroke="var(--header-element-hover-border-color)" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></circle>
        <path d="M14.5 14.5L19 19" stroke="var(--header-element-hover-border-color)" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
      <p class="fz-14 letter-spacing-05 w-100 m-0 ml-3 p-0 text-left">Поиск</p>
    </a>

    <div class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row">
      <p class="fz-22 w-20 m-0 p-0"></p>
      <hr class="fz-14 w-80 m-0 p-0 hr-user-info">
    </div>

    <a class="w-100 m-0 p-0 pt-2 pb-2 d-flex flex-row align-items-center font-weight-bold" href="rate" aria-label="Оценить">
      <svg class="m-0 p-0 svg-rate-main-menu-icon" width="22px" height="22px" viewBox="0 0 24 24" fill="none">
        <path d="M11.0748 3.25583C11.4141 2.42845 12.5859 2.42845 12.9252 3.25583L14.6493 7.45955C14.793 7.80979 15.1221 8.04889 15.4995 8.07727L20.0303 8.41798C20.922 8.48504 21.2841 9.59942 20.6021 10.1778L17.1369 13.1166C16.8482 13.3614 16.7225 13.7483 16.8122 14.1161L17.8882 18.5304C18.1 19.3992 17.152 20.0879 16.3912 19.618L12.5255 17.2305C12.2034 17.0316 11.7966 17.0316 11.4745 17.2305L7.60881 19.618C6.84796 20.0879 5.90001 19.3992 6.1118 18.5304L7.18785 14.1161C7.2775 13.7483 7.1518 13.3614 6.86309 13.1166L3.3979 10.1778C2.71588 9.59942 3.07796 8.48504 3.96971 8.41798L8.50046 8.07727C8.87794 8.04889 9.20704 7.80979 9.35068 7.45955L11.0748 3.25583Z" stroke-width="2"></path>
      </svg>
      <p class="fz-14 letter-spacing-05 w-100 m-0 ml-3 p-0 text-left">Оценить</p>
    </a>
  </div>

  <div class="header-full w-100 row m-0 h-100 d-none d-sm-none d-md-none d-lg-flex d-xl-flex justify-content-between">

    <div class="m-0 d-flex justify-content-start align-items-center header-logo col-lg-2 col-xl-2">
      <a class="m-0 p-0 pb-1" id="full-header-logo-link" href="rate">
        <img width="90" src="imgs/logo.png" alt="Statify">
      </a>
    </div>

    <div class="m-0 p-0 col-lg-10 col-xl-10 d-flex flex-row" id="full-header-content">
      <div class="m-0 p-0 input-with-icon d-flex flex-row align-items-center position-relative" id="header-search">
        <svg class="position-absolute" width="19px" height="19px" viewBox="0 0 24 24" fill="none">
          <circle cx="10" cy="10" r="6" stroke="var(--header-element-hover-border-color)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></circle>
          <path d="M14.5 14.5L19 19" stroke="var(--header-element-hover-border-color)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
        <input type="text" class="fz-14 w-100 mt-2 mb-2 p-0 input-field d-flex align-items-center" id="header-search-input" placeholder="Поиск" autocomplete="off">    
      </div>

      <div class="m-0 ml-auto p-0 d-flex justify-content-end align-items-center user-header-menu">
        <a class="m-0 p-1 mr-3 d-flex justify-content-center align-items-center" href="activity" aria-label="Переход на страницу с активностью" data-toggle="tooltip" data-placement="bottom" title="Активность">
          <p class="m-0 p-0">
            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none">
              <path d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2ZM17.26 9.96L14.95 12.94C14.66 13.31 14.25 13.55 13.78 13.6C13.31 13.66 12.85 13.53 12.48 13.24L10.65 11.8C10.58 11.74 10.5 11.74 10.46 11.75C10.42 11.75 10.35 11.77 10.29 11.85L7.91 14.94C7.76 15.13 7.54 15.23 7.32 15.23C7.16 15.23 7 15.18 6.86 15.07C6.53 14.82 6.47 14.35 6.72 14.02L9.1 10.93C9.39 10.56 9.8 10.32 10.27 10.26C10.73 10.2 11.2 10.33 11.57 10.62L13.4 12.06C13.47 12.12 13.54 12.12 13.59 12.11C13.63 12.11 13.7 12.09 13.76 12.01L16.07 9.03C16.32 8.7 16.8 8.64 17.12 8.9C17.45 9.17 17.51 9.64 17.26 9.96Z" fill="var(--header-footer-text-color)"></path>
            </svg>
          </p>
        </a>

        <a class="m-0 p-0 mr-3 d-flex justify-content-center align-items-center" href="notifications" aria-label="Переход на страницу с уведомлениями" data-toggle="tooltip" data-placement="bottom" title="Уведомления">
          <p class="m-0 p-0">
            <svg fill="var(--header-footer-text-color)" height="23px" width="23px" viewBox="0 0 448 512">
              <path d="M222.987,510c31.418,0,57.529-22.646,62.949-52.5H160.038C165.458,487.354,191.569,510,222.987,510z"></path>
              <path d="M432.871,352.059c-22.25-22.25-49.884-32.941-49.884-141.059c0-79.394-57.831-145.269-133.663-157.83h-4.141 c4.833-5.322,7.779-12.389,7.779-20.145c0-16.555-13.42-29.975-29.975-29.975s-29.975,13.42-29.975,29.975 c0,7.755,2.946,14.823,7.779,20.145h-4.141C120.818,65.731,62.987,131.606,62.987,211c0,108.118-27.643,118.809-49.893,141.059 C-17.055,382.208,4.312,434,47.035,434H398.93C441.568,434,463.081,382.269,432.871,352.059z"></path> 
            </svg>
          </p>
<?
        if ($notifications_all_count > 0)
          echo '<p class="fz-12 p-0 pr-2 pl-2 notifications-count" id="notification-count">'.(($notifications_all_count > 99) ? '99+' : $notifications_all_count).'</p>';
?>
        </a>

<?
      if ($user_latest_photo_date == 'success' && check_user_page_status($user_uuid) && check_email_confirmed($user_uuid))
      {
?>

        <button class="btn mr-3 pl-3 pr-3 d-flex flex-row align-items-center justify-content-center" id="header-btn-add-new-photo" data-toggle="tooltip" data-placement="bottom" title="Добавить фотографию" data-href="add-photo">
          <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none">
            <path d="M21 11V18C21 19.1046 20.1046 20 19 20H5C3.89543 20 3 19.1046 3 18V9C3 7.89543 3.89543 7 5 7H6.5C7.12951 7 7.72229 6.70361 8.1 6.2L9.15 4.8C9.52771 4.29639 10.1205 4 10.75 4H13.25" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M18.5 4V6.5M18.5 9V6.5M18.5 6.5H16M18.5 6.5H21" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            <circle cx="12" cy="13" r="4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></circle>
          </svg>

          <p class="m-0 ml-2 p-0 fz-14 font-weight-bold text-white">Добавить</p>
        </button>
<?
      }

      if ($avatar_exists) 
      {
        $preview_photo_check = file_exists('users/'.$user_uuid.'/'.get_user_avatar_preview($user_uuid)) ? 1 : 0;

        echo '<img class="rounded-circle m-0 p-0 user-header-menu-picture" src="users/'.$user_uuid.'/'.($preview_photo_check == 1 ? get_user_avatar_preview($user_uuid) : get_user_avatar($user_uuid)).'" alt="'.$user_fullname.'">';
      }else
        echo '<img class="rounded-circle m-0 p-0 user-header-menu-picture" src="imgs/no-avatar.png" alt="'.$user_fullname.'">';
        
      include("includes/header/settings-menu.php"); 
?>
      </div>
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