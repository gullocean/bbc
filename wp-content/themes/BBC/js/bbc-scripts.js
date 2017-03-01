;(function ($) {

	var cl_nav,
			cl_navOuterHeight;

	jQuery(document).ready(function ($) {
		//"use strict";

		// Smooth scroll to inner links

		jQuery('.inner-link').each(function () {
			var href = jQuery(this).attr('href');
			if ( href.charAt(0) !== "#" ) {
				jQuery(this).removeClass('inner-link');
			}
		});

		jQuery('.inner-link').click(function () {
			jQuery('html, body').animate({
				scrollTop: 0
			}, 1000);
			return false;
		});

		// Fix nav to top while scrolling

		cl_nav = $('body .nav-container nav:first');
		cl_navOuterHeight = $('body .nav-container nav:first').outerHeight();
		var window_w = jQuery(window).width();
		if ( window_w > 991 ) {
			window.addEventListener("scroll", updateNav, false);
			updateNav();
		}

		$(window).resize(function () {
			window_w = $(window).width();
			if ( window_w < 992 ) {
				cl_nav.removeClass('fixed scrolled outOfSight');
			} else {
				window.addEventListener("scroll", updateNav, false);
				updateNav();
			}
		});

		// Menu dropdown positioning

		$('.menu > li > ul').each(function () {
			var menu = $(this).offset();
			var farRight = menu.left + $(this).outerWidth(true);
			if ( farRight > $(window).width() && !$(this).hasClass('mega-menu') ) {
				$(this).addClass('make-right');
			} else if ( farRight > $(window).width() && $(this).hasClass('mega-menu') ) {
				var isOnScreen = $(window).width() - menu.left;
				var difference = $(this).outerWidth(true) - isOnScreen;
				$(this).css('margin-left', -(difference));
			}
		});

		// Mobile Menu

		$('.mobile-toggle').click(function () {
			$('.nav-bar').toggleClass('nav-open');
			$(this).toggleClass('active');
			$('.search-widget-handle').toggleClass('hidden-xs hidden-sm');
		});

		$('.menu li').click(function (e) {
			if ( !e ) e = window.event;
			e.stopPropagation();
			if ( $(this).find('ul').length ) {
				$(this).toggleClass('toggle-sub');
			} else {
				$(this).parents('.toggle-sub').removeClass('toggle-sub');
			}
		});

		$('.menu li a').click(function () {
			if ( $(this).hasClass('inner-link') ) {
				$(this).closest('.nav-bar').removeClass('nav-open');
			}
		});

		// Lightbox gallery titles
		$('.lightbox-grid li a').each(function () {
			var galleryTitle = $(this).closest('.lightbox-grid').attr('data-gallery-title');
			$(this).attr('data-lightbox', galleryTitle);
		});
	});

	/* Function To
	 * keep menu fixed
	 **/
	function updateNav() {
		var scroll = $(window).scrollTop();
		var window_w = jQuery(window).width();

		if ( window_w < 992 ) {
			return;
		}

		if ( scroll > cl_navOuterHeight ) {
			cl_nav.addClass('outOfSight');
		}

		if ( $(window).scrollTop() > (cl_navOuterHeight + 65) ) {//if href = #element id
			cl_nav.addClass('fixed scrolled');
			$('body').addClass('scrolled');
			if ($('#wpadminbar').length) {
				$('body').addClass('is_admin_bar');	
			}
		}

		if ( $(window).scrollTop() == 0 ) {
			cl_nav.removeClass('fixed scrolled outOfSight');
			$('body').removeClass('scrolled is_admin_bar');
		}
	}

})(jQuery);