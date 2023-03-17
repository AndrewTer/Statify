<?
  include("requests/user-info.php");

  $user_name = get_user_name($user_uuid);
  $user_surname = get_user_surname($user_uuid);
  $user_birthday = get_user_birthday($user_uuid);
?>
<p class="fz-17 text-center mt-2 mb-2">Основное</p>
<hr class="hr-user-info"> 
<div class="modal-body">
  <form id="edit-user-data-block" data-attr="<?= $user_uuid; ?>" action="" method="POST" onSubmit="return editUserDataValidation();">
    <div class="form-group col-12">
      <div class="row m-0">
        <label class="font-weight-bold col-6 p-0 m-0 d-flex align-items-center">Имя</label>
        <input type="text" id="name-edit" class="form-control col-6 input-field" value="<?= $user_name; ?>" autocomplete="off" placeholder="Допустимые символы: А-я">
        <em class="text-center col-6"></em>
        <em id="name-edit-message" class="text-center col-6"></em>
      </div>
    </div>

    <div class="form-group col-12">
      <div class="row m-0">
        <label class="font-weight-bold col-6 p-0 m-0 d-flex align-items-center">Фамилия</label>
        <input type="text" id="surname-edit" class="form-control col-6 input-field" value="<?= $user_surname; ?>" autocomplete="off" placeholder="Допустимые символы: А-я">
        <em class="text-center col-6"></em>
        <em id="surname-edit-message" class="text-center col-6"></em>
      </div>
    </div>

    <div class="form-group col-12" id="edit-date-born">
      <div class="row m-0">
        <label class="font-weight-bold col-6 p-0 m-0 d-flex align-items-center">Дата рождения</label>
        <input type="date" id="date-born-edit" class="form-control col-6 input-field" min="1940-01-01" max="<?= date("Y-m-d"); ?>" value="<?= $user_birthday; ?>">
        <em class="text-center col-6"></em>
        <em id="date-born-edit-message" class="text-center col-6"></em>
      </div>
    </div>

    <hr class="hr-user-info">

    <div class="form-group col-12 m-0 mt-3 mb-3" id="edit-country">
      <div class="row m-0">
        <label class="font-weight-bold col-6 p-0 m-0 d-flex align-items-center">Страна</label>
        <select class="form-control col-6 input-field" id="edit-input-select-country">
        <?
          $countries_list = get_country_list();
          $user_country = get_user_country($user_uuid);

          for ($countries_num = 0; $countries_num < count($countries_list); $countries_num++)
            if ($countries_list[$countries_num][0] == $user_country)
              echo '<option value="'.$countries_list[$countries_num][0].'" selected>'.$countries_list[$countries_num][1].'</option>';
            else
              echo '<option value="'.$countries_list[$countries_num][0].'">'.$countries_list[$countries_num][1].'</option>';

          if ($user_country == 'Other')
            echo '<option value="Other" selected>Иная страна</option>';
          else
            echo '<option value="Other">Иная страна</option>'
        ?>
        </select>
      </div>
    </div>

    <div class="form-group col-12 m-0 mt-3 mb-3" id="edit-city" data-attr = "<?= get_user_city($user_uuid); ?>">
      <div class="row m-0">
        <label class="font-weight-bold col-6 p-0 m-0 d-flex align-items-center">Город</label>
        <select class="form-control col-6 input-field" id="edit-input-select-city"></select>
      </div>
    </div>

    <hr class="hr-user-info"> 

    <div class="form-group col-12">
      <div class="row m-0">
        <i class="fa fa-vk fz-20 col-3 d-flex justify-content-center align-items-center edit-social-i" aria-hidden="true"></i>
        <input type="text" id="vk-edit" class="form-control col-9 input-field" placeholder="https://vk.com/" value="https://vk.com/<?= get_vk_link($user_uuid); ?>">
        <em class="text-center col-3"></em>
        <em id="vk-edit-message" class="text-center col-9"></em>
      </div>     
    </div>

    <div class="form-group col-12">
      <div class="row m-0">
        <i class="fa fa-instagram fz-20 col-3 d-flex justify-content-center align-items-center edit-social-i" aria-hidden="true"></i>
        <input type="text" id="inst-edit" class="form-control col-9 input-field" placeholder="https://instagram.com/" value="https://instagram.com/<?= get_insta_link($user_uuid); ?>">
        <em class="text-center col-3"></em>
        <em id="inst-edit-message" class="text-center col-9"></em>
      </div>      
    </div>

    <div class="form-group col-12">
      <div class="row m-0">
        <i class="fa fa-odnoklassniki fz-20 col-3 d-flex justify-content-center align-items-center edit-social-i" aria-hidden="true"></i>
        <input type="text" id="ok-edit" class="form-control col-9 input-field" placeholder="https://ok.com/" value="https://ok.ru/<?= get_ok_link($user_uuid); ?>">
        <em class="text-center col-3"></em>
        <em id="ok-edit-message" class="text-center col-9"></em>
      </div>
    </div>

    <input type="submit" class="btn btn-standard w-100 m-0" value="Сохранить изменения"> 
  </form>
</div>