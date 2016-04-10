;(function($, App) {
	
	'use strict';

	var self = App.Nav = {

		$header: null,

		// When mobile is compact
		isCompact: false,

		// On mobile navigation expand mode
		isFullNavOpen: false,

		onScroll: function () {
			var scrollUp = $('body').scrollTop()

			if (scrollUp > 300 && !this.isCompact) {
				this.$header.addClass('is-compact')
				this.isCompact = true
			}
			if (scrollUp <= 300 && this.isCompact) {
				this.$header.removeClass('is-compact')
				this.isCompact = false;
			}
		},

		onToggle: function () {
			var $toggle = $('#toggleMobileNav')

			if (!this.isFullNavOpen) {
				this.$header.addClass('is-nav-expand')
			} else {
				this.$header.removeClass('is-nav-expand')
			}
			this.isFullNavOpen = !this.isFullNavOpen;
		},

		onNavItemClick: function () {
			if (this.isFullNavOpen) {
				this.$header.removeClass('is-nav-expand')
				this.isFullNavOpen = false;
			}
		},

		bindEvents: function () {
			$(document).scroll($.proxy(this.onScroll, this))
			$('#toggleMobileNav').click($.proxy(this.onToggle, this))
			$('#topNav .nav > li > a ').click($.proxy(this.onNavItemClick, this))
		},

		isMobileWidth: function () {
			return $('body').outerWidth() < 767;
		},

		init: function  () {
			this.$header = $('header')
			this.bindEvents()

			// On ready
			this.onScroll()
		}

	}

})(jQuery, App);