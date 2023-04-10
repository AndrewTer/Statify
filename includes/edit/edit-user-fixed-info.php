<p class="text-center mt-2 mb-2 fz-17 font-weight-bold">Постоянная информация</p>
<hr class="hr-user-info"> 
<div class="modal-body">

<? 
  if ($page_status)
  {
    include("requests/user-info.php");

    $user_gender = get_user_gender($user_uuid);
    $user_nickname = get_user_nickname($user_uuid);
?>
  <div class="form-group m-0 p-0 mb-3 d-flex flex-row align-items-center">
    <label class="fz-13 font-weight-bold m-0 mr-auto p-0 h-100">Пол</label>
    <p class="m-0 ml-auto p-0 h-100 text-right">
    <?
      switch ($user_gender) {
        case 'male':
          echo 'Мужской';
        break;

        case 'female':
          echo 'Женский';
        break;

        default:
          echo 'Не указан';
        break;
      }
    ?>
    </p>
  </div>

  <div class="form-group m-0 p-0 d-flex flex-row align-items-center">
    <label class="fz-13 font-weight-bold m-0 mr-auto p-0 h-100 justify-content-start">Пользовательское имя</label>
    <p class="m-0 ml-auto p-0 h-100 text-right d-flex flex-row flex-wrap text-break justify-content-end align-items-center" id="edit-user-nickname-text"><?= ($user_nickname) ? $user_nickname : 'Не указано'; ?>
<?
    if ($premium_status && check_nickname_change_date($user_uuid))
    {
?>
      <svg class="m-0 ml-3 svg-edit-user-nickname-icon" width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" data-toggle="collapse" role="button" href="#editNicknameBlock" aria-expanded="false" aria-controls="editNicknameBlock">
        <defs>  
          <linearGradient id="premium-icon-edit-user-nickname" x1="50%" y1="0%" x2="50%" y2="100%" > 
            <stop offset="0%" stop-color="#7A5FFF">
              <animate attributeName="stop-color" values="#7A5FFF; #01FF89; #7A5FFF" dur="4s" repeatCount="indefinite"></animate>
            </stop>
            <stop offset="100%" stop-color="#01FF89">
              <animate attributeName="stop-color" values="#01FF89; #7A5FFF; #01FF89" dur="4s" repeatCount="indefinite"></animate>
            </stop>
          </linearGradient> 
        </defs>
        <path d="M12 4H6C4.89543 4 4 4.89543 4 6V18C4 19.1046 4.89543 20 6 20H18C19.1046 20 20 19.1046 20 18V12M9 15V12.5L17.75 3.75C18.4404 3.05964 19.5596 3.05964 20.25 3.75V3.75C20.9404 4.44036 20.9404 5.55964 20.25 6.25L15.5 11L11.5 15H9Z" stroke="url('#premium-icon-edit-user-nickname')" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
<?
    }
?>
    </p>
  </div>
<?
    if ($premium_status && check_nickname_change_date($user_uuid))
    {
?>
  <div id="editNicknameBlock" class="collapse w-100">
    <div class="modal-body edit-modal-body m-0">
      <hr class="hr-user-info mt-0">
      <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0 pt-1 w-100">

        <form class="m-0 p-0 w-100" id="edit-user-nickname-block" action="" method="POST" onSubmit="return editUserNicknameValidation('<?= $user_uuid; ?>');">         
          <div class="form-group w-100 m-0 p-0">
            <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0">
              <input type="text" id="new-nickname-edit" class="form-control m-0 input-field justify-content-start" placeholder="максимум 20 символов" autocomplete="off" value="<?= ($user_nickname) ? $user_nickname : ''; ?>">
              <input type="submit" class="btn btn-sm btn-skip fz-14 skip-rate-btn ml-3" value="Сохранить"></input>
            </div>
            <div class="d-flex flex-row justify-content-center align-items-center m-0 p-0">
              <em id="new-nickname-edit-message" class="text-left w-100"></em>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
<?
    }
  }
?>
</div>      