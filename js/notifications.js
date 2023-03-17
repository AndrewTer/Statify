function readAllNotifications(user_uuid) {
	const regexExp = /^[0-9a-fA-F]{8}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{4}\b-[0-9a-fA-F]{12}$/gi;

	if (regexExp.test(user_uuid))
	{
		var read_all = 'user=' + user_uuid;

		$.ajax({
			url: "actions/read-all-notifications.php",
			type: 'POST',
			data: read_all,
			success: function (data) {
				const notificationsCount = document.getElementsByClassName('notifications-count');
		    	
		    	while(notificationsCount.length > 0)
		    	{
		        	notificationsCount[0].parentNode.removeChild(notificationsCount[0]);
		    	}
		    
		    	$("#notifications-list").load(location.href + ' #notifications-list');

			    $('.toast').addClass('toast-success');
			    $('.toast').removeClass('toast-error');
			    $('.toast-body').html('Все уведомления прочитаны');
        		$('.toast').toast('show');
			},
			error: function() {
				$('.toast').addClass('toast-error');
				$('.toast').removeClass('toast-success');
		        $('.toast-body').html('Системная ошибка!');
		        $('.toast').toast('show');
			}
		});
	}
}