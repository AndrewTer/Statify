function showUserSaveHistory()
{
	var user_uuid = $("#main-header-block").attr('data-attr');

	var user_data = 'user_uuid=' + user_uuid;

	$.ajax({
		url: "actions/get-user-save-history.php",
		type: 'POST',
		data: user_data,
		success: function (data) {
			if (data == 'not-premium')
			{
				$('.toast').addClass('toast-error');
				$('.toast').removeClass('toast-success');
				$('.toast-body').html('У вас нет премиума!');
				$('.toast').toast('show');
			}else
				$("#block-user-content-history").html(data);
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
			$('.toast-body').html('Системная ошибка!');
			$('.toast').toast('show');
		}
	});
}

function hideUserSaveHistory()
{
	var user_uuid = $("#main-header-block").attr('data-attr');

	var user_data = 'user_uuid=' + user_uuid;

	$.ajax({
		url: "actions/get-user-rating-history.php",
		type: 'POST',
		data: user_data,
		success: function (data) {
			$("#block-user-content-history").html(data);
		},
		error: function () {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
			$('.toast-body').html('Системная ошибка!');
			$('.toast').toast('show');
		}
	});
}

function openRatingStatisticsForPremiumModal(current_user)
{
	var modal_all = 'current_user=' + current_user;

	$.ajax({
		url: "actions/open-rating-statistics-for-premium-modal.php",
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
					$('#ratingStatisticsForPremiumModal').modal('show');
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

function resizeBlocksWithAmounts()
{
	let blocks = document.querySelectorAll('.block-with-amounts');
	let textBlocks = document.querySelectorAll('.amount-value-text-block');
	let text = document.querySelectorAll('.amount-value-text');
	let textNumbers = document.querySelectorAll('.amount-value-text-number');
	let iconBlocks = document.querySelectorAll('.amount-value');
	let icons = document.querySelectorAll('.amount-value svg');
	
	for (let i = 0; i < blocks.length; i++)
	{
		let width = blocks[i].offsetWidth;

		switch(true) {
			case width < 162 && width >= 148:
				textBlocks[i].style = 'margin-left: 8px !important';
				textNumbers[i].style.fontSize = '18px';
				text[i].style.fontSize = '12px';
				text[i].style.display = 'block';
				iconBlocks[i].style.height = '45px';
				iconBlocks[i].style.minHeight = '45px';
				iconBlocks[i].style.width = '45px';
				iconBlocks[i].style.minWidth = '45px';
				icons[i].style.width = '20px';
			break;

			case width < 148 && width >= 143:
				textNumbers[i].style.fontSize = '16px';
				text[i].style.display = 'block';
				iconBlocks[i].style.height = '40px';
				iconBlocks[i].style.minHeight = '40px';
				iconBlocks[i].style.width = '40px';
				iconBlocks[i].style.minWidth = '40px';
				icons[i].style.width = '17px';
			break;

			case width < 143 && width >= 137:
				textNumbers[i].style.fontSize = '16px';
				text[i].style.display = 'block';
				iconBlocks[i].style.height = '35px';
				iconBlocks[i].style.minHeight = '35px';
				iconBlocks[i].style.width = '35px';
				iconBlocks[i].style.minWidth = '35px';
				icons[i].style.width = '17px';
			break;

			case width < 137 && width >= 110:
				textBlocks[i].style = 'margin-left: 16px !important';
				textNumbers[i].style.fontSize = '18px';
				text[i].style.display = 'none';
				iconBlocks[i].style.height = '47px';
				iconBlocks[i].style.minHeight = '47px';
				iconBlocks[i].style.width = '47px';
				iconBlocks[i].style.minWidth = '47px';
				icons[i].style.width = '25px';
			break;

			case width < 110:
				textBlocks[i].style = 'margin-left: 10px !important';
				textNumbers[i].style.fontSize = '14px';
				text[i].style.display = 'none';
				iconBlocks[i].style.height = '35px';
				iconBlocks[i].style.minHeight = '35px';
				iconBlocks[i].style.width = '35px';
				iconBlocks[i].style.minWidth = '35px';
				icons[i].style.width = '18px';
			break;

			default:
				textBlocks[i].style = 'margin-left: 16px !important';
				textNumbers[i].style.fontSize = '20px';
				text[i].style.fontSize = '14px';
				text[i].style.display = 'block';
				iconBlocks[i].style.height = '47px';
				iconBlocks[i].style.minHeight = '47px';
				iconBlocks[i].style.width = '47px';
				iconBlocks[i].style.minWidth = '47px';
				icons[i].style.width = '25px';
			break;
		}
	}
}

function resizeBlockWithRatingContent()
{
	let block = document.getElementById('block-rating-content');
	let starIcons = document.querySelectorAll('#block-rating-content .fa.fa-star-o');

	if (block)
	{
		let width = block.offsetWidth;

		if (width < 253)
		{
			for (let i = 0; i < starIcons.length; i++)
			{
				starIcons[i].style = 'font-size: 9px !important';
			}
		}else 
		{
			for (let i = 0; i < starIcons.length; i++)
			{
				starIcons[i].style = 'font-size: 12px !important';
			}
		}
	}
}

window.onload = function() {
	resizeBlocksWithAmounts();
	resizeBlockWithRatingContent();
};

window.onresize = function() {
	resizeBlocksWithAmounts();
	resizeBlockWithRatingContent();
};

/*function showUserCommentsList(current_user)
{
	var comments_all = 'current_user=' + current_user;

	$.ajax({
		url: "actions/get-current-user-comments-list.php",
		type: 'POST',
		data: comments_all,
		beforeSend: function() {
			$('#user-page-content-block').html('<div class="m-0 p-5 d-flex justify-content-center align-items-center">'
																					+ '<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="40px" height="40px" viewBox="0 0 128 128" xml:space="preserve"><g><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#000000"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#f8f8f8" transform="rotate(30 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#e8e8e8" transform="rotate(60 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#d4d4d4" transform="rotate(90 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#bebebe" transform="rotate(120 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#a6a6a6" transform="rotate(150 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#8e8e8e" transform="rotate(180 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#737373" transform="rotate(210 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#5a5a5a" transform="rotate(240 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#414141" transform="rotate(270 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#2a2a2a" transform="rotate(300 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#151515" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>'
																					+ '</div>');
			$('#number-of-comments-by-current-user').addClass('active');
		},
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
					$('#user-page-content-block').html(data);
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
}*/

/*function showUserMainStatistic(current_user)
{
	var statistic_all = 'current_user=' + current_user;

	$.ajax({
		url: "actions/get-user-main-statistic.php",
		type: 'POST',
		data: statistic_all,
		beforeSend: function() {
			$('#user-page-content-block').html('<div class="m-0 p-5 d-flex justify-content-center align-items-center">'
																					+ '<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="40px" height="40px" viewBox="0 0 128 128" xml:space="preserve"><g><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#000000"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#f8f8f8" transform="rotate(30 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#e8e8e8" transform="rotate(60 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#d4d4d4" transform="rotate(90 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#bebebe" transform="rotate(120 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#a6a6a6" transform="rotate(150 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#8e8e8e" transform="rotate(180 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#737373" transform="rotate(210 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#5a5a5a" transform="rotate(240 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#414141" transform="rotate(270 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#2a2a2a" transform="rotate(300 64 64)"/><path d="M64 0l2.48 7.64h8.02L68 12.36 70.5 20 64 15.28 57.5 20l2.5-7.64-6.5-4.72h8.02z" fill="#151515" transform="rotate(330 64 64)"/><animateTransform attributeName="transform" type="rotate" values="0 64 64;30 64 64;60 64 64;90 64 64;120 64 64;150 64 64;180 64 64;210 64 64;240 64 64;270 64 64;300 64 64;330 64 64" calcMode="discrete" dur="840ms" repeatCount="indefinite"></animateTransform></g></svg>'
																					+ '</div>');
		},
		success: function(result) {
			$('#user-page-content-block').html(result);
			$('#number-of-comments-by-current-user').removeClass('active');
		}
	});
}*/