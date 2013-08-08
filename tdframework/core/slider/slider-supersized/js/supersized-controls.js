
	
	jQuery(document).ready(function() {
		
	var outputctrl 	=	'<div id="prevthumb"></div>';
	outputctrl 	+= 	'<div id="nextthumb"></div>';
	
	//<!--Arrow Navigation-->
	outputctrl 	+=	'<a id="prevslide" class="load-item"></a>';
	outputctrl 	+=	'<a id="nextslide" class="load-item"></a>';
	
	outputctrl 	+=	'<div id="thumb-tray" class="load-item">';
	outputctrl 	+=	'<div id="thumb-back"></div>';
	outputctrl 	+=	'<div id="thumb-forward"></div>';
	outputctrl 	+=	'</div>';
	
	//<!--Time Bar-->
	outputctrl 	+=	'<div id="progress-back" class="load-item">';
	outputctrl 	+=	'<div id="progress-bar"></div>';
	outputctrl 	+=	'</div>';
	
	//<!--Control Bar-->
	outputctrl 	+=	'<div id="controls-wrapper" class="load-item">';
	outputctrl 	+=	'<div id="controls">';
			
	outputctrl 	+=	'<a id="play-button"><img id="pauseplay" src="http://localhost:56/ThemeDutch/Theme-Gazz/WebApp/wp-content/themes/gazz/tdframework/core/slider/slider-supersized/img/pause.png"/></a>';
		
			//<!--Slide counter-->
	outputctrl 	+=	'<div id="slidecounter">';
	outputctrl 	+=	'<span class="slidenumber"></span> / <span class="totalslides"></span>';
	outputctrl 	+=	'</div>';
			
			//<!--Slide captions displayed here-->
	outputctrl 	+=	'<div id="slidecaption"></div>';
			
			//<!--Thumb Tray button-->
	outputctrl 	+=	'<a id="tray-button"><img id="tray-arrow" src="http://localhost:56/ThemeDutch/Theme-Gazz/WebApp/wp-content/themes/gazz/tdframework/core/slider/slider-supersized/img/button-tray-up.png"/></a>';
			
			//<!--Navigation-->
	outputctrl 	+=	'<ul id="slide-list"></ul>';
			
	outputctrl 	+='</div>';
	outputctrl 	+='</div>';
		jQuery('body').append( outputctrl);
	});
