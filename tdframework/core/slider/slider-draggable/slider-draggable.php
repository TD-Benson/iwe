<?php
$categories = get_categories(array(
         'type'      => 'post',
         'orderby'      => 'name',
         'order'        => 'ASC',
         'hide_empty'   => 0,
));
$draggablecategories = array();

foreach($categories as $category):
  $title = $category->name ;
  $draggablecategories[$title] =  $title ;
endforeach;



$slider = array(
	'name' => __('Draggable slider', THEME_SLUG),
	'scripts' => array(
		'jquery' => '',
		'draggablebox-script-tml' => CORE_URI . '/slider/slider-draggable/jquery.tmpl.min.js',
		'draggablebox-script-kinetic' => CORE_URI . '/slider/slider-draggable/jquery.kinetic.js',
		'draggablebox-script-easing' => CORE_URI . '/slider/slider-draggable/jquery.easing.1.3.js',
		'draggablebox-script-swipe' => CORE_URI . '/slider/slider-draggable/jquery.touchSwipe.js',
	),
	'styles' => array(
		'draggablebox-style' => CORE_URI . '/slider/slider-draggable/draggablebox.css',
	),
	'output' => 'theme_draggablebox_output',

	// General settings
	'options' => array(
		'category' => array(
			'type' => 'select',
			'items' => $draggablecategories ,
			'title' => __('Select Category', THEME_SLUG),
		),
		'max_post' => array(
			'type' => 'number',
			'title' => __('Maximum Number of Posts', THEME_SLUG),
			'default' => '100',
		),
		'slide_height' => array(
			'type' => 'number',
			'title' => __('Slider Height', THEME_SLUG),
			'default' => '500',
		),
		'slide_rowimgnum' => array(
			'type' => 'number',
			'title' => __('Number of Images in a Row', THEME_SLUG),
			'default' => '10',
		)

	),

	// Options for individual slides
);

core_slider_register($slider);

function theme_draggablebox_output($settings) {

	$slider_settings = $settings['settings'];
	$id = core_get_uuid('theme-slider-');

	$defbox = 10;
	if ($slider_settings['slide_rowimgnum'] == ''){
		$defbox = 10;
	}
	else
	{
		$defbox = $slider_settings['slide_rowimgnum'];
	}
	$boxContainerwidth = 230 * $defbox;


	echo '<script id="previewTmpl" type="text/x-jquery-tmpl">
			<div id="ib-img-preview" class="ib-preview">
                <img src="${src}" alt="" class="ib-preview-img"/>
                <span class="ib-preview-descr" style="display:none;">${description}</span>
                <div class="ib-nav" style="display:none;">
                    <span class="ib-nav-prev icon-angle-left"></span>
                    <span class="ib-nav-next icon-angle-right"> </span>
                </div>
                <span class="ib-close icon-remove" style="display:none;"></span>
                <div class="ib-loading-large" style="display:none;">Loading...</div>
            </div>
		</script>
		<script id="contentTmpl" type="text/x-jquery-tmpl">
			<div id="ib-content-preview" class="ib-content-preview">
                <div class="ib-teaser" style="display:none;">{{html teaser}}</div>
                <div class="ib-content-full" style="display:none;">{{html content}}</div>
                <span class="ib-close icon-remove" style="display:none;"></span>
            </div>
		</script>';
?>
<div id="draggable-container" style="height:<?php echo $slider_settings['slide_height']; ?>px">
<div id="ib-main-wrapper" class="ib-main-wrapper">
	<div class="ib-main">
		<?php
		query_posts( 'posts_per_page='.$slider_settings['max_post'] );
		if ( have_posts() ) while ( have_posts() ) : the_post();
			//$ShowContent = get_post_meta($post->ID, '_screen-displayboxcontent', true);
			$ShowContent = true;
				if ( in_category($slider_settings['category'])) {
				$med_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'boxtype');
				$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
				if ($med_image_url != ''){
				echo '<a href="' . $large_image_url[0] . '" title="' . get_the_title() . '" >';
				echo '<img src="'.$med_image_url[0].'" data-largesrc="'.$large_image_url[0].'" alt="image01"/><span>'.get_the_title().'</span>';
				echo '</a>';
				}else{
					?>
					<a href="#" class="ib-content">
						<div class="ib-teaser">
							<h2><?php echo get_the_title();  ?></h2>
						</div>
						<div class="ib-content-full">
								<?php echo the_content();?>
						</div>
					</a>
					<?php
				}
				}
			endwhile;
		?>
		<?php wp_reset_query(); ?>

		<div class="clr"></div>
	</div>
	<!-- ib-main -->
</div>
</div>
<style type="text/css">
.ib-main
{
	width:<?php echo $boxContainerwidth; ?>px;
}
</style>
<script type="text/javascript">
	jQuery.noConflict();
	jQuery(document).ready(function(){
		var divHeight = jQuery("#draggable-container").height();
		jQuery("#ib-main-wrapper").css({height: divHeight});

	});

            jQuery(function() {
				var jQueryibWrapper	= jQuery('#ib-main-wrapper'),
					Template	= (function() {
							// true if dragging the container
						var kinetic_moving				= false,
							// current index of the opened item
							current						= -1,
							// true if the item is being opened / closed
							isAnimating					= false,
							// items on the grid
							jQueryibItems					= jQueryibWrapper.find('div.ib-main > a'),
							// image items on the grid
							jQueryibImgItems					= jQueryibItems.not('.ib-content'),
							// total image items on the grid
							imgItemsCount				= jQueryibImgItems.length,
							init						= function() {
								// add a class ib-image to the image items
								jQueryibImgItems.addClass('ib-image');
								// apply the kinetic plugin to the wrapper
								loadKinetic();
								// load some events
								initEvents();
							},
							loadKinetic					= function() {
								setWrapperSize();
								jQueryibWrapper.kinetic({
									moved	: function() {
										kinetic_moving = true;
									},
									stopped	: function() {
										kinetic_moving = false;
									}
								});
							},
							setWrapperSize				= function() {
								var containerMargins	= jQuery('#ib-top').outerHeight(true) + jQuery('#header').outerHeight(true) + parseFloat( jQueryibItems.css('margin-top') );
								//jQueryibWrapper.css( 'height', jQuery(window).height() - containerMargins )
								//jQueryibWrapper.css( 'height', jQuery(window).height() - containerMargins - 2 )
							},
							initEvents					= function() {
								// open the item only if not dragging the container
								jQueryibItems.bind('click.ibTemplate', function( event ) {
									if( !kinetic_moving )
										openItem( jQuery(this) );
									return false;
								});
								// on window resize, set the wrapper and preview size accordingly
								jQuery(window).bind('resize.ibTemplate', function( event ) {
									setWrapperSize();
									jQuery('#ib-img-preview, #ib-content-preview, .rasterizeBox').css({
										width	: jQuery(window).width(),
										height	: jQuery(window).height()
									})
								});
							},
							openItem					= function( jQueryitem ) {
								if( isAnimating ) return false;
								// if content item
								if( jQueryitem.hasClass('ib-content') ) {
									isAnimating	= true;
									current	= jQueryitem.index('.ib-content');
									loadContentItem( jQueryitem, function() { isAnimating = false; } );
								}
								// if image item
								else {
									isAnimating	= true;
									current	= jQueryitem.index('.ib-image');
									loadImgPreview( jQueryitem, function() { isAnimating = false; } );
								}
							},
							// opens one image item (fullscreen)
							loadImgPreview				= function( jQueryitem, callback ) {
								var largeSrc		= jQueryitem.children('img').data('largesrc'),
									description		= jQueryitem.children('span').text(),
									largeImageData	= {
										src			: largeSrc,
										description	: description
									};
								// preload large image
								jQueryitem.addClass('ib-loading');
								preloadImage( largeSrc, function() {
									jQueryitem.removeClass('ib-loading');
									var hasImgPreview	= ( jQuery('#ib-img-preview').length > 0 );
									if( !hasImgPreview )
										jQuery('#previewTmpl').tmpl( largeImageData ).insertAfter( jQueryibWrapper );
									else
										jQuery('#ib-img-preview').children('img.ib-preview-img')
															.attr( 'src', largeSrc )
															.end()
															.find('span.ib-preview-descr')
															.text( description );
									//get dimentions for the image, based on the windows size
									var	dim	= getImageDim( largeSrc );
									jQueryitem.removeClass('ib-img-loading');
									//set the returned values and show/animate preview
									jQuery('#ib-img-preview').css({
										width	: jQueryitem.width(),
										height	: jQueryitem.height(),
										left	: jQueryitem.offset().left,
										//top		: jQueryitem.offset().top
									}).children('img.ib-preview-img').hide().css({
										width	: dim.width,
										height	: dim.height,
										left	: dim.left,
										top		: dim.top
									}).fadeIn( 400 ).end().show().animate({
										width	: jQuery(window).width(),
										left	: 0
									}, 500, 'easeOutExpo', function() {
										jQuery(this).animate({
											height	: jQuery(window).height(),
											top		: 0
										}, 400, function() {
											var jQuerythis	= jQuery(this);
											jQuerythis.find('span.ib-preview-descr, span.ib-close').show()
											if( imgItemsCount > 1 )
												jQuerythis.find('div.ib-nav').show();
											if( callback ) callback.call();
										});
									});
									if( !hasImgPreview )
										initImgPreviewEvents();
								} );
							},
							// opens one content item (fullscreen)
							loadContentItem				= function( jQueryitem, callback ) {
								var hasContentPreview	= ( jQuery('#ib-content-preview').length > 0 ),
									teaser				= jQueryitem.children('div.ib-teaser').html(),
									content				= jQueryitem.children('div.ib-content-full').html(),
									contentData			= {
										teaser		: teaser,
										content		: content
									};
								if( !hasContentPreview )
									jQuery('#contentTmpl').tmpl( contentData ).insertAfter( jQueryibWrapper );
								//set the returned values and show/animate preview
								jQuery('#ib-content-preview').css({
									width	: jQueryitem.width(),
									height	: jQueryitem.height(),
									left	: jQueryitem.offset().left,
									top		: jQueryitem.offset().top
								}).show().animate({
									width	: jQuery(window).width(),
									left	: 0
								}, 500, 'easeOutExpo', function() {
									jQuery(this).animate({
										height	: jQuery(window).height(),
										top		: 0
									}, 400, function() {
										var jQuerythis	= jQuery(this),
											jQueryteaser	= jQuerythis.find('div.ib-teaser'),
											jQuerycontent= jQuerythis.find('div.ib-content-full'),
											jQueryclose	= jQuerythis.find('span.ib-close');
										if( hasContentPreview ) {
											jQueryteaser.html( teaser )
											jQuerycontent.html( content )
										}
										jQueryteaser.show();
										jQuerycontent.show();
										jQueryclose.show();
										if( callback ) callback.call();
									});
								});
								if( !hasContentPreview )
									initContentPreviewEvents();
								jQuery('.ib-content-full').css({
									height	: jQuery(window).height() - 200
								});
							},
							// preloads an image
							preloadImage				= function( src, callback ) {
								jQuery('<img/>').load(function(){
									if( callback ) callback.call();
								}).attr( 'src', src );
							},
							// load the events for the image preview : navigation ,close button, and window resize
							initImgPreviewEvents		= function() {
								var jQuerypreview	= jQuery('#ib-img-preview');
								jQuerypreview.find('span.ib-nav-prev').bind('click.ibTemplate', function( event ) {
									navigate( 'prev' );
								}).end().find('span.ib-nav-next').bind('click.ibTemplate', function( event ) {
									navigate( 'next' );
								}).end().find('span.ib-close').bind('click.ibTemplate', function( event ) {
									closeImgPreview();
								});
								//resizing the window resizes the preview image
								jQuery(window).bind('resize.ibTemplate', function( event ) {
									var jQuerylargeImg	= jQuerypreview.children('img.ib-preview-img'),
										dim			= getImageDim( jQuerylargeImg.attr('src') );
									jQuerylargeImg.css({
										width	: dim.width,
										height	: dim.height,
										left	: dim.left,
										top		: dim.top
									})
								});
								//Enable swiping...
								  jQuery("#ib-img-preview").swipe( {
									//Generic swipe handler for all directions
									swipeRight:function(event) {
										navigate( 'next' );
									},
									swipeLeft:function(event) {
										navigate( 'prev' );
									},
									swipeUp:function(event) {
										closeImgPreview();
									},
									swipeDown:function(event) {
										closeImgPreview();
									},
									//Default is 75px, set to 0 for demo so any distance triggers swipe
									threshold:0
								  });
							},
							// load the events for the content preview : close button
							initContentPreviewEvents	= function() {
								jQuery('#ib-content-preview').find('span.ib-close').bind('click.ibTemplate', function( event ) {
									closeContentPreview();
								});
							},
							// navigate the image items in fullscreen mode
							navigate					= function( dir ) {
								if( isAnimating ) return false;
								isAnimating		= true;
								var jQuerypreview	= jQuery('#ib-img-preview'),
									jQueryloading	= jQuerypreview.find('div.ib-loading-large');
								jQueryloading.show();
								if( dir === 'next' ) {
									( current === imgItemsCount - 1 ) ? current	= 0 : ++current;
								}
								else if( dir === 'prev' ) {
									( current === 0 ) ? current	= imgItemsCount - 1 : --current;
								}
								var jQueryitem		= jQueryibImgItems.eq( current ),
									largeSrc	= jQueryitem.children('img').data('largesrc'),
									description	= jQueryitem.children('span').text();
								preloadImage( largeSrc, function() {
									jQueryloading.hide();
									//get dimentions for the image, based on the windows size
									var	dim	= getImageDim( largeSrc );
									jQuerypreview.children('img.ib-preview-img').fadeOut(800, function() {
														jQuery('img.ib-preview-img').attr('src', largeSrc)
														.css({
														width	: dim.width,
														height	: dim.height,
														left	: dim.left,
														top		: dim.top
														});
													}).fadeIn(800)
													.css({
													width	: dim.width,
													height	: dim.height,
													left	: dim.left,
													top		: dim.top
													})
													.end();
									jQuerypreview.children('span.ib-preview-descr').fadeOut(800, function()
													{
													jQuerypreview.children('span.ib-preview-descr').text( description );
													}
													);
									jQuerypreview.children('span.ib-preview-descr')
													.fadeIn(1500);

									jQueryibWrapper.scrollTop( jQueryitem.offset().top )
											  .scrollLeft( jQueryitem.offset().left );

									isAnimating	= false;

								});
							},
							// closes the fullscreen image item
							closeImgPreview				= function() {

								if( isAnimating ) return false;

								isAnimating	= true;

								var jQueryitem	= jQueryibImgItems.eq( current );

								jQuery('#ib-img-preview').find('span.ib-preview-descr, div.ib-nav, span.ib-close')
												.hide()
												.end()
												.animate({
													height	: jQueryitem.height(),
													top		: jQueryitem.offset().top
													}, 500, 'easeOutExpo', function() {

													jQuery(this).animate({
														width	: jQueryitem.width(),
														left	: jQueryitem.offset().left
														}, 400, function() {

															jQuery(this).fadeOut(function() {isAnimating	= false;});

													} );
												});
							},
							// closes the fullscreen content item
							closeContentPreview			= function() {
								if( isAnimating ) return false;
								isAnimating	= true;
								var jQueryitem	= jQueryibItems.not('.ib-image').eq( current );
								jQuery('#ib-content-preview').find('div.ib-teaser, div.ib-content-full, span.ib-close')
														.hide()
														.end()
														.animate({
															height	: jQueryitem.height(),
															top		: jQueryitem.offset().top
														}, 500, 'easeOutExpo', function() {

															jQuery(this).animate({
																width	: jQueryitem.width(),
																left	: jQueryitem.offset().left
															}, 400, function() {

																jQuery(this).fadeOut(function() {isAnimating	= false;});

															} );
														});
							},
							// get the size of one image to make it full size and centered
							getImageDim			= function( src ) {
								var img = '';
								 img     	= new Image();
								img.src     	= src;
								var w_w	= jQuery(window).width(),
									w_h	= jQuery(window).height(),

									i_w	= 0,
									i_h	= 0,
									w_sf = 0,
									h_sf = 0,
									m_t=0,
									m_l=0;

								i_w	= img.width;
								i_h	= img.height;
								w_sf = w_w/i_w;
								h_sf = w_h/i_h;

								if((w_sf * i_h) > w_h)
								{
								  ni_w = w_w;
								  // base on height
								  ni_h = w_sf * i_h;
								  m_t = -(ni_h - w_h)/2;
								  m_l = 0;
								}else if((w_sf * i_h) < w_h)
								{
								  // base on height
								  ni_h = w_h;
								  ni_w = h_sf * i_w;
								  m_l = -(ni_w - w_w)/2;
								  m_t = 0;
								}
								else
								{
									i_w = w_w;
									i_h = w_h;
									m_l:0;
									m_t:0;
								}


								return {
									width	: ni_w,
									height	: ni_h,
									left	: m_l,
									top		: m_t
								};
							};
						return { init : init };
					})();
				Template.init();
            });
        </script>
<?php
}
add_image_size( 'boxtype', 250, 250, true);


?>