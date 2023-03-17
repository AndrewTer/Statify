<?
	if (check_user_page_status($user_uuid))
		if (!check_email_confirmed($user_uuid))
			echo '<div class="main-info-section mt-3">
			  			<div class="section section-user-info p-0">
				  			<table class="table table-borderless table-email-confirm m-0">
				  				<tbody>
				  					<tr data-href="edit">
				  						<th scope="row"><i class="fa fa-envelope" aria-hidden="true"></i></th>
				  						<td class="fz-12 fw-700">Подтвердить email</td>
				  					</tr>
				  				</tbody>
				  			</table>
			  			</div>
						</div>';
?>