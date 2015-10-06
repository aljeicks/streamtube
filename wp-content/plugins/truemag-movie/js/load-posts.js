jQuery(document).ready(function($) {

	// The number of the next page to load (/page/x/).
	var pageNum = parseInt(pbd_alp.startPage) + 1;
	
	// The maximum number of pages the current query can return.
	var max = parseInt(pbd_alp.maxPages);
	
	// The link of the next page of posts.
	var nextLink = pbd_alp.nextLink;
	// Text 1.
	var textLb1 = pbd_alp.textLb1;
	// Text 2.
	var textLb2 = pbd_alp.textLb2;
	// check link.
	var ot_permali = pbd_alp.ot_permali;
	// Quick view.
	var quick_view = pbd_alp.quick_view;
	/**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	 */
	if(pageNum <= max) {
		// Insert the "More Posts" link.
		$('.tm_load_ajax')
			.append('<div class="ajax-load-post pbd-alp-placeholder-'+ pageNum +'"></div>')
			.append('<p id="pbd-alp-load-posts"><a href="#" class="light-button btn btn-default btn-lg btn-block">'+ textLb1 +'...</a></p>');
			
		// Remove the traditional navigation.
		$('.navigation').remove();
	}
	
	
	/**
	 * Load new posts when the link is clicked.
	 */
	$('#pbd-alp-load-posts a').click(function() {
	
		// Are there more posts to load?
		if(pageNum <= max) {
		
			// Show that we're working.
			$(this).text(textLb2+'...');
			
			$('.pbd-alp-placeholder-'+ pageNum).load(nextLink + ' .post_ajax_tm',
				function() {
					// Update page number and nextLink.
					pageNum++;
					if(ot_permali){
						nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/');
						nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
					} else {
						//alert(pageNum);
						nextLink = nextLink.replace(/paged\=[0-9]?/, 'paged=');
						nextLink = nextLink.replace(/paged\=[0-9]?/, 'paged='+ pageNum);						
						//alert(nextLink);
					}
					// Add a new placeholder, for when user clicks again.
					$('#pbd-alp-load-posts')
						.before('<div class="ajax-load-post pbd-alp-placeholder-'+ pageNum +'"></div>')
					
					// Update the button message.
					if(pageNum <= max) {
						$('#pbd-alp-load-posts a').text( textLb1+'...');
					} else {
						$('#pbd-alp-load-posts a').css('display','none');
					}
				}
			);
		} else {
			$('#pbd-alp-load-posts a').append('.');
		}	
		$(document).ajaxSuccess(function(){
			//jQuery(".html5lightbox").html5lightbox();
			jQuery(".youtube").colorbox({iframe:true, innerWidth:480, innerHeight:320});
			jQuery(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:409});			
			// Tooltip only Text
			jQuery('.qv_tooltip').tooltipster({
						contentAsHTML: true,
						position: 'right',
						interactive: true,
						fixedWidth:250,
						//theme: 'tm-quickview'
			});			
			jQuery(".is-carousel").each(function(){
				var carousel_id = jQuery(this).attr('id');
				var carousel_effect = jQuery(this).data('effect')?jQuery(this).data('effect'):'scroll';
				var carousel_auto = jQuery(this).data('notauto')?false:true;
				smartboxcarousel = jQuery(this).find(".smart-box-content");
				if(smartboxcarousel.length){
					smcarousel = smartboxcarousel.carouFredSel({
						responsive  : true,
						items       : {
							visible	: 1,
							width       : 750,
							height      : "variable"
						},
						circular: true,
						infinite: true,
						width 	: "100%",
						height	: "variable",
						auto 	: false,
						align 	: "left",
						prev	: {	
							button	: "#"+carousel_id+" .prev",
							key		: "left"
						},
						next	: { 
							button	: "#"+carousel_id+" .next",
							key		: "right"
						},
						scroll : {
							items : 1,
							fx : carousel_effect
						},
						swipe       : {
							onTouch : false,
							onMouse : false,
							items	: 1
						}
					}).imagesLoaded( function() {
						smcarousel.trigger("updateSizes");
					});
				}//if length
				//top carousel
				topcarousel = jQuery(this).find(".carousel-content");
				if(topcarousel.length){
					if(carousel_id=='big-carousel'){
						visible = 3;
						align = "center";
					}else{
						visible = 0;
						align = false;
					}
					tcarousel = topcarousel.carouFredSel({
						responsive  : false,
						items       : {
							visible	: function(visibleItems){
								if(visible>0){
									if(visibleItems>=3){
										return 5;
									}else{
										return 3;
									}
								}else{return visibleItems+1;}
							},
							minimum	: 1,
						},
						circular: true,
						infinite: true,
						width 	: "100%",
						auto 	: {
							play	: carousel_auto,
							timeoutDuration : 2600,
							duration        : 800,
							pauseOnHover: "immediate-resume"
						},
						align	: align,
						prev	: {	
							button	: "#"+carousel_id+" .prev",
							key		: "left"
						},
						next	: { 
							button	: "#"+carousel_id+" .next",
							key		: "right"
						},
						scroll : {
							items : 1,
							fx : "scroll",
							easing : 'quadratic',
							onBefore : function( data ) {
								jQuery(".video-item").removeClass('current-carousel-item').removeClass('current-carousel-item2');
								var current_item_count=0;
								data.items.visible.each(function(){
									current_item_count++;
									if(current_item_count==2){jQuery(this).addClass( "current-carousel-item2" );}
									jQuery(this).addClass( "current-carousel-item" );
								});
							}
						},
						swipe       : {
							onTouch : false,
							onMouse : false,
						}
					}).imagesLoaded( function() {
						tcarousel.trigger("updateSizes");
						tcarousel.trigger("configuration", {
								items       : {
									visible	: function(visibleItems){
										if(visible>0){
											if(visibleItems>=3){
												return 5;
											}else{
												return 3;
											}
										}else{return visibleItems+1;}
									},
								},
							}
						);
					});
					topcarousel.swipe({
						allowPageScroll : 'vertical',
						swipeStatus:function(event, phase, direction, distance, duration, fingers)
						{
						  //phase : 'start', 'move', 'end', 'cancel'
						  //direction : 'left', 'right', 'up', 'down'
						  //distance : Distance finger is from initial touch point in px
						  //duration : Length of swipe in MS 
						  //fingerCount : the number of fingers used
						  if(phase=='move'){
							  if(direction=='left'||direction=='right'){
								  jQuery(this).css('transform','translateX('+(direction=='left'?'-':'')+distance+'px)');
							  }
						  }
						  if(phase=='end'){
							  item_to_next = distance>520?2:1;
							  direction_to_next = direction=='left'?'next':'prev';
							  jQuery(this).trigger(direction_to_next,item_to_next);
							  jQuery(this).css('transform','translateX(0px)');
						  }
						}
					});
					jQuery(".carousel-content").trigger("currentVisible", function( current_items ) {
						var current_item_count=0;
						current_items.each(function(){
							current_item_count++;
							if(current_item_count==2){jQuery(this).addClass( "current-carousel-item2" );}
							jQuery(this).addClass( "current-carousel-item" );
						});
					});
				}//if length
				//classy carousel
				classycarousel = jQuery(this).find(".classy-carousel-content");
				if(classycarousel.length){
					if(carousel_id=='stage-carousel'){
						cscarousel = classycarousel.carouFredSel({
							responsive  : true,
							items       : {
								visible	: 1,
								minimum	: 1,
								width   : 740,
								height  : "variable"
							},
							circular: true,
							infinite: true,
							width 	: "100%",
							auto 	: {
								play	: carousel_auto,
								timeoutDuration : 3600,
								duration        : 850,
								pauseOnHover: "immediate-resume"
							},
							align	: "center",
							scroll : {
								items : 1,
								fx : "scroll",
								easing : 'quadratic',
								onBefore: function() {
									var pos = jQuery(this).triggerHandler( 'currentPosition' );
									jQuery('.classy-carousel-content .video-item').removeClass( 'selected' );
									jQuery('.classy-carousel-content .video-item.item'+pos).addClass( 'selected' );
									var page = Math.floor( pos / 1 );
									jQuery('#control-stage-carousel .classy-carousel-content').trigger( 'slideToPage', page );
								}
							},
							swipe       : {
								onTouch : true,
								onMouse : false,
								items	: 1
							}
						}).imagesLoaded( function() {
							cscarousel.trigger("updateSizes");
						});
					}else{
						if(jQuery(window).width()<768){
							c_height = 198;
						}else{
							c_height = 363;
						}
						ccarousel = classycarousel.carouFredSel({
							responsive  : false,
							items       : {
								visible	: 4,
								minimum	: 1
							},
							direction: 'up',
							circular: true,
							infinite: true,
							width 	: "variable",
							height: c_height,
							auto 	: false,
							prev	: {	
								button	: "#"+carousel_id+" .control-up"
							},
							next	: { 
								button	: "#"+carousel_id+" .control-down"
							},
							align	: false,
							scroll : {
								items : 1,
								fx : "scroll",
								onBefore : function( data ) {
									jQuery(".video-item").removeClass('current-carousel-item').removeClass('current-carousel-item2');
									var current_item_count=0;
									data.items.visible.each(function(){
										current_item_count++;
										if(current_item_count==1){jQuery(this).addClass( "current-carousel-item2" );}
										jQuery(this).addClass( "current-carousel-item" );
									});
								}
							},
							swipe       : {
								onTouch : true,
								onMouse : false,
								items	: 1
							}
						}).imagesLoaded( function() {
							ccarousel.trigger("updateSizes");
						});
						jQuery(this).find(".classy-carousel-content").children().each(function(i) {
							jQuery(this).addClass( 'item'+i );
							jQuery(this).click(function() {
								jQuery('#stage-carousel .classy-carousel-content').trigger( 'slideTo', [i, 0, true] );
								return false;
							});
						});
					}
					jQuery(".classy-carousel-content").trigger("currentVisible", function( current_items ) {
						var current_item_count=0;
						current_items.each(function(){
							current_item_count++;
							if(current_item_count==1){jQuery(this).addClass( "selected" );}
						});
					});
				}//if length
				
				simplecarousel = jQuery(this).find(".simple-carousel-content");
				if(simplecarousel.length){
					scarousel = simplecarousel.carouFredSel({
						responsive  : true,
						items       : {
							visible	: 1,
							width       : 365,
							height      : "variable"
						},
						circular: true,
						infinite: true,
						width 	: "100%",
						auto 	: {
							play	: carousel_auto,
							timeoutDuration : 2600,
							duration        : 600
						},
						align	: 'center',
						pagination  : "#"+carousel_id+" .carousel-pagination",
						scroll : {
							items : 1,
							fx : "scroll",
						},
						swipe       : {
							onTouch : true,
							onMouse : false,
							items	: 1
						}
					}).imagesLoaded( function() {
						scarousel.trigger("updateSizes");
					});
				}//if length
			});//each
//			
		});
		return false;
	});
});