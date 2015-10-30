define(['jquery', 'app/widget/datepicker', 'app/widget/tooltip'], function($, datepicker, tooltip) {
	var exports = {};

	
	exports.init = function() {
		datepicker.init('#datepicker');
		tooltip.init(document);
	}

	return exports;
});
