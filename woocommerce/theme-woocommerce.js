jQuery(document).ready(function() {

	// Detect touch support
	var isTouch = 'ontouchstart' in document.documentElement;

	// WooCommerce product items
	//
	jQuery('ul.products .product').each(function(index, element) {
		var element = jQuery(element);
		var imgEl = element.children('img');
		var container = element.find('.product_hover_container');

		var ANIMATE_SPEED = 800;

		// Hover effects
		container.hide();
		container.css('visibility', 'visible');

		//if (isTouch) {
		//	var startEvent = 'click';
		//	var endEvent = '';
		//} else {
			var startEvent = 'mouseenter';
			var endEvent = 'mouseleave';
		//}

		element.bind(startEvent, function(event) {
			container.css('top', (imgEl.outerHeight(true) / 2 - container.height() / 2) + 'px');
			container.css('left', (imgEl.outerWidth(true) / 2 - container.width() / 2) + 'px');

			container.stop(true, true).fadeIn(ANIMATE_SPEED / 2);

			//event.preventDefault();
			//return false;
		});
		if (endEvent !== '') {
			element.bind(endEvent, function(event) {
				container.stop(true, true).fadeOut(ANIMATE_SPEED);

				//event.preventDefault();
				//return false;
			});
		}
	});

	// WooCommerce cart dropdown
	//
	cart = jQuery('.theme-woocommerce-cart');
	if (cart.length) {
		var cartDropdown = cart.find('.theme-woocommerce-cart-dropdown');
		var eventSelector = '.theme-woocommerce-cart';

		cartDropdown.hide();

		function cartToggle() {
			var cart = jQuery(this);
			var cartDropdown = cart.find('.theme-woocommerce-cart-dropdown');

			if (cartDropdown.css('display') === 'none')
				cartShow();
			else
				cartHide();
		}

		function cartShow() {
			var cartDropdown = jQuery('.theme-woocommerce-cart-dropdown');
			var navigateRow = jQuery('.theme-woocommerce-cart');

			cartDropdown.css({
				visibility: 'visible'
				//left: navigateRow.offset().left + navigateRow.width() - cartDropdown.outerWidth()
			});
			cartDropdown.stop(true, true).slideDown(200);
		}

		function cartHide() {
			var cartDropdown = jQuery('.theme-woocommerce-cart-dropdown');

			cartDropdown.stop(true, true).slideUp(200);
		}

		// Behaviour
		if (isTouch) {
			jQuery(document).on('touchstart', eventSelector, cartToggle);
		} else {
			jQuery(document).on('mouseenter', eventSelector, cartShow);
			jQuery(document).on('mouseleave', eventSelector, cartHide);
		}
	}

	// Append arrow to buttons
	var barr = ' →';
	jQuery('input.button').each(function(index, element) {
			element = jQuery(element);
			var value = element.attr('value');
			if ( value.indexOf('→') === -1 ){
				element.attr('value', value + barr);
			}
	});

	// add prettyPhoto
    jQuery('a[rel^="prettyPhoto"]').prettyPhoto({
	    animationSpeed: 'slow', /* fast/slow/normal */
		theme: "pp_default", /*pp_default/light_rounded/dark_rounded/dark_square/light_square/facebook */
		opacity: 0.35, /* Value between 0 and 1 */
		showTitle: false /* true/false */
	});


	// Remove waitlist button
	jQuery('div.product div.images div.stock').find('div').remove();

	// Product page slider and carousel
	jQuery('#carousel').flexslider({
	    animation: "slide",
	    controlNav: false,
	    directionNav: false,
	    animationLoop: false,
	    slideshow: false,
	    itemWidth: 90,
	    itemMargin: 10,
	    asNavFor: '.images .flexslider',
	    start: function(){
		    jQuery('#carousel .slides').css({
                width:'',
                display: 'inline-block'
            });
            jQuery('#carousel .slides li').css({
                width:''
            });
       },
       after: function(){
            jQuery('#carousel .slides li').css({
                width:''
            });
	    }
	  });

	jQuery('.images .flexslider').flexslider({
	    animation: "slide",
	    controlNav: false,
	    prevText: '<i class="icon-minus"></i>',
	    nextText: '<i class="icon-plus"></i>',
	    animationLoop: false,
	    slideshow: true,
	    sync: "#carousel"
	  });

});

jQuery(window).load(function() {

});