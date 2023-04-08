$('#view-all-top-ten-users').click(function() {
    if (!$(this).data('shown'))
    {
        $(this).text('Свернуть список');
        $(this).data('shown', true);
    }else {
        $(this).text('Показать всех');
        $(this).data('shown', false);
    }
});

function showMorePopularPhotosSortedByRating(current_user)
{
  var show_all = 'current_user=' + current_user;

  $.ajax({
    url: "actions/get-more-popular-photos-sorted-by-rating.php",
    type: 'POST',
    data: show_all,
    beforeSend: function() {
      $('#more-popular-photos-sorted-by-rating').html('<div class="m-0 p-3 d-flex justify-content-center align-items-center">'
                                          + '<svg width="35px" height="35px" viewBox="0 0 128 128"><g><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#000000"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#f8f8f8" transform="rotate(30 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#e8e8e8" transform="rotate(60 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#d4d4d4" transform="rotate(90 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#bebebe" transform="rotate(120 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#a6a6a6" transform="rotate(150 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#8e8e8e" transform="rotate(180 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#737373" transform="rotate(210 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#5a5a5a" transform="rotate(240 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#414141" transform="rotate(270 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#2a2a2a" transform="rotate(300 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#151515" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>'
                                          + '</div>');
    },
    success: function(result) {
      $('#more-popular-photos-sorted-by-rating').html(result);
      $('#show-more-popular-photos-sorted-by-rating').html('<h5 class="fz-15 m-0 p-0 font-weight-bold letter-spacing-05">По рейтингу</h5><p class="m-0 ml-auto mr-0 p-0 fz-14 news-popular-top-p" onclick="event.preventDefault();hideMorePopularPhotosSortedByRating(\'' + current_user +'\');">Скрыть</p>');
    }
  });
}

function hideMorePopularPhotosSortedByRating(current_user) 
{
  $('#more-popular-photos-sorted-by-rating').html('');
  $('#show-more-popular-photos-sorted-by-rating').html('<h5 class="fz-15 m-0 p-0 font-weight-bold letter-spacing-05">По рейтингу</h5><p class="m-0 ml-auto mr-0 p-0 fz-14 news-popular-top-p" onclick="event.preventDefault();showMorePopularPhotosSortedByRating(\'' + current_user + '\');">Топ 100</p>');
}

function showMorePopularPhotosSortedByNumberOfSaves(current_user)
{
  var show_all = 'current_user=' + current_user;

  $.ajax({
    url: "actions/get-more-popular-photos-sorted-by-number-of-saves.php",
    type: 'POST',
    data: show_all,
    beforeSend: function() {
      $('#more-popular-photos-sorted-by-number-of-saves').html('<div class="m-0 p-3 d-flex justify-content-center align-items-center">'
                                          + '<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="35px" height="35px" viewBox="0 0 128 128" xml:space="preserve"><g><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#000000"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#f8f8f8" transform="rotate(30 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#e8e8e8" transform="rotate(60 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#d4d4d4" transform="rotate(90 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#bebebe" transform="rotate(120 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#a6a6a6" transform="rotate(150 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#8e8e8e" transform="rotate(180 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#737373" transform="rotate(210 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#5a5a5a" transform="rotate(240 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#414141" transform="rotate(270 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#2a2a2a" transform="rotate(300 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#151515" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>'
                                          + '</div>');
    },
    success: function(result) {
      $('#more-popular-photos-sorted-by-number-of-saves').html(result);
      $('#show-more-popular-photos-sorted-by-number-of-saves').html('<h5 class="fz-15 m-0 p-0 font-weight-bold letter-spacing-05">Самые сохраняемые</h5><p class="m-0 ml-auto mr-0 p-0 fz-14 news-popular-top-p" onclick="event.preventDefault();hideMorePopularPhotosSortedByNumberOfSaves(\'' + current_user +'\');">Скрыть</p>');
    }
  });
}

function hideMorePopularPhotosSortedByNumberOfSaves(current_user) 
{
  $('#more-popular-photos-sorted-by-number-of-saves').html('');
  $('#show-more-popular-photos-sorted-by-number-of-saves').html('<h5 class="fz-15 m-0 p-0 font-weight-bold letter-spacing-05">Самые сохраняемые</h5><p class="m-0 ml-auto mr-0 p-0 fz-14 news-popular-top-p" onclick="event.preventDefault();showMorePopularPhotosSortedByNumberOfSaves(\'' + current_user + '\');">Топ 100</p>');
}

function showMorePopularPhotosSortedByNumberOfComments(current_user)
{
  var show_all = 'current_user=' + current_user;

  $.ajax({
    url: "actions/get-more-popular-photos-sorted-by-number-of-comments.php",
    type: 'POST',
    data: show_all,
    beforeSend: function() {
      $('#more-popular-photos-sorted-by-number-of-comments').html('<div class="m-0 p-3 d-flex justify-content-center align-items-center">'
                                          + '<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="35px" height="35px" viewBox="0 0 128 128" xml:space="preserve"><g><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#000000"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#f8f8f8" transform="rotate(30 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#e8e8e8" transform="rotate(60 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#d4d4d4" transform="rotate(90 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#bebebe" transform="rotate(120 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#a6a6a6" transform="rotate(150 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#8e8e8e" transform="rotate(180 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#737373" transform="rotate(210 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#5a5a5a" transform="rotate(240 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#414141" transform="rotate(270 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#2a2a2a" transform="rotate(300 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#151515" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>'
                                          + '</div>');
    },
    success: function(result) {
      $('#more-popular-photos-sorted-by-number-of-comments').html(result);
      $('#show-more-popular-photos-sorted-by-number-of-comments').html('<h5 class="fz-15 m-0 p-0 font-weight-bold letter-spacing-05">Самые комментируемые</h5><p class="m-0 ml-auto mr-0 p-0 fz-14 news-popular-top-p" onclick="event.preventDefault();hideMorePopularPhotosSortedByNumberOfComments(\'' + current_user +'\');">Скрыть</p>');
    }
  });
}

function hideMorePopularPhotosSortedByNumberOfComments(current_user) 
{
  $('#more-popular-photos-sorted-by-number-of-comments').html('');
  $('#show-more-popular-photos-sorted-by-number-of-comments').html('<h5 class="fz-15 m-0 p-0 font-weight-bold letter-spacing-05">Самые комментируемые</h5><p class="m-0 ml-auto mr-0 p-0 fz-14 news-popular-top-p" onclick="event.preventDefault();showMorePopularPhotosSortedByNumberOfComments(\'' + current_user + '\');">Топ 100</p>');
}



const newUsersSlider = document.querySelector('.new-users-slider');
let isDown = false;
let startX;
let sLeft;
newUsersSlider.scrollLeft = 0;

newUsersSlider.addEventListener('mousedown', (e) => {
  isDown = true;
  startX = e.pageX;
  sLeft = newUsersSlider.scrollLeft;
});

newUsersSlider.addEventListener('mouseleave', () => {
  isDown = false;
});

newUsersSlider.addEventListener('mouseup', () => {
  isDown = false;
});

newUsersSlider.addEventListener('mousemove', (e) => {
  if(!isDown) return;
  e.preventDefault();
  const x = e.pageX;
  const dragged = x - startX;
  newUsersSlider.scrollLeft = sLeft - dragged;
}); 

newUsersSlider.addEventListener("wheel", function (e) {
  let sliderElementWidth = document.querySelector('.slider-element').offsetWidth;

  if (e.deltaY > 0) 
    newUsersSlider.scrollLeft += sliderElementWidth;
  else 
    newUsersSlider.scrollLeft -= sliderElementWidth;
  });

$(document).ready(function() {
  $('.new-users-next-btn').click(function(event) {
    $('.new-users-prev-btn').show();
    event.preventDefault();
    $('.new-users-slider').animate({
      scrollLeft: "+=300px"
    }, "slow");
  });

  $('.new-users-prev-btn').click(function(event) {
    event.preventDefault();
    $('.new-users-slider').animate({
      scrollLeft: "-=300px"
    }, "slow");
  });
});

$('.new-users-slider').scroll(function() {
  if($(this).scrollLeft() == 0) {
    $('.new-users-prev-btn').addClass('disable');
    $('.new-users-next-btn').removeClass('disable');                       
  }else {
    $('.new-users-prev-btn').removeClass('disable'); 
    $('.new-users-next-btn').removeClass('disable');
  }

  if ($(this).scrollLeft() > $('.new-users-slider').width()) {
    $('.new-users-next-btn').addClass('disable');
    $('.new-users-prev-btn').removeClass('disable');
  }

  /*if ($(this).scrollLeft() < $('.new-users-slider').width()) {
    $('.new-users-next-btn').addClass('disable');
  }*/
}).scroll(); 