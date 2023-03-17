<?
	if (!$page_status && $current_user_uuid = $user_uuid)
	{
?>
	<div class="m-0 p-0 col-12 col-sm-8 col-md-8 col-lg-9 col-xl-9 person-info order-2 order-sm-2 order-md-2 order-lg-2 order-xl-2" id="block-with-registration-completion">
		<div class="block-user-content" id="registration-completion">
   	 		<h5 class="text-center fz-18">Завершение регистрации</h5>
    		<hr class="hr-user-info">

    		<p class="w-100 m-0 p-0 text-center fz-13">Вам следует заполнить поля ниже для активации вашей страницы</p>

    		<div class="modal-body edit-modal-body">
    			<form id="registration-completion-block" data-attr="<?=$user_uuid; ?>" action="" method="POST" onSubmit="return registrationCompletionValidation();">

    				<div class="form-group col-12 m-0 p-0">
    					<div class="row m-0">
					        <label class="font-weight-bold col-6 m-0 p-0 d-flex align-items-center">Пользовательское имя</label>
					        <input type="text" id="nickname-save" class="form-control col-6 m-0 input-field" placeholder="максимум 20 символов" autocomplete="off">
					        <em class="text-center float-right w-50"></em>
					        <em id="nickname-save-message" class="text-center float-right w-50"></em>
      					</div>
    				</div>

    				<div class="form-group col-12 m-0 p-0 mt-3">
				     	<div class="row m-0">
					        <label class="font-weight-bold col-6 m-0 p-0 d-flex align-items-center">Дата рождения</label>
					        <input type="date" id="date-born-save" class="form-control col-6 m-0 input-field" min="1940-01-01" max="<?= date("Y-m-d"); ?>">
					        <em class="text-center float-right w-50"></em>
					      	<em id="date-born-save-message" class="text-center float-right w-50"></em>
				    	</div>
				    </div>

			        <div class="form-group col-12 m-0 p-0 mt-3">
			          <div class="row m-0">
			            <label class="font-weight-bold col-6 m-0 p-0 d-flex align-items-center">Пол</label>
			            <select class="form-control col-6 m-0 input-field" id="save-input-select-gender">
				        <?
				        	$genders_list = get_genders_list();

				        	for ($genders_num = 0; $genders_num < count($genders_list); $genders_num++)
				        		echo '<option value="'.$genders_list[$genders_num][0].'" selected>'.$genders_list[$genders_num][1].'</option>';
				        ?>
			            </select>
			          </div>
			        </div>

			        <input type="submit" class="btn btn-standard w-100 mt-2" value="Сохранить">

    			</form>
    		</div>

    		<p class="w-100 m-0 p-0 text-center fz-12 font-italic">Ваши пользовательское имя и пол в дальнейшем нельзя будет изменить!<br>Учтите это при заполнении</p>
		</div>
	</div>
<?
	}
?>

<script defer type="text/javascript" src="js/registration-completion.js"></script>