// IIFE to ensure safe use of $
(function( $ ) {

  // Create plugin
  jQuery.fn.tooltips = function(el) {

    var $tooltip,
      $body = $('body'),
      $el;

    // Ensure chaining works
    return this.each(function(i, el) {
    
      $el = $(el).attr("data-tooltip", i);

      // Make DIV and append to page 
      var $tooltip = $('<div class="tooltip" data-tooltip="' + i + '">' + $el.attr('title') + '<div class="arrow"></div></div>').appendTo(".mainblk-rposts");

      // Position right away, so first appearance is smooth
      var linkPosition = $el.position();

      $tooltip.css({
        top: linkPosition.top - $tooltip.outerHeight() - 20,
        //left: linkPosition.left - ($tooltip.width()/2) + 45
      	left: linkPosition.left,
		width: ($el.width() - 10) 
	  });
		$el.find("img").css({
			height:$el.width()
		});
      $el
      // Get rid of yellow box popup
      .removeAttr("title")

      // Mouseenter
      .hover(function() {

        $el = $(this);

        $tooltip = $('div[data-tooltip=' + $el.data('tooltip') + ']');

        // Reposition tooltip, in case of page movement e.g. screen resize                        
        var linkPosition = $el.position();
		//alert (linkPosition.top);
        $tooltip.css({
          top: linkPosition.top - $tooltip.outerHeight() - 20,
         //left: linkPosition.left - ($tooltip.width()/2) + 45
      	left: linkPosition.left,
		width: ($el.width() - 10) 
		});
		
		$el.fadeTo('slow', 0.5);
        // Adding class handles animation through CSS
        $tooltip.addClass("active");

        // Mouseleave
      }, function() {

        $el = $(this);

        // Temporary class for same-direction fadeout
        $tooltip = $('div[data-tooltip=' + $el.data('tooltip') + ']').addClass("out");

        // Remove all classes
        setTimeout(function() {
          $tooltip.removeClass("active").removeClass("out");
          }, 300);
		$el.fadeTo('slow', 1);

        });

      });

    }

})(jQuery);