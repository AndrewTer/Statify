var windowWidth = window.innerWidth;

if (windowWidth <= 490)
{
	$(".card-user-info").removeClass("d-flex flex-row w-100 m-0 p-0 justify-content-center");
}

$(window).resize(function() {
	windowWidth = window.innerWidth;

	if (windowWidth <= 490)
	{
		$(".card-user-info").removeClass("d-flex flex-row w-100 m-0 p-0 justify-content-center");
	}else {
		$(".card-user-info").removeClass("d-flex flex-row w-100 m-0 p-0 justify-content-center").addClass("d-flex flex-row w-100 m-0 p-0 justify-content-center");
	}
});

$(function () {
	$('[data-toggle="tooltip"]').tooltip()
});

function displayPhotoStatistics()
{
	let displayCheck = document.getElementById('photo-statistics');

	if (displayCheck.classList.contains('--show'))
	{
		displayCheck.classList.remove('--show');
		displayCheck.classList.add('--hide');
	}else
	{
		displayCheck.classList.add('--show');
		displayCheck.classList.remove('--hide');
	}
}

function displayBlockSetRating()
{
	let mainFooter = document.getElementById('footer-modal'),
		ratingFooter = document.getElementById('footer-for-rating');

	mainFooter.classList.remove('--show');
	mainFooter.classList.add('--hide');
	ratingFooter.classList.remove('--hide');
	ratingFooter.classList.add('--show');
}

function displayPhotoMenuBlock()
{
	let mainFooter = document.getElementById('footer-modal'),
		ratingFooter = document.getElementById('footer-for-rating');

	mainFooter.classList.add('--show');
	mainFooter.classList.remove('--hide');
	ratingFooter.classList.add('--hide');
	ratingFooter.classList.remove('--show');
}

function changeUserAvatar(current_photo)
{
	var change_user_avatar = 'current_photo=' + current_photo;

	$.ajax({
      url: "actions/change-user-avatar.php",
      type: 'POST',
      data: change_user_avatar,
      success: function (data) {
      	if (data)
      	{
      		if (data == 'error')
      		{
      			$('.toast').addClass('toast-error');
			      $('.toast').removeClass('toast-success');
			      $('.toast-body').html('Системная ошибка!');
			      $('.toast').toast('show');
      		}else {
      			location.reload();
      		}
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

function addRatingOnPhoto(current_author, current_receiver, current_photo)
{
   var current_rating_mark = $('input[name=rating]:checked').val(),
       rating_all = 'author=' + current_author + '&receiver=' + current_receiver + '&photo=' + current_photo + '&mark=' + current_rating_mark;

   let mainFooter = document.getElementById('footer-modal'),
       ratingFooter = document.getElementById('footer-for-rating');

   $.ajax({
      url: "actions/rate-picture.php",
      type: 'POST',
      data: rating_all,
      success: function (data) {
      	if (data)
			{
				switch (data) {
					case 'empty':
						displayPhotoMenuBlock();
						break;

					default:
						mainFooter.classList.add('--show');
			         mainFooter.classList.remove('--hide');
			         ratingFooter.classList.add('--hide');
			         ratingFooter.classList.remove('--show');

			         let content_stars = '';

			         for (let stars_count = 0; stars_count < 5; stars_count++)
						{
							if (stars_count <= data - 1)
							{
								content_stars += '<p class="m-0 p-0"><svg class="active-star" width="25px" height="25px" viewBox="0 0 24 24" fill="none"><path d="M17.2 20.7501C17.0776 20.7499 16.9573 20.7189 16.85 20.6601L12 18.1101L7.14999 20.6601C7.02675 20.7262 6.88746 20.7566 6.74786 20.7478C6.60825 20.7389 6.47391 20.6912 6.35999 20.6101C6.24625 20.5267 6.15796 20.4133 6.10497 20.2826C6.05199 20.1519 6.03642 20.0091 6.05999 19.8701L6.99999 14.4701L3.05999 10.6501C2.96124 10.5512 2.89207 10.4268 2.86027 10.2907C2.82846 10.1547 2.83529 10.0124 2.87999 9.88005C2.92186 9.74719 3.00038 9.62884 3.10652 9.53862C3.21266 9.4484 3.34211 9.38997 3.47999 9.37005L8.89999 8.58005L11.33 3.67005C11.3991 3.55403 11.4973 3.45795 11.6147 3.39123C11.7322 3.32451 11.8649 3.28943 12 3.28943C12.1351 3.28943 12.2678 3.32451 12.3853 3.39123C12.5027 3.45795 12.6008 3.55403 12.67 3.67005L15.1 8.58005L20.52 9.37005C20.6579 9.38997 20.7873 9.4484 20.8935 9.53862C20.9996 9.62884 21.0781 9.74719 21.12 9.88005C21.1647 10.0124 21.1715 10.1547 21.1397 10.2907C21.1079 10.4268 21.0387 10.5512 20.94 10.6501L17 14.4701L17.93 19.8701C17.9536 20.0091 17.938 20.1519 17.885 20.2826C17.832 20.4133 17.7437 20.5267 17.63 20.6101C17.5034 20.6976 17.3539 20.7463 17.2 20.7501ZM12 16.5201C12.121 16.5215 12.2403 16.5488 12.35 16.6001L16.2 18.6001L15.47 14.3101C15.4502 14.1897 15.4589 14.0664 15.4953 13.9501C15.5318 13.8337 15.595 13.7275 15.68 13.6401L18.8 10.6401L14.49 10.0001C14.3708 9.98109 14.2578 9.93401 14.1605 9.86271C14.0631 9.79141 13.9841 9.69795 13.93 9.59005L12 5.69005L10.07 9.60005C10.0159 9.70795 9.9369 9.80141 9.83952 9.87271C9.74214 9.94401 9.62918 9.99109 9.50999 10.0101L5.19999 10.6401L8.31999 13.6401C8.40493 13.7275 8.46817 13.8337 8.50464 13.9501C8.54111 14.0664 8.54979 14.1897 8.52999 14.3101L7.79999 18.6301L11.65 16.6301C11.7573 16.5683 11.8767 16.5308 12 16.5201Z"></path></svg></p>';
							}else
							{
								content_stars += '<p class="m-0 p-0"><svg class="inactive-star" width="25px" height="25px" viewBox="0 0 24 24" fill="none"><path d="M17.2 20.7501C17.0776 20.7499 16.9573 20.7189 16.85 20.6601L12 18.1101L7.14999 20.6601C7.02675 20.7262 6.88746 20.7566 6.74786 20.7478C6.60825 20.7389 6.47391 20.6912 6.35999 20.6101C6.24625 20.5267 6.15796 20.4133 6.10497 20.2826C6.05199 20.1519 6.03642 20.0091 6.05999 19.8701L6.99999 14.4701L3.05999 10.6501C2.96124 10.5512 2.89207 10.4268 2.86027 10.2907C2.82846 10.1547 2.83529 10.0124 2.87999 9.88005C2.92186 9.74719 3.00038 9.62884 3.10652 9.53862C3.21266 9.4484 3.34211 9.38997 3.47999 9.37005L8.89999 8.58005L11.33 3.67005C11.3991 3.55403 11.4973 3.45795 11.6147 3.39123C11.7322 3.32451 11.8649 3.28943 12 3.28943C12.1351 3.28943 12.2678 3.32451 12.3853 3.39123C12.5027 3.45795 12.6008 3.55403 12.67 3.67005L15.1 8.58005L20.52 9.37005C20.6579 9.38997 20.7873 9.4484 20.8935 9.53862C20.9996 9.62884 21.0781 9.74719 21.12 9.88005C21.1647 10.0124 21.1715 10.1547 21.1397 10.2907C21.1079 10.4268 21.0387 10.5512 20.94 10.6501L17 14.4701L17.93 19.8701C17.9536 20.0091 17.938 20.1519 17.885 20.2826C17.832 20.4133 17.7437 20.5267 17.63 20.6101C17.5034 20.6976 17.3539 20.7463 17.2 20.7501ZM12 16.5201C12.121 16.5215 12.2403 16.5488 12.35 16.6001L16.2 18.6001L15.47 14.3101C15.4502 14.1897 15.4589 14.0664 15.4953 13.9501C15.5318 13.8337 15.595 13.7275 15.68 13.6401L18.8 10.6401L14.49 10.0001C14.3708 9.98109 14.2578 9.93401 14.1605 9.86271C14.0631 9.79141 13.9841 9.69795 13.93 9.59005L12 5.69005L10.07 9.60005C10.0159 9.70795 9.9369 9.80141 9.83952 9.87271C9.74214 9.94401 9.62918 9.99109 9.50999 10.0101L5.19999 10.6401L8.31999 13.6401C8.40493 13.7275 8.46817 13.8337 8.50464 13.9501C8.54111 14.0664 8.54979 14.1897 8.52999 14.3101L7.79999 18.6301L11.65 16.6301C11.7573 16.5683 11.8767 16.5308 12 16.5201Z"></path></svg></p>';
							}
						}

			         $('#rating-result').html(content_stars);
			         $('#rating-result').addClass('no-hover');
	         		break;
				}
      	}else
      	{
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

function savePicture(author, user, picture)
{
	var save_all = 'author=' + author + '&user=' + user + '&picture=' + picture;

	$.ajax({
		url: "actions/save-picture.php",
		type: 'POST',
		data: save_all,
		success: function (data) {
			var savephoto = document.getElementById('savephoto');

			savephoto.innerHTML = `
				<a class="nav-link p-0 text-center d-flex flex-row justify-content-center align-items-center bubbly-button" 
					style="border: none;" 
					onclick="event.preventDefault();unsavePicture('`+author+`', '`+user+`', '`+picture+`');">
					<p class="m-0 p-0">
						<svg width="22px" height="22px" viewBox="0 0 24 24" fill="none">
							<path d="M5.5 1C4.39543 1 3.5 1.89543 3.5 3V22C3.5 22.3612 3.6948 22.6944 4.00961 22.8715C4.32441 23.0486 4.71028 23.0422 5.01903 22.8548L12 18.6157L18.981 22.8548C19.2897 23.0422 19.6756 23.0486 19.9904 22.8715C20.3052 22.6944 20.5 22.3612 20.5 22V3C20.5 1.89543 19.6046 1 18.5 1H5.5Z" fill="var(--save-icon-color)"></path>
						</svg>
					</p>
		    </a>`;

			$(".bubbly-button").each(function() {
				$(this).removeClass('animate');
			  	$(this).addClass('animate');

			  	setTimeout(function(){
			    $(this).removeClass('animate');
			  	},700);
			});
		},
		error: function() {
			$('.toast').addClass('toast-error');
         $('.toast').removeClass('toast-success');
         $('.toast-body').html('Системная ошибка!');
         $('.toast').toast('show');
		}
	});
}

function unsavePicture(author, user, picture)
{
	var save_all = 'author=' + author + '&user=' + user + '&picture=' + picture;

	$.ajax({
		url: "actions/unsave-picture.php",
		type: 'POST',
		data: save_all,
		success: function (data) {
			var unsavephoto = document.getElementById('savephoto');

			unsavephoto.innerHTML = `
				<a class="nav-link p-0 text-center d-flex flex-row justify-content-center align-items-center" 
					style="border: none;" 
					onclick="event.preventDefault();savePicture('`+author+`', '`+user+`', '`+picture+`');">
		    	<p class="m-0 p-0">
						<svg width="22px" height="22px" viewBox="0 0 24 24" fill="none">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M3.5 3C3.5 1.89543 4.39543 1 5.5 1H18.5C19.6046 1 20.5 1.89543 20.5 3V22C20.5 22.3612 20.3052 22.6944 19.9904 22.8715C19.6756 23.0486 19.2897 23.0422 18.981 22.8548L12 18.6157L5.01903 22.8548C4.71028 23.0422 4.32441 23.0486 4.00961 22.8715C3.6948 22.6944 3.5 22.3612 3.5 22V3ZM18.5 3L5.5 3V20.2228L11.481 16.591C11.7999 16.3974 12.2001 16.3974 12.519 16.591L18.5 20.2228V3Z" fill="var(--main-text-color)"></path>
						</svg>
					</p>
		    </a>`;
		},
		error: function() {
			$('.toast').addClass('toast-error');
         $('.toast').removeClass('toast-success');
         $('.toast-body').html('Системная ошибка!');
         $('.toast').toast('show');
		}
	});
}

function sendComplaintOnUser(identifier)
{
	var complaint_author = $(identifier).data('complaintauthor'),
		 complaint_receiver = $(identifier).data('complaintreceiver'),
		 complaint_reason = document.querySelector('input[name="complaintReasons"]:checked').value,
		 complaint_comment = $('textarea[name="commentOnComplaint"]').val(),
		 send_all = 'author=' + complaint_author + '&receiver=' + complaint_receiver + '&reason=' + complaint_reason + '&comment=' + complaint_comment;

	$.ajax({
		url: "actions/send-complaint-on-user.php",
		type: 'POST',
		data: send_all,
		success: function (data) {
			if (data)
			{
				switch (data) {
					case 'success':
						$('.toast').addClass('toast-success');
			         $('.toast').removeClass('toast-error');
			         $('.toast-body').html('Жалоба успешно отправлена');
			         $('.toast').toast('show');
						break;

					case 'error':
						$('.toast').addClass('toast-error');
			         $('.toast').removeClass('toast-success');
			         $('.toast-body').html('Системная ошибка!');
			         $('.toast').toast('show');
						break;

					default:
						$('.toast').addClass('toast-error');
			         $('.toast').removeClass('toast-success');
			         $('.toast-body').html('Системная ошибка!');
			         $('.toast').toast('show');
	         		break;
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

function sendComplaintOnComment(identifier)
{
	var complaint_author = $(identifier).data('complaintauthor'),
		 complaint_receiver = $(identifier).data('complaintreceiver'),
		 complaint_on_comment = $(identifier).data('complaintoncomment'),
		 complaint_reason = document.querySelector('input[name="complaintReasons"]:checked').value,
		 complaint_comment = $('textarea[name="commentOnComplaint"]').val(),
		 send_all = 'author=' + complaint_author + '&receiver=' + complaint_receiver + '&comment_uuid=' + complaint_on_comment + '&reason=' + complaint_reason + '&comment=' + complaint_comment;

	$.ajax({
		url: "actions/send-complaint-on-comment.php",
		type: 'POST',
		data: send_all,
		success: function (data) {
			if (data)
			{
				switch (data) {
					case 'success':
						$('.toast').addClass('toast-success');
			         $('.toast').removeClass('toast-error');
			         $('.toast-body').html('Жалоба успешно отправлена');
			         $('.toast').toast('show');
						break;

					case 'error':
						$('.toast').addClass('toast-error');
			         $('.toast').removeClass('toast-success');
			         $('.toast-body').html('Системная ошибка!');
			         $('.toast').toast('show');
						break;

					default:
						$('.toast').addClass('toast-error');
			         $('.toast').removeClass('toast-success');
			         $('.toast-body').html('Системная ошибка!');
			         $('.toast').toast('show');
	         		break;
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

function openReportUserModal(current_user, user)
{
	var modal_all = 'current_user=' + current_user + '&user=' + user;

	$.ajax({
		url: "actions/open-report-user-modal.php",
		type: 'POST',
		data: modal_all,
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
					$('#ucm').modal('show');
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

function openReportCommentModal(current_user, comment_user, comment)
{
	var modal_all = 'current_user=' + current_user + '&comment_user=' + comment_user + '&comment=' + comment;

	$.ajax({
		url: "actions/open-report-comment-modal.php",
		type: 'POST',
		data: modal_all,
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
					$('#ucm').modal('show');
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

function openProfilePictureModal(current_user, user, photo, type)
{
	var modal_all = 'current_user=' + current_user + '&user=' + user + '&photo=' + photo + '&type=' + type;

	$.ajax({
		url: "actions/open-profile-picture-modal.php",
		type: 'POST',
		data: modal_all,
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
					$('#ppm').modal('show');
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

function openMutualFriendsModal(current_user, another_user)
{
	var modal_all = 'current_user=' + current_user + '&another_user=' + another_user;

	$.ajax({
		url: "actions/open-mutual-friends-modal.php",
		type: 'POST',
		data: modal_all,
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
					$('#mutualFriendsListModal').modal('show');
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

function openRecoveryPasswordModal()
{
	$.ajax({
		url: "actions/open-recovery-password-modal.php",
		type: 'POST',
		success: function(data) {
			$('.modal-container').html(data);
			$('#recoveryPasswordModal').modal('show');
		},
		error: function() {
			$('.toast').addClass('toast-error');
         $('.toast').removeClass('toast-success');
         $('.toast-body').html('Системная ошибка!');
         $('.toast').toast('show');
		}
	});
}

function openPremiumActiveUserModal(current_user)
{
	var modal_all = 'current_user=' + current_user;

	$.ajax({
		url: "actions/open-premium-active-user-modal.php",
		type: 'POST',
		data: modal_all,
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
					$('#premiumActiveUserModal').modal('show');
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

function activatePremiumTrialPeriod(current_user)
{
	var trial_premium_all = 'current_user=' + current_user;

	$.ajax({
		url: "actions/activate-premium-trial-period.php",
		type: 'POST',
		data: trial_premium_all,
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
					$('#premiumActiveUserModal').modal('hide');
					$('.toast').addClass('toast-success');
			      $('.toast').removeClass('toast-error');
			      $('.toast-body').html('Премиум успешно активирован');
			      $('.toast').toast('show');
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