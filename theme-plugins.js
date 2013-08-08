

jQuery(document).load(function(){


});

jQuery(document).ready(function(){
// Target your #container, #wrapper etc.
    //jQuery("#wrapper").fitVids();

    //jQuery('#container').each(function(index, element) {
    //	var element = jQuery(element);
    //	element.css({ 'opacity': 0});
    //});
	

    // Sub Menu Item Arrows
	jQuery('#site-navigation #theme-menu-main li').each(function(index, element) {
		var item = jQuery(element);
		var parent = jQuery('#theme-menu-main > li:first-child');
		var subMenu = item.children('ul');
		var isSubmenu = item.parent().hasClass('sub-menu');
		var incontentHtml = item.children('a').html();
		// Add dropdown indicators
		// parent
		var iconclass = item.attr('class').split(' ')[0];
		if (iconclass.indexOf("icon") == 0){
			item.children('a').html('<i class="mn-icon '+ iconclass +'"></i>'+ incontentHtml);
			item.removeClass(iconclass);
		}
		if ( parent && item.children().hasClass('sub-menu') && !isSubmenu ) {
			var contentHtml = item.children('a').html();
			item.children('a').html(contentHtml);
			var arrowDown = ' <i class="icon-angle-down"></i>';
			item.children('a').append(arrowDown);
		}

		// Submenus in submenus
		if (isSubmenu && subMenu.length) {
			var arrowRight = ' <i class="icon-double-angle-right"></i> ';
			item.children('a').append(arrowRight);
		}

	});
	jQuery('#footer #theme-menu-main li').each(function(index, element) {
		var mainItem = jQuery(element);
	
		var iconFClass = mainItem.attr('class').split(' ')[0];
		if (iconFClass.indexOf("icon") == 0){
			mainItem.removeClass(iconFClass);
		}
	
	});
	// Collapsible Menu
	jQuery('#theme-sidebar-menu li').each(function(index, element) {
		var item = jQuery(element);
		var parent = jQuery('#theme-sidebar-menu > li:first-child');
		var subMenu = item.children('ul');
		var isSubmenu = item.parent().hasClass('sub-menu');

		// Add dropdown indicators
		// parent
		if ( parent && item.children().hasClass('sub-menu') && !isSubmenu ) {
			var contentHtml = item.children('a').html();
			item.children('a').html('<span>' + contentHtml + '</span>');
			var iconPlus = ' <i class="icon-plus"></i>';
			item.children('a').append(iconPlus);
		}

		// Submenus in submenus
		if (isSubmenu && subMenu.length) {
			var iconPlus = ' <i class="icon-plus"></i>';
			item.children('a').append(iconPlus);
		}

		item.hover(
			function() {

				subMenu.stop(true, true).show(350);
			},
			function() {
				subMenu.stop(true, true).hide(350);			}
		);

	});

	// Append arrows to some elements
	var rarr = jQuery('<i class="icon-double-angle-right"></i> ');
	jQuery('.widget li > a:first-child').each(function(index, element) {
			element = jQuery(element);
			if( !element.parents(".widget").hasClass('widget_td_categories') && !element.parents(".widget").hasClass('widget_themedutch_posts') )
				element.prepend(rarr);
	});

	// Append arrow to buttons
	var barr = ' <span class="arrow">&rarr;</span> ';
	jQuery('a.button').each(function(index, element) {
			element = jQuery(element);
			element.append(barr);
	});

	// Input field placeholder text
	jQuery('input[placeholder]').each(function(index, element) {
		var element = jQuery(element);

		var placeholderText = element.attr('placeholder');
		if (!placeholderText === '')
			return;
		element.removeAttr('placeholder');

		// Place first placeholder
		if (element.val() === '') {
			element.val(placeholderText);
			element.addClass('placeholderActive');
		}

		element.bind('focus', function() {
			if (element.val() === placeholderText) {
				element.val('');
				element.removeClass('placeholderActive');
			}
		});
		element.bind('blur', function() {
			if (element.val() === '') {
				element.val(placeholderText);
				element.addClass('placeholderActive');
			}
		});
	});

    // show the back top link
    toTop();

    // Setup PrettyPhoto links
	//
	jQuery('a[data-rel^="prettyPhoto"]').prettyPhoto({
		animationSpeed: 'slow', /* fast/slow/normal */
		theme: "pp_default", /*pp_default/light_rounded/dark_rounded/dark_square/light_square/facebook */
		opacity: 0.35, /* Value between 0 and 1 */
		showTitle: false /* true/false */
	});

	// Responsive Menu (TinyNav)
	jQuery("#theme-menu-main").tinyNav({
		active: 'current_page_item', // Set the "active" class for default menu
		label: '', // String: Sets the <label> text for the <select> (if not set, no label will be added)
	    header: '', // String: Specify text for "header" and show header instead of the active item
	});

	// Responsive Menu (Selectbox)
	jQuery(function () {
	    jQuery(".tinynav").selectbox();
	});

	// Cleanup empty p tags
	jQuery('p').each(function(index, element) {
		element = jQuery(element);
		if ( element.html() === '' || element.html() === '<br>')
			element.remove();
	});

	//Search on top
	jQuery("#theme-search-icon").bind({
		click: function() {
			jQuery(".theme-search .container").animate({top: 0}, 350);
		},
		mouseenter: function() {
			jQuery(this).addClass("hover");
		},
		mouseleave: function() {
			jQuery(this).removeClass("hover");
		}

	});

	//Search on top
	jQuery("#theme-hand-icon").bind({
		click: function() {
			//
		},
		mouseenter: function() {
			jQuery(this).addClass("hover");
		},
		mouseleave: function() {
			jQuery(this).removeClass("hover");
		}

	});

	// Search close button
	jQuery(".theme-search .container #close").bind({
		click: function() {
			jQuery(".theme-search .container").animate({top: -180}, 350);
			jQuery("#theme-search-icon").removeClass("hover");
		}
	});


});

jQuery(window).load(function() {

	jQuery('#container').each(function(index, element) {
    	var element = jQuery(element);
    	element.css({ 'opacity': 1});
    });

	// Remove loader when ready
	jQuery('.core-loader').delay(50).fadeOut(150);

	// Sidebar Heights
	var ua = navigator.userAgent;
    var checker = {
      iphone: ua.match(/(iPhone|iPod)/),
      blackberry: ua.match(/BlackBerry/),
      android: ua.match(/Android/)
    };
    if (checker.android){
        //empty
    }
    else if (checker.iphone){
        //empty
    }
    else if (checker.blackberry){
        //empty
    }
    else {

       // Correct the sidebar borders
		var minHeight = jQuery('#content-main .theme-content').height();
		var maxHeight = minHeight;
		if(jQuery('#content-main .theme-sidebar').length > 0 ) {
			jQuery('#content-main .theme-sidebar').each(function(index, element){
				var element = jQuery(element);
				var elementHeight = element.height();

				if ( elementHeight > maxHeight ){
					maxHeight = elementHeight;
				}

			});

			if ( maxHeight > minHeight  ) {
				jQuery('#content-main .theme-content').stop(true, true).animate({height: maxHeight-30 }, 350);
			} else {
				jQuery('#content-main .theme-sidebar').stop(true, true).animate({height: maxHeight+30 }, 350);
			}

		}

		if(jQuery('#footer-widget-area .footer-sidebar').length > 0 ) {
			minHeight = jQuery('#footer-widget-area .footer-sidebar').height();
			maxHeight = minHeight;

			jQuery('#footer-widget-area .footer-sidebar').each(function(index, element){
				var element = jQuery(element);
				var elementHeight = element.height();

				if ( elementHeight > maxHeight ){
					maxHeight = elementHeight;
				}

			});

			if ( maxHeight > minHeight  ) {
				jQuery('#footer-widget-area .footer-sidebar').stop(true, true).animate({height: maxHeight+30 }, 350);
			}
		}
    }

});

/*!
 * Responsive JS Plugins v1.2.2
 */
// Placeholder
jQuery(function(){
    //jQuery('input[placeholder], textarea[placeholder]').placeholder();
});

// Have a custom video player? We now have a customSelector option where you can add your own specific video vendor selector (mileage may vary depending on vendor and fluidity of player):
// jQuery("#thing-with-videos").fitVids({ customSelector: "iframe[src^='http://example.com'], iframe[src^='http://example.org']"});
// Selectors are comma separated, just like CSS
// Note: This will be the quickest way to add your own custom vendor as well as test your player's compatibility with FitVids.


// Masonry
//jQuery(function(){
//    jQuery('#container').masonry({
//      itemSelector: '.grid',
//      columnWidth: 200,
      //isAnimated: !Modernizr.csstransitions,
//      isFitWidth: true
//    });
//  });

// To top
//
function toTop() {
	var TOP_MINIMUM = 200;
	var ANIMATE_SPEED = 500;

	var toTop = jQuery('.scroll-top');

	function updateToTop() {
		var scrollTop = jQuery(window).scrollTop();

		if (scrollTop > TOP_MINIMUM)
			toTop.stop(true, true).slideDown(ANIMATE_SPEED);
		else if (scrollTop <= TOP_MINIMUM)
			toTop.stop(true, true).slideUp(ANIMATE_SPEED);
	}

	jQuery(window).scroll(updateToTop);
	updateToTop();

	// To top button
	toTop.bind('click', function() {
		jQuery('html, body').stop(true, true).animate({scrollTop: 0}, ANIMATE_SPEED);
		return false;
	});
}

