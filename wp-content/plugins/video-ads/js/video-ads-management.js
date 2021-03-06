	(function($){
		var minusDefault = 240;
		if($(window).width() < 1218){minusDefault = 0;}else{minusDefault = 240}

		var checkWidth = $('.video-player').width() - minusDefault;
		var checkHeight = checkWidth / 16 * 9;

    	$(window).resize(function() {
    		setTimeout(function(){
    			if($(window).width() < 1218){minusDefault = 0;}else{minusDefault = 240}
				checkWidth = $('.video-player').width() - minusDefault;
				checkHeight = checkWidth / 16 * 9;
				$('.cactus-video-list .cactus-video-item').css({"width": checkWidth + "px" , "height": checkHeight + "px"});
				$('.cactus-video-list .cactus-video-item .cactus-video-content').css({"width": checkWidth + "px" , "height": checkHeight + "px"});
				$('.cactus-video-list .cactus-video-item .cactus-video-ads iframe').css({"width": checkWidth + "px" , "height": checkHeight + "px"});
    		},400)
    	});

		$(document).ready(function() {

			/*Video Youtube Iframe*/
			var tag = document.createElement('script');
			tag.src = "https://www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
			/*Video Youtube Iframe*/

			var cactusAllVideoList='cactus-video-list';
			var cactusVideoItem='cactus-video-item';
			var cactusVideoDetails='cactus-video-details';
			var cactusVideoContent='cactus-video-content';
			var cactusVideoAds='cactus-video-ads';

			var $global_this='';
			var flag = [];
			var flag_vimeo = [];
			var flag_ads_vimeo = [];

			//youtube variable
			var cactus_player=[];
			var cactus_player_Ads=[];
			var cactus_player_Ads1=[];

			//vimeo variable

			var cactus_vimeo_player=[];
			var cactus_vimeo_player_Ads=[];

			var cactus_main_vimeo=[];
			var cactus_main_vimeo_player=[];

			var cactus_ads_vimeo_obj=[];
			var cactus_ads_vimeo_player=[];




			window.onYouTubeIframeAPIReady = function () {	//onYouTubeIframeAPIReady

				$('.'+cactusAllVideoList).find('.'+cactusVideoItem).each(function(index, element) {
					var $this=$(this);
					$global_this=$(this);

					var divVideoId=cactusVideoItem+'-'+index;
					var AdsVideoId=cactusVideoAds+'-'+index;

					$this.find('.'+cactusVideoDetails).find('.'+cactusVideoContent).attr('id', divVideoId);

					var videoWidth				= $this.attr("data-width");
					var videoHeight				= $this.attr("data-height");
					var videoSource				= $this.attr("data-source");
					var videoLink 				= $this.attr("data-link");
					var videoAdsType 			= $this.attr("data-ads-type");
					var videoAds 				= $this.attr("data-ads");
					var videoAdsSource 			= $this.attr("data-ads-source");
					var videoAutoPlay 			= $this.attr("data-autoplay");
					var videoDataTimeHideAds 	= parseInt($this.attr("data-time-hide-ads"));
					var closeButtonName 		= $this.attr("data-close-button-name");
                	var videoDataLinkRedirect	= $this.attr("data-link-redirect");
					var videoDataTimePlayAgain 	= parseInt($this.attr("ads-play-again-after"));
                	var closeButtonPosition		= $this.attr("close-button-position");
                	var isMobileOrTablet		= $this.attr("is-mobile-or-tablet");
                	var autoLoadNextVideo		= $this.attr("auto-next-video");
                	var autoLoadNextVideoOptions= $this.attr("auto-next-video-options");

                	var enableBrand				= $this.attr("enable-brand");
                	var brandLogo				= $this.attr("brand-logo");
                	var brandText				= $this.attr("brand-text");
                	var brandPosition			= $this.attr("brand-position");
                	var brandColor				= $this.attr("brand-color");
                	var brandOpacity			= $this.attr("brand-opacity");


                	var adsImagePosition			= $this.attr("ads-image-position");



                	if(videoLink == '@data-link')
                		videoLink = $('input[name=main_video_url]').val();

                	if(videoSource == '@data-source')
                		videoSource = $('input[name=main_video_type]').val();


					$this.css({"width": checkWidth + "px" , "height": checkHeight + "px"});

					//setup branch
					if(enableBrand == 'yes')
					{
						if(brandLogo != '' && brandLogo != undefined)
							$this.find('.'+cactusVideoDetails).append('<div id="brand-'+index+'"><img src="' + brandLogo + '"/></div>');
						else
						{
							$this.find('.'+cactusVideoDetails).append('<div id="brand-'+index+'">' + brandText + '</div>');
							$this.find('#brand-'+index).css({opacity: brandOpacity, color: brandColor});
						}

						if(brandPosition == 'top-right')
							$this.find('#brand-'+index).css({top: '0',right: '0'});
						else if(brandPosition == 'top-left')
							$this.find('#brand-'+index).css({top: '0',left: '0'});
						else if(brandPosition == 'bottom-right')
							$this.find('#brand-'+index).css({bottom: '0',right: '0'});
						else if(brandPosition == 'bottom-left')
							$this.find('#brand-'+index).css({bottom: '0',left: '0'});
						else
							$this.find('#brand-'+index).css({top: '0',right: '0'});
					}

					/*Video Youtube Iframe*/

					if(videoSource == 'youtube')
					{

						function onPlayerReady(event) {

							function StartVideoNow(){event.target.playVideo();};

							$this.find('.'+cactusVideoAds).css("visibility","hidden");

							var videoDurationAds=0;
							var videoPlayCurrentTime=0;

							if(videoAutoPlay=="1")
							{
								if(videoAds!='' && videoAds!=null && videoAdsType!='')
								{
									$this.find('.'+cactusVideoAds).css("visibility","visible");
									var divVideoAdsId=cactusVideoAds+'-'+index;

									if(videoAdsType=='video')
									{
										if(videoAdsSource == 'youtube')
										{
											close_button($this, divVideoAdsId, cactusVideoAds, videoDataLinkRedirect, closeButtonPosition);

											function onPlayerReady_auto(event) {
												$this.find('.'+cactusVideoAds).find('.hide-pause').css({"opacity":"0", "cursor":"auto"});
												$this.find('.'+cactusVideoAds).find('.linkads').css({"opacity":"1", "visibility":"visible"});
											};

											function onPlayerStateChange_auto(event) {
												$this.find('.'+cactusVideoAds).find('.hide-pause').css({"opacity":"0", "cursor":"auto"});
												$this.find('.'+cactusVideoAds).find('.linkads').css({"opacity":"1", "visibility":"visible"});

												if(event.data === 0) {
													$this.find('.'+cactusVideoAds).css({"display":"none"});
													cactus_player_Ads[index].stopVideo();
													StartVideoNow();
												};

												function adsPlayCurrentTime_func() {
													videoPlayCurrentTime=cactus_player_Ads[index].getCurrentTime();
													if(parseInt(videoPlayCurrentTime) >= videoDataTimeHideAds) {
														clearInterval(adsPlayCurrentTime_func);
														$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').css({"visibility":"visible", "opacity":"1"}).text(closeButtonName);

														$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').click(function(){
																$this.find('.'+cactusVideoAds).css({"display":"none"});
																cactus_player_Ads[index].stopVideo();
																StartVideoNow();
														});

													}
												};
												setInterval(adsPlayCurrentTime_func,500);
											};

											cactus_player_Ads[index] = new YT.Player(divVideoAdsId, {
												width: checkWidth,
												height: checkHeight,
												videoId: videoAds,
												playerVars: {
													controls: 0,
													showinfo: 0,
													enablejsapi:1,
													autoplay:1,
													disablekb:1,
												},
												events: {
													'onReady': onPlayerReady_auto,
													'onStateChange': onPlayerStateChange_auto
												}
											});
										}
										else
										{
											if(flag_vimeo[index] == true)
											{
												flag_vimeo[index] = true;
											}
											else
											{
												flag_vimeo[index] = false;
											}

											$this.find('.'+cactusVideoAds).html('<iframe id="player-vimeo-' + index + '" src="//player.vimeo.com/video/' + videoAds + '?api=1&player_id=player-vimeo-' + index + '&autoplay=1" width="' + checkWidth + '" height="' + checkHeight + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');

											close_button($this, divVideoAdsId, cactusVideoAds, videoDataLinkRedirect, closeButtonPosition, videoAdsSource);

										    // var iframe = $('#player-vimeo-' + index)[0];
										    // cactus_player_Ads[] = $f(iframe);

										    cactus_vimeo_player[index] = $('#player-vimeo-' + index)[0];
											cactus_vimeo_player_Ads[index] =$f(cactus_vimeo_player[index]);
										    // var status = $('.vimeo_status');

									        function onPause(id) {
									            // status.text('paused');
									        }

									        function onFinish(id) {
									            // status.text('finished');
									            $this.find('.'+cactusVideoAds).css({"display":"none"});
									            StartVideoNow();
									        }

									        function onPlayProgress(data, id) {
									            // status.text(data.seconds + 's played');
									            if(data.seconds > videoDataTimeHideAds && flag_vimeo[index] == false)
									            {
									            	$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').css({"visibility":"visible", "opacity":"1"}).text(closeButtonName);

									            	$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').click(function(){
									            			$this.find('.'+cactusVideoAds).css({"display":"none"});
									            			cactus_vimeo_player_Ads[index].api('pause');
									            			StartVideoNow();
							            					flag_vimeo[index] = true;
									            	});
									            }
									        }

									        // When the cactus_vimeo_player_Ads[index] is ready, add listeners for pause, finish, and playProgress
									        cactus_vimeo_player_Ads[index].addEvent('ready', function() {
									            // status.text('ready');
									            cactus_vimeo_player_Ads[index].addEvent('pause', onPause);
									            cactus_vimeo_player_Ads[index].addEvent('finish', onFinish);
									            cactus_vimeo_player_Ads[index].addEvent('playProgress', onPlayProgress);
									        });
										}
									}
									else if(videoAdsType=='image')
									{
										//ads images

										// Hidden ads images
										$this.find('.'+cactusVideoAds).css("display","none");

										//full size
										if(adsImagePosition == '1' || adsImagePosition == 'undefined')
										{
											// prepare ads images
											$this.find('.'+cactusVideoAds).html('<a href="' + videoDataLinkRedirect + '" target="_blank"><img src="' + videoAds + '"/></a>');
											$this.find('.'+cactusVideoAds + ' img').css({"width":"100%", "height":"100%"});

											close_button($this, divVideoAdsId, cactusVideoAds, videoDataLinkRedirect, closeButtonPosition);
											$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').css({"visibility":"visible", "opacity":"1"}).text(closeButtonName);


							            	$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').click(function(){
							            			$this.find('.'+cactusVideoAds).css({"display":"none"});
							            			StartVideoNow();
							            	});
										}
										else
										{
											// top banner
											if(adsImagePosition == '2')
											{
												// prepare ads images
												$this.find('.'+cactusVideoAds).css("height","0");
												$this.find('.'+cactusVideoAds).html('<div class="banner-img"><a href="' + videoDataLinkRedirect + '" target="_blank"><img src="' + videoAds + '"/></div></a>');
												$this.find('.'+cactusVideoAds + ' img').css({"width":"100%", "height":"auto"});
												$this.find('.'+cactusVideoAds + ' .banner-img').append('<span class="close-banner-button">X</span>');
												$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').css({'bottom': '2px'});
												$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').click(function() {
							            			$this.find('.'+cactusVideoAds).css({"display":"none"});
							            		});
											}
											//bottom banner
											else if(adsImagePosition == '3')
											{
												// prepare ads images
												$this.find('.'+cactusVideoAds).css({"height":"auto", "top": "auto"});
												$this.find('.'+cactusVideoAds).html('<div class="banner-img"><a href="' + videoDataLinkRedirect + '" target="_blank"><img src="' + videoAds + '"/></div></a>');
												$this.find('.'+cactusVideoAds + ' img').css({"width":"100%", "height":"auto"});
												$this.find('.'+cactusVideoAds + ' .banner-img').append('<span class="close-banner-button">X</span>');
												$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').css({'top': '0'});

												$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').click(function() {
							            			$this.find('.'+cactusVideoAds).css({"display":"none"});
							            		});
											}
										}

						            	//play youtube video
						            	StartVideoNow();

									}
									else if(videoAdsType=='adsense')
									{
										// Hidden ads images
										$this.find('.'+cactusVideoAds).css("display","none");

										// top banner
										if(adsImagePosition == '2')
										{
											$this.find('.'+cactusVideoAds).css("height","0");
											$this.find('.'+cactusVideoAds).html('<div class="adsense-block">' + videoAds + '</div>');
											$this.find('.'+cactusVideoAds + ' .adsense-block').append('<span class="close-banner-button">X</span>');
											$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').css({'bottom': '-20px', 'right': '-23px'});
											$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').click(function() {
						            			$this.find('.'+cactusVideoAds).css({"display":"none"});
						            		});
										}
										//bottom banner
										else if(adsImagePosition == '3')
										{
											$this.find('.'+cactusVideoAds).css({"height":"auto", "top": "auto", "pointer-events" : "none"});
						            		$this.find('.'+cactusVideoAds).html('<div class="adsense-block">' + videoAds + '</div>');

											
											$this.find('.'+cactusVideoAds + ' .adsense-block').append('<span class="close-banner-button">X</span>');
											$this.find('.'+cactusVideoAds + ' .adsense-block').css({"padding-bottom" : "40px"});
											$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').css({'top': '-28px', 'right': '-23px'});
											$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').click(function() {
						            			$this.find('.'+cactusVideoAds).css({"display":"none"});
						            		});

										}


										//play youtube video
						            	StartVideoNow();
									}
								}
								else
								{
									//event.target.playVideo();
									StartVideoNow();
								}
							}
							else
							{
								if(videoAds!='' && videoAds!=null && videoAdsType!='')
								{
									$this.find('.'+cactusVideoAds).css("visibility","visible");
									var divVideoAdsId=cactusVideoAds+'-'+index;
									if(videoAdsType=='video')
									{
										if(videoAdsSource == 'youtube')
										{
											close_button($this, divVideoAdsId, cactusVideoAds, videoDataLinkRedirect, closeButtonPosition, videoAdsSource);

											$this.find('.'+cactusVideoAds).find(".hide-pause.button-start").click(function(){

												var $thisads=$(this);

												function onPlayerReady_nauto(event) {
													$thisads.css({"opacity":"0"});
													$this.find('.'+cactusVideoAds).find('.linkads').css({"opacity":"1", "visibility":"visible"});
												};

												function onPlayerStateChange_nauto(event) {
													if(event.data === 0) {
														$this.find('.'+cactusVideoAds).css({"display":"none"});
														cactus_player_Ads[index].stopVideo();
														StartVideoNow();
													};

													//alert( cactus_player_Ads[index].getDuration()	)	;
													//alert( cactus_player_Ads[index].getCurrentTime() )
													function adsPlayCurrentTime_func() {
														videoPlayCurrentTime=cactus_player_Ads[index].getCurrentTime();
														if(parseInt(videoPlayCurrentTime) >= videoDataTimeHideAds) {
															clearInterval(adsPlayCurrentTime_func);
															$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').css({"visibility":"visible", "opacity":"1"}).text(closeButtonName);
															$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').click(function(){
																$this.find('.'+cactusVideoAds).css({"display":"none"});
																cactus_player_Ads[index].stopVideo();
																StartVideoNow();
															})
														}else{
															//alert(videoPlayCurrentTime);
														};
													}
													setInterval(adsPlayCurrentTime_func,500)
												};

												cactus_player_Ads[index] = new YT.Player(divVideoAdsId, {
													width: checkWidth,
													height: checkHeight,
													videoId: videoAds,
													playerVars: {
														controls: 0,
														showinfo: 0,
														enablejsapi:1,
														autoplay:1,
														disablekb:1,
													},
													events: {
														'onReady': onPlayerReady_nauto,
														'onStateChange': onPlayerStateChange_nauto
													}
												});

											});
										}
										else
										{
											if(flag_vimeo[index] == true)
											{
												flag_vimeo[index] = true;
											}
											else
											{
												flag_vimeo[index] = false;
											}

											mask_button($this, cactusVideoAds, videoAdsSource, videoSource);

											$this.find('.'+cactusVideoAds).find(".hide-pause.button-start").click(function() {

												$this.find('.'+cactusVideoAds).html('<iframe id="player-vimeo-' + index + '" src="//player.vimeo.com/video/' + videoAds + '?api=1&player_id=player-vimeo-' + index + '" width="' + checkWidth + '" height="' + checkHeight + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');

												close_button($this, divVideoAdsId, cactusVideoAds, videoDataLinkRedirect, closeButtonPosition, videoAdsSource);

											    cactus_vimeo_player[index] = $('#player-vimeo-' + index)[0];
												cactus_vimeo_player_Ads[index] =$f(cactus_vimeo_player[index]);
											    // var status = $('.vimeo_status');

										        function onPause(id) {
										            // status.text('paused');
										        }

										        function onFinish(id) {
										            // status.text('finished');
										            $this.find('.'+cactusVideoAds).css({"display":"none"});
										            StartVideoNow();
										        }

										        function onPlayProgress(data, id) {
										            // status.text(data.seconds + 's played');
										            if(data.seconds > videoDataTimeHideAds && flag_vimeo[index] == false)
										            {
										            	$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').css({"visibility":"visible", "opacity":"1"}).text(closeButtonName);

										            	$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').click(function(){
										            			$this.find('.'+cactusVideoAds).css({"display":"none"});
										            			cactus_vimeo_player_Ads[index].api('pause');
										            			StartVideoNow();
								            					flag_vimeo[index] = true;
										            	});
										            }
										        }

										        // When the cactus_vimeo_player_Ads[index] is ready, add listeners for pause, finish, and playProgress
										        cactus_vimeo_player_Ads[index].addEvent('ready', function() {
										            // status.text('ready');
										            cactus_vimeo_player_Ads[index].addEvent('pause', onPause);
										            cactus_vimeo_player_Ads[index].addEvent('finish', onFinish);
										            cactus_vimeo_player_Ads[index].addEvent('playProgress', onPlayProgress);
										            cactus_vimeo_player_Ads[index].api('play');
										        });
									        });
										}
									}
									else if(videoAdsType=='image')
									{
										//ads images

										// Hidden ads images
										$this.find('.'+cactusVideoAds).css("display","none");

										//full size
										if(adsImagePosition == '1' || adsImagePosition == 'undefined')
										{
											// prepare ads images
											$this.find('.'+cactusVideoAds).html('<a href="' + videoDataLinkRedirect + '" target="_blank"><img src="' + videoAds + '"/></a>');
											$this.find('.'+cactusVideoAds + ' img').css({"width":"100%", "height":"100%"});

											close_button($this, divVideoAdsId, cactusVideoAds, videoDataLinkRedirect, closeButtonPosition);
											$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').css({"visibility":"visible", "opacity":"1"}).text(closeButtonName);


							            	$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').click(function(){
							            			$this.find('.'+cactusVideoAds).css({"display":"none"});
							            			StartVideoNow();
							            	});
										}
										else if(videoAdsType=='image')
										{
											// top banner
											if(adsImagePosition == '2')
											{
												// prepare ads images
												$this.find('.'+cactusVideoAds).css("height","0");
												$this.find('.'+cactusVideoAds).html('<div class="banner-img"><a href="' + videoDataLinkRedirect + '" target="_blank"><img src="' + videoAds + '"/></div></a>');
												$this.find('.'+cactusVideoAds + ' img').css({"width":"100%", "height":"auto"});
												$this.find('.'+cactusVideoAds + ' .banner-img').append('<span class="close-banner-button">X</span>');
												$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').css({'bottom': '2px'});
												$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').click(function() {
							            			$this.find('.'+cactusVideoAds).css({"display":"none"});
							            		});
											}
											//bottom banner
											else if(adsImagePosition == '3')
											{
												// prepare ads images
												$this.find('.'+cactusVideoAds).css({"height":"auto", "top": "auto"});
												$this.find('.'+cactusVideoAds).html('<div class="banner-img"><a href="' + videoDataLinkRedirect + '" target="_blank"><img src="' + videoAds + '"/></div></a>');
												$this.find('.'+cactusVideoAds + ' img').css({"width":"100%", "height":"auto"});
												$this.find('.'+cactusVideoAds + ' .banner-img').append('<span class="close-banner-button">X</span>');
												$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').css({'top': '0'});

												$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').click(function() {
							            			$this.find('.'+cactusVideoAds).css({"display":"none"});
							            		});
											}
										}
										else if(videoAdsType=='adsense')
										{
											// Hidden ads images
											$this.find('.'+cactusVideoAds).css("display","none");

											// top banner
											if(adsImagePosition == '2')
											{
												$this.find('.'+cactusVideoAds).css("height","0");
												$this.find('.'+cactusVideoAds).html('<div class="adsense-block">' + videoAds + '</div>');
												$this.find('.'+cactusVideoAds + ' .adsense-block').append('<span class="close-banner-button">X</span>');
												$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').css({'bottom': '2px'});
												$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').click(function() {
							            			$this.find('.'+cactusVideoAds).css({"display":"none"});
							            		});
											}
											//bottom banner
											else if(adsImagePosition == '3')
											{
												$this.find('.'+cactusVideoAds).css({"height":"auto", "top": "auto"});
							            		$this.find('.'+cactusVideoAds).html('<div class="adsense-block">' + videoAds + '</div>');
												$this.find('.'+cactusVideoAds + ' .adsense-block').append('<span class="close-banner-button">X</span>');
												$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').css({'top': '0'});
												$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').click(function() {
							            			$this.find('.'+cactusVideoAds).css({"display":"none"});
							            		});
											}
										}
									}
									else if(videoAdsType=='adsense')
									{
										// Hidden ads images
										$this.find('.'+cactusVideoAds).css("display","none");

										// top banner
										if(adsImagePosition == '2')
										{
											$this.find('.'+cactusVideoAds).css("height","0");
											$this.find('.'+cactusVideoAds).html('<div class="adsense-block">' + videoAds + '</div>');
											$this.find('.'+cactusVideoAds + ' .adsense-block').append('<span class="close-banner-button">X</span>');
											$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').css({'bottom': '-20px', 'right': '-23px'});
											$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').click(function() {
						            			$this.find('.'+cactusVideoAds).css({"display":"none"});
						            		});
										}
										//bottom banner
										else if(adsImagePosition == '3')
										{
											$this.find('.'+cactusVideoAds).css({"height":"auto", "top": "auto", "pointer-events" : "none"});
						            		$this.find('.'+cactusVideoAds).html('<div class="adsense-block">' + videoAds + '</div>');

											
											$this.find('.'+cactusVideoAds + ' .adsense-block').append('<span class="close-banner-button">X</span>');
											$this.find('.'+cactusVideoAds + ' .adsense-block').css({"padding-bottom" : "40px"});
											$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').css({'top': '-28px', 'right': '-23px'});
											$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').click(function() {
						            			$this.find('.'+cactusVideoAds).css({"display":"none"});
						            		});

										}
									}
								}
								else
								{
									cactus_player[index].stopVideo();
								}
							}
						};



						var done = false;
						function onPlayerStateChange(event) {

					        // when video ends
							if(event.data === 0) {
								setTimeout(function(){
									if(autoLoadNextVideo == 1)
									{
										var link = $('.prev-post a').attr('href');
										if(autoLoadNextVideoOptions == 1)
										{
											link = jQuery('.next-post a').attr('href');
										}
										var className = $('#tm-autonext span#autonext').attr('class');
										//alert(className);
										if(className!=''){
										  if(link !=undefined){
											  window.location.href= link;
										  }
										}
									}
								},1000);
							}


							function videoPlayCurrentTime_func() {
								videoPlayCurrentTime=cactus_player[index].getCurrentTime();
								if(flag[index] == true)
								{
									flag[index] = true;
								}
								else
								{
									flag[index] = false;
								}
								if(parseInt(videoPlayCurrentTime) >= videoDataTimePlayAgain && flag[index] == false) {
									clearInterval(videoPlayCurrentTime_func);


									//display ads and play it
									$global_this.find('.'+cactusVideoAds).css({"visibility":"visible", "display":"block"});
									//pause main video
									cactus_player[index].pauseVideo();

									if(videoAdsType == 'video')
									{
										if(videoAdsSource == 'youtube')
										{
											if($.browser.mozilla)
											{
												cactus_player_Ads[index].destroy();

												function onPlayerReady_auto1(event) {
												};

												function onPlayerStateChange_auto1(event) {

													$this.find('.'+cactusVideoAds).find('#close-'+AdsVideoId+'').click(function(){
															$this.find('.'+cactusVideoAds).css({"display":"none"});
															cactus_player_Ads[index].stopVideo();
															cactus_player[index].playVideo();
													});

													if(event.data === 0) {
														$this.find('.'+cactusVideoAds).css({"display":"none"});
														cactus_player_Ads[index].stopVideo();
														cactus_player[index].playVideo();
													};

												};

												cactus_player_Ads[index] = new YT.Player(AdsVideoId, {
													width: checkWidth,
													height: checkHeight,
													videoId: videoAds,
													playerVars: {
														controls: 0,
														showinfo: 0,
														enablejsapi:1,
														autoplay:1,
														disablekb:1,
													},
													events: {
														'onReady': onPlayerReady_auto1,
														'onStateChange': onPlayerStateChange_auto1
													}
												});
											}
											else
											{
												cactus_player_Ads[index].seekTo(0, true);
												cactus_player_Ads[index].playVideo();
											}
										}
										else if(videoAdsSource == 'vimeo')
										{
											cactus_vimeo_player_Ads[index].api("seekTo", 0);
											cactus_vimeo_player_Ads[index].api("play");
										}
									}
									else if(videoAdsType == '')
									{
										$global_this.find('.'+cactusVideoAds).css({"visibility":"hidden", "display":"none"});
										cactus_player[index].playVideo();
									}
									else if(videoAdsType == 'adsense')
									{
										if(adsImagePosition == '1')
											$global_this.find('.'+cactusVideoAds).css({"visibility":"hidden", "display":"none"});
										cactus_player[index].playVideo();
									}
									else
									{
										if(adsImagePosition == '2' || adsImagePosition == '3')
										//ads image
										cactus_player[index].playVideo();
									}

									flag[index] = true;
								}
							};
							setInterval(videoPlayCurrentTime_func,500);
						};

						function stopVideo() {
							cactus_player[index].stopVideo();
						};

						cactus_player[index] = new YT.Player(divVideoId, {
							width: checkWidth,
							height: checkHeight,
							videoId: videoLink,
							playerVars: {
								//controls: 0,
								//showinfo: 0,
								enablejsapi:1,
							},
							events: {
								'onReady': onPlayerReady,
								'onStateChange': onPlayerStateChange
							}
						});


					}
					else if(videoSource == 'vimeo')
					{
						if(flag_vimeo[index] == true)
						{
							flag_vimeo[index] = true;
						}
						else
						{
							flag_vimeo[index] = false;
						}

						$this.find('.'+cactusVideoDetails).find('.'+cactusVideoContent).html('<iframe id="player-vimeo-' + index + '" src="//player.vimeo.com/video/' + videoLink + '?api=1&player_id=player-vimeo-' + index + '" width="' + checkWidth + '" height="' + checkHeight + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');

						cactus_main_vimeo[index] = $('#player-vimeo-' + index)[0];
						cactus_main_vimeo_player[index] =$f(cactus_main_vimeo[index]);
						// var status = $('.vimeo_status');

				        function onPause(id) {
				            // status.text('paused');
				        }

				        function onFinish(id) {
				            // status.text('finished');
				            $this.find('.'+cactusVideoAds).css({"display":"none"});
				            setTimeout(function(){
				            	if(autoLoadNextVideo == 1)
								{
									var link = $('.prev-post a').attr('href');
									if(autoLoadNextVideoOptions == 1)
									{
										link = jQuery('.next-post a').attr('href');
									}
									var className = $('#tm-autonext span#autonext').attr('class');
									//alert(className);
									if(className!=''){
									  if(link !=undefined){
										  window.location.href= link;
									  }
									}
								}
				            }, 1000);
				        }

				        function onPlayProgress(data, id) {
				            // status.text(data.seconds + 's played');
				            if(data.seconds > videoDataTimePlayAgain && flag_vimeo[index] == false)
				            {
								$global_this.find('.'+cactusVideoAds).css({"visibility":"visible", "display":"block"});

								//pause main video
								cactus_main_vimeo_player[index].api('pause');

								if(videoAdsType == 'video')
								{
									if(videoAdsSource == 'youtube')
									{
										if($.browser.mozilla)
										{
											cactus_player_Ads[index].destroy();

											function onPlayerReady_auto1(event) {
											};

											function onPlayerStateChange_auto1(event) {
												if(event.data === 0) {
													$this.find('.'+cactusVideoAds).css({"display":"none"});
													cactus_player_Ads[index].stopVideo();
													cactus_main_vimeo_player[index].api("play");
												};

											};

											cactus_player_Ads[index] = new YT.Player(AdsVideoId, {
												width: checkWidth,
												height: checkHeight,
												videoId: videoAds,
												playerVars: {
													controls: 0,
													showinfo: 0,
													enablejsapi:1,
													autoplay:1,
													disablekb:1,
												},
												events: {
													'onReady': onPlayerReady_auto1,
													'onStateChange': onPlayerStateChange_auto1
												}
											});
										}
										else
										{
											cactus_player_Ads[index].seekTo(0, true);
											cactus_player_Ads[index].playVideo();
										}
									}
									else if(videoAdsSource == 'vimeo')
									{
										cactus_ads_vimeo_player[index].api("seekTo", 0);
										cactus_ads_vimeo_player[index].api("play");
									}
								}
								else if(videoAdsType == '')
								{
									$global_this.find('.'+cactusVideoAds).css({"visibility":"hidden", "display":"none"});
									cactus_main_vimeo_player[index].api('play');
								}
								else if(videoAdsType == 'adsense')
								{
									if(adsImagePosition == '1')
										$global_this.find('.'+cactusVideoAds).css({"visibility":"hidden", "display":"none"});
									cactus_main_vimeo_player[index].api('play');
								}
								else
								{
									if(adsImagePosition == '2' || adsImagePosition == '3')
										cactus_main_vimeo_player[index].api('play');
								}

								flag_vimeo[index] = true;
				            }
				        }

				        // When the cactus_vimeo_player_Ads[index] is ready, add listeners for pause, finish, and playProgress
				        cactus_main_vimeo_player[index].addEvent('ready', function() {
				            cactus_main_vimeo_player[index].addEvent('pause', onPause);
				            cactus_main_vimeo_player[index].addEvent('finish', onFinish);
				            cactus_main_vimeo_player[index].addEvent('playProgress', onPlayProgress);
				            if(videoAdsType == '')
				            {
								$global_this.find('.'+cactusVideoAds).css({"visibility":"hidden", "display":"none"});
								cactus_main_vimeo_player[index].api('play');
							}
				        });


						if(videoAutoPlay == "1")
						{
							if(videoAds!='' && videoAds!=null && videoAdsType!='')
							{
								$this.find('.'+cactusVideoAds).css("visibility","visible");
									var divVideoAdsId=cactusVideoAds+'-'+index;
									if(videoAdsType=='video')
									{
										if(videoAdsSource == 'youtube')
										{
											close_button($this, divVideoAdsId, cactusVideoAds, videoDataLinkRedirect, closeButtonPosition);

											function onPlayerReady_auto(event) {
												$this.find('.'+cactusVideoAds).find('.hide-pause').css({"opacity":"0", "cursor":"auto"});
												$this.find('.'+cactusVideoAds).find('.linkads').css({"opacity":"1", "visibility":"visible"});
											};

											function onPlayerStateChange_auto(event) {
												$this.find('.'+cactusVideoAds).find('.hide-pause').css({"opacity":"0", "cursor":"auto"});
												$this.find('.'+cactusVideoAds).find('.linkads').css({"opacity":"1", "visibility":"visible"});

												if(event.data === 0) {
													$this.find('.'+cactusVideoAds).css({"display":"none"});
													cactus_player_Ads[index].stopVideo();
													cactus_main_vimeo_player[index].api("play");
												};

												function adsPlayCurrentTime_func() {
													videoPlayCurrentTime=cactus_player_Ads[index].getCurrentTime();
													if(parseInt(videoPlayCurrentTime) >= videoDataTimeHideAds) {
														clearInterval(adsPlayCurrentTime_func);
														$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').css({"visibility":"visible", "opacity":"1"}).text(closeButtonName);

														$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').click(function(){
																$this.find('.'+cactusVideoAds).css({"display":"none"});
																cactus_player_Ads[index].stopVideo();
																cactus_main_vimeo_player[index].api("play");
														});

													}
												};
												setInterval(adsPlayCurrentTime_func,500);
											};

											cactus_player_Ads[index] = new YT.Player(divVideoAdsId, {
												width: checkWidth,
												height: checkHeight,
												videoId: videoAds,
												playerVars: {
													controls: 0,
													showinfo: 0,
													enablejsapi:1,
													autoplay:1,
													disablekb:1,
												},
												events: {
													'onReady': onPlayerReady_auto,
													'onStateChange': onPlayerStateChange_auto
												}
											});
										}
										else
										{
											if(flag_ads_vimeo[index] == true)
											{
												flag_ads_vimeo[index] = true;
											}
											else
											{
												flag_ads_vimeo[index] = false;
											}



											$this.find('.'+cactusVideoAds).html('<iframe id="ads-vimeo-player'+index+'" src="//player.vimeo.com/video/' + videoAds + '?api=1&player_id=ads-vimeo-player'+index+'&autoplay=1" width="' + checkWidth + '" height="' + checkHeight + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
											close_button($this, divVideoAdsId, cactusVideoAds, videoDataLinkRedirect, closeButtonPosition, videoAdsSource);


											cactus_ads_vimeo_obj[index] = $('#ads-vimeo-player' + index)[0];
										    cactus_ads_vimeo_player[index]  = $f(cactus_ads_vimeo_obj[index]);
										    // var status = $('.status');

										    function onPauseAds(id) {
										        // status.text('paused');
										    }

										    function onFinishAds(id) {
										        // status.text('finished');
										        $this.find('.'+cactusVideoAds).css({"display":"none"});
								            	cactus_main_vimeo_player[index].api('play');
										    }

										    function onPlayProgressAds(data, id) {

										        if(data.seconds > videoDataTimeHideAds && flag_ads_vimeo[index] == false)
									            {

									            	$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').css({"visibility":"visible", "opacity":"1"}).text(closeButtonName);

									            	$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').click(function(){
									            			$this.find('.'+cactusVideoAds).css({"display":"none"});
									            			cactus_ads_vimeo_player[index].api('pause');
									            			cactus_main_vimeo_player[index].api('play');
					            							flag_ads_vimeo[index] = true;
									            	});
									            }
										    }

										    // When the cactus_ads_vimeo_player[index]  is ready, add listeners for pause, finish, and playProgress
										    cactus_ads_vimeo_player[index] .addEvent('ready', function() {
										        // status.text('ready');
										        cactus_ads_vimeo_player[index] .addEvent('pause', onPauseAds);
										        cactus_ads_vimeo_player[index] .addEvent('finish', onFinishAds);
										        cactus_ads_vimeo_player[index] .addEvent('playProgress', onPlayProgressAds);
										    });
										}
									}
									else
									{
										if(videoAdsType=='image')
										//ads images
										{
											// Hidden ads images
											$this.find('.'+cactusVideoAds).css("display","none");

											//full size
											if(adsImagePosition == '1' || adsImagePosition == 'undefined')
											{
												// prepare ads images
												$this.find('.'+cactusVideoAds).html('<a href="' + videoDataLinkRedirect + '" target="_blank"><img src="' + videoAds + '"/></a>');
												$this.find('.'+cactusVideoAds + ' img').css({"width":"100%", "height":"100%"});

												close_button($this, divVideoAdsId, cactusVideoAds, videoDataLinkRedirect, closeButtonPosition);
												$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').css({"visibility":"visible", "opacity":"1"}).text(closeButtonName);


								            	$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').click(function(){
								            			$this.find('.'+cactusVideoAds).css({"display":"none"});
								            			cactus_main_vimeo_player[index].api("play");
								            	});
											}
											else
											{
												// top banner
												if(adsImagePosition == '2')
												{
													// prepare ads images
													$this.find('.'+cactusVideoAds).css("height","0");
													$this.find('.'+cactusVideoAds).html('<div class="banner-img"><a href="' + videoDataLinkRedirect + '" target="_blank"><img src="' + videoAds + '"/></div></a>');
													$this.find('.'+cactusVideoAds + ' img').css({"width":"100%", "height":"auto"});
													$this.find('.'+cactusVideoAds + ' .banner-img').append('<span class="close-banner-button">X</span>');
													$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').css({'bottom': '2px'});
													$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').click(function() {
								            			$this.find('.'+cactusVideoAds).css({"display":"none"});
								            		});
												}
												//bottom banner
												else if(adsImagePosition == '3')
												{
													// prepare ads images
													$this.find('.'+cactusVideoAds).css({"height":"auto", "top": "auto"});
													$this.find('.'+cactusVideoAds).html('<div class="banner-img"><a href="' + videoDataLinkRedirect + '" target="_blank"><img src="' + videoAds + '"/></div></a>');
													$this.find('.'+cactusVideoAds + ' img').css({"width":"100%", "height":"auto"});
													$this.find('.'+cactusVideoAds + ' .banner-img').append('<span class="close-banner-button">X</span>');
													$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').css({'top': '0'});

													$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').click(function() {
								            			$this.find('.'+cactusVideoAds).css({"display":"none"});
								            		});
												}
											}
										}
										else if( videoAdsType == 'adsense')
										{
											// Hidden ads images
											$this.find('.'+cactusVideoAds).css("display","none");

											// top banner
											if(adsImagePosition == '2')
											{
												$this.find('.'+cactusVideoAds).css("height","0");
												$this.find('.'+cactusVideoAds).html('<div class="adsense-block">' + videoAds + '</div>');
												$this.find('.'+cactusVideoAds + ' .adsense-block').append('<span class="close-banner-button">X</span>');
												$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').css({'bottom': '-20px', 'right': '-23px'});
												$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').click(function() {
							            			$this.find('.'+cactusVideoAds).css({"display":"none"});
							            		});
											}
											//bottom banner
											else if(adsImagePosition == '3')
											{
												$this.find('.'+cactusVideoAds).css({"height":"auto", "top": "auto", "pointer-events" : "none"});
							            		$this.find('.'+cactusVideoAds).html('<div class="adsense-block">' + videoAds + '</div>');

												
												$this.find('.'+cactusVideoAds + ' .adsense-block').append('<span class="close-banner-button">X</span>');
												$this.find('.'+cactusVideoAds + ' .adsense-block').css({"padding-bottom" : "40px"});
												$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').css({'top': '-28px', 'right': '-23px'});
												$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').click(function() {
							            			$this.find('.'+cactusVideoAds).css({"display":"none"});
							            		});

											}
										}


						            	//play vimeo video
						            	cactus_main_vimeo_player[index].addEvent('ready', function() {
						            	    cactus_main_vimeo_player[index].api('play');
						            		cactus_main_vimeo_player[index].addEvent('pause', onPause);
								            cactus_main_vimeo_player[index].addEvent('finish', onFinish);
								            cactus_main_vimeo_player[index].addEvent('playProgress', onPlayProgress);
						            	});
									}
							}
							else
							{
								//play video
								cactus_main_vimeo_player[index].api("play");
							}
						}
						else
						{
							if(videoAds!='' && videoAds!=null && videoAdsType!='')
							{
								$this.find('.'+cactusVideoAds).css("visibility","hidden");
									var divVideoAdsId=cactusVideoAds+'-'+index;
									if(videoAdsType=='video')
									{
										if(videoAdsSource == 'youtube')
										{
											mask_button($this, cactusVideoAds, videoAdsSource, videoSource);
											close_button($this, divVideoAdsId, cactusVideoAds, videoDataLinkRedirect, closeButtonPosition);

											$this.find('.'+cactusVideoAds).find(".hide-pause.button-start").click(function() {

												$this.find('.'+cactusVideoAds).css("visibility","visible");

												function onPlayerReady_nauto(event) {
													$this.find('.'+cactusVideoAds).find('.hide-pause').css({"opacity":"0", "cursor":"auto"});
													$this.find('.'+cactusVideoAds).find('.linkads').css({"opacity":"1", "visibility":"visible"});
												};

												function onPlayerStateChange_nauto(event) {
													$this.find('.'+cactusVideoAds).find('.hide-pause').css({"opacity":"0", "cursor":"auto"});
													$this.find('.'+cactusVideoAds).find('.linkads').css({"opacity":"1", "visibility":"visible"});

													if(event.data === 0) {
														$this.find('.'+cactusVideoAds).css({"display":"none"});
														cactus_player_Ads[index].stopVideo();
														cactus_main_vimeo_player[index].api("play");
													};

													function adsPlayCurrentTime_func() {
														videoPlayCurrentTime=cactus_player_Ads[index].getCurrentTime();
														if(parseInt(videoPlayCurrentTime) >= videoDataTimeHideAds) {
															clearInterval(adsPlayCurrentTime_func);
															$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').css({"visibility":"visible", "opacity":"1"}).text(closeButtonName);

															$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').click(function(){
																	$this.find('.'+cactusVideoAds).css({"display":"none"});
																	cactus_player_Ads[index].stopVideo();
																	cactus_main_vimeo_player[index].api("play");
															});

														}
													};
													setInterval(adsPlayCurrentTime_func,500);
												};

												cactus_player_Ads[index] = new YT.Player(divVideoAdsId, {
													width: checkWidth,
													height: checkHeight,
													videoId: videoAds,
													playerVars: {
														controls: 0,
														showinfo: 0,
														enablejsapi:1,
														autoplay:1,
														disablekb:1,
													},
													events: {
														'onReady': onPlayerReady_nauto,
														'onStateChange': onPlayerStateChange_nauto
													}
												});
											});
										}
										else
										{
											if(flag_ads_vimeo[index] == true)
											{
												flag_ads_vimeo[index] = true;
											}
											else
											{
												flag_ads_vimeo[index] = false;
											}

											mask_button($this, cactusVideoAds, videoAdsSource, videoSource);



											$this.find('.'+cactusVideoAds).find(".hide-pause.button-start").click(function() {

												$this.find('.'+cactusVideoAds).html('<iframe id="ads-vimeo-player'+index+'" src="//player.vimeo.com/video/' + videoAds + '?api=1&player_id=ads-vimeo-player'+index+'&autoplay=1" width="' + checkWidth + '" height="' + checkHeight + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');

												close_button($this, divVideoAdsId, cactusVideoAds, videoDataLinkRedirect, closeButtonPosition, videoAdsSource);

												$this.find('.'+cactusVideoAds).css("visibility","visible");

												cactus_ads_vimeo_obj[index] = $('#ads-vimeo-player' + index)[0];
											    cactus_ads_vimeo_player[index]  = $f(cactus_ads_vimeo_obj[index]);
											    // var status = $('.status');

											    function onPauseAds(id) {
											        // status.text('paused');
											    }

											    function onFinishAds(id) {
											        // status.text('finished');
											        $this.find('.'+cactusVideoAds).css({"display":"none"});
									            	cactus_main_vimeo_player[index].api('play');
											    }

											    function onPlayProgressAds(data, id) {
											        // status.text(data.seconds + 's played');
											        if(data.seconds > videoDataTimeHideAds && flag_ads_vimeo[index] == false)
										            {
										            	$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').css({"visibility":"visible", "opacity":"1"}).text(closeButtonName);

										            	$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').click(function(){
										            			$this.find('.'+cactusVideoAds).css({"display":"none"});
										            			cactus_ads_vimeo_player[index].api('pause');
										            			cactus_main_vimeo_player[index].api('play');
						            							flag_ads_vimeo[index] = true;
										            	});
										            }
											    }

											    // When the cactus_ads_vimeo_player[index]  is ready, add listeners for pause, finish, and playProgress
											    cactus_ads_vimeo_player[index] .addEvent('ready', function() {
											        // status.text('ready');
											        cactus_ads_vimeo_player[index] .addEvent('pause', onPauseAds);
											        cactus_ads_vimeo_player[index] .addEvent('finish', onFinishAds);
											        cactus_ads_vimeo_player[index] .addEvent('playProgress', onPlayProgressAds);
											    });
										    });
										}
									}
									else
									{
									 	if(videoAdsType=='image')
									 	{
											//ads images

											// Hidden ads images
											$this.find('.'+cactusVideoAds).css("display","none");

											//full size
											if(adsImagePosition == '1' || adsImagePosition == 'undefined')
											{
												// prepare ads images
												$this.find('.'+cactusVideoAds).html('<a href="' + videoDataLinkRedirect + '" target="_blank"><img src="' + videoAds + '"/></a>');
												$this.find('.'+cactusVideoAds + ' img').css({"width":"100%", "height":"100%"});

												close_button($this, divVideoAdsId, cactusVideoAds, videoDataLinkRedirect, closeButtonPosition);
												$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').css({"visibility":"visible", "opacity":"1"}).text(closeButtonName);


								            	$this.find('.'+cactusVideoAds).find('#close-'+divVideoAdsId+'').click(function(){
								            			$this.find('.'+cactusVideoAds).css({"display":"none"});
								            			cactus_main_vimeo_player[index].api("play");
								            	});
											}
											else
											{
												// top banner
												if(adsImagePosition == '2')
												{
													// prepare ads images
													$this.find('.'+cactusVideoAds).css("height","0");
													$this.find('.'+cactusVideoAds).html('<div class="banner-img"><a href="' + videoDataLinkRedirect + '" target="_blank"><img src="' + videoAds + '"/></div></a>');
													$this.find('.'+cactusVideoAds + ' img').css({"width":"100%", "height":"auto"});
													$this.find('.'+cactusVideoAds + ' .banner-img').append('<span class="close-banner-button">X</span>');
													$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').css({'bottom': '2px'});
													$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').click(function() {
								            			$this.find('.'+cactusVideoAds).css({"display":"none"});
								            		});
												}
												//bottom banner
												else if(adsImagePosition == '3')
												{
													// prepare ads images
													$this.find('.'+cactusVideoAds).css({"height":"auto", "top": "auto"});
													$this.find('.'+cactusVideoAds).html('<div class="banner-img"><a href="' + videoDataLinkRedirect + '" target="_blank"><img src="' + videoAds + '"/></div></a>');
													$this.find('.'+cactusVideoAds + ' img').css({"width":"100%", "height":"auto"});
													$this.find('.'+cactusVideoAds + ' .banner-img').append('<span class="close-banner-button">X</span>');
													$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').css({'top': '0'});

													$this.find('.'+cactusVideoAds + ' .banner-img .close-banner-button').click(function() {
								            			$this.find('.'+cactusVideoAds).css({"display":"none"});
								            		});
												}
											}
									 	}
									 	else if( videoAdsType == 'adsense')
										{
											// Hidden ads images
											$this.find('.'+cactusVideoAds).css("display","none");

											// top banner
											if(adsImagePosition == '2')
											{
												$this.find('.'+cactusVideoAds).css("height","0");
												$this.find('.'+cactusVideoAds).html('<div class="adsense-block">' + videoAds + '</div>');
												$this.find('.'+cactusVideoAds + ' .adsense-block').append('<span class="close-banner-button">X</span>');
												$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').css({'bottom': '-20px', 'right': '-23px'});
												$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').click(function() {
							            			$this.find('.'+cactusVideoAds).css({"display":"none"});
							            		});
											}
											//bottom banner
											else if(adsImagePosition == '3')
											{
												$this.find('.'+cactusVideoAds).css({"height":"auto", "top": "auto", "pointer-events" : "none"});
							            		$this.find('.'+cactusVideoAds).html('<div class="adsense-block">' + videoAds + '</div>');

												
												$this.find('.'+cactusVideoAds + ' .adsense-block').append('<span class="close-banner-button">X</span>');
												$this.find('.'+cactusVideoAds + ' .adsense-block').css({"padding-bottom" : "40px"});
												$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').css({'top': '-28px', 'right': '-23px'});
												$this.find('.'+cactusVideoAds + ' .adsense-block .close-banner-button').click(function() {
							            			$this.find('.'+cactusVideoAds).css({"display":"none"});
							            		});

											}
										}
									}
							}
							else
							{
								//play video
								cactus_main_vimeo_player[index].api("play");
							}
						}
					}

					/*Video Youtube Iframe*/

				});

			};//onYouTubeIframeAPIReady


			// $('.'+cactusAllVideoList).find('.'+cactusVideoItem+'[data-source="vimeo"]').each(function(index, element) {

			// });



        });

		function close_button(elements, divVideoAdsId, cactusVideoAds, videoDataLinkRedirect, closeButtonPosition, videoAdsSource)
		{
			var $this=elements;

			if(videoAdsSource == 'youtube')
				$this.find('.'+cactusVideoAds).append('<div id="close-'+divVideoAdsId+'"></div><a class="linkads" href="'+videoDataLinkRedirect+'" target="_blank"></a><div class="hide-pause button-start"></div><div id="'+divVideoAdsId+'"></div>');
			else
			{
				$this.find('.'+cactusVideoAds).append('<div id="close-'+divVideoAdsId+'"></div><a class="linkads" href="'+videoDataLinkRedirect+'" target="_blank"></a></div><div id="'+divVideoAdsId+'"></div>');
			}

			//set up close position
			if(closeButtonPosition == 'right')
				$this.find('#close-'+divVideoAdsId).css({"right":"0"});
			else
				$this.find('#close-'+divVideoAdsId).css({"left":"0"});
		}

		function mask_button(elements, cactusVideoAds, videoAdsSource, videoSource)
		{
			var $this=elements;
			if(videoSource == 'youtube')
				$this.find('.'+cactusVideoAds).append('<div class="hide-pause button-start"></div>');
			else if(videoSource == 'vimeo')
				$this.find('.'+cactusVideoAds).append('<div class="hide-pause button-start non-icon"></div>');
		}
	}(jQuery));