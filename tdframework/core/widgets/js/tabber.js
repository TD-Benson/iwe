jQuery(document).ready(function() {

	jQuery('.tabber').each(function(index, tabberContainer) {
		tabberContainer = jQuery(tabberContainer);

		var contentElements = tabberContainer.find('.tabbertab');
		var navContainer = jQuery('<ul class="tabbernav"></ul>');
		var contentContainer = jQuery('<div class="tabbercontent"></div>');

		// Construct HTML layout
		contentElements.each(function(contentIndex, contentElement) {
			contentElement = jQuery(contentElement);

			// Build navigation element
			var contentTitle = contentElement.find('h3:first');
			var navElement = jQuery('<li>' + contentTitle.text() + '</li>');
			contentTitle.remove();

			// Store reference to content element
			navElement.data('content', contentElement);

			// Append new navigation element to navigation container
			navContainer.append(navElement);

			// Move tab content div into content container
			contentElement.detach();
			contentContainer.append(contentElement);
		});

		// Add navigation list
		tabberContainer.prepend(navContainer);
		tabberContainer.append(contentContainer);

		// Keep list of navigation elements
		var navElements = navContainer.children('li');

		// Show first tab
		var currentContent = jQuery(contentElements[0]);
		showTab(jQuery(navElements[0]));

		// Bind tab clicks
		navElements.bind('mousedown', function() {
			showTab(jQuery(this));
		});

		// Animates to a new tab
		function showTab(navElement) {
			var tabberContainerWidth = tabberContainer.width();

			var ANIMATE_SPEED = 350;

			if (navElement.hasClass('tabberactive'))
				return;

			// Set new content coordinates
			newContent = navElement.data('content');
			newContent.css('left', tabberContainerWidth + 'px');
			currentContent.css('left', '0px');

			// Move content blocks left, and adjust container height to the new content height
			currentContent.stop(true, true).animate({left: (-tabberContainerWidth) + 'px'}, ANIMATE_SPEED, 'linear');
			newContent.stop(true, true).animate({left: '0px'}, ANIMATE_SPEED, 'linear');
			contentContainer.stop(true, true).animate({height: newContent.outerHeight(true) + 'px'}, ANIMATE_SPEED, 'linear');

			// Toggle active classes
			navElements.removeClass('tabberactive');
			navElement.addClass('tabberactive');

			// Remember current content block
			currentContent = newContent;
		}
	});

});