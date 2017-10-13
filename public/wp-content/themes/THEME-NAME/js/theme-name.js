if (!window.console) {
	window.console = {
		log: function () { }
	}
}

(function ($, console) {
	var fixedHeader = function () {
		var didScroll = false
		var lastScrollTop = 0
		var delta = 5
		var headerHeight = js('site-header').outerHeight()

		$(window).on('scroll', function (event) {
			didScroll = true
		})

		setInterval(function () {
			if (didScroll) {
				window.requestAnimationFrame(hasScrolled)
				didScroll = false
			}
		}, 250)

		function hasScrolled () {
			var st = $(this).scrollTop()

			if (Math.abs(lastScrollTop - st) <= delta) {
				return
			}

			// If current position > last position AND scrolled past navbar...
			if (st > lastScrollTop && st > headerHeight) {
				// Scroll Down
				$('body').addClass('is-scrolling-down')
			} else {
				// Scroll Up
				// If did not scroll past the document (possible on mac)...
				if (st + $(window).height() < $(document).height()) {
					$('body').removeClass('is-scrolling-down')
				}
			}

			lastScrollTop = st
		}
	}

	var toggleSiteNav = function () {
		$('body').toggleClass('has-menu')
		return false
	}

	var bindEvents = function () {
		js('site-nav-toggle').on('click', toggleSiteNav)
		js('off-canvas-overlay').on('click', toggleSiteNav)
	}

	var init = function () {
		// eslint-disable-next-line no-console
		console.log('Initializing...')

		bindEvents()

		if (window.requestAnimationFrame) {
			fixedHeader()
		}

		window.svg4everybody()
	}

	// eslint-disable-next-line no-unused-vars
	var js = function (name, ctx) {
		if (!ctx) {
			ctx = document
		}

		return $('[data-js~="' + name + '"]', ctx)
	}

	// eslint-disable-next-line no-unused-vars
	var jsClosest = function (name, ctx) {
		if (!ctx) {
			ctx = document
		}
		return ctx.closest('[data-js~="' + name + '"]')
	}

	$(document).ready(init)
})(window.jQuery, window.console)

/* eslint-disable */
var MTIProjectId='9f0aca85-af7d-4fd4-8698-a84bdb7c8033';
(function() {
		var mtiTracking = document.createElement('script');
		mtiTracking.type='text/javascript';
		mtiTracking.async='true';
		mtiTracking.src='/wp-content/themes/THEME-NAME/js/libs/mtiFontTrackingCode.js';
		(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild( mtiTracking );
})();
/* eslint-enable */
