$(document).ready(function(){
	if($(window).width() > 480){
		$('.video-carousel').slick({
			autoplay: false,
			infinite: false,
			slidesToShow: 2,
			variableWidth: true,
			centerMode: false,
			arrows: false,
			dots: false,
			responsive: [
				{
					breakpoint: 480,
					settings: "unslick",
				}
			]
		});
	}

	$('#partners').slick({
		autoplay: false,
		infinite: false,
		slidesToShow: 3,
		slidesToScroll: 3,
		arrows: false,
		dots: true,
	});
});