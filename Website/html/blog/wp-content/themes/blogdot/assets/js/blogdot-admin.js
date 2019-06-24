jQuery(document).ready(function(jQuery) {

	"use strict";

	jQuery(document).on( 'click', '.blogdot-intro-notice .bd-notice-dismiss', function(e) {
		e.preventDefault();
		jQuery.ajax({
			url: ajaxurl,
			data: {
				action: 'blogdot-intro-dismissed'
			},
			success: function() {
				location.reload();
			}
		});
	});

});
