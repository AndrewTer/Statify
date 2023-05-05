<?
	$updates_list = get_statify_updates_list();
	echo '<div class="about-card"><p class="fz-16 m-0 p-0 font-weight-bold">Обновления</p></div>';
	if ($updates_list)
	{
		echo '<div class="d-flex flex-column p-0 pt-3 pb-3 w-100">';
		for ($updates_num = 0; $updates_num < count($updates_list); $updates_num++)
		{
			$updates_title = $updates_list[$updates_num]['title'];
			$updates_date = $updates_list[$updates_num]['date'];
			$updates_text = $updates_list[$updates_num]['text'];
			$mt3 = ($updates_num == 0) ? '' : 'mt-3';
			echo '<div class="about-card w-100 '.$mt3.'">'
							.'<div class="w-100 m-0 p-0 d-flex flex-row">'
								.'<p class="fz-14 m-0 mr-auto p-0 font-weight-bold">'.$updates_title.'</p>'
								.'<p class="fz-14 m-0 ml-auto p-0 font-weight-bold">'.$updates_date.'</p>'
							.'</div>'
							.'<hr class="hr-user-info">'
							.'<div class="w-100 m-0 p-0 fz-14">'.$updates_text.'</div>'
						.'</div>';
		}
		echo '</div>';
	}
?>