let userCommentBlock = document.getElementById('user-comment-block'),
		addCommentBtn = document.getElementById('add-comment-btn'),
		delCommentBtn = document.getElementById('del-comment-btn');

function addCommentBlock(photo_uuid, author_uuid) {
	userCommentBlock.insertAdjacentHTML('afterbegin', 
		`<div class="m-0 p-2 pl-3 pr-3">
        	<textarea class="textarea m-0 w-100 fz-14" id="new-comment-text" placeholder="Введите текст комментария"></textarea>
        	<input type="submit" class="btn btn-standard w-100 m-0 mt-1" value="Добавить комментарий" onclick="event.preventDefault();addNewComment('` + photo_uuid + `', '` + author_uuid + `');">
    	 </div>
    	 <hr class="hr-user-info m-0">`);

	addCommentBtn.classList.add("add-comment-btn-hide");
	addCommentBtn.classList.remove("add-comment-btn-show");
	delCommentBtn.classList.add("del-comment-btn-show");
	delCommentBtn.classList.remove("del-comment-btn-hide");
}

function delCommentBlock() {
	userCommentBlock.innerHTML = "";

	addCommentBtn.classList.remove("add-comment-btn-hide");
	addCommentBtn.classList.add("add-comment-btn-show");
	delCommentBtn.classList.remove("del-comment-btn-show");
	delCommentBtn.classList.add("del-comment-btn-hide");
}

function addReplyToCommentBlock(current_user_uuid, photo_uuid, comment_uuid) {
	document.querySelectorAll('.reply-to-user-comment-block').forEach(function(el) {
  	el.innerHTML = "";
	});

	document.querySelectorAll('.hide-reply-to-comment-p').forEach(function(el) {
  	el.style.display = 'none';
	});

	document.querySelectorAll('.add-reply-to-comment-p').forEach(function(el) {
  	el.style.display = 'block';
	});

	document.getElementById('reply-block-'+comment_uuid).insertAdjacentHTML('afterbegin', 
		`<div class="m-0 p-0 pt-2 pb-2">
        <textarea class="textarea m-0 w-100 fz-14" id="reply-to-comment-text" placeholder="Введите текст комментария"></textarea>
       	<input type="submit" class="btn btn-standard w-100 m-0" value="Добавить комментарий" onclick="event.preventDefault();addNewReplyToComment('` + current_user_uuid + `', '` + photo_uuid + `', '` + comment_uuid + `')">
    	</div>`);

	document.getElementById('add-reply-'+comment_uuid).style.display = 'none';
	document.getElementById('hide-reply-'+comment_uuid).style.display = 'block';
}

function delReplyToCommentBlock(comment_uuid) {
	document.getElementById('reply-block-'+comment_uuid).innerHTML = "";

	document.getElementById('add-reply-'+comment_uuid).style.display = 'block';
	document.getElementById('hide-reply-'+comment_uuid).style.display = 'none';
}

function addNewComment(photo_uuid, author_uuid) {
	var commentTextArea = document.getElementById('new-comment-text')
	var text_comment = commentTextArea.value;

	if (text_comment)
	{
		var add_comment_all = 'photo=' + photo_uuid + '&author=' + author_uuid + '&text=' + text_comment;

		$.ajax({
			url: "actions/add-new-comment.php",
			type: 'POST',
			data: add_comment_all,
			success: function (data) {
				$("#comments-list").load(location.href + ' #comments-list');
				$("#comments-count").load(location.href + ' #comments-count');
				delCommentBlock();
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

function addNewReplyToComment(current_user_uuid, photo_uuid, comment_uuid) {
	var commentTextArea = document.getElementById('reply-to-comment-text');
	var text_comment = commentTextArea.value;

	if (text_comment)
	{
		var add_comment_all = 'photo=' + photo_uuid + '&author=' + current_user_uuid + '&comment_uuid=' + comment_uuid + '&text=' + text_comment;

		$.ajax({
			url: "actions/add-new-reply-to-comment.php",
			type: 'POST',
			data: add_comment_all,
			success: function (data) {
				$("#comments-list").load(location.href + ' #comments-list');
				$("#comments-count").load(location.href + ' #comments-count');
				delReplyToCommentBlock(comment_uuid);
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

function delComment(author_uuid, photo_uuid, comment_uuid) {
	var del_comment_all = 'author=' + author_uuid + '&photo=' + photo_uuid + '&comment=' + comment_uuid;

	$.ajax({
		url: "actions/del-comment.php",
		type: 'POST',
		data: del_comment_all,
		success: function (data) {
			$("#comments-list").load(location.href + ' #comments-list');
			$("#comments-count").load(location.href + ' #comments-count');
		},
		error: function() {
			$('.toast').addClass('toast-error');
			$('.toast').removeClass('toast-success');
      $('.toast-body').html('Системная ошибка!');
      $('.toast').toast('show');
		}
	});
}

function addRatingInComments(current_author, current_receiver, current_photo) 
{
   var current_rating_mark = $('input[name=rating]:checked').val(),
       rating_all = 'author=' + current_author + '&receiver=' + current_receiver + '&photo=' + current_photo + '&mark=' + current_rating_mark;

   $.ajax({
      url: "actions/rate-picture.php",
      type: 'POST',
      data: rating_all,
      success: function (data) {
        $("#comments-block-user-rating").load(location.href + " #comments-rating-area");
      },
      error: function () {
        $('.toast').addClass('toast-error');
				$('.toast').removeClass('toast-success');
        $('.toast-body').html('Системная ошибка!');
        $('.toast').toast('show');
      }
   });
}

document.addEventListener("DOMContentLoaded", () => {
	var location_hash = document.location.hash;

	if (location_hash)
  {
  	$('html, body').stop().animate({'scrollTop': $(document.location.hash).offset().top - 100}, 10, 'linear', function () {});
   	$(location_hash).addClass('selected');
  }
});