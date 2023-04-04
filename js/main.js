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
								content_stars += '<i class="fa fa-star-o active-star fz-18 p-1" aria-hidden="true"></i>';
							}else
							{
								content_stars += '<i class="fa fa-star-o inactive-star fz-18 p-1" aria-hidden="true"></i>';
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