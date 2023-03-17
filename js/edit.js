const 
    tagsList = document.querySelector(".tags-block-content ul"),
    tagsInput = document.querySelector(".tags-block-content input"),
    tagsNumb = document.querySelector(".tags-block-details span"),
    countriesList = document.querySelector("#edit-input-select-country"),
    citiesList = $("#edit-input-select-city");

let maxTags = 5,
    userUuid = $("#edit-user-data-block").attr('data-attr'),
    userCity = $("#edit-city").attr('data-attr');
    user_uuid_data = 'user_uuid='+userUuid;

var tags = [],
    cities = [];

$("#name-edit").on("keypress", function(e) {
    var chars = /[А-яЁё\s]/,
        val = String.fromCharCode(e.which),
        checkInputCharacters = chars.test(val),
        maxCharacters = 30;
  
    if (!checkInputCharacters) 
        return false;

    if ($(this).val().length >= maxCharacters)
        $(this).val($(this).val().substr(0, maxCharacters));
});

$("#surname-edit").on("keypress", function(e) {
    var chars = /[А-яЁё\s]/,
        val = String.fromCharCode(e.which),
        checkInputCharacters = chars.test(val),
        maxCharacters = 30;
  
    if (!checkInputCharacters) 
        return false;

    if ($(this).val().length >= maxCharacters)
        $(this).val($(this).val().substr(0, maxCharacters));
});

$("#tags-edit").on("keypress", function(e) {
    var chars = /[А-яЁёA-z0-9\-\_\,]/,
        val = String.fromCharCode(e.which),
        checkInputCharacters = chars.test(val),
        maxCharacters = 30;
  
    if (!checkInputCharacters) 
        return false;

    if ($(this).val().length >= maxCharacters)
        $(this).val($(this).val().substr(0, maxCharacters));
});

// Tags

function getTagsListFromUL(ul)
{
    let list = ul.querySelectorAll('li');
    return [...list].map(item=>item.textContent);
}

function countTags() {
    tagsInput.focus();
    tagsNumb.innerText = maxTags - tags.length;
}

function createTag() {
    tagsList.querySelectorAll("li").forEach(li => li.remove());
    tags.slice().reverse().forEach(tag =>{
        let liTag = `<li class="tags-field">${tag} <i class="fa fa-times" onclick="remove(this, '${tag}')"></i></li>`;
        tagsList.insertAdjacentHTML("afterbegin", liTag);
    });
    countTags();
}

function remove(element, tag) {
    let index  = tags.indexOf(tag);
    tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
    element.parentElement.remove();
    countTags();
}

function addTag(e) {
    if(e.key == "Enter"){
        let tag = e.target.value.replace(/\s+/g, ' ');
        if(tag.length > 1 && !tags.includes(tag)){
            if(tags.length < 5){
                tag.split(',').forEach(tag => {
                    tags.push(tag);
                    createTag();
                });
            }
        }
        e.target.value = "";
    }
}

function editUserTags() {
    var newTagsList = '';

    $("#new-tags-list li").each(function() {
        newTagsList = newTagsList + $(this).text() + ',';
    });

    newTagsList = newTagsList.substring(0, newTagsList.length - 1);

    $.ajax({
        url: "actions/edit-user-tags-data.php",
        type: 'POST',
        data: {"user_uuid": userUuid, "tags_list": newTagsList},
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
                $('.toast-body').html('Теги успешно сохранены');
                $('.toast').toast('show');

                $(".tags-field").addClass('is-valid');
                $(".tags-field i").addClass('is-valid');

                setTimeout(function(){ $('.tags-field').removeClass('is-valid'); $('.tags-field i').removeClass('is-valid'); }, 5000)
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

// Update Info

function checkForm() {
    if (parseInt($('#w').val())) return true;
    $('.error').html('Please select a crop region and then press Upload').show();
    return false;
};

// update info by cropping (onChange and onSelect events handler)
function updateInfo(e) {
    $('#x1').val(e.x);
    $('#y1').val(e.y);
    $('#x2').val(e.x2);
    $('#y2').val(e.y2);
    $('#w').val(e.w);
    $('#h').val(e.h);
};

// clear info by cropping (onRelease event handler)
function clearInfo() {
    $('.upload-file-info #w').val('');
    $('.upload-file-info #h').val('');
};

function editUserInterestsValidation()
{
    var user_uuid_edit = $("#edit-user-interests-block").attr('data-attr'),
        user_gender_preference = $("#edit-input-select-gender-preference").val(),
        user_age_preference = $("input[name='age-preference']:checked").val();

    if (user_uuid_edit && user_gender_preference)
    {
        if (!user_age_preference && $("#before-adulthood"))
            user_age_preference = 1;

        var edit_user_interests = 'user_uuid=' + user_uuid_edit + '&user_gender_preference=' + user_gender_preference
                                    + '&user_age_preference=' + user_age_preference;

        $.ajax({
            url: "actions/edit-user-interests.php",
            type: 'POST',
            data: edit_user_interests,
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
                    $('.toast-body').html('Интересы успешно изменены');
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
    }else
    {
        $('.toast').addClass('toast-error');
        $('.toast').removeClass('toast-success');
        $('.toast-body').html('Системная ошибка!');
        $('.toast').toast('show');
    }

    return false;
}

function editUserDataValidation()
{
    var editCheck = 0;

    if (!$("#name-edit").val())
    {
        $("#name-edit").addClass('is-invalid');
        $("#name-edit-message").html('<span class="text-danger">Поле не заполнено!</span>');
        editCheck++;
    }else if ($("#name-edit").val() == 'null')
    {
        $("#name-edit").addClass('is-invalid');
        $("#name-edit-message").html('<span class="text-danger">Введено некорректное значение!</span>');
        editCheck++;
    }else {
        if (!(/^[А-яЁё\s]*$/i.test($("#name-edit").val())))
        {
            $("#name-edit").addClass('is-invalid');
            $("#name-edit-message").html('<span class="text-danger">Содержатся недопустимые символы!</span>');
            editCheck++;
        }else {
            $("#name-edit").removeClass('is-invalid');
            $("#name-edit").addClass('is-valid');

            setTimeout(function(){ $('#name-edit').removeClass('is-valid'); }, 5000)
            $("#name-edit-message").html('');
        }
    }

    if (!$("#surname-edit").val())
    {
        $("#surname-edit").addClass('is-invalid');
        $("#surname-edit-message").html('<span class="text-danger">Поле не заполнено!</span>');
        editCheck++;
    }else if ($("#surname-edit").val() == 'null')
    {
        $("#surname-edit").addClass('is-invalid');
        $("#surname-edit-message").html('<span class="text-danger">Введено некорректное значение!</span>');
        editCheck++;
    }else {
        if (!(/^[А-яЁё\s]*$/i.test($("#surname-edit").val())))
        {
            $("#surname-edit").addClass('is-invalid');
            $("#surname-edit-message").html('<span class="text-danger">Содержатся недопустимые символы!</span>');
            editCheck++;
        }else {
            $("#surname-edit").removeClass('is-invalid');
            $("#surname-edit").addClass('is-valid');

            setTimeout(function(){ $('#surname-edit').removeClass('is-valid'); }, 5000)
            $("#surname-edit-message").html('');
        }
    }

    if (!$("#date-born-edit").val())
    {
        $("#date-born-edit").addClass('is-invalid');
        $("#date-born-edit-message").html('<span class="text-danger">Поле не заполнено!</span>');
        editCheck++;
    }else{
        $("#date-born-edit").removeClass('is-invalid');
        $("#date-born-edit").addClass('is-valid');

        setTimeout(function(){ $('#date-born-edit').removeClass('is-valid'); }, 5000)
        $("#date-born-edit-message").html('');
    }

    var vk_link_val = $("#vk-edit").val(),
        inst_link_val = $("#inst-edit").val(),
        ok_link_val = $("#ok-edit").val();

    if (!vk_link_val.startsWith('https://vk.com/') && vk_link_val)
    {
        $("#vk-edit").addClass('is-invalid');
        $("#vk-edit-message").html('<span class="text-danger">Ссылка некорректа!</span>');
        editCheck++;
    }else{
        $("#vk-edit").removeClass('is-invalid');
        $("#vk-edit").addClass('is-valid');

        setTimeout(function(){ $('#vk-edit').removeClass('is-valid'); }, 5000)
        $("#vk-edit-message").html('');
    }

    if (!inst_link_val.startsWith('https://instagram.com/') && inst_link_val)
    {
        $("#inst-edit").addClass('is-invalid');
        $("#inst-edit-message").html('<span class="text-danger">Ссылка некорректа!</span>');
        editCheck++;
    }else{
        $("#inst-edit").removeClass('is-invalid');
        $("#inst-edit").addClass('is-valid');

        setTimeout(function(){ $('#inst-edit').removeClass('is-valid'); }, 5000)
        $("#inst-edit-message").html('');
    }

    if (!ok_link_val.startsWith('https://ok.ru/') && ok_link_val)
    {
        $("#ok-edit").addClass('is-invalid');
        $("#ok-edit-message").html('<span class="text-danger">Ссылка некорректа!</span>');
        editCheck++;
    }else{
        $("#ok-edit").removeClass('is-invalid');
        $("#ok-edit").addClass('is-valid');

        setTimeout(function(){ $('#ok-edit').removeClass('is-valid'); }, 5000)
        $("#ok-edit-message").html('');
    }

    if (editCheck == 0)
    {
        var user_uuid_edit = $("#edit-user-data-block").attr('data-attr'),
            user_name_edit = $("#name-edit").val(),
            user_surname_edit = $("#surname-edit").val(),
            user_date_born_edit = $("#date-born-edit").val(),
            user_country_edit = $("#edit-input-select-country").val(),
            user_city_edit = $("#edit-input-select-city").val(),
            user_vk_link_edit = vk_link_val.trim().replace('https://vk.com/', ''),
            user_inst_link_edit = inst_link_val.trim().replace('https://instagram.com/', ''),
            user_ok_link_edit = ok_link_val.trim().replace('https://ok.ru/', '');

        var edit_user_data = 'user_name=' + user_name_edit + '&user_surname=' + user_surname_edit 
                        + '&user_date_born=' + user_date_born_edit
                        + '&user_country=' + user_country_edit + '&user_city=' + user_city_edit
                        + '&vk_link=' + user_vk_link_edit + '&inst_link=' + user_inst_link_edit + '&ok_link=' + user_ok_link_edit
                        + '&user_uuid=' + user_uuid_edit;

        $.ajax({
            url: "actions/edit-user-data.php",
            type: 'POST',
            data: edit_user_data,
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
                    $('.toast-body').html('Данные успешно изменены');
                    $('.toast').toast('show');

                    $('.block-edit-user-interests').load(location.href + ' #interests-content');
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

function getCitiesListByCountry()
{
    selectedCountry = countriesList.value;
    selected_country_data = 'country=' + selectedCountry;

    citiesList.empty();

    $.ajax({
        url: "actions/get-cities-list-for-selected-country.php",
        type: 'POST',
        dataType: 'json',
        data: selected_country_data,
        success: function (data) {
            if (data != null)
            {
                for (var numResult = 0; numResult < data.length; numResult++)
                {
                    cities[numResult] = data[numResult];

                    if (cities[numResult][0] == userCity)
                    {
                        citiesList.append('<option value="'+cities[numResult][0]+'" selected>'+cities[numResult][1]+'</option>');
                    }else
                        citiesList.append('<option value="'+cities[numResult][0]+'">'+cities[numResult][1]+'</option>');
                }

                if (selectedCountry != 'Other')
                    citiesList.append('<option value="Other">Иной город</option>');
            }
        }
    });
}

function saveNewUserAvatar()
{
    var newAvatarImg = document.getElementById("user-avatar").src,
        saveBtn = document.getElementById("btn-save-new-avatar");

    if (newAvatarImg)
    {
        var new_avatar_data = 'user_uuid=' + userUuid + '&avatar_img=' + newAvatarImg;

        saveBtn.disabled = true;

        $.ajax({
            url: "actions/upload-cropped-avatar.php",
            type: 'POST',
            data: new_avatar_data,
            success: function (data) {
                switch (data) {
                    case 'success':
                            $('.toast').addClass('toast-success');
                            $('.toast').removeClass('toast-error');
                            $('.toast-body').html('Фотография успешно обновлена');
                            $('.toast').toast('show');
                            $("#edit-user-profile-group-btn").html(`<div class="col-12 m-0 p-2"><div class="error-upload-user-photo-text text-center">Для обновления фотографии профиля с момента последнего обновления должна пройти неделя</div></div>`);
                        break;

                    default:
                            $('.toast').addClass('toast-error');
                            $('.toast').removeClass('toast-success');
                            $('.toast-body').html('Системная ошибка!');
                            $('.toast').toast('show');
                            saveBtn.disabled = false;
                        break;
                }
            }
        });
    }
}

$(document).ready(function(e)
{
    $("#name-edit").on("keyup",function()
    {
        if (!$("#name-edit").val())
        {
            $("#name-edit").addClass('is-invalid');
            $("#name-edit").removeClass('is-valid');
            return false;
        }else{
            $("#name-edit").removeClass('is-invalid');
            $("#name-edit").addClass('is-valid');
            $("#name-edit-message").html('');
        }
    });

    $("#surname-edit").on("keyup",function()
    {
        if (!$("#surname-edit").val())
        {
            $("#surname-edit").addClass('is-invalid');
            $("#surname-edit").removeClass('is-valid');
            return false;
        }else{
            $("#surname-edit").removeClass('is-invalid');
            $("#surname-edit").addClass('is-valid');
            $("#surname-edit-message").html('');
        }
    });

    $("#date-born-edit").on("keyup",function()
    {
        if (!$("#date-born-edit").val())
        {
            $("#date-born-edit").addClass('is-invalid');
            $("#date-born-edit").removeClass('is-valid');
            $("#edit-gender-preference").css("margin-top", "25px");
            return false;
        }else{
            $("#date-born-edit").removeClass('is-invalid');
            $("#date-born-edit").addClass('is-valid');
            $("#date-born-edit-message").html('');
            $("#edit-gender-preference").css("margin-top", "0px");
        }
    });

    $.ajax({
        url: "actions/get-user-tags.php",
        type: 'POST',
        dataType: 'json',
        data: user_uuid_data,
        success: function (data) {
            if (data != null)
            {
                for (var numResult = 0; numResult < data.length; numResult++)
                {
                    tags[numResult] = data[numResult];
                    countTags();
                    createTag();
                }
            }
            
        }
    });

    // Заполнение массива тегов существующими тегами пользователя

    if (getTagsListFromUL(tagsList).length > 0)
    {
        tags = getTagsListFromUL(tagsList);
        countTags();
    }

    tagsInput.addEventListener("keyup", addTag);

    const removeTagsBtn = document.querySelector(".tags-block-details .btn-delete-tags");

    removeTagsBtn.addEventListener("click", () =>{
        tags.length = 0;
        tagsList.querySelectorAll("li").forEach(li => li.remove());
        countTags();
    });

    // Событие на изменение выбранного элемента в списке стран
    getCitiesListByCountry();

    $(countriesList).change(function () {
        getCitiesListByCountry();
    });

});

function getConfirmEmailCode()
{
    var user_email = $('#current-user-email').text();

    if (user_email)
    {
        var user_email_data = user_uuid_data + '&user_email=' + user_email;

        $.ajax({
            url: "actions/send-confirmation-code-to-email.php",
            type: 'POST',
            data: user_email_data,
            success: function (data) {
                if(data == 'error' || data == 'empty')
                {
                    $('.toast').addClass('toast-error');
                    $('.toast').removeClass('toast-success');
                    $('.toast-body').html('Системная ошибка!');
                    $('.toast').toast('show');
                }else
                {
                    $('.toast').addClass('toast-success');
                    $('.toast').removeClass('toast-error');
                    $('.toast-body').html('Код подтверждения отправлен на ваш email');
                    $('.toast').toast('show');

                    $('#email-verification-code-block').html('<hr class="hr-user-info"><div class="modal-body"><div class="form-group col-12 row m-0 p-0 mb-3"><div class="row m-0"><label class="font-weight-bold col-6 p-0 m-0 d-flex align-items-center">Код подтверждения</label><input type="text" id="email-verification-code-input" class="form-control col-6 input-field" autocomplete="off"><em class="text-center col-6"></em><em id="email-verification-code-message" class="text-center col-6"></em></div></div><input type="submit" class="btn btn-standard w-100 m-0" onclick="event.preventDefault();confirmEmail();" value="Подтвердить"</div>');
                    $('#have-email-verification-code').remove();
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
}

function showComfirmCodeBlock()
{
    $('#email-verification-code-block').html('<hr class="hr-user-info"><div class="modal-body"><div class="form-group col-12 row m-0 p-0 mb-3"><div class="row m-0"><label class="font-weight-bold col-6 p-0 m-0 d-flex align-items-center">Код подтверждения</label><input type="text" id="email-verification-code-input" class="form-control col-6 input-field" autocomplete="off"><em class="text-center col-6"></em><em id="email-verification-code-message" class="text-center col-6"></em></div></div><input type="submit" class="btn btn-standard w-100 m-0" onclick="event.preventDefault();confirmEmail();" value="Подтвердить"</div>');
    $('#have-email-verification-code').remove();
}

function confirmEmail()
{
    var confirmation_code = $('#email-verification-code-input').val(),
        user_email = $('#current-user-email').text();

    if (confirmation_code && user_email)
    {

        var user_email_confirm_data = user_uuid_data + '&user_email=' + user_email + '&confirmation_code=' + confirmation_code;

        $.ajax({
                url: "actions/confirm-email.php",
                type: 'POST',
                data: user_email_confirm_data,
                success: function (data) {
                    if (data == 'success') {
                        $('.toast').addClass('toast-success');
                        $('.toast').removeClass('toast-error');
                        $('.toast-body').html('Email подтверждён');
                        $('.toast').toast('show');

                        $('.block-edit-user-confirm-email').remove();
                    }else if (data == 'unequal') {
                        $('.toast').addClass('toast-error');
                        $('.toast').removeClass('toast-success');
                        $('.toast-body').html('Некорректный код!');
                        $('.toast').toast('show');
                    }else {
                        $('.toast').addClass('toast-error');
                        $('.toast').removeClass('toast-success');
                        $('.toast-body').html('Системная ошибка!');
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
}

function editUserNicknameValidation(user_uuid)
{
    var new_nickname = $('#new-nickname-edit').val();

    if (!new_nickname)
    {
      $("#new-nickname-edit").removeClass('is-valid');
      $("#new-nickname-edit").addClass('is-invalid');
      $("#new-nickname-edit-message").html("<span class='text-danger'>Поле не заполнено!</span>");
      return false;
    }else if (new_nickname == 'null')
    {
      $("#new-nickname-edit").removeClass('is-valid');
      $("#new-nickname-edit").addClass('is-invalid');
      $("#new-nickname-edit-message").html("<span class='text-danger'>Введено некорректное значение!</span>");
      return false;
    }

    if (new_nickname)
    {
      var user_new_nickname_data = 'user_uuid=' + user_uuid + '&user_nickname=' + new_nickname;

      $.ajax({
                url: "actions/edit-user-nickname.php",
                type: 'POST',
                data: user_new_nickname_data,
                success: function (data) {
                  switch (data)
                  {
                    case 'exists':
                      $("#new-nickname-edit").removeClass('is-valid');
                      $("#new-nickname-edit").addClass('is-invalid');
                      $("#new-nickname-edit-message").html("<span class='text-danger'>Это имя уже занято!</span>");
                    break;

                    case 'error':
                      $('.toast').addClass('toast-error');
                      $('.toast').removeClass('toast-success');
                      $('.toast-body').html('Системная ошибка!');
                      $('.toast').toast('show');
                    break;

                    case 'success':
                      $('#edit-user-nickname-text').html(new_nickname);
                      $('.toast').addClass('toast-success');
                      $('.toast').removeClass('toast-error');
                      $('.toast-body').html('Пользовательское имя изменено');
                      $('.toast').toast('show');

                      $('#editNicknameBlock').remove();
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
    }
      
    return false;
}

$("#new-nickname-edit").on("keypress", function(e) {
  var chars = /["a-zA-Z0-9\-\_]/,
      val = String.fromCharCode(e.which),
      checkInputCharacters = chars.test(val),
      maxCharacters = 19;
  
  if (!checkInputCharacters) 
  {
    $("#new-nickname-edit").removeClass('is-valid');
    $("#new-nickname-edit").addClass('is-invalid');
    $("#new-nickname-edit-message").html("<span class='text-danger'>Допустимые символы:<br>A-z, 0-9, дефис, нижнее подчёркивание</span>");
    return false;
  }else
  {
    $("#new-nickname-edit").removeClass('is-invalid');
    $("#new-nickname-edit").addClass('is-valid');
    $("#new-nickname-edit-message").html('');
  }

  if ($(this).val().length >= maxCharacters)
    $(this).val($(this).val().substr(0, maxCharacters));
});