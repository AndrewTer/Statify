document.addEventListener("DOMContentLoaded", () => {
	showCurrentUserPhotosList();
});

$("#more-user-info").on("click", function (event) {
	showCurrentUserMoreInfo();
});

$("#user-profile-menu-photos").on("click", function (event) {
	showCurrentUserPhotosList();
});

$("#user-profile-menu-mobile-photos").on("click", function (event) {
	showCurrentUserPhotosList();
});

$("#general-values-photos-p").on("click", function (event) {
	showCurrentUserPhotosList();
});

$("#user-profile-menu-saves").on("click", function (event) {
	showCurrentUserSavesList();
});

$("#user-profile-menu-mobile-saves").on("click", function (event) {
	showCurrentUserSavesList();
});

$("#general-values-saves-p").on("click", function (event) {
	showCurrentUserSavesList();
});

$("#user-profile-menu-comments").on("click", function (event) {
	showCurrentUserCommentsList();
});

$("#user-profile-menu-mobile-comments").on("click", function (event) {
	showCurrentUserCommentsList();
});

$("#general-values-comments-p").on("click", function (event) {
	showCurrentUserCommentsList();
});

$("#user-profile-menu-statistics").on("click", function (event) {
	showCurrentUserStatisticsList();
});

$("#user-profile-menu-mobile-statistics").on("click", function (event) {
	showCurrentUserStatisticsList();
});

function showCurrentUserMoreInfo()
{
	var urlParams = new URLSearchParams(window.location.search);
	var userNickname = urlParams.get('u');

	var get_more_info = 'nickname=' + userNickname;

	$.ajax({
		url: "actions/open-more-user-info-modal.php",
		type: 'POST',
		data: get_more_info,
		success: function (data) {
			if (data)
			{
				if (data == 'error')
				{
					$('.toast').addClass('toast-error');
		      $('.toast').removeClass('toast-success');
		      $('.toast-body').html('Системная ошибка!');
		      $('.toast').toast('show');
				}else
				{
					$('.modal-container').html(data);
					$('#user-more-info-modal').modal('show');
				}
			}else
			{
				$('.toast').addClass('toast-error');
	      $('.toast').removeClass('toast-success');
	      $('.toast-body').html('Системная ошибка!');
	      $('.toast').toast('show');
			}
		},
		error: function() {
			$('.toast').addClass('toast-error');
      $('.toast').removeClass('toast-success');
      $('.toast-body').html('Системная ошибка!');
      $('.toast').toast('show');
		}
	});
}

function showCurrentUserPhotosList()
{
	var userProfileContent = $('#user-profile-content');
	var urlParams = new URLSearchParams(window.location.search);
	var userNickname = urlParams.get('u');

	var get_photos_all = 'nickname=' + userNickname;
		
	$.ajax({
		url: "actions/get-current-user-photos-list.php",
		type: 'POST',
		data: get_photos_all,
		beforeSend: function() {
			userProfileContent.html('<div class="w-100 m-0 p-5 d-flex justify-content-center align-items-center">'
															+ '<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="40px" height="40px" viewBox="0 0 128 128" xml:space="preserve"><g><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#000000"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#f8f8f8" transform="rotate(30 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#e8e8e8" transform="rotate(60 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#d4d4d4" transform="rotate(90 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#bebebe" transform="rotate(120 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#a6a6a6" transform="rotate(150 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#8e8e8e" transform="rotate(180 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#737373" transform="rotate(210 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#5a5a5a" transform="rotate(240 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#414141" transform="rotate(270 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#2a2a2a" transform="rotate(300 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#151515" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>'
															+ '</div>');
		},
		success: function (data) {
			userProfileContent.html(data);
		},
		error: function() {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      $('.toast-body').html('Системная ошибка!');
      $('.toast').toast('show');
		}
	});

	$('#user-profile-menu-statistics').removeClass('active');
	$('#user-profile-menu-mobile-statistics').removeClass('active');
	$('#user-profile-menu-photos').addClass('active');
	$('#user-profile-menu-mobile-photos').addClass('active');
	$('#user-profile-menu-saves').removeClass('active');
	$('#user-profile-menu-mobile-saves').removeClass('active');
	$('#user-profile-menu-comments').removeClass('active');
	$('#user-profile-menu-mobile-comments').removeClass('active');
}

function showCurrentUserSavesList()
{
	var userProfileContent = $('#user-profile-content');

	$.ajax({
		url: "actions/get-current-user-saves-list.php",
		type: 'POST',
		beforeSend: function() {
			userProfileContent.html('<div class="w-100 m-0 p-5 d-flex justify-content-center align-items-center">'
															+ '<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="40px" height="40px" viewBox="0 0 128 128" xml:space="preserve"><g><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#000000"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#f8f8f8" transform="rotate(30 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#e8e8e8" transform="rotate(60 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#d4d4d4" transform="rotate(90 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#bebebe" transform="rotate(120 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#a6a6a6" transform="rotate(150 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#8e8e8e" transform="rotate(180 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#737373" transform="rotate(210 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#5a5a5a" transform="rotate(240 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#414141" transform="rotate(270 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#2a2a2a" transform="rotate(300 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#151515" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>'
															+ '</div>');
		},
		success: function (data) {
			userProfileContent.html(data);
		},
		error: function() {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      $('.toast-body').html('Системная ошибка!');
      $('.toast').toast('show');
		}
	});

	$('#user-profile-menu-statistics').removeClass('active');
	$('#user-profile-menu-mobile-statistics').removeClass('active');
	$('#user-profile-menu-photos').removeClass('active');
	$('#user-profile-menu-mobile-photos').removeClass('active');
	$('#user-profile-menu-saves').addClass('active');
	$('#user-profile-menu-mobile-saves').addClass('active');
	$('#user-profile-menu-comments').removeClass('active');
	$('#user-profile-menu-mobile-comments').removeClass('active');
}

function showCurrentUserCommentsList()
{
	var userProfileContent = $('#user-profile-content');
	
	$.ajax({
		url: "actions/get-current-user-comments-list.php",
		type: 'POST',
		beforeSend: function() {
			userProfileContent.html('<div class="w-100 m-0 p-5 d-flex justify-content-center align-items-center">'
															+ '<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="40px" height="40px" viewBox="0 0 128 128" xml:space="preserve"><g><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#000000"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#f8f8f8" transform="rotate(30 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#e8e8e8" transform="rotate(60 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#d4d4d4" transform="rotate(90 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#bebebe" transform="rotate(120 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#a6a6a6" transform="rotate(150 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#8e8e8e" transform="rotate(180 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#737373" transform="rotate(210 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#5a5a5a" transform="rotate(240 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#414141" transform="rotate(270 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#2a2a2a" transform="rotate(300 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#151515" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>'
															+ '</div>');
		},
		success: function (data) {
			userProfileContent.html(data);
		},
		error: function() {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      $('.toast-body').html('Системная ошибка!');
      $('.toast').toast('show');
		}
	});

	$('#user-profile-menu-statistics').removeClass('active');
	$('#user-profile-menu-mobile-statistics').removeClass('active');
	$('#user-profile-menu-photos').removeClass('active');
	$('#user-profile-menu-mobile-photos').removeClass('active');
	$('#user-profile-menu-saves').removeClass('active');
	$('#user-profile-menu-mobile-saves').removeClass('active');
	$('#user-profile-menu-comments').addClass('active');
	$('#user-profile-menu-mobile-comments').addClass('active');
}

function showCurrentUserStatisticsList()
{
	var userProfileContent = $('#user-profile-content');
	var urlParams = new URLSearchParams(window.location.search);
	var userNickname = urlParams.get('u');

	var get_bio_all = 'nickname=' + userNickname;

	$.ajax({
		url: "actions/get-current-user-statistics.php",
		type: 'POST',
		data: get_bio_all,
			beforeSend: function() {
				userProfileContent.html('<div class="w-100 m-0 p-5 d-flex justify-content-center align-items-center">'
																+ '<svg width="40px" height="40px" viewBox="0 0 128 128"><g><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#000000"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#f8f8f8" transform="rotate(30 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#e8e8e8" transform="rotate(60 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#d4d4d4" transform="rotate(90 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#bebebe" transform="rotate(120 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#a6a6a6" transform="rotate(150 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#8e8e8e" transform="rotate(180 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#737373" transform="rotate(210 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#5a5a5a" transform="rotate(240 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#414141" transform="rotate(270 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#2a2a2a" transform="rotate(300 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#151515" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>'
																+ '</div>');
			},
			success: function (data) {
				userProfileContent.html(data);
			},
			error: function() {
				$('.toast').addClass('toast-error');
				$('.toast').removeClass('toast-success');
        $('.toast-body').html('Системная ошибка!');
        $('.toast').toast('show');
			}
	});

	$('#user-profile-menu-statistics').addClass('active');
	$('#user-profile-menu-mobile-statistics').addClass('active');
	$('#user-profile-menu-photos').removeClass('active');
	$('#user-profile-menu-mobile-photos').removeClass('active');
	$('#user-profile-menu-saves').removeClass('active');
	$('#user-profile-menu-mobile-saves').removeClass('active');
	$('#user-profile-menu-comments').removeClass('active');
	$('#user-profile-menu-mobile-comments').removeClass('active');
}

$("#del-friend-from-user-page-btn").on("click", function (event) {
	var el = document.getElementById('del-friend-from-user-page-btn'),
			user = el.dataset.u,
			friend = el.dataset.f,
			del_friend = 'user=' + user + '&friend=' + friend;

	$.ajax({
		url: "actions/del-friend.php",
		type: 'POST',
		data: del_friend,
		success: function (data) {
			location.reload();
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
			$('.toast-body').html('Системная ошибка!');
			$('.toast').toast('show');
		}
	});
});

$("#add-friend-from-user-page-btn").on("click", function (event) {
	var el = document.getElementById('add-friend-from-user-page-btn'),
			user = el.dataset.u,
			friend = el.dataset.f,
			add_friend = 'user=' + user + '&friend=' + friend;

	$.ajax({
		url: "actions/add-friend.php",
		type: 'POST',
		data: add_friend,
		success: function (data) {
			location.reload();
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
			$('.toast-body').html('Системная ошибка!');
			$('.toast').toast('show');
		}
	});
});

$("#add-friend-from-subscriber-from-user-page-btn").on("click", function (event) {
	var el = document.getElementById('add-friend-from-subscriber-from-user-page-btn'),
			user = el.dataset.u,
			friend = el.dataset.f,
			add_friend = 'user=' + user + '&friend=' + friend;

	$.ajax({
		url: "actions/add-friend-from-subscriber.php",
		type: 'POST',
		data: add_friend,
		success: function (data) {
			location.reload();
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
			$('.toast-body').html('Системная ошибка!');
			$('.toast').toast('show');
		}
	});
});

$("#del-subscribed-from-user-page-btn").on("click", function (event) {
	var el = document.getElementById('del-subscribed-from-user-page-btn'),
			subscriber = el.dataset.u,
			user = el.dataset.f,
			del_subscriber = 'subscriber=' + subscriber + '&user=' + user;

	$.ajax({
		url: "actions/del-subscribed.php",
		type: 'POST',
		data: del_subscriber,
		success: function (data) {
			location.reload();
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
			$('.toast-body').html('Системная ошибка!');
			$('.toast').toast('show');
		}
	});
});

$("#del-request-from-user-page-btn").on("click", function (event) {
	var el = document.getElementById('del-request-from-user-page-btn'),
			user = el.dataset.u,
			friend = el.dataset.f,
			del_request = 'user=' + user + '&friend=' + friend;

	$.ajax({
		url: "actions/del-request.php",
		type: 'POST',
		data: del_request,
		success: function (data) {
			location.reload();
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
			$('.toast-body').html('Системная ошибка!');
			$('.toast').toast('show');
		}
	});
});

$("#accept-request-from-user-page-btn").on("click", function (event) {
	var el = document.getElementById('user-profile-answer-request'),
			user = el.dataset.u,
			friend = el.dataset.f,
			add_friend = 'user=' + user + '&friend=' + friend;

	$.ajax({
		url: "actions/add-friend-from-request.php",
		type: 'POST',
		data: add_friend,
		success: function (data) {
			location.reload();
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
			$('.toast-body').html('Системная ошибка!');
			$('.toast').toast('show');
		}
	});
});

$("#deny-request-from-user-page-btn").on("click", function (event) {
	var el = document.getElementById('user-profile-answer-request'),
			user = el.dataset.u,
			subscriber = el.dataset.f,
			add_subscriber = 'user=' + user + '&subscriber=' + subscriber;

	$.ajax({
		url: "actions/add-subscriber-from-request.php",
		type: 'POST',
		data: add_subscriber,
		success: function (data) {
			location.reload();
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
			$('.toast-body').html('Системная ошибка!');
			$('.toast').toast('show');
		}
	});
});

const usersGeneralValuesSlider = document.querySelector('#block-general-values');
let isDown = false;
let startX;
let sLeft;
usersGeneralValuesSlider.scrollLeft = 0;

usersGeneralValuesSlider.addEventListener('mousedown', (e) => {
  isDown = true;
  startX = e.pageX;
  sLeft = usersGeneralValuesSlider.scrollLeft;
});

usersGeneralValuesSlider.addEventListener('mouseleave', () => {
  isDown = false;
});

usersGeneralValuesSlider.addEventListener('mouseup', () => {
  isDown = false;
});

usersGeneralValuesSlider.addEventListener('mousemove', (e) => {
  if(!isDown) return;
  e.preventDefault();
  const x = e.pageX;
  const dragged = x - startX;
  usersGeneralValuesSlider.scrollLeft = sLeft - dragged;
}); 