$("#nickname-save").on("keypress", function(e) {
  var chars = /["a-zA-Z0-9\-\_]/,
      val = String.fromCharCode(e.which),
      checkInputCharacters = chars.test(val),
      maxCharacters = 19;
  
  if (!checkInputCharacters) 
  {
    $("#nickname-save").addClass('is-invalid');
    $("#nickname-save-message").html("<span class='text-danger'>Допустимые символы:<br>A-z, 0-9, дефис, нижнее подчёркивание</span>");
    return false;
  }else
  {
    $("#nickname-save").removeClass('is-invalid');
    $("#nickname-save-message").html('');
  }

  if ($(this).val().length >= maxCharacters)
    $(this).val($(this).val().substr(0, maxCharacters));
});

function registrationCompletionValidation()
{
  var regCheck = 0;

  if (!$("#nickname-save").val())
  {
    $("#nickname-save").addClass('is-invalid');
    $("#nickname-save-message").html('<span class="text-danger">Поле не заполнено!</span>');
    regCheck++;
  }else if ($("#nickname-save").val() == 'null')
  {
    $("#nickname-save").addClass('is-invalid');
    $("#nickname-save-message").html('<span class="text-danger">Введено некорректное значение!</span>');
    regCheck++;
  }else{
    $("#nickname-save").removeClass('is-invalid');
    $("#nickname-save-message").html('');
  }

  if (!$("#date-born-save").val())
  {
    $("#date-born-save").addClass('is-invalid');
    $("#date-born-save-message").html('<span class="text-danger">Поле не заполнено!</span>');
    regCheck++;
  }else{
    $("#date-born-save").removeClass('is-invalid');
    $("#date-born-save-message").html('');
  }

  if (regCheck == 0)
  {
    var user_uuid_save = $("#registration-completion-block").attr('data-attr'),
        user_nickname_save = $("#nickname-save").val(),
        user_date_born_save = $("#date-born-save").val(),
        user_gender_save = $("#save-input-select-gender").val();

    var save_user_data = 'user_nickname=' + user_nickname_save + 
                         '&user_date_born=' + user_date_born_save + 
                         '&user_gender=' + user_gender_save +
                         '&user_uuid=' + user_uuid_save;

    $.ajax({
        url: "actions/save-data-to-complete-registration.php",
        type: 'POST',
        data: save_user_data,
        success: function (data) {
          switch (data)
          {
            case 'nickname':
              $("#nickname-save").addClass('is-invalid');
              $("#nickname-save-message").html('<span class="text-danger">Это имя уже занято!</span>');
            break;

            case 'error':
              $('.toast').addClass('toast-error');
              $('.toast').removeClass('toast-success');
              $('.toast-body').html('Системная ошибка!');
              $('.toast').toast('show');
            break;

            case 'success':
              location.reload();
            break;

            default:
              $('.toast').addClass('toast-error');
              $('.toast').removeClass('toast-success');
              $('.toast-body').html('Системная ошибка!');
              $('.toast').toast('show');
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