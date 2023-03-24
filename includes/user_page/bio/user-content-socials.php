<div class="block-user-content mt-3 <?= (!check_user_page_status($user_uuid)) ? 'page-not-completed-user-info-hide' : ''; ?>" id="user-info-socials">
  <h5 class="title-user-info">Социальные сети</h5>
  <hr class="hr-user-info">

<?
  if ($page_status)
  {
?>
  <p class="row m-0 p-0 d-flex justify-content-center">
<?
    if (is_null(get_vk_link($user_uuid)))
      echo '<a class="m-0 p-0">
              <i class="fa fa-vk social-icon-empty social-user d-flex justify-content-center align-items-center" aria-hidden="true"></i>
            </a>';
    else
      echo '<a class="m-0 p-0" href="https://vk.com/'.get_vk_link($user_uuid).'" target="_blank" aria-label="Ссылка на страницу VK">
              <i class="fa fa-vk social-icon social-user d-flex justify-content-center align-items-center" aria-hidden="true"></i>
            </a>';

    if (is_null(get_insta_link($user_uuid)))
      echo '<a class="m-0 p-0">
              <i class="fa fa-instagram social-icon-empty social-user d-flex justify-content-center align-items-center" aria-hidden="true"></i>
            </a>';
    else
      echo '<a class="m-0 p-0" href="https://instagram.com/'.get_insta_link($user_uuid).'" target="_blank" aria-label="Ссылка на аккаунт в Instagram">
              <i class="fa fa-instagram social-icon social-user d-flex justify-content-center align-items-center" aria-hidden="true"></i>
            </a>';

    if (is_null(get_ok_link($user_uuid)))
      echo '<a class="m-0 p-0">
              <i class="fa fa-odnoklassniki social-icon-empty social-user d-flex justify-content-center align-items-center" aria-hidden="true"></i>
            </a>';
    else
      echo '<a class="m-0 p-0" href="https://ok.ru/'.get_ok_link($user_uuid).'" target="_blank" aria-label="Ссылка на страницу в Одноклассниках">
              <i class="fa fa-odnoklassniki social-icon social-user d-flex justify-content-center align-items-center" aria-hidden="true"></i>
            </a>';
?>
  </p>
<?
  }else
    echo '<p class="w-100 text-center f-13 m-0">Отсутствуют</p>';

  if ($user_uuid == $current_user_uuid)
  echo '<hr class="hr-user-info">
        <p class="card-text text-center w-100">Дата регистрации: <span id="status">'.(($creation_date) ? corrected_date_with_text_month(date($creation_date)) : "Отсутствует").'</span></p>';  
?>
</div>