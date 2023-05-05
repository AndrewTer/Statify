const searchInput = document.querySelector("#search-users-field"),
			searchNotification = document.querySelector("#search-notification");

function searchUsers() {
	var searchText = searchInput.value;
	var baseUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
	var newUrl = baseUrl;

	if (searchText)
		newUrl = baseUrl + '?q=' + searchText;
	else
		newUrl = baseUrl;

	if (history.pushState) {	
    history.pushState(null, null, newUrl);
    window.location.reload();
  }

  return false;
}

if (searchInput)
	searchInput.addEventListener('keydown', function(e) {
		if (e.keyCode == 13)
			searchUsers();
});

$('#showmore-search-users-button').click(function () {
  var selector = '#block-search .block-search-result-content'; 
  var target = $(this);
  var page = target.attr('data-page');
  var pageMax = target.attr('data-max');
  var searchParameter = target.attr('data-p');
  var searchText = target.attr('data-q');
  page++;
 
  $.ajax({
    url: '?p=' + searchParameter + '&q=' + searchText + '&page=' + page,  
    dataType: 'html',
    success: function(data) {
      $(selector).append($(data).find(selector).html());
    }
  });
 
  target.attr('data-page', page);
  if (page ==  pageMax)
    target.hide();
 
  return false;
});


$('#showmore-search-tags-button').click(function () {
  var selector = '#block-search-all-photos-by-tag .user-photo-cards-list'; 
  var target = $(this);
  var page = target.attr('data-page');
  var pageMax = target.attr('data-max');
  var searchParameter = target.attr('data-p');
  var searchText = target.attr('data-q');
  page++;
 
  $.ajax({
    url: '?p=' + searchParameter + '&q=' + searchText + '&page=' + page,  
    dataType: 'html',
    success: function(data) {
      $(selector).append($(data).find(selector).html());
    }
  });
 
  target.attr('data-page', page);
  if (page ==  pageMax)
    target.hide();
 
  return false;
});