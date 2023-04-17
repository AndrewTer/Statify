<div class="m-0 p-0" id="interests-content">
  <p class="fz-17 text-center mt-2 mb-2 font-weight-bold">Предпочтения</p>
  <hr class="hr-user-info"> 
  <div class="modal-body">
<?
    $user_birthday = get_user_birthday($user_uuid);

    $user_age = ($user_birthday) ? calculate_age($user_birthday) : null;

    if ($user_birthday && $user_age)
    {
?>  
    <form id="edit-user-interests-block" data-attr="<?= $user_uuid; ?>" action="" method="POST" onSubmit="return editUserInterestsValidation();">
      <div class="form-group w-100 m-0 mb-3 pl-4 pr-4 d-flex align-items-center" id="edit-gender-preference">
        <label class="font-weight-bold p-0 m-0 w-40">Пол</label>
        <select class="form-control m-0 p-0 w-60 input-field" id="edit-input-select-gender-preference">
        <?
          $genders_list = get_genders_list();
          $user_gender_preference = get_user_gender_preference($user_uuid);

          for ($genders_num = 0; $genders_num < count($genders_list); $genders_num++)
            if ($genders_list[$genders_num][0] == $user_gender_preference)
              echo '<option value="'.$genders_list[$genders_num][0].'" selected>'.$genders_list[$genders_num][1].'</option>';
            else
              echo '<option value="'.$genders_list[$genders_num][0].'">'.$genders_list[$genders_num][1].'</option>';
        ?>
        </select>
      </div>

      <div class="form-group w-100 m-0 mb-3 pl-4 pr-4 d-flex align-items-center" id="edit-age-preference">
        <label class="font-weight-bold m-0 p-0 w-50">Возрастной диапазон</label>
        <div class="m-0 p-0 w-50 d-flex flex-wrap justify-content-center align-items-center">
<?
        if ($user_age < 18)
          echo '<p class="m-0 p-0 font-weight-bold" id="before-adulthood">до 18 лет</p>';
        else
        {
          $min_age_preference = get_user_minimum_age_preference($user_uuid);
          $max_age_preference = get_user_maximum_age_preference($user_uuid);

          switch (true) {
            case ($min_age_preference && $max_age_preference):
                $age_difference_min = $user_age - $min_age_preference;
                $age_difference_max = $max_age_preference - $user_age;

                $age_difference = ($age_difference_min > $age_difference_max) ? $age_difference_min : $age_difference_max;
              break;
              
            case ($min_age_preference && !$max_age_preference):
                $age_difference = $user_age - $min_age_preference;
              break;

            case (!$min_age_preference && $max_age_preference):
                $age_difference = $max_age_preference - $user_age;
              break;

            default:
                $age_difference = 3;
              break;
          }
?>
          <div class="radio_btn age_preference_radio_btn m-0 mt-1 mr-1">
            <input id="age-preference-3" type="radio" name="age-preference" value="3" <?= ($age_difference == 3) ? "checked" : ""; ?>>
            <label class="m-0 text-center" for="age-preference-3">3 года</label>
          </div>
             
          <div class="radio_btn age_preference_radio_btn m-0 mt-1 mr-1">
            <input id="age-preference-5" type="radio" name="age-preference" value="5" <?= ($age_difference == 5) ? "checked" : ""; ?>>
            <label class="m-0 text-center" for="age-preference-5">5 лет</label>
          </div>
             
          <div class="radio_btn age_preference_radio_btn m-0 mt-1 mr-1">
            <input id="age-preference-10" type="radio" name="age-preference" value="10" <?= ($age_difference == 10) ? "checked" : ""; ?>>
            <label class="m-0 text-center" for="age-preference-10">10 лет</label>
          </div>

          <div class="radio_btn age_preference_radio_btn m-0 mt-1 mr-1">
            <input id="age-preference-15" type="radio" name="age-preference" value="15" <?= ($age_difference == 15) ? "checked" : ""; ?>>
            <label class="m-0 text-center" for="age-preference-15">15 лет</label>
          </div>

          <div class="radio_btn age_preference_radio_btn m-0 mt-1 mr-1">
            <input id="age-preference-20" type="radio" name="age-preference" value="20" <?= ($age_difference == 20) ? "checked" : ""; ?>>
            <label class="m-0 text-center" for="age-preference-20">20 лет</label>
          </div>

          <div class="radio_btn age_preference_radio_btn m-0 mt-1 mr-1">
            <input id="age-preference-25" type="radio" name="age-preference" value="25" <?= ($age_difference == 25) ? "checked" : ""; ?>>
            <label class="m-0 text-center" for="age-preference-25">25 лет</label>
          </div>
<?
        }
?>
        </div>
      </div>

      <input type="submit" class="btn btn-standard w-100 m-0 fz-14" value="Сохранить предпочтения">
            
    </form>
<?
    }else
      echo '<p class="fz-15 m-0 p-0 text-center">Недоступно</p>';
?>
  </div>
</div>