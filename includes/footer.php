<div class="footer w-100 text-center m-0 p-2">
  <div class="row w-100 m-0 p-0 pt-2 pr-2 pl-2 fz-13 d-flex justify-content-center align-items-center">
    <a class="m-2 p-0" href="about?sort=rules"><p class="m-0 p-0">Правила сайта</p></a>
    <a class="m-2 p-0" href="about?sort=updates"><p class="m-0 p-0">Обновления</p></a>
    <a class="m-2 p-0" href="about?sort=limits"><p class="m-0 p-0">Ограничения</p></a>
    <!--<a class="m-2 p-0" href="about?sort=help"><p class="m-0 p-0">Помощь</p></a>-->
  </div>
  <p class="w-100 m-0 pt-2 pb-2 fz-14 d-flex justify-content-center align-items-center">Statify &copy; 2023</p>
</div>

<div class="modal-container"></div>
<?
  if (session_status() == PHP_SESSION_ACTIVE && 
    //$_SESSION['auth_user'] == "yes_auth" && 
    (empty($_COOKIE['cookies']) || $_COOKIE['cookies'] != 'accepted'))
  {
?>
<div class="cookie-container w-100 m-0 p-0 d-flex flex-row justify-content-center">
  <div class="m-0 p-0 w-100 d-flex flex-row align-items-center justify-content-center">
    <p class="w-100 text-center m-0 p-0 pt-3 pb-3">Этот сайт использует cookie для хранения данных.<br>Продолжая использовать сайт, Вы даете согласие на работу с этими файлами.</p>
    <p class="btn btn-standard m-0 ml-2 mr-2 pl-3 pr-3 d-flex justify-content-center align-items-center" id="accept-cookies" onclick="event.preventDefault();acceptCookies();">Принять</p>
  </div>
</div>
<?
  }
?>