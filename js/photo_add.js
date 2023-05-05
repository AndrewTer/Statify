let tagsList = document.querySelector(".tags-block-content ul"),
    tagsInput = document.querySelector(".tags-block-content input"),
    tagsNumb = document.querySelector(".tags-block-details span"),
    maxTags = 15,
    tags = [];

/* New Photo Upload */

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

function saveNewUserPhoto()
{
  var newPhotoImg = document.getElementById("new-user-photo").src,
      saveBtn = document.getElementById("btn-save-new-photo"),
      photoTagsList = '';

  if (newPhotoImg)
  {
    saveBtn.disabled = true;

    $("#new-tags-list li").each(function() {
      photoTagsList = photoTagsList + $(this).text() + ',';
    });

    photoTagsList = photoTagsList.substring(0, photoTagsList.length - 1);

    $.ajax({
      url: "actions/upload-new-user-photo.php",
      type: 'POST',
      data: {"new_photo": newPhotoImg, "tags_list": photoTagsList},
      success: function (data) {
        switch (data) {
          case 'success':
            $('.toast').addClass('toast-success');
            $('.toast').removeClass('toast-error');
            $('.toast-body').html('Фотография успешно загружена');
            $('.toast').toast('show');
            $("#block-upload-user-photo-input").html(`<div class="w-100 m-0 p-2"><div class="error-upload-user-photo-text text-center fz-16">Для добавления новой фотографии с момента последней загрузки должна пройти как минимум неделя</div></div>`);
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

function saveModifiedUserPhoto()
{
  var saveBtn = document.getElementById("btn-save-modified-photo"),
      photo_uuid = $("#img-edit").attr('data-img'),
      photoTagsList = '';

  if (photo_uuid)
  {
    $("#new-tags-list li").each(function() {
      photoTagsList = photoTagsList + $(this).text() + ',';
    });

    photoTagsList = photoTagsList.substring(0, photoTagsList.length - 1);

    $.ajax({
      url: "actions/edit-user-photo.php",
      type: 'POST',
      data: {"photo_uuid": photo_uuid, "tags_list": photoTagsList},
      success: function (data) {
        switch (data) {
          case 'success':
            $('.toast').addClass('toast-success');
            $('.toast').removeClass('toast-error');
            $('.toast-body').html('Фотография успешно изменена');
            $('.toast').toast('show');
            break;

          default:
            $('.toast').addClass('toast-error');
            $('.toast').removeClass('toast-success');
            $('.toast-body').html('Системная ошибка!');
            $('.toast').toast('show');
            break;
        }
      }
    });
  }
}

/* Tags */

$("#new-photo-tags-add").on("keypress", function(e) {
  var chars = /[А-яЁёA-z0-9\-\_\,\s]/,
      val = String.fromCharCode(e.which),
      checkInputCharacters = chars.test(val),
      maxCharacters = 30;
  
  if (!checkInputCharacters) 
    return false;

  if ($(this).val().length >= maxCharacters)
    $(this).val($(this).val().substr(0, maxCharacters));
});

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
    let liTag = `<li class="tags-field font-weight-bold d-flex flex-row align-items-center">
                  ${tag}
                  <svg viewBox="0 0 48 48" class="svg-close-icon pointer" onclick="remove(this, '${tag}')">
                    <rect width="48" height="48" fill="none"></rect>
                    <path d="M26.8,24,37.4,13.5a2.1,2.1,0,0,0,.2-2.7,1.9,1.9,0,0,0-3-.2L24,21.2,13.4,10.6a1.9,1.9,0,0,0-3,.2,2.1,2.1,0,0,0,.2,2.7L21.2,24,10.6,34.5a2.1,2.1,0,0,0-.2,2.7,1.9,1.9,0,0,0,3,.2L24,26.8,34.6,37.4a1.9,1.9,0,0,0,3-.2,2.1,2.1,0,0,0-.2-2.7Z"></path>
                  </svg>
                </li>`;
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
  if(e.key == "Enter")
  {
    let tag = e.target.value.replace(/\s+/g, ' ');
    if(tag.length > 1 && !tags.includes(tag)){
      if(tags.length < 15) {
        tag.split(',').forEach(tag => {
          tags.push(tag);
          createTag();
        });
      }
    }
    e.target.value = "";
  }
}

$(document).ready(function(e)
{
  if (tagsInput)
  {
    let photo_uuid = $("#img-edit").attr('data-img');

    $.ajax({
      url: "actions/get-current-photo-tags.php",
      type: 'POST',
      dataType: 'json',
      data: 'photo_uuid='+photo_uuid,
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

    // Заполнение массива тегов существующими тегами фотографии
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
  }
});