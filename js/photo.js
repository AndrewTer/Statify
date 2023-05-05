$("#photo-menu-by-years").on("click","tr", function (event) {
	var id  = $(this).attr('data-href'),
	     top = $(id).offset().top - 50;
		
	$('body,html').animate({scrollTop: top}, 0);
});