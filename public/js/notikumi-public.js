(function( $ ) {
	'use strict';

	
	$( window ).load(function() {		
		
	});
	
})( jQuery );


function init_checkout_widget() {				
	var value = {
		channel: jQuery("#ntk-checkout-channel").val(),
		content: jQuery("#ntk-checkout-slug").val(),
		type: 1,
		layout: 'sell-grid',
		resizer: true,
		customCss: jQuery("#ntk-checkout-custom-css").val(), 
		profile: jQuery("#ntk-checkout-environment").val(),
		target: "#checkout_target", 
		lang: jQuery("#ntk-checkout-locale").val()
	}
	
	_ntk = [];
	_ntk.push(value);
	window.___notikumiWidget.init();

}