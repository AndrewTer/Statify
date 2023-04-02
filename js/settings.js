var emailMask = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;

function editUserEmailValidation()
{
	var currentEmail = $("#current-email"),
			emailEditInput = $("#email-edit"),
	  	emailEditInputMessage = $("#email-edit-message"),
	  	passwordForEmailEditInput = $("#password-for-email-edit"),
	  	passwordForEmailEditInputMessage = $("#password-for-email-edit-message");

	var editEmailCheck = 0,
			editEmailSuccess = 0,
			currentEmailValue = currentEmail.text();

	if (!emailEditInput.val())
	{
		emailEditInput.addClass('is-invalid');
		emailEditInput.removeClass('is-valid');
		emailEditInputMessage.html('<span class="text-danger">Поле не заполнено!</span>');
		editEmailCheck++;
	}else{
		var newEmail = emailEditInput.val();

		if (emailMask.test(newEmail) == false)
		{
			emailEditInput.addClass('is-invalid');
			emailEditInput.removeClass('is-valid');
			emailEditInputMessage.html('<span class="text-danger">Некорректный формат email!</span>');
			editEmailCheck++;
		}else{
			if (newEmail == currentEmailValue)
			{
				emailEditInput.addClass('is-invalid');
				emailEditInput.removeClass('is-valid');
				emailEditInputMessage.html('<span class="text-danger">Введён текущий email!</span>');
				editEmailCheck++;
			}
		}
	}

	if (!passwordForEmailEditInput.val())
	{
		passwordForEmailEditInput.addClass('is-invalid');
		passwordForEmailEditInput.removeClass('is-valid');
		passwordForEmailEditInputMessage.html('<span class="text-danger">Поле не заполнено!</span>');
		editEmailCheck++;
	}else{
		passwordForEmailEditInput.addClass('is-valid');
		passwordForEmailEditInput.removeClass('is-invalid');
		passwordForEmailEditInputMessage.html('');
	}

	if (editEmailCheck == 0)
	{
		var check_email = 'email=' + newEmail;

		$.ajax({
	    url: "actions/check-email.php",
			type: 'POST',
			data: check_email,
			success: function (data) {
				switch(data) {
					case 'success':
						emailEditInput.removeClass('is-invalid');
						emailEditInput.addClass('is-valid');
						emailEditInputMessage.html('');
						
						var email_edit = emailEditInput.val(),
							password_for_email_edit = passwordForEmailEditInput.val(),
							edit_email_data = 'new_email=' + email_edit + '&current_email=' + currentEmailValue + '&password=' + password_for_email_edit;

						$.ajax({
				            url: "actions/edit-user-email.php",
				            type: 'POST',
				            data: edit_email_data,
				            success: function (data) {
				            	switch (data) {
				            		case 'update_error':
				                    $('.toast').addClass('toast-error');
						                $('.toast').removeClass('toast-success');
						                $('.toast-body').html('Ошибка при изменении email!');
						                $('.toast').toast('show');
				            			break;

				            		case 'password_error':
				                    passwordForEmailEditInput.addClass('is-invalid');
														passwordForEmailEditInput.removeClass('is-valid');
														passwordForEmailEditInputMessage.html('<span class="text-danger">Неверный пароль!</span');
				            			break;

				            		case 'email_error':
				                    $('.toast').addClass('toast-error');
						                $('.toast').removeClass('toast-success');
						                $('.toast-body').html('Неверный email!');
						                $('.toast').toast('show');
				            			break;

				            		case 'error':
				                    $('.toast').addClass('toast-error');
						                $('.toast').removeClass('toast-success');
						                $('.toast-body').html('Системная ошибка!');
						                $('.toast').toast('show');
				            			break;

				            		default:
				            				currentEmail.html(email_edit);
				                    $('.toast').addClass('toast-success');
						                $('.toast').removeClass('toast-error');
						                $('.toast-body').html('Email успешно изменён');
						                $('.toast').toast('show');

						                setTimeout(function(){ $('#email-edit').removeClass('is-valid'); 
		                				$('#password-for-email-edit').removeClass('is-valid'); }, 5000)
				            			break;
				            	}
				            },
				            error: function () {
				                $('.toast').addClass('toast-error');
				                $('.toast').removeClass('toast-success');
				                $('.toast-body').html('Системная ошибка!');
				                $('.toast').toast('show');
				            }
				        });

					break;

					case 'error':
						emailEditInput.addClass('is-invalid');
						emailEditInput.removeClass('is-valid');
						emailEditInputMessage.html('<span class="text-danger">Этот email уже занят!</span>');
					break;

					default:
						emailEditInput.addClass('is-invalid');
						emailEditInput.removeClass('is-valid');
						emailEditInputMessage.html('<span class="text-danger">Этот email уже занят!</span>');
					break;
				}
			},
			error: function () {
				emailEditInput.addClass('is-invalid');
				emailEditInput.removeClass('is-valid');
				emailEditInputMessage.html('<span class="text-danger">Ошибка!&nbsp;Попробуйте ещё раз</span>');
			}
        });

		return false;
	}else
		return false;
}

function editUserPasswordValidation()
{
	var currentEmail = $("#current-email"),
		oldPasswordEditInput = $("#old-password-edit"),
		oldPasswordEditInputMessage = $("#old-password-edit-message"),
		newPasswordEditInput = $("#new-password-edit"),
	  newPasswordEditInputMessage = $("#new-password-edit-message"),
	  repeatPasswordEditInput = $("#repeat-password-edit"),
	  repeatPasswordEditInputMessage = $("#repeat-password-edit-message")
		editPasswordCheck = 0;

	if (!oldPasswordEditInput.val())
	{
		oldPasswordEditInput.addClass('is-invalid');
		oldPasswordEditInput.removeClass('is-valid');
		oldPasswordEditInputMessage.html('<span class="text-danger">Поле не заполнено!</span>');
		editPasswordCheck++;
	}else{
		oldPasswordEditInput.addClass('is-valid');
		oldPasswordEditInput.removeClass('is-invalid');
		oldPasswordEditInputMessage.html('');
	}

	if (!newPasswordEditInput.val())
	{
		newPasswordEditInput.addClass('is-invalid');
		newPasswordEditInput.removeClass('is-valid');
		newPasswordEditInputMessage.html('<span class="text-danger">Поле не заполнено!</span>');
		editPasswordCheck++;
	}else{
		newPasswordEditInput.addClass('is-valid');
		newPasswordEditInput.removeClass('is-invalid');
		newPasswordEditInputMessage.html('');
	}

	if (!repeatPasswordEditInput.val())
	{
		repeatPasswordEditInput.addClass('is-invalid');
		repeatPasswordEditInput.removeClass('is-valid');
		repeatPasswordEditInputMessage.html('<span class="text-danger">Поле не заполнено!</span>');
		editPasswordCheck++;
	}else{
		repeatPasswordEditInput.addClass('is-valid');
		repeatPasswordEditInput.removeClass('is-invalid');
		repeatPasswordEditInputMessage.html('');
	}

	if (newPasswordEditInput.val() != repeatPasswordEditInput.val())
	{
		newPasswordEditInput.addClass('is-invalid');
		newPasswordEditInput.removeClass('is-valid');
		newPasswordEditInputMessage.html('<span class="text-danger">Пароли не совпадают!</span>');
		repeatPasswordEditInput.addClass('is-invalid');
		repeatPasswordEditInput.removeClass('is-valid');
		repeatPasswordEditInputMessage.html('<span class="text-danger">Пароли не совпадают!</span>');
		editPasswordCheck++;
	}

	if (editPasswordCheck == 0)
	{
		var current_email_value = currentEmail.text(),
				old_password_edit = oldPasswordEditInput.val(),
				new_password_edit = newPasswordEditInput.val(),
				edit_password_data = 'email=' + current_email_value +'&old_password=' + old_password_edit + '&new_password=' + new_password_edit;

		$.ajax({
            url: "actions/edit-user-password.php",
            type: 'POST',
            data: edit_password_data,
            success: function (data) {
            	switch (data) {
            		case 'error':
                    $('.toast').addClass('toast-error');
		                $('.toast').removeClass('toast-success');
		                $('.toast-body').html('Ошибка при изменении пароля!');
		                $('.toast').toast('show');
            			break;

            		case 'wrong_current_password':
            				oldPasswordEditInput.addClass('is-invalid');
										oldPasswordEditInput.removeClass('is-valid');
										oldPasswordEditInputMessage.html('');

            				$('.toast').addClass('toast-error');
		                $('.toast').removeClass('toast-success');
		                $('.toast-body').html('Некорректный текущий пароль!');
		                $('.toast').toast('show');
            			break;

            		default:
                    $('.toast').addClass('toast-success');
		                $('.toast').removeClass('toast-error');
		                $('.toast-body').html('Пароль успешно изменён');
		                $('.toast').toast('show');

		                setTimeout(function(){ $('#old-password-edit').removeClass('is-valid'); 
		                $('#new-password-edit').removeClass('is-valid');
		                $('#repeat-password-edit').removeClass('is-valid'); }, 5000)
            			break;
            	}
            },
            error: function () {
                $('.toast').addClass('toast-error');
                $('.toast').removeClass('toast-success');
                $('.toast-body').html('Системная ошибка!');
                $('.toast').toast('show');
            }
        });

		return false;
	}else
		return false;
}

function editUserPrivatePreferences(user_uuid)
{
	const regexExp = /^[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$/gi;
	var user_uuid = $("#all-user-settings-block").attr('data-attr'),
			user_who_can_rate_photos = $("input[name='who-can-rate-photos']:checked").val(),
			user_who_can_comment_photos = $("input[name='who-can-comment-photos']:checked").val(),
			user_who_can_read_comments_on_photos = $("input[name='who-can-read-comments-on-photos']:checked").val();

	if (regexExp.test(user_uuid))
	{
		var edit_user_private_preferences = 'user_uuid=' + user_uuid 
																				+ '&who_can_rate_photos=' + user_who_can_rate_photos 
																				+ '&who_can_comment_photos=' + user_who_can_comment_photos 
																				+ '&who_can_read_comments_on_photos=' + user_who_can_read_comments_on_photos;

		$.ajax({
            url: "actions/edit-user-private-preferences.php",
            type: 'POST',
            data: edit_user_private_preferences,
            success: function (data) {
                if(data == 'error')
                {
                    $('.toast').addClass('toast-error');
                    $('.toast').removeClass('toast-success');
                    $('.toast-body').html('Системная ошибка!');
                    $('.toast').toast('show');
                }else
                {
                    $('.toast').addClass('toast-success');
                    $('.toast').removeClass('toast-error');
                    $('.toast-body').html('Настройки приватности сохранены');
                    $('.toast').toast('show');
                }
            },
            error: function () {
                $('.toast').addClass('toast-error');
                $('.toast').removeClass('toast-success');
                $('.toast-body').html('Системная ошибка!');
                $('.toast').toast('show');
            }
        });
	}

	return false;
}

function terminateAllSessions()
{
	const regexExp = /^[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$/gi;
	var user_uuid = $("#all-user-settings-block").attr('data-attr');

	if (regexExp.test(user_uuid))
	{
		var terminate_all = 'user=' + user_uuid;

		$.ajax({
			url: "actions/terminate-all-sessions.php",
			type: 'POST',
			data: terminate_all,
			success: function (data) {
				switch (data) {
					case 'error':
						$('.toast').addClass('toast-error');
						$('.toast').removeClass('toast-success');
		        $('.toast-body').html('Системная ошибка!');
		        $('.toast').toast('show');
        		break;

        	case 'success':
						$('.toast').addClass('toast-success');
					  $('.toast').removeClass('toast-error');
					  $('.toast-body').html('Все сеансы завершены');
		        $('.toast').toast('show');
		        break;
		    }
			},
			error: function() {
				$('.toast').addClass('toast-error');
				$('.toast').removeClass('toast-success');
        $('.toast-body').html('Системная ошибка!');
        $('.toast').toast('show');
			}
		});
	}
}

$(document).ready(function(e)
{
	// Email edit

	var emailEditInput = $("#email-edit"),
			emailEditInputMessage = $("#email-edit-message")
			passwordForEmailEditInput = $("#password-for-email-edit"),
			passwordForEmailEditInputMessage = $("#password-for-email-edit-message"),
			oldPasswordEditInput = $("#old-password-edit"),
			oldPasswordEditInputMessage = $("#old-password-edit-message"),
			newPasswordEditInput = $("#new-password-edit"),
	  	newPasswordEditInputMessage = $("#new-password-edit-message"),
	  	repeatPasswordEditInput = $("#repeat-password-edit"),
	  	repeatPasswordEditInputMessage = $("#repeat-password-edit-message");

	emailEditInput.on("keyup", function()
	{
		if (!emailEditInput.val())
		{
			emailEditInput.addClass('is-invalid');
			emailEditInput.removeClass('is-valid');
			return false;
		}else{
			if (emailMask.test(emailEditInput.val()) == false)
			{
				emailEditInput.addClass('is-invalid');
				emailEditInput.removeClass('is-valid');
				return false;
			}else{
				emailEditInput.addClass('is-valid');
				emailEditInput.removeClass('is-invalid');
				emailEditInputMessage.html('');
			}
		}
	});

	passwordForEmailEditInput.on("keyup", function()
	{
		if (!passwordForEmailEditInput.val())
		{
			passwordForEmailEditInput.addClass('is-invalid');
			passwordForEmailEditInput.removeClass('is-valid');
			return false;
		}else{
			passwordForEmailEditInput.removeClass('is-invalid');
			passwordForEmailEditInput.addClass('is-valid');
			passwordForEmailEditInputMessage.html('');
		}
	});

	oldPasswordEditInput.on("keyup", function()
	{
		if (!oldPasswordEditInput.val())
		{
			oldPasswordEditInput.addClass('is-invalid');
			oldPasswordEditInput.removeClass('is-valid');
			return false;
		}else{
			oldPasswordEditInput.addClass('is-valid');
			oldPasswordEditInput.removeClass('is-invalid');
			oldPasswordEditInputMessage.html('');
		}
	});

	newPasswordEditInput.on("keyup", function()
	{
		if (!newPasswordEditInput.val())
		{
			newPasswordEditInput.addClass('is-invalid');
			newPasswordEditInput.removeClass('is-valid');
			return false;
		}else{
			newPasswordEditInput.addClass('is-valid');
			newPasswordEditInput.removeClass('is-invalid');
			newPasswordEditInputMessage.html('');
		}
	});

	repeatPasswordEditInput.on("keyup", function()
	{
		if (!repeatPasswordEditInput.val())
		{
			repeatPasswordEditInput.addClass('is-invalid');
			repeatPasswordEditInput.removeClass('is-valid');
			return false;
		}else{
			repeatPasswordEditInput.addClass('is-valid');
			repeatPasswordEditInput.removeClass('is-invalid');
			repeatPasswordEditInputMessage.html('');
		}
	});
});

$("input[name='choose-design-theme']").click(function()
{
	let designTheme = $('input:radio[name=choose-design-theme]:checked').val();

	switch (designTheme) {
		case 'darkness':
			$(document.body).removeClass();
			localStorage.setItem("theme", "darkness");
			break;

		case 'dark-sapphire':
			$(document.body).removeClass();
			$(document.body).addClass("dark-sapphire-theme");
			localStorage.setItem("theme", "dark-sapphire");
			break;

		case 'night-forest':
			$(document.body).removeClass();
			$(document.body).addClass("night-forest-theme");
			localStorage.setItem("theme", "night-forest");
			break;

		case 'spotted':
			$(document.body).removeClass();
			$(document.body).addClass("spotted-theme");
			localStorage.setItem("theme", "spotted");
			break;

		case 'ocean-depths':
			$(document.body).removeClass();
			$(document.body).addClass("ocean-depths-theme");
			localStorage.setItem("theme", "ocean-depths");
			break;

		case 'bahama-blue':
			$(document.body).removeClass();
			$(document.body).addClass("bahama-blue-theme");
			localStorage.setItem("theme", "bahama-blue");
			break;

		default:
			$(document.body).removeClass();
			localStorage.setItem("theme", "darkness");
			break;
	}
});

switch (localStorage.getItem("theme")) {
  case 'darkness':
      $("input[name=choose-design-theme][value='darkness']").prop('checked', true);
      break;

    case 'dark-sapphire':
      $("input[name=choose-design-theme][value='dark-sapphire']").prop('checked', true);
      break;

    case 'night-forest':
      $("input[name=choose-design-theme][value='night-forest']").prop('checked', true);
      break;

    case 'spotted':
      $("input[name=choose-design-theme][value='spotted']").prop('checked', true);
      break;

    case 'ocean-depths':
      $("input[name=choose-design-theme][value='ocean-depths']").prop('checked', true);
      break;

    case 'bahama-blue':
      $("input[name=choose-design-theme][value='bahama-blue']").prop('checked', true);
      break;

    default:
      $("input[name=choose-design-theme][value='darkness']").prop('checked', true);
      break;
}