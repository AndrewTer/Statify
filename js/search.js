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