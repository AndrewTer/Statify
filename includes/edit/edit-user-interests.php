<p class="fz-17 text-center mt-2 mb-2 font-weight-bold">Интересы</p>
<hr class="hr-user-info"> 
<div class="m-0 p-2 position-relative">
  <div class="interests-block m-0 p-0 d-flex flex-wrap">
<?
$interests_list = get_interests_list();
$user_interests_list = get_user_interests($user_uuid);
$user_interests_list_values = array();

if ($interests_list)
{
  if ($user_interests_list)
    for ($user_interests_num = 0; $user_interests_num < count($user_interests_list); $user_interests_num++)
      $user_interests_list_values[$user_interests_num] = $user_interests_list[$user_interests_num]['value'];

  for ($interests_num = 0; $interests_num < count($interests_list); $interests_num++)
  {
    $interests_title = $interests_list[$interests_num]['title'];
    $interests_value = $interests_list[$interests_num]['value'];
    $interests_color = $interests_list[$interests_num]['color'];

    if ($user_interests_list_values)
      if (in_array($interests_value, $user_interests_list_values))
        echo '
          <label class="fz-14 font-weight-bold interests-checkbox position-relative"
                  id="interests-label-'.$interests_value.'"
                  style="color: rgb('.$interests_color.');
                          border-color: rgb('.$interests_color.');
                          background-color: rgba('.$interests_color.', .2);">
            <input type="checkbox" name="interests" value="'.$interests_value.'" data-color="'.$interests_color.'" checked />
            '.$interests_title.'
          </label>';
      else
        echo '
          <label class="fz-14 font-weight-bold interests-checkbox position-relative" id="interests-label-'.$interests_value.'">
            <input type="checkbox" name="interests" value="'.$interests_value.'" data-color="'.$interests_color.'" />
            '.$interests_title.'
          </label>';
    else
        echo '
          <label class="fz-14 font-weight-bold interests-checkbox position-relative" id="interests-label-'.$interests_value.'">
            <input type="checkbox" name="interests" value="'.$interests_value.'" data-color="'.$interests_color.'" />
            '.$interests_title.'
          </label>';
    
  }
}
?>
  </div>

  <input type="submit" class="btn btn-standard fz-14 w-100 m-0 mt-3" onclick="event.preventDefault();editUserInterests();" value="Сохранить список интересов">
</div>