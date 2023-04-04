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
    <div class="form-group w-100 m-0 mb-3 pl-4 pr-4 d-flex align-items-center">
      <label class="font-weight-bold letter-spacing-05 p-0 m-0 w-40">Имя</label>
      <div class="m-0 p-0 w-60 d-flex flex-column align-items-center">
        <input type="text" id="name-edit" class="form-control input-field" value="<?= $user_name; ?>" autocomplete="off" placeholder="Допустимые символы: А-я">
        <em id="name-edit-message" class="text-center"></em>
      </div>
    </div>

    <div class="form-group w-100 m-0 mt-3 mb-3 pl-4 pr-4 d-flex align-items-center">
      <label class="font-weight-bold letter-spacing-05 p-0 m-0 w-40">Фамилия</label>
      <div class="m-0 p-0 w-60 d-flex flex-column align-items-center">
        <input type="text" id="surname-edit" class="form-control input-field" value="<?= $user_surname; ?>" autocomplete="off" placeholder="Допустимые символы: А-я">
        <em id="surname-edit-message" class="text-center"></em>
      </div>
    </div>

    <div class="form-group w-100 m-0 mt-3 mb-3 pl-4 pr-4 d-flex align-items-center" id="edit-date-born">
      <label class="font-weight-bold letter-spacing-05 m-0 p-0 w-40">Дата рождения</label>
      <div class="m-0 p-0 w-60 d-flex flex-column align-items-center">
        <input type="date" id="date-born-edit" class="form-control input-field" min="1940-01-01" max="<?= date("Y-m-d"); ?>" value="<?= $user_birthday; ?>">
        <em id="date-born-edit-message" class="text-center"></em>
      </div>
    </div>

    <hr class="hr-user-info">

    <div class="form-group w-100 m-0 mt-3 mb-3 pl-4 pr-4 d-flex align-items-center" id="edit-country">
      <label class="font-weight-bold letter-spacing-05 m-0 p-0 w-40">Страна</label>
      <select class="form-control m-0 p-0 w-60 input-field" id="edit-input-select-country">
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

    <div class="form-group w-100 m-0 mt-3 mb-3 pl-4 pr-4 d-flex align-items-center" id="edit-city" data-attr = "<?= get_user_city($user_uuid); ?>">
      <label class="font-weight-bold letter-spacing-05 m-0 p-0 w-40">Город</label>
      <select class="form-control m-0 p-0 w-60 input-field" id="edit-input-select-city"></select>
    </div>

    <hr class="hr-user-info"> 

    <div class="form-group w-100 m-0 mt-2 mb-2 p-0 pl-4 pr-4 d-flex align-items-start">
      <p class="m-0 p-0 w-30 d-flex justify-content-center align-items-center">
        <svg class="svg-social-icons fill-path" width="32px" height="32px" viewBox="-2.5 0 32 32">
          <path d="M16.563 15.75c-0.5-0.188-0.5-0.906-0.531-1.406-0.125-1.781 0.5-4.5-0.25-5.656-0.531-0.688-3.094-0.625-4.656-0.531-0.438 0.063-0.969 0.156-1.344 0.344s-0.75 0.5-0.75 0.781c0 0.406 0.938 0.344 1.281 0.875 0.375 0.563 0.375 1.781 0.375 2.781 0 1.156-0.188 2.688-0.656 2.75-0.719 0.031-1.125-0.688-1.5-1.219-0.75-1.031-1.5-2.313-2.063-3.563-0.281-0.656-0.438-1.375-0.844-1.656-0.625-0.438-1.75-0.469-2.844-0.438-1 0.031-2.438-0.094-2.719 0.5-0.219 0.656 0.25 1.281 0.5 1.813 1.281 2.781 2.656 5.219 4.344 7.531 1.563 2.156 3.031 3.875 5.906 4.781 0.813 0.25 4.375 0.969 5.094 0 0.25-0.375 0.188-1.219 0.313-1.844s0.281-1.25 0.875-1.281c0.5-0.031 0.781 0.406 1.094 0.719 0.344 0.344 0.625 0.625 0.875 0.938 0.594 0.594 1.219 1.406 1.969 1.719 1.031 0.438 2.625 0.313 4.125 0.25 1.219-0.031 2.094-0.281 2.188-1 0.063-0.563-0.563-1.375-0.938-1.844-0.938-1.156-1.375-1.5-2.438-2.563-0.469-0.469-1.063-0.969-1.063-1.531-0.031-0.344 0.25-0.656 0.5-1 1.094-1.625 2.188-2.781 3.188-4.469 0.281-0.5 0.938-1.656 0.688-2.219-0.281-0.625-1.844-0.438-2.813-0.438-1.25 0-2.875-0.094-3.188 0.156-0.594 0.406-0.844 1.063-1.125 1.688-0.625 1.438-1.469 2.906-2.344 4-0.313 0.375-0.906 1.156-1.25 1.031z"></path>
        </svg>
      </p>
      <div class="m-0 p-0 w-70 d-flex flex-column align-items-center">
        <input type="text" id="vk-edit" class="form-control input-field" placeholder="https://vk.com/" value="https://vk.com/<?= get_vk_link($user_uuid); ?>">
        <em id="vk-edit-message" class="text-center"></em>    
      </div>
    </div>

    <div class="form-group w-100 m-0 mb-2 p-0 pl-4 pr-4 d-flex align-items-start">
      <p class="m-0 p-0 w-30 d-flex justify-content-center align-items-center">
        <svg class="svg-social-icons fill-path" width="32px" height="32px" viewBox="0 0 32 32">
          <path d="M20.445 5h-8.891A6.559 6.559 0 0 0 5 11.554v8.891A6.559 6.559 0 0 0 11.554 27h8.891a6.56 6.56 0 0 0 6.554-6.555v-8.891A6.557 6.557 0 0 0 20.445 5zm4.342 15.445a4.343 4.343 0 0 1-4.342 4.342h-8.891a4.341 4.341 0 0 1-4.341-4.342v-8.891a4.34 4.34 0 0 1 4.341-4.341h8.891a4.342 4.342 0 0 1 4.341 4.341l.001 8.891z"></path>
          <path d="M16 10.312c-3.138 0-5.688 2.551-5.688 5.688s2.551 5.688 5.688 5.688 5.688-2.551 5.688-5.688-2.55-5.688-5.688-5.688zm0 9.163a3.475 3.475 0 1 1-.001-6.95 3.475 3.475 0 0 1 .001 6.95zM21.7 8.991a1.363 1.363 0 1 1-1.364 1.364c0-.752.51-1.364 1.364-1.364z"></path>
        </svg>
      </p>
      <div class="m-0 p-0 w-70 d-flex flex-column align-items-center">
        <input type="text" id="inst-edit" class="form-control input-field" placeholder="https://instagram.com/" value="https://instagram.com/<?= get_insta_link($user_uuid); ?>">
        <em id="inst-edit-message" class="text-center"></em>
      </div>
    </div>

    <div class="form-group w-100 m-0 mb-3 p-0 pl-4 pr-4 d-flex align-items-start">
      <p class="m-0 p-0 w-30 d-flex justify-content-center align-items-center">
        <svg class="svg-social-icons fill-path" width="25px" height="25px" viewBox="0 0 95.481 95.481">
          <path d="M43.041,67.254c-7.402-0.772-14.076-2.595-19.79-7.064c-0.709-0.556-1.441-1.092-2.088-1.713 c-2.501-2.402-2.753-5.153-0.774-7.988c1.693-2.426,4.535-3.075,7.489-1.682c0.572,0.27,1.117,0.607,1.639,0.969 c10.649,7.317,25.278,7.519,35.967,0.329c1.059-0.812,2.191-1.474,3.503-1.812c2.551-0.655,4.93,0.282,6.299,2.514 c1.564,2.549,1.544,5.037-0.383,7.016c-2.956,3.034-6.511,5.229-10.461,6.761c-3.735,1.448-7.826,2.177-11.875,2.661 c0.611,0.665,0.899,0.992,1.281,1.376c5.498,5.524,11.02,11.025,16.5,16.566c1.867,1.888,2.257,4.229,1.229,6.425 c-1.124,2.4-3.64,3.979-6.107,3.81c-1.563-0.108-2.782-0.886-3.865-1.977c-4.149-4.175-8.376-8.273-12.441-12.527 c-1.183-1.237-1.752-1.003-2.796,0.071c-4.174,4.297-8.416,8.528-12.683,12.735c-1.916,1.889-4.196,2.229-6.418,1.15 c-2.362-1.145-3.865-3.556-3.749-5.979c0.08-1.639,0.886-2.891,2.011-4.014c5.441-5.433,10.867-10.88,16.295-16.322 C42.183,68.197,42.518,67.813,43.041,67.254z"></path>
          <path d="M47.55,48.329c-13.205-0.045-24.033-10.992-23.956-24.218C23.67,10.739,34.505-0.037,47.84,0 c13.362,0.036,24.087,10.967,24.02,24.478C71.792,37.677,60.889,48.375,47.55,48.329z M59.551,24.143 c-0.023-6.567-5.253-11.795-11.807-11.801c-6.609-0.007-11.886,5.316-11.835,11.943c0.049,6.542,5.324,11.733,11.896,11.709 C54.357,35.971,59.573,30.709,59.551,24.143z"></path>
        </svg>
      </p>
      <div class="m-0 p-0 w-70 d-flex flex-column align-items-center">
        <input type="text" id="ok-edit" class="form-control input-field" placeholder="https://ok.com/" value="https://ok.ru/<?= get_ok_link($user_uuid); ?>">
        <em id="ok-edit-message" class="text-center"></em>
      </div>
    </div>

    <input type="submit" class="btn btn-standard w-100 m-0 fz-14" value="Сохранить изменения"> 
  </form>
</div>