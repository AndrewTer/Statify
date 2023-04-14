const emailMask = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/,
      loginEmailInput = $("#email-login"),
      loginEmailInputMessage = $("#email-login-message"),
      loginPasswordInput = $("#password-login"),
      loginPasswordInputMessage = $("#password-login-message"),
      regEmailInput = $("#email-reg"),
      regEmailInputMessage = $("#email-reg-message"),
      regUsernameInput = $("#username-reg"),
      regUsernameInputMessage = $("#username-reg-message"),
      regUsersurnameInput = $("#usersurname-reg"),
      regUsersurnameInputMessage = $("#usersurname-reg-message"),
      regPasswordInput = $("#userpassword-reg"),
      regPasswordInputMessage = $("#userpassword-reg-message"),
      regPasswordConfirmInput = $("#userconfirm-reg"),
      regPasswordConfirmInputMessage = $("#userconfirm-reg-message");

var emailFromInput;

$("#username-reg").on("keypress", function(e) {
    var chars = /[а-яёА-ЯЁ]/,
        val = String.fromCharCode(e.which),
        checkInputCharacters = chars.test(val),
        maxCharacters = 30;
  
    if (!checkInputCharacters) 
        return false;

    if ($(this).val().length >= maxCharacters)
        $(this).val($(this).val().substr(0, maxCharacters));
});

$("#usersurname-reg").on("keypress", function(e) {
    var chars = /[а-яёА-ЯЁ]/,
        val = String.fromCharCode(e.which),
        checkInputCharacters = chars.test(val),
        maxCharacters = 30;
  
    if (!checkInputCharacters) 
        return false;

    if ($(this).val().length >= maxCharacters)
        $(this).val($(this).val().substr(0, maxCharacters));
});

function recoveryPassword()
{
    var passwordRecoveryEmailInput = $("#email-recovery-input"),
        passwordRecoveryEmailMessage = $("#recovery-password-message");

    if(!$("#email-recovery-input").val())
    {
        passwordRecoveryEmailInput.addClass('is-invalid');
        passwordRecoveryEmailInput.removeClass('is-valid');
        passwordRecoveryEmailMessage.html('<span class="text-danger">Поле не заполнено!</span>');
    }else
    {
        if(emailMask.test(passwordRecoveryEmailInput.val()) == false)
        {
            passwordRecoveryEmailInput.addClass('is-invalid');
            passwordRecoveryEmailInput.removeClass('is-valid');
            passwordRecoveryEmailMessage.html('<span class="text-danger">Некорректный формат email!</span>');
        }else
        {
            var password_recovery_email = 'email=' + passwordRecoveryEmailInput.val();

            $.ajax({
                url: "actions/password-recovery.php",
                type: 'POST',
                data: password_recovery_email,
                success: function (data) {
                    switch (data)
                    {
                        case 'success':
                            $('#recovery-modal-body').html('<p class="fz-15 w-100 m-0 p-0 text-center font-weight-bold text-white">На ваш email отправлено письмо с новым паролем!</p>'
                                                            + '<p class="fz-13 w-100 m-0 p-0 text-center">(Письмо может оказаться в папке <span class="fz-14 text-white">Спам</span>)</p>');
                            break;

                        case 'empty':
                            passwordRecoveryEmailInput.addClass('is-invalid');
                            passwordRecoveryEmailInput.removeClass('is-valid');
                            passwordRecoveryEmailMessage.html('<span class="text-danger">Такого пользователя не существует!</span>');
                            break;

                        default:
                            passwordRecoveryEmailInput.addClass('is-invalid');
                            passwordRecoveryEmailInput.removeClass('is-valid');
                            passwordRecoveryEmailMessage.html('<span class="text-danger">Системная ошибка!</span>');
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
        }
    }
}

function loginValidation()
{
    var loginCheck = 0;

    if(!loginEmailInput.val())
    {
        loginEmailInput.addClass('is-invalid');
        loginEmailInput.removeClass('is-valid');
        loginEmailInputMessage.html('<span class="text-danger">Поле не заполнено!</span>');
        loginCheck++;
    }else{
        if(emailMask.test(loginEmailInput.val()) == false)
        {
            loginEmailInput.addClass('is-invalid');
            loginEmailInput.removeClass('is-valid');
            loginEmailInputMessage.html('<span class="text-danger">Некорректный формат email!</span>');
            loginCheck++;
        }else{
            loginEmailInput.addClass('is-valid');
            loginEmailInput.removeClass('is-invalid');
            loginEmailInputMessage.html('');
        }
    }

    if(!loginPasswordInput.val())
    {
        loginPasswordInput.addClass('is-invalid');
        loginPasswordInput.removeClass('is-valid');
        loginPasswordInputMessage.html('<span class="text-danger">Поле не заполнено!</span>');
        loginCheck++;
    }else{
        loginPasswordInput.addClass('is-valid');
        loginPasswordInput.removeClass('is-invalid');
        loginPasswordInputMessage.html('');
    }

    if(loginCheck == 0)
    {
        var email_login = loginEmailInput.val();
        var password_login = loginPasswordInput.val();
        var login_user = 'email=' + email_login + '&password=' + password_login;

        $.ajax({
            url: "actions/login-user.php",
            type: 'POST',
            data: login_user,
            success: function (data) {
                if(data == 'error')
                {
                    $('.toast').addClass('toast-error');
                    $('.toast').removeClass('toast-success');
                    $('.toast-body').html('Такого пользователя не существует!');
                    $('.toast').toast('show');
                }else{
                    window.open('./', '_self');
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

function regValidation()
{
    var regCheck = 0;

    if(!regEmailInput.val())
    {
        regEmailInput.addClass('is-invalid');
        regEmailInputMessage.html('<span class="text-danger">Поле не заполнено!</span>');
        regCheck++;
    }else{
        
        if(emailMask.test(regEmailInput.val()) == false)
        {
            regEmailInput.addClass('is-invalid');
            regEmailInput.removeClass('is-valid');
            regEmailInputMessage.html('<span class="text-danger">Некорректный формат email!</span>');
            regCheck++;
        }else{
            regEmailInput.addClass('is-valid');
            regEmailInput.removeClass('is-invalid');
            regEmailInputMessage.html('');
        }
    }

    if(!regUsernameInput.val())
    {
        regUsernameInput.addClass('is-invalid');
        regUsernameInput.removeClass('is-valid');
        regUsernameInputMessage.html('<span class="text-danger">Поле не заполнено!</span>');
        regCheck++;
    }else{
        regUsernameInput.addClass('is-valid');
        regUsernameInput.removeClass('is-invalid');
        regUsernameInputMessage.html('');
    }

    if(!regUsersurnameInput.val())
    {
        regUsersurnameInput.addClass('is-invalid');
        regUsersurnameInput.removeClass('is-valid');
        regUsersurnameInputMessage.html('<span class="text-danger">Поле не заполнено!</span>');
        regCheck++;
    }else{
        regUsersurnameInput.addClass('is-valid');
        regUsersurnameInput.removeClass('is-invalid');
        regUsersurnameInputMessage.html('');
    }

    if(!regPasswordInput.val())
    {
        regPasswordInput.addClass('is-invalid');
        regPasswordInput.removeClass('is-valid')
        regPasswordInputMessage.html('<span class="text-danger">Поле не заполнено!</span>');
        regCheck++;
    }else{
        regPasswordInput.addClass('is-valid');
        regPasswordInput.removeClass('is-invalid');
        regPasswordInputMessage.html('');
    }

    if(!regPasswordConfirmInput.val())
    {
        regPasswordConfirmInput.addClass('is-invalid');
        regPasswordConfirmInput.removeClass('is-valid');
        regPasswordConfirmInputMessage.html('<span class="text-danger">Поле не заполнено!</span>');
        regCheck++;
    }else{
        regPasswordConfirmInput.addClass('is-valid');
        regPasswordConfirmInput.removeClass('is-invalid');
        regPasswordConfirmInputMessage.html('');
    }

    if(regPasswordInput.val()!=regPasswordConfirmInput.val())
    {
        regPasswordInput.addClass('is-invalid');
        regPasswordInput.removeClass('is-valid')
        regPasswordInputMessage.html('<span class="text-danger">Пароли не совпадают!</span>');
        regPasswordConfirmInput.addClass('is-invalid');
        regPasswordConfirmInput.removeClass('is-valid');
        regPasswordConfirmInputMessage.html('<span class="text-danger">Пароли не совпадают!</span>');
        regCheck++;
    }

    if(regCheck == 0)
    {
        var email_reg = emailFromInput,
            password_reg = regPasswordInput.val(),
            username_reg = regUsernameInput.val(),
            usersurname_reg = regUsersurnameInput.val();

        var reg_user = 'email=' + email_reg + '&password=' + password_reg + '&username=' + username_reg + '&usersurname=' + usersurname_reg;

        $.ajax({
            url: "actions/registration-user.php",
            type: 'POST',
            data: reg_user,
            success: function (data) {
                if (data == 'error')
                {
                    $('.toast').addClass('toast-error');
                    $('.toast').removeClass('toast-success');
                    $('.toast-body').html('Системная ошибка!');
                    $('.toast').toast('show');
                    return false;
                }else
                    window.open('./', '_self');
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

function emailCheck()
{
    if(!regEmailInput.val())
    {
        regEmailInput.addClass('is-invalid');
        regEmailInput.removeClass('is-valid');
        regEmailInputMessage.html('<span class="text-danger">Поле не заполнено!</span>');
        return false;
    }else{

        if(emailMask.test(regEmailInput.val()) == false)
        {
            regEmailInput.addClass('is-invalid');
            regEmailInput.removeClass('is-valid');
            regEmailInputMessage.html('<span class="text-danger">Некорректный формат email!</span>');
            return false;
        }else{
            emailFromInput = regEmailInput.val();
            var check_email = 'email=' + emailFromInput;

            $.ajax({
                url: "actions/check-email.php",
                type: 'POST',
                data: check_email,
                success: function (data) {
                    switch(data) {
                        case 'success':
                            regEmailInput.addClass('is-valid');
                            regEmailInput.removeClass('is-invalid');
                            regEmailInputMessage.html('');
                            $('#full-reg-form').collapse('show');
                            regEmailInput.prop('disabled', true);
                            return true;
                        break;

                        case 'error':
                            regEmailInput.removeClass('is-invalid');
                            regEmailInputMessage.html('');
                            $('.toast').addClass('toast-error');
                            $('.toast').removeClass('toast-success');
                            $('.toast-body').html('Этот email уже занят!');
                            $('.toast').toast('show');
                            $('#full-reg-form').collapse('hide');
                            return false;
                        break;

                        default:
                            regEmailInput.removeClass('is-invalid');
                            regEmailInputMessage.html('');
                            $('.toast').addClass('toast-error');
                            $('.toast').removeClass('toast-success');
                            $('.toast-body').html('Этот email уже занят!');
                            $('.toast').toast('show');
                            $('#full-reg-form').collapse('hide');
                            return false;
                        break;
                    }
                },
                error: function () {
                    regEmailInput.removeClass('is-invalid');
                    regEmailInputMessage.html('');
                    $('.toast').addClass('toast-error');
                    $('.toast').removeClass('toast-success');
                    $('.toast-body').html('Системная ошибка!');
                    $('.toast').toast('show');
                    $('#full-reg-form').collapse('hide');
                    return false;
                }
            });
        }
        return false;
    }
}

$(document).ready(function(e) 
{
    // LOGIN

    loginEmailInput.on("keyup", function()
    {
        if(!loginEmailInput.val())
        {
            loginEmailInput.addClass('is-invalid');
            loginEmailInput.removeClass('is-valid');
            return false;
        }else{
            if(emailMask.test(loginEmailInput.val()) == false)
            {
                loginEmailInput.addClass('is-invalid');
                loginEmailInput.removeClass('is-valid');
                return false;
            }else{
                loginEmailInput.addClass('is-valid');
                loginEmailInput.removeClass('is-invalid');
                loginEmailInputMessage.html('');
            }
        }
    });

    loginPasswordInput.on("keyup",function()
    {
        if(!loginPasswordInput.val())
        {
            loginPasswordInput.addClass('is-invalid');
            loginPasswordInput.removeClass('is-valid');
            return false;
        }else{
            loginPasswordInput.addClass('is-valid');
            loginPasswordInput.removeClass('is-invalid');
            loginPasswordInputMessage.html('');
        }
    });

    // REGISTRATION

    regEmailInput.on("keyup",function()
    {
        if(!regEmailInput.val())
        {
            regEmailInput.addClass('is-invalid');
            return false;
        }else{
            if(emailMask.test(regEmailInput.val()) == false)
            {
                regEmailInput.addClass('is-invalid');
                return false;
            }else{
                regEmailInput.addClass('is-valid');
                regEmailInput.removeClass('is-invalid');
                regEmailInputMessage.html('');
            }
        }
    });

    regUsernameInput.on("keyup",function()
    {
        if(!regUsernameInput.val())
        {
            regUsernameInput.addClass('is-invalid');
            return false;
        }else{
            regUsernameInput.addClass('is-valid');
            regUsernameInput.removeClass('is-invalid');
            regUsernameInputMessage.html('');
        }
    });

    regUsersurnameInput.on("keyup",function()
    {
        if(!regUsersurnameInput.val())
        {
            regUsersurnameInput.addClass('is-invalid');
            return false;
        }else{
            regUsersurnameInput.addClass('is-valid');
            regUsersurnameInput.removeClass('is-invalid');
            regUsersurnameInputMessage.html('');
        }
    });

    regPasswordInput.on("keyup",function()
    {
        if(!regPasswordInput.val())
        {
            regPasswordInput.addClass('is-invalid');
            return false;
        }else{
            regPasswordInput.addClass('is-valid');
            regPasswordInput.removeClass('is-invalid');
            regPasswordInputMessage.html('');
        }
    });

    regPasswordConfirmInput.on("keyup",function()
    {
        if(!regPasswordConfirmInput.val())
        {
            regPasswordConfirmInput.addClass('is-invalid');
            return false;
        }else{
            regPasswordConfirmInput.addClass('is-valid');
            regPasswordConfirmInput.removeClass('is-invalid');
            regPasswordConfirmInputMessage.html('');
        }
    });
});