<?
	$latest_avatar_date = get_latest_avatar_date_upload($user_uuid);
	if ($latest_avatar_date == 'success' && $page_status)
		echo '<div class="main-info-section mt-3">
		  			<div class="section section-user-info p-0">

			  			<table class="table table-borderless table-avatar-update m-0">
			  				<tbody>
			  					<tr data-href="edit">
			  						<th scope="row"><i class="fa fa-camera" aria-hidden="true"></i></th>
			  						<td class="fz-12 fw-700">Обновить фотографию</td>
			  					</tr>
			  				</tbody>
			  			</table>

		  			</div>
					</div>';
?>