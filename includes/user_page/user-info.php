<? include("requests/user-info.php"); ?>
<script type="text/javascript" src="js/popper.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<div class="w-100 m-0 mb-3 p-0 d-flex flex-column block-user-content">
  <div class="w-100 m-0 p-2 d-flex flex-row align-items-center" id="block-user-main-info">
    <? include("includes/user_page/user-info-avatar.php"); ?>
    
    <div class="m-0 ml-3 mr-auto p-0 d-flex flex-column w-100" id="user-main-info">
      <? include("includes/user_page/user-info-fullname.php"); ?>
      
      <div class="m-0 p-0 d-flex flex-row" id="user-brief-and-general-values-info">
<?
        include("includes/user_page/user-info-brief.php");
        include("includes/user_page/user-info-general-values.php");
?>
      </div>
    </div>
  </div>
<?
  if (ban_check($current_user_uuid) == 'success')
  {
?>
  <hr class="hr-user-info mt-0">

  <div class="m-0 p-0 d-flex flex-row justify-content-center align-items-center" id="user-profile-menu">
    <p class="m-0 p-2 fz-16 pointer active" id="user-profile-menu-bio">Профиль</p>
<?
  if ($current_user_uuid == $user_uuid || user_friendly_status($user_uuid, $current_user_uuid) == 'friend')
    echo '<p class="m-0 ml-4 p-2 fz-16 pointer" id="user-profile-menu-photos">Фотографии</p>';

  if ($current_user_uuid == $user_uuid)
    echo '<p class="m-0 ml-4 p-2 fz-16 pointer" id="user-profile-menu-saves">Сохранения</p>    
          <p class="m-0 ml-4 p-2 fz-16 pointer" id="user-profile-menu-comments">Комментарии</p>';
?>
  </div>

  <div class="m-0 p-0 d-flex flex-row justify-content-center align-items-center" id="user-profile-menu-mobile">
    <p class="m-0 p-2 pl-3 pr-3 fz-16 pointer active" id="user-profile-menu-mobile-bio">
      <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M21.5609 10.7381L20.2109 9.15812C19.9609 8.85812 19.7509 8.29813 19.7509 7.89813V6.19812C19.7509 5.13812 18.8809 4.26812 17.8209 4.26812H16.1209C15.7209 4.26812 15.1509 4.05813 14.8509 3.80812L13.2709 2.45812C12.5809 1.86813 11.4509 1.86813 10.7609 2.45812L9.16086 3.80812C8.86086 4.05813 8.30086 4.26812 7.90086 4.26812H6.17086C5.11086 4.26812 4.24086 5.13812 4.24086 6.19812V7.89813C4.24086 8.28813 4.04086 8.84812 3.79086 9.14812L2.44086 10.7381C1.86086 11.4381 1.86086 12.5581 2.44086 13.2381L3.79086 14.8281C4.04086 15.1181 4.24086 15.6881 4.24086 16.0781V17.7881C4.24086 18.8481 5.11086 19.7181 6.17086 19.7181H7.91086C8.30086 19.7181 8.87086 19.9281 9.17086 20.1781L10.7509 21.5281C11.4409 22.1181 12.5709 22.1181 13.2609 21.5281L14.8409 20.1781C15.1409 19.9281 15.7009 19.7181 16.1009 19.7181H17.8009C18.8609 19.7181 19.7309 18.8481 19.7309 17.7881V16.0881C19.7309 15.6881 19.9409 15.1281 20.1909 14.8281L21.5409 13.2481C22.1509 12.5681 22.1509 11.4381 21.5609 10.7381ZM11.2509 8.12813C11.2509 7.71813 11.5909 7.37813 12.0009 7.37813C12.4109 7.37813 12.7509 7.71813 12.7509 8.12813V12.9581C12.7509 13.3681 12.4109 13.7081 12.0009 13.7081C11.5909 13.7081 11.2509 13.3681 11.2509 12.9581V8.12813ZM12.0009 16.8681C11.4509 16.8681 11.0009 16.4181 11.0009 15.8681C11.0009 15.3181 11.4409 14.8681 12.0009 14.8681C12.5509 14.8681 13.0009 15.3181 13.0009 15.8681C13.0009 16.4181 12.5609 16.8681 12.0009 16.8681Z" fill="var(--main-menu-icon-color)"></path>
      </svg>
    </p>
<?
  if ($current_user_uuid == $user_uuid || user_friendly_status($user_uuid, $current_user_uuid) == 'friend') 
    echo '<p class="m-0 ml-4 p-2 pl-3 pr-3 fz-16 pointer" id="user-profile-menu-mobile-photos">
      <svg fill="var(--main-menu-icon-color)" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25px" height="25px" viewBox="0 0 31.06 32.001" xml:space="preserve" style="width: 25px;">
        <path d="M29.341,11.405L13.213,7.383c-1.21-0.301-2.447,0.441-2.748,1.652L6.443,25.163c-0.303,1.211,0.44,2.445,1.65,2.748 l16.127,4.023c1.21,0.301,2.447-0.443,2.748-1.652l4.023-16.127C31.293,12.944,30.551,11.708,29.341,11.405z M28.609,14.338 l-2.926,11.731c-0.1,0.402-0.513,0.65-0.915,0.549l-14.662-3.656c-0.403-0.1-0.651-0.512-0.551-0.916l2.926-11.729 c0.1-0.404,0.513-0.65,0.916-0.551l14.661,3.658C28.462,13.522,28.71,13.936,28.609,14.338z"></path>
        <circle cx="15.926" cy="13.832" r="2.052"></circle>
        <path d="M22.253,16.813c-0.136-0.418-0.505-0.51-0.82-0.205l-2.943,2.842c-0.315,0.303-0.759,0.244-0.985-0.133l-0.471-0.781 c-0.227-0.377-0.719-0.5-1.095-0.273l-4.782,2.852c-0.377,0.225-0.329,0.469,0.096,0.576l3.099,0.771 c0.426,0.107,1.122,0.281,1.549,0.389l3.661,0.912c0.426,0.105,1.123,0.279,1.549,0.385l3.098,0.773 c0.426,0.107,0.657-0.121,0.521-0.539L22.253,16.813z"></path>
        <path d="M2.971,7.978l14.098-5.439c0.388-0.149,0.828,0.045,0.977,0.432l1.506,3.933l2.686,0.67l-2.348-6.122 c-0.449-1.163-1.768-1.748-2.931-1.299L1.45,6.133C0.287,6.583-0.298,7.902,0.151,9.065L5.156,22.06l0.954-3.827L2.537,8.954 C2.389,8.565,2.583,8.126,2.971,7.978z"></path>
      </svg>
    </p>';

  if ($current_user_uuid == $user_uuid)
    echo '
    <p class="m-0 ml-4 p-2 pl-3 pr-3 fz-16 pointer" id="user-profile-menu-mobile-saves">
      <svg fill="var(--main-menu-icon-color)" width="25px" height="25px" viewBox="0 0 256 256" id="Flat" xmlns="http://www.w3.org/2000/svg" style="width: 25px;">
        <path d="M192,24H96A16.01833,16.01833,0,0,0,80,40V56H64A16.01833,16.01833,0,0,0,48,72V224a8.00026,8.00026,0,0,0,12.65039,6.50977l51.34277-36.67872,51.35743,36.67872A7.99952,7.99952,0,0,0,176,224V184.6897l19.35059,13.82007A7.99952,7.99952,0,0,0,208,192V40A16.01833,16.01833,0,0,0,192,24Zm0,152.45508-16-11.42676V72a16.01833,16.01833,0,0,0-16-16H96V40h96Z"></path>
      </svg>
    </p>    
    <p class="m-0 ml-4 p-2 pl-3 pr-3 fz-16 pointer" id="user-profile-menu-mobile-comments">
      <svg fill="var(--main-menu-icon-color)" width="25px" height="25px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="796 796 200 200" enable-background="new 796 796 200 200" xml:space="preserve">
        <path d="M975.771,935.469c12.24-9.523,19.702-22.13,19.702-35.958c0-22.787-20.226-42.25-48.777-50.084 c-13.191-18.566-39.921-31.304-70.701-31.304c-43.818,0-79.467,25.793-79.467,57.498c0,14.631,7.523,28.544,21.183,39.173 c0.88,0.685,1.292,1.829,1.05,2.915l-5.043,22.702c-0.909,4.092,0.741,8.264,4.203,10.624c1.7,1.16,3.686,1.773,5.744,1.773 c2.032,0,3.996-0.6,5.684-1.733l27.088-18.205c0.434-0.292,0.912-0.496,1.404-0.654c14.028,12.803,36.061,21.074,60.878,21.074 c5.319,0,10.511-0.386,15.524-1.111c2.963-0.428,5.982,0.259,8.469,1.932l28.327,19.037c1.463,0.98,3.376,0.975,4.833-0.017 c1.454-0.995,2.161-2.774,1.777-4.495l-5.275-23.735C971.589,941.366,972.913,937.69,975.771,935.469z M826.62,938.285l3.987-17.945 c1.253-5.638-0.884-11.572-5.443-15.123c-10.642-8.28-16.501-18.791-16.501-29.597c0-25.013,30.204-45.362,67.331-45.362 c37.124,0,67.326,20.349,67.326,45.362c0,25.013-30.202,45.363-67.326,45.363c-4.675,0-9.378-0.337-13.978-1.002 c-4.312-0.619-8.735,0.389-12.351,2.816L826.62,938.285z"></path>
      </svg>
    </p>';
?>
  </div>

<?
  }
  /*include("includes/user_page/user-info-avatar.php");
  
  if (check_email_confirmed($user_uuid))
    include("includes/user_page/user-info-avatar-update.php");

  include("includes/user_page/user-info-confirm-email.php");
  include("includes/user_page/user-info-about.php");
  include("includes/user_page/user-info-interests.php");
  include("includes/user_page/user-info-tags.php");
  include("includes/user_page/user-info-socials.php");*/
?>
</div>