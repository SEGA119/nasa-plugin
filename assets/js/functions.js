(function($) {
	
	$(document).ready(function() {
		
		$('.nasa-gallery').slick({
			infinite: true,
			slidesToShow: 3,
			slidesToScroll: 3,
			prevArrow: '<div type="button" class="slick-prev">Previous</div>',
			nextArrow: '<div type="button" class="slick-next">Next</div>'
		});
		
	});
	
})(jQuery);