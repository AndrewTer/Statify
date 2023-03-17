$("#photo-menu-by-years").on("click","tr", function (event) {
	var id  = $(this).attr('data-href'),
		top = $(id).offset().top - 50;
		
	$('body,html').animate({scrollTop: top}, 0);
});


if (document.getElementById("photo-menu") && document.getElementById("photo-menu-content")
	&& document.getElementById("saves-card-large") && document.getElementById("saves-card-small")
	&& document.getElementsByClassName("profile-picture-card"))
{
	var photoMenuContent = document.getElementById("photo-menu-content"),
		photoMenuWidth = document.getElementById("photo-menu").offsetWidth,
		photoMenuContentForLargeCard = document.getElementById("saves-card-large"),
		photoMenuContentForSmallCard = document.getElementById("saves-card-small"),
		photoCards = document.getElementsByClassName("profile-picture-card");

		photoMenuContent.style.width = photoMenuWidth + "px";


	photoMenuContentForLargeCard.addEventListener("click", function(){
		for (var i = 0; i < photoCards.length; i++)
		{
			photoCards[i].style.width = "25%";
		}
	});

	photoMenuContentForSmallCard.addEventListener("click", function(){
		for (var i = 0; i < photoCards.length; i++)
		{
			photoCards[i].style.width = "20%";
		}
	});

	window.addEventListener('resize', function(){
		if (document.getElementById("photo-menu"))
		{
			var photoMenuWidthResize = document.getElementById("photo-menu").offsetWidth;
			photoMenuContent.style.width = photoMenuWidthResize + "px";
		}
	});
}