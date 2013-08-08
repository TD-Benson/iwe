

jQuery(document).ready(function() {
	// Target your #container, #wrapper etc.
	jQuery("#wrapper").fitVids();
	jQuery('#container').each(function(index, element) {
		var element = jQuery(element);
		element.css({
			'opacity': 0
		});
	});
	// Sub Menu Item Arrows
	jQuery('#site-navigation #theme-menu-main li').each(function(index, element) {
		var item = jQuery(element);
		var parent = jQuery('#theme-menu-main > li:first-child');
		var subMenu = item.children('ul');
		var isSubmenu = item.parent().hasClass('sub-menu');

		//Check for icons
		var iconclass = item.attr('class').split(' ')[0];
		if (iconclass.indexOf("icon") == 0){
			var newIcon = '<i class="icon-menu '+ iconclass +'"></i>&nbsp;&nbsp;';
			item.children('a').prepend(newIcon);
			item.removeClass(iconclass);
		}

		// Add dropdown indicators
		if (parent && item.children().hasClass('sub-menu') && !isSubmenu) {
			var arrowDown = ' <i class="icon-plus"></i>';
			//item.children('a').append(arrowDown);
		}
		// Submenus in submenus
		if (isSubmenu && subMenu.length) {
			var arrowRight = ' <i class="icon-plus"></i>&nbsp;&nbsp;';
			item.children('a').append(arrowRight);
		}
	});

	// Input field placeholder text
	jQuery('input[placeholder]').each(function(index, element) {
		var element = jQuery(element);
		var placeholderText = element.attr('placeholder');
		if (!placeholderText === '') return;
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
		animationSpeed: 'normal',
		/* fast/slow/normal */
		slideshow: 3000,
		autoplay_slideshow: false,
		theme: "pp_default",
		/*pp_default/light_rounded/dark_rounded/dark_square/light_square/facebook */
		opacity: 0.35,
		/* Value between 0 and 1 */
		hook: 'data-rel',
		showTitle: false /* true/false */
	});
	// Responsive Menu (TinyNav)
	jQuery("#theme-menu-main").tinyNav({
		active: 'current_page_item',
		// Set the "active" class for default menu
		label: '',
		// String: Sets the <label> text for the <select> (if not set, no label will be added)
		header: '',
		// String: Specify text for "header" and show header instead of the active item
	});
	// Responsive Menu (Selectbox)
	jQuery(function() {
		jQuery(".tinynav").selectbox();
	});
	// Cleanup empty p tags
	jQuery('p').each(function(index, element) {
		element = jQuery(element);
		if (element.html() === '' || element.html() === '<br>') element.remove();
	});

	// Search
	jQuery('#icon-search').click(function(e) {
		if( ! jQuery('#theme-search').hasClass('active') ) {
			pullDown();
			jQuery('#theme-search').addClass('active');
			jQuery('#theme-search').slideDown(300);
			jQuery('#theme-search').find('.grid').delay(100).animate({'opacity': 1}, 200);
		} else {
			jQuery('#theme-search').removeClass('active');
			jQuery('#theme-search').find('.grid').animate({'opacity': 0}, 100,
				function() {
					jQuery('#theme-search').stop(true,true).slideUp(300);
				});
		}
	});

	// Language
	jQuery('#icon-language').click(function(e) {
		if( ! jQuery('#theme-language').hasClass('active') ) {
			pullDown();
			jQuery('#theme-language').addClass('active');
			jQuery('#theme-language').slideDown(300);
			jQuery('#theme-language').find('.grid').delay(100).animate({'opacity': 1}, 200);
		} else {
			jQuery('#theme-language').removeClass('active');
			jQuery('#theme-language').find('.grid').animate({'opacity': 0}, 100,
				function() {
					jQuery('#theme-language').stop(true,true).slideUp(300);
				});
		}
	});

	// My Account
	jQuery('#icon-user').click(function(e) {
		if( ! jQuery('#theme-my-account').hasClass('active') ) {
			pullDown();
			jQuery('#theme-my-account').addClass('active');
			jQuery('#theme-my-account').slideDown(300);
			jQuery('#theme-my-account').find('.grid').delay(100).animate({'opacity': 1}, 1000);
		} else {
			jQuery('#theme-my-account').removeClass('active');
			jQuery('#theme-my-account').find('.grid').animate({'opacity': 0}, 200,
				function() {
					jQuery('#theme-my-account').stop(true,true).slideUp(300);
				});
		}
	});

	// Cart
	jQuery('#icon-cart').click(function(e) {
		if( ! jQuery('#theme-cart').hasClass('active') ) {
			pullDown();
			jQuery('#theme-cart').addClass('active');
			jQuery('#theme-cart').slideDown(300);
			jQuery('#theme-cart').find('.grid').delay(100).animate({'opacity': 1}, 1000);
		} else {
			jQuery('#theme-cart').removeClass('active');
			jQuery('#theme-cart').find('.grid').animate({'opacity': 0}, 200,
				function() {
					jQuery('#theme-cart').stop().slideUp(300);
				});
		}
	});

	// Remove icon
	jQuery('.remove-icon').each(function(index, element) {
		var element = jQuery(element);

		element.click(function(){
			element.parent().parent().removeClass('active');
			element.parent().animate({'opacity': 0}, 300);
			element.parent().parent().delay(300).slideUp(300);
		});
	});

	// Show/Hide Background
	var show = false;
	var hide = true;
	jQuery('#hide-show-bg .icon-minus').click(function(e) {
		e.preventDefault();
		if (hide) {
			show = true;
			hide = false;
			jQuery("#container").animate({
				"left": "-=2800px"
			}, "slow");
			//$("#show-wall-image").css("display","none");
			//$("#show-wall").removeClass("show-download");
			jQuery('#hide-show-bg .icon-plus').removeClass('current');
			jQuery('#hide-show-bg .icon-minus').addClass('current');
		}
	});
	jQuery('#hide-show-bg .icon-plus').click(function(e) {
		e.preventDefault();
		if (show) {
			show = false;
			hide = true;
			jQuery("#container").animate({
				"left": "+=2800px"
			}, "slow");
			//$("#show-wall-image").css("display","block");
			//$("#show-wall").addClass("show-download");
			//$('#show-wall').html("Show site");
			jQuery('#hide-show-bg .icon-plus').addClass('current');
			jQuery('#hide-show-bg .icon-minus').removeClass('current');
		}
	});
	//Icon tooltip
	jQuery('.icon-tip').each(function(index, element) {
		var element = jQuery(element);
		element.tooltipsy();
	});
	jQuery(".comment-reply-link").click(function() {
		//jQuery("#respond").slideDown("slow");
		jQuery("#respond").hide().slideDown('slow');
	});

	//** Fix Smoothness for breadcrumb and 
	jQuery('.entry-meta-list .detail').css({'display':'block'});
	var breadwidth = jQuery('.breadcrumb-list').width();
	var postedwidth = jQuery('.posted-on-pnl').width();
	jQuery('.entry-meta-list .detail').css({'display':'none'});

	jQuery('.breadcrumb-list').css({width:breadwidth+10, 'display':'block'});
	jQuery('.posted-on-pnl').css({width:postedwidth+10, 'display':'block'});
	

	//Post/Page Icons Hover
	jQuery('.entry-meta-list .icon').each(function(index, element) {
		var element = jQuery(element);

		element.click(function () {

			if( element.hasClass('active') ){
				element.removeClass('active');
				element.next('.detail').removeClass('active');
				var detH = element.parent().find('.icon').height();
		    	//element.next('.detail').hide(300);
				
		    	element.next('.detail').animate({height : detH, width: 'toggle'}, 500, 'linear');
		    } else {

			    if ( element.parent().find('.icon').hasClass('active') )
				    element.parent().find('.icon').removeClass('active');

		    	if ( element.parent().find('.detail').hasClass('active') ){
				   // element.parent().find('.detail.active').hide(300);
				    var elH = element.parent().find('.icon').height();
				    element.parent().find('.detail.active').stop().animate({height: elH, width: 'toggle'}, 500, 'linear').removeClass('active');
				    //element.parent().find('.detail').removeClass('active');
				}

				element.addClass('active');
			    //element.next('.detail').addClass('active');
				var det2H = element.parent().find('.icon').height();
		    	//element.next('.detail').show(300);
		    	element.next('.detail').stop().animate({height: det2H, width: 'toggle'}, 500, 'easeInOutSine').addClass('active');
		    }
		  });
	});

	// Footer Tabs
	//
	jQuery('#footer-widget-area').each(function() {
		var tabContainer = jQuery(this);
		var tabTitleList = jQuery('.titles', tabContainer);
		var tabContentList = jQuery('.content', tabContainer);
		var contentWidth = tabContainer.width();

		// Tab buttons
		jQuery('.shortcode-tab-title', this).each(function(index, element) {
			var tabTitle = jQuery(this);
			var tabContent = tabTitle.next();

			// Move title into title container
			tabTitle.detach();
			tabTitleList.append(tabTitle);

			// Move content into content container
			tabContent.detach();
			tabContentList.append(tabContent);

			// Hide all but the first tab
			if (index > 0)
				tabContent.hide();
			else {

				if( tabContainer.hasClass('openTab') ){
					tabTitle.addClass('active');
					tabTitle.find('i').removeClass('icon-plus');
					tabTitle.find('i').addClass('icon-minus');
				} else
					tabContent.hide();

			}

			function findIcon(element){
				var thisTitle = element;
				var titleIcon = thisTitle.find('i');

				jQuery('.shortcode-tab-title').find('i').removeClass('icon-minus');
				jQuery('.shortcode-tab-title').find('i').addClass('icon-plus');

				if (titleIcon.hasClass('icon-plus') && !titleIcon.parent().hasClass('active') ) {
					titleIcon.removeClass('icon-plus');
					titleIcon.addClass('icon-minus');
				}

			}

			// Tab title click
			tabTitle.click(function() {

				if (tabContent.css('display') !== 'none'){

					tabContent.slideToggle(500);
					findIcon(tabTitle);
				} else {

					// Toggle tab style and content visibility
					tabContainer.find('.shortcode-tab:visible').slideToggle(500);
					tabTitleList.find('.active').removeClass('active');
					tabContent.slideToggle(500);
					findIcon(tabTitle);
				}

				// Always scroll to the bottom
				jQuery('html, body').animate({scrollTop: jQuery(document).height()+jQuery('footer-widget-area').height()}, 500);

				tabTitle.addClass('active');
			});
		});
	});

	adjustHeadMenu();

});
jQuery(window).load(function() {
	jQuery('#container').each(function(index, element) {
		var element = jQuery(element);
		element.css({
			'opacity': 1
		});
	});
	// Remove loader when ready
	jQuery('.core-loader').delay(50).fadeOut(150);
	// Sidebar Heights
	var width = jQuery(window);

	if (width <= 768 ) {

        // Correct the sidebar borders
		var minContentHeight = jQuery('#content-main .theme-content').height();
		var maxContentHeight = minContentHeight;
		if(jQuery('#content-main .theme-sidebar').length > 0 ) {
			jQuery('#content-main .theme-sidebar').each(function(index, element){
				var element = jQuery(element);
				var elementHeight = element.height();

				if ( elementHeight > maxContentHeight ){
					maxContentHeight = elementHeight;
				}

			});
		}

		if ( jQuery('#content-main .theme-content').find('#content-woocommerce').length < 1 ) {
			jQuery('#content-main .theme-content').stop(true, true).animate({height: maxContentHeight }, 350);
			jQuery('#content-main .theme-sidebar').stop(true, true).animate({height: maxContentHeight }, 350);
		}

	}
	adjustHeadMenu();

});
/*!
 * Responsive JS Plugins v1.2.2
 */
// Placeholder
jQuery(function() {
	//jQuery('input[placeholder], textarea[placeholder]').placeholder();
});
// Have a custom video player? We now have a customSelector option where you can add your own specific video vendor selector (mileage may vary depending on vendor and fluidity of player):
// jQuery("#thing-with-videos").fitVids({ customSelector: "iframe[src^='http://example.com'], iframe[src^='http://example.org']"});
// Selectors are comma separated, just like CSS
// Note: This will be the quickest way to add your own custom vendor as well as test your player's compatibility with FitVids.
// To top
//

function toTop() {
	var TOP_MINIMUM = 200;
	var ANIMATE_SPEED = 500;
	var toTop = jQuery('.scroll-top');

	function updateToTop() {
		var scrollTop = jQuery(window).scrollTop();
		if (scrollTop > TOP_MINIMUM) toTop.stop(true, true).slideDown(ANIMATE_SPEED);
		else if (scrollTop <= TOP_MINIMUM) toTop.stop(true, true).slideUp(ANIMATE_SPEED);
	}
	jQuery(window).scroll(updateToTop);
	updateToTop();
	// To top button
	toTop.bind('click', function() {
		jQuery('html, body').stop(true, true).animate({
			scrollTop: 0
		}, ANIMATE_SPEED);
		return false;
	});
}

function pullDown() {
	var item = jQuery('.pull-down');
	item.each(function(index, element) {
		var element = jQuery(element);

		if( element.hasClass('active') ) {
			element.slideUp(300);
			element.find('.grid').animate({'opacity': 0}, 300);
			element.removeClass('active');
		}
	});
}
function adjustHeadMenu() {
	var logoH = jQuery('#menu-logo').height();
	var menuH = jQuery('#site-navigation').height();
	var diffH = 0;
	if(logoH > menuH) {
		diffH = (logoH - menuH)/2;
		jQuery('#site-navigation').animate({marginTop: diffH},300)
	}else{
		//diffH = (menuH - logoH)/2;
		//jQuery('#menu-logo').animate({marginTop: diffH},300)
	}
	
}


jQuery(window).scroll(function() {
	 adjustHeaderPanel();
});
jQuery(window).resize(function() {
	adjustHeaderPanel();
});

function adjustHeaderPanel(){
	var scrollTop = jQuery(window).scrollTop();
	var topMargin = jQuery('.theme-wrap').height();
	var mainContentW = jQuery('#container').width()

	var menuHt = jQuery('#site-navigation').height();


	if(scrollTop > topMargin)
	{
		jQuery('#theme-nav').css({'position':'fixed', 'width' : mainContentW,'border-bottom': '1px solid #000000','background-color':'#ffffff', 'border-top': '2px solid #000000'}		
		).stop().animate({top:0},100,
			function(){
				jQuery('#menu-logo img').animate({height:menuHt},300, function(){jQuery('#site-navigation').animate({marginTop:0},100)} );
			}
		);
	}else{
		var imgTempLogoH = jQuery('#menu-logo img').height();
		var imgLogoH = jQuery('#menu-logo img').css({'height':'auto'});
		imgLogoH = jQuery('#menu-logo img').height();
		jQuery('#menu-logo img').css({height:imgTempLogoH });
		jQuery('#theme-nav').css({'position':'relative', 'width' : '100%','border-bottom': 'none','background-color':'transparent', 'border-top': 'none'}		
		).stop().animate({top:'auto'},100,
			function(){
				jQuery('#menu-logo img').animate({height:imgLogoH},300, function(){adjustHeadMenu();});
			}
		);
	}
}
