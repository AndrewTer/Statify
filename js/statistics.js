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