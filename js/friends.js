function checkEmpty(str){
    return !str || !/[^\s]+/.test(str);
}

function searchFriend() {
	var input = document.getElementById("friendlist-search");
	var filter = input.value.toUpperCase();

	var ul = document.getElementById("block-friend");
	var li = ul.getElementsByClassName("user-card");

	for (var i = 0; i < li.length; i++)
	{
		if (!checkEmpty(filter))
		{
			var a = li[i].getElementsByClassName("search-content")[0];

			if (a.innerHTML.toUpperCase().indexOf(filter) > -1)
			{
				li[i].style.display = "";
			}else {
				li[i].style.display = "none";
			}
		}else
			li[i].style.display = "";
	}
}

function searchOnlineFriend() {
	var input = document.getElementById("onlinelist-search");
	var filter = input.value.toUpperCase();

	var ul = document.getElementById("block-online");
	var li = ul.getElementsByClassName("user-card");

	for (var i = 0; i < li.length; i++)
	{
		if (!checkEmpty(filter))
		{
			var a = li[i].getElementsByClassName("search-content")[0];

			if (a.innerHTML.toUpperCase().indexOf(filter) > -1)
			{
				li[i].style.display = "";
			}else {
				li[i].style.display = "none";
			}
		}else
			li[i].style.display = "";
	}
}

function searchSubscriber() {
	var input = document.getElementById("subscriberslist-search");
	var filter = input.value.toUpperCase();

	var ul = document.getElementById("block-subscriber");
	var li = ul.getElementsByClassName("user-card");

	for (var i = 0; i < li.length; i++)
	{
		if (!checkEmpty(filter))
		{
			var a = li[i].getElementsByClassName("search-content")[0];

			if (a.innerHTML.toUpperCase().indexOf(filter) > -1)
			{
				li[i].style.display = "";
			}else {
				li[i].style.display = "none";
			}
		}else
			li[i].style.display = "";
	}
}

$("#friendlist-search").keyup(function() {
	searchFriend();
});

$("#onlinelist-search").keyup(function() {
	searchOnlineFriend();
});

$("#subscriberslist-search").keyup(function() {
	searchSubscriber();
});