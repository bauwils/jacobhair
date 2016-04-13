;(function($, App) {
	
	'use strict';

	var self = App.Timely = {

		init: function  () {
			$('.js-trigger-timely').click(function() {
				$('#timelyContainer > a').click()
				return false
			});
		}

	}

})(jQuery, App);