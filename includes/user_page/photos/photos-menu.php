<div class="m-0 p-0" id="photo-menu-content">
  <div class="block-search-and-sort p-0 m-0 mb-3">
    <table class="table table-borderless m-0">
      <tbody>
        <tr class="saves-resize-list-item">
          <th scope="row" class="text-center" id="saves-card-large" style="border-right: 1px solid var(--hr-user-info-bg-color);"><i class="fa fa-th-large fz-15" aria-hidden="true"></i></th>
          <th scope="row" class="text-center" id="saves-card-small"><i class="fa fa-th fz-15" aria-hidden="true"></i></th>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="block-search-and-sort p-0 m-0">
    <table class="table table-borderless m-0" id="photo-menu-by-years">
      <tbody>
  <?
      for ($years_num = 0; $years_num < count($years_list); $years_num++)
      {
        $year_value = $years_list[$years_num][0];
        $border_class = '';

        if (count($years_list) == 1)
          $border_class =  'once-item';
        else
          if ($years_num == 0)
            $border_class = 'first-item';
          else if ($years_num == count($years_list)-1)
            $border_class = 'last-item';

        echo '<tr class="saves-sort-list-item '.$border_class.'" data-href="#'.$year_value.'">
                <th scope="row" class="text-center">'.$year_value.'</th>
              </tr>';
      }
  ?>
      </tbody>
    </table>
  </div>
</div>