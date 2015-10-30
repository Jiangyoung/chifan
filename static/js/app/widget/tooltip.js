define(['jquery', 'jquery-ui'], function($, ui) {

	return {
		init : function(selector) {
			$(selector).tooltip({
				track: true,
				open: function() {
					
				}
			});
		}
	};
});