(function( $ ) {
	'use strict';

	
	$( window ).load(function() {	
			
		$(".read_more--action").click(function(e) {
			e.preventDefault();
			$(".extra_text").removeClass("hidden").show();
			$(".read_more--text").hide();
			return false;
		});

		$(".event__section__title").click(function() {	
			let isVisible = $("#checkout_target").is(":visible"); 
			
			if(!isVisible) {
				$(".event__section__title")
					.find(".dashicons-arrow-down-alt2")
					.removeClass("dashicons-arrow-down-alt2")
					.addClass("dashicons-arrow-up-alt2");

				$("#checkout_target").empty();

				init_checkout_widget();
				
				$("#checkout_target").slideDown();
			}
			else {
				$("#checkout_target").slideUp();

				$(".event__section__title")
					.find(".dashicons-arrow-up-alt2")
					.removeClass("dashicons-arrow-up-alt2")
					.addClass("dashicons-arrow-down-alt2");

			}

		});
		
		// Inicio automático
		$("#checkout_target").empty();
		init_checkout_widget();
		$("#checkout_target").slideDown();

	});

	
})( jQuery );
