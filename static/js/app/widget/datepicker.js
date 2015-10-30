define(['jquery', 'jquery-ui'], function($, ui) {
	var options = {
		closeText: "完成", // Display text for close link
		prevText: "上月", // Display text for previous month link
		nextText: "下月", // Display text for next month link
		currentText: "今天", // Display text for current month link
		monthNames: ["1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月"], // Names of months for drop-down and formatting
		monthNamesShort: ["1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月"], // For formatting
		dayNames: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"], // For formatting
		dayNamesShort: ["日", "一", "二", "三", "四", "五", "六"], // For formatting
		dayNamesMin: ["日", "一", "二", "三", "四", "五", "六"], // Column headings for days starting at Sunday
		weekHeader: "Wk", // Column header for week of the year
		dateFormat: "yy-mm-dd", // See format options on parseDate
		firstDay: 0, // The first day of the week, Sun = 0, Mon = 1, ...
		isRTL: false, // True if right-to-left language, false if left-to-right
		showMonthAfterYear: true, // True if the year select precedes month, false for month then year
		yearSuffix: "" // Additional text to append to the year in the month headers
	};
	
	return {
		init : function(selector) {
			$(selector).datepicker(options);
		}
	};
});