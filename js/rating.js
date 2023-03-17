function addRating(current_author, current_receiver, current_photo) 
{
   var current_rating_mark = $('input[name=rating]:checked').val(),
       rating_all = 'author=' + current_author + '&receiver=' + current_receiver + '&photo=' + current_photo + '&mark=' + current_rating_mark,
       rateBtn = document.getElementById("rate-btn");

   rateBtn.disabled = true;
   rateBtn.innerHTML = '<svg id="loading-spinner" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 11-6.219-8.56"></path></svg>';

   $.ajax({
      url: "actions/rate-picture.php",
      type: 'POST',
      data: rating_all,
      success: function (data) {
        $.ajax({
          url: "includes/rating/rating-content-solo-card.php",
          type: 'POST',
          success: function (data) {
            $('#rating-photos-container').html(data);
            resizeSoloRatingCardBlock();
          },
          error: function () {
            $('#rating-photos-container').html('');
          }
        });
      },
      error: function () {
         $('.toast').addClass('toast-error');
         $('.toast').removeClass('toast-success');
         $('.toast-body').html('Системная ошибка!');
         $('.toast').toast('show');

         rateBtn.disabled = false;
         rateBtn.innerHTML = 'Оценить';
      }
   });
};

function skipRating(current_author, current_receiver, current_photo)
{
   var current_rating_mark = 7,
       rating_all = 'author=' + current_author + '&receiver=' + current_receiver + '&photo=' + current_photo + '&mark=' + current_rating_mark,
       skipBtn = document.getElementById("skip-rate-btn");

   skipBtn.disabled = true;
   skipBtn.innerHTML = '<svg id="loading-spinner" xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12a9 9 0 11-6.219-8.56"></path></svg>';

   $.ajax({
      url: "actions/rate-picture.php",
      type: 'POST',
      data: rating_all,
      success: function (data) {
        $.ajax({
          url: "includes/rating/rating-content-solo-card.php",
          type: 'POST',
          success: function (data) {
            $('#rating-photos-container').html(data);
            resizeSoloRatingCardBlock();
          },
          error: function () {
            $('#rating-photos-container').html('');
          }
        });
      },
      error: function () {
         $('.toast').addClass('toast-error');
         $('.toast').removeClass('toast-success');
         $('.toast-body').html('Системная ошибка!');
         $('.toast').toast('show');

         skipBtn.disabled = false;
         skipBtn.innerHTML = 'Пропустить';
      }
   });
};

function getActive() 
{
   document.getElementById('rate-btn').removeAttribute('disabled');
};


function resizeSoloRatingCardBlock() 
{
  var main = document.getElementById('main-rating-card-block').offsetHeight,
      menu = document.getElementById('rating-menu-block').offsetHeight;

  if (document.getElementById('solo-rating-card-block'))
  {
    document.getElementById('solo-rating-card-block').style.height = 'calc(' + main + 'px - ' + menu + 'px - 4rem)';

    if (document.getElementById('solo-rating-card-block').offsetHeight < 550)
      document.getElementById('solo-rating-card-block').style.height = '550px';
  }
};
    
window.onload = function() {
  switch (localStorage.getItem("rating-view")) {
    case 'solo':
      $('#rating-photos-view-solo-svg').addClass('active');
      $('#rating-photos-view-list-svg').removeClass('active');

      $.ajax({
        url: "includes/rating/rating-content-solo-card.php",
        type: 'POST',
        success: function (data) {
          $('#rating-photos-container').html(data);
          resizeSoloRatingCardBlock();
        },
        error: function () {
          $('#rating-photos-container').html('');
        }
      });
      break;

    case 'list':
      $('#rating-photos-view-list-svg').addClass('active');
      $('#rating-photos-view-solo-svg').removeClass('active');

      $.ajax({
        url: "includes/rating/rating-content-photo-list.php",
        type: 'POST',
        success: function (data) {
          $('#rating-photos-container').html(data);
        },
        error: function () {
          $('#rating-photos-container').html('');
        }
      });
      break;

    default:
      $('#rating-photos-view-solo-svg').addClass('active');
      $('#rating-photos-view-list-svg').removeClass('active');

      $.ajax({
        url: "includes/rating/rating-content-solo-card.php",
        type: 'POST',
        success: function (data) {
          $('#rating-photos-container').html(data);
          resizeSoloRatingCardBlock();
        },
        error: function () {
          $('#rating-photos-container').html('');
        }
      });
      break;
  };
};

window.onresize = function() {
  resizeSoloRatingCardBlock();
};

document.getElementById('rating-photos-view-solo').onclick = function(){
  $('#rating-photos-view-solo-svg').addClass('active');
  $('#rating-photos-view-list-svg').removeClass('active');

  $.ajax({
    url: "includes/rating/rating-content-solo-card.php",
    type: 'POST',
    success: function (data) {
      $('#rating-photos-container').html(data);
      resizeSoloRatingCardBlock();
    },
    error: function () {
      $('#rating-photos-container').html('');
    }
  });

  localStorage.setItem("rating-view", "solo");
};

document.getElementById('rating-photos-view-list').onclick = function(){
  $('#rating-photos-view-list-svg').addClass('active');
  $('#rating-photos-view-solo-svg').removeClass('active');

  $.ajax({
    url: "includes/rating/rating-content-photo-list.php",
    type: 'POST',
    success: function (data) {
      $('#rating-photos-container').html(data);
    },
    error: function () {
      $('#rating-photos-container').html('');
    }
  });

  localStorage.setItem("rating-view", "list");
};