var settingsMenuBtn = $('.user-header-menu-picture'),
    settingsMenu = $('.settings-menu'),
    mobileMenu = $('.mobile-menu-items'),
    mobileMenuCheckbox = $('#mobile-menu-checkbox');

$('.checkbox-menu').on("click", function() {
  if ($('.checkbox-menu').is(':checked')) {
    $('.mobile-menu-items').css('transform', 'translateX(0%)');
  }else {
    $('.mobile-menu-items').css('transform', 'translateX(-100%)');
  }
});

settingsMenuBtn.on("click", function() {
  if (settingsMenu.hasClass("settings-menu-height"))
    settingsMenu.removeClass("settings-menu-height");
  else
    settingsMenu.addClass("settings-menu-height");
});

// Закрытие окна по клику вне окна
$(document).click(function(e) {
  if (!settingsMenuBtn.is(e.target) && !settingsMenu.is(e.target) && settingsMenu.has(e.target).length === 0)
    settingsMenu.removeClass("settings-menu-height");

  if (!mobileMenuCheckbox.is(e.target) && !mobileMenu.is(e.target))
  {
    if (mobileMenuCheckbox.prop('checked'))
    {
      mobileMenuCheckbox.prop('checked', false);
      $('.mobile-menu-items').css('transform', 'translateX(-100%)');
    }
  }
});

switch (localStorage.getItem("theme")) {
  case 'darkness':
      $(document.body).removeClass();
      break;

    case 'dark-sapphire':
      $(document.body).removeClass();
      $(document.body).addClass("dark-sapphire-theme");
      break;

    case 'spotted':
      $(document.body).removeClass();
      $(document.body).addClass("spotted-theme");
      break;

    case 'ocean-depths':
      $(document.body).removeClass();
      $(document.body).addClass("ocean-depths-theme");
      break;

    case 'bahama-blue':
      $(document.body).removeClass();
      $(document.body).addClass("bahama-blue-theme");
      break;

    default:
      $(document.body).removeClass();
      localStorage.setItem("theme", "darkness");
      break;
}

function acceptCookies()
{
  $.ajax({
    url: "actions/accept-cookies.php",
    type: 'POST',
    success: function (data) {
      $('.cookie-container').remove();
    },
    error: function() {
      $('.toast').addClass('toast-error');
      $('.toast').removeClass('toast-success');
        $('.toast-body').html('Системная ошибка!');
          $('.toast').toast('show');
    }
  });
}

window.addEventListener('resize', (e) => {
  if (document.documentElement.clientWidth > 991)
  {
    if (mobileMenuCheckbox.prop('checked'))
    {
      mobileMenuCheckbox.prop('checked', false);
      $('.mobile-menu-items').css('transform', 'translateX(-100%)');
    }
  }
});

const headerSearchInput = document.querySelector("#header-search-input");

function searchTextFromHeaderSearchInput() {
  var searchText = headerSearchInput.value;
  var newUrl = 'search';

  if (searchText)
    newUrl = 'search?q=' + searchText;
  else
    newUrl = 'search';

  if (history.pushState) {      
    history.pushState(null, null, newUrl);
    window.location.reload();
  }

  return false;
}

if (headerSearchInput)
  headerSearchInput.addEventListener('keydown', function(e) {
    if (e.keyCode == 13)
      searchTextFromHeaderSearchInput();
});