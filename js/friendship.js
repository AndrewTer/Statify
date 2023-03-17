function delFriendFromFriendsList(del_user, del_friend, del_list)
{
	var del_all = 'user=' + del_user + '&friend=' + del_friend;

	$.ajax({
		url: "actions/del-friend.php",
		type: 'POST',
		data: del_all,
		success: function (data) {
			switch(del_list) {
				case 'all':
					$("#block-friends").load('friends?sort=all-friends #block-friend');
				break;

				case 'online':
					$("#block-friends").load('friends?sort=online #block-online');
				break;

				default:
					$("#block-friends").load('friends?sort=all-friends #block-friend');
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

function addFriendFromSubscriberList(add_user, add_friend)
{
	var add_all = 'user=' + add_user + '&friend=' + add_friend;

	$.ajax({
		url: "actions/add-friend-from-subscriber.php",
		type: 'POST',
		data: add_all,
		success: function (data) {
			$("#block-friends").load('friends?sort=subscribers #block-subscriber');
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function delSubscribedFromSubscriptionsList(del_subscriber, del_user)
{
	var del_all = 'subscriber=' + del_subscriber + '&user=' + del_user;

	$.ajax({
		url: "actions/del-subscribed.php",
		type: 'POST',
		data: del_all,
		success: function (data) {
			$("#block-friends").load('friends?sort=subscriptions #block-subscriber');
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function addFriendFromRequestList(add_user, add_friend)
{
	var add_all = 'user=' + add_user + '&friend=' + add_friend;

	$.ajax({
		url: "actions/add-friend-from-request.php",
		type: 'POST',
		data: add_all,
		success: function (data) {
			$("#block-friends").load('friends?sort=received #block-received');
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function addSubscriberFromRequestList(add_user, add_subscriber)
{
	var add_all = 'user=' + add_user + '&subscriber=' + add_subscriber;

	$.ajax({
		url: "actions/add-subscriber-from-request.php",
		type: 'POST',
		data: add_all,
		success: function (data) {
			$("#block-friends").load('friends?sort=received #block-received');
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function delRequestFromRequestList(del_user, del_request)
{
	var del_all = 'user=' + del_user + '&friend=' + del_request;

	$.ajax({
		url: "actions/del-request.php",
		type: 'POST',
		data: del_all,
		success: function (data) {
			$("#block-friends").load('friends?sort=submitted #block-submitted');
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function addFriendFromSearchList(add_user, add_friend, hash)
{
	var add_all = 'user=' + add_user + '&friend=' + add_friend,
		hash_add = hash;

	$.ajax({
		url: "actions/add-friend.php",
		type: 'POST',
		data: add_all,
		success: function (data) {
			$("#search-block-" + hash_add).load(location.href + " #search-block-content-" + hash_add);
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function addFriendFromSubscriberFromSearchList(add_user, add_friend, hash)
{
	var add_all = 'user=' + add_user + '&friend=' + add_friend,
		hash_add = hash;

	$.ajax({
		url: "actions/add-friend-from-subscriber.php",
		type: 'POST',
		data: add_all,
		success: function (data) {
			$("#search-block-" + hash_add).load(location.href + " #search-block-content-" + hash_add);
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function delFriendFromSearchList(del_user, del_friend, hash)
{
	var del_all = 'user=' + del_user + '&friend=' + del_friend,
		hash_del = hash;

	$.ajax({
		url: "actions/del-friend.php",
		type: 'POST',
		data: del_all,
		success: function (data) {
			$("#search-block-" + hash_del).load(location.href + " #search-block-content-" + hash_del);
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function delRequestFromSearchList(del_user, del_request, hash)
{
	var del_all = 'user=' + del_user + '&friend=' + del_request,
		hash_del = hash;

	$.ajax({
		url: "actions/del-request.php",
		type: 'POST',
		data: del_all,
		success: function (data) {
			$("#search-block-" + hash_del).load(location.href + " #search-block-content-" + hash_del);
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function delSubscribedFromSearchList(del_subscriber, del_user, hash)
{
	var del_all = 'subscriber=' + del_subscriber + '&user=' + del_user,
		hash_del = hash;

	$.ajax({
		url: "actions/del-subscribed.php",
		type: 'POST',
		data: del_all,
		success: function (data) {
			$("#search-block-" + hash_del).load(location.href + " #search-block-content-" + hash_del);
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function acceptFriendRequestFromSearchList(add_user, add_friend, hash)
{
	var add_all = 'user=' + add_user + '&friend=' + add_friend,
		hash_add = hash;

	$.ajax({
		url: "actions/add-friend-from-request.php",
		type: 'POST',
		data: add_all,
		success: function (data) {
			$("#search-block-" + hash_add).load(location.href + " #search-block-content-" + hash_add);
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function declineFriendRequestFromSearchList(add_user, add_subscriber, hash)
{
	var add_all = 'user=' + add_user + '&subscriber=' + add_subscriber,
		hash_add = hash;

	$.ajax({
		url: "actions/add-subscriber-from-request.php",
		type: 'POST',
		data: add_all,
		success: function (data) {
			$("#search-block-" + hash_add).load(location.href + " #search-block-content-" + hash_add);
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function addFriendFromComments(add_user, add_friend)
{
	var add_all = 'user=' + add_user + '&friend=' + add_friend;

	$.ajax({
		url: "actions/add-friend.php",
		type: 'POST',
		data: add_all,
		success: function (data) {
			$("#user-menu-block").load(location.href + " #user-menu");
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function delFriendFromComments(del_user, del_friend)
{
	var del_all = 'user=' + del_user + '&friend=' + del_friend;

	$.ajax({
		url: "actions/del-friend.php",
		type: 'POST',
		data: del_all,
		success: function (data) {
			$("#user-menu-block").load(location.href + " #user-menu");
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function delRequestFromComments(del_user, del_request)
{
	var del_all = 'user=' + del_user + '&friend=' + del_request;

	$.ajax({
		url: "actions/del-request.php",
		type: 'POST',
		data: del_all,
		success: function (data) {
			$("#user-menu-block").load(location.href + " #user-menu");
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function acceptFriendRequestFromComments(add_user, add_friend)
{
	var add_all = 'user=' + add_user + '&friend=' + add_friend;

	$.ajax({
		url: "actions/add-friend-from-request.php",
		type: 'POST',
		data: add_all,
		success: function (data) {
			$("#user-menu-block").load(location.href + " #user-menu");
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function declineFriendRequestFromComments(add_user, add_subscriber)
{
	var add_all = 'user=' + add_user + '&subscriber=' + add_subscriber;

	$.ajax({
		url: "actions/add-subscriber-from-request.php",
		type: 'POST',
		data: add_all,
		success: function (data) {
			$("#user-menu-block").load(location.href + " #user-menu");
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function addFriendFromSubscriberFromComments(add_user, add_friend)
{
	var add_all = 'user=' + add_user + '&friend=' + add_friend;

	$.ajax({
		url: "actions/add-friend-from-subscriber.php",
		type: 'POST',
		data: add_all,
		success: function (data) {
			$("#user-menu-block").load(location.href + " #user-menu");
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}

function delSubscribedFromComments(del_subscriber, del_user)
{
	var del_all = 'subscriber=' + del_subscriber + '&user=' + del_user;

	$.ajax({
		url: "actions/del-subscribed.php",
		type: 'POST',
		data: del_all,
		success: function (data) {
			$("#user-menu-block").load(location.href + " #user-menu");
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      		$('.toast-body').html('Системная ошибка!');
      		$('.toast').toast('show');
		}
	});
}