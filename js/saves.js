$("#saves-menu-by-years").on("click","tr", function (event) {
	var id  = $(this).attr('data-href'),
		top = $(id).offset().top - 50;
		
	$('body,html').animate({scrollTop: top}, 0);
});

if (document.getElementById("saves-menu") && document.getElementById("saves-menu-content")
	&& document.getElementById("saves-card-large") && document.getElementById("saves-card-small")
	&& document.getElementsByClassName("saved-card"))
{
	var savesMenuWidth = document.getElementById("saves-menu").offsetWidth,
		savesMenuContent = document.getElementById("saves-menu-content"),
		savesMenuContentForLargeCard = document.getElementById("saves-card-large"),
		savesMenuContentForSmallCard = document.getElementById("saves-card-small"),
		savedCards = document.getElementsByClassName("saved-card");

	savesMenuContent.style.width = savesMenuWidth + "px";

	savesMenuContentForLargeCard.addEventListener("click", function(){
		for (var i = 0; i < savedCards.length; i++)
		{
			savedCards[i].style.width = "25%";
		}
	});

	savesMenuContentForSmallCard.addEventListener("click", function(){
		for (var i = 0; i < savedCards.length; i++)
		{
			savedCards[i].style.width = "20%";
		}
	});

	window.addEventListener('resize', function(){
		if (document.getElementById("saves-menu"))
		{
			var savesMenuWidthResize = document.getElementById("saves-menu").offsetWidth;
			savesMenuContent.style.width = savesMenuWidthResize + "px";
		}
	});
}