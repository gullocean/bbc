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

		//Init FlexSlider on property template.
		$('.flexslider').flexslider({
			minItems      : 1,
			maxItems      : 1,
			move          : 1,
			itemWidth     : 200,
			itemMargin    : 0,
			animation     : "slide",
			slideshow     : true,
			slideshowSpeed: 3000,
			directionNav  : false,
			controlNav    : false
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

	var geocoder;
  	var map;
	function initialize() {
	    geocoder = new google.maps.Geocoder();
	    var latlng = new google.maps.LatLng(44.0682, 114.7420);
	    var mapOptions = {
	      zoom: 4,
	      center: latlng
	    }
	    map = new google.maps.Map(document.getElementById('community-map'), mapOptions);
	}

	function codeAddress() {
	    var address = [];
	    for(i=0; i<$('input.idaho_location').length; i++) {
	    	var real_location = $('input[name=location' + i + ']').val();
	    	address.push(real_location);
	    }

	    for(i=0;i<address.length;i++) {
	    	geocoder.geocode( { 'address': address[i]}, function(results, status) {
		      if (status == 'OK') {
		      	map.setCenter(results[0].geometry.location);
		        var marker = new google.maps.Marker({
		            map: map,
		            position: results[0].geometry.location
		        });
		      } else {
		        alert('Geocode was not successful for the following reason: ' + status);
		      }
		    });
	    }
	}

	// Load Google map on community template.
	if ($('#community-map').length) {// If there is map wrapper.
		initialize();
		setTimeout(function() {
			codeAddress();
		}, 1000);
	}

})(jQuery);