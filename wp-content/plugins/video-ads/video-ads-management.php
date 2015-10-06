<?php
/*
Plugin Name: Video ads management
Plugin URI: http://cactusthemes.com/
Description: This plugin manages video ads
Version: 2.3
Author: CactusThemes
Author URI: http://cactusthemes.com/
License: Commercial
*/

// check version


global $wp_version;

include plugin_dir_path( __FILE__ ) . 'includes/custom-meta-box/meta-box.php';
include plugin_dir_path( __FILE__ ) . 'includes/advs-meta-boxes.php';
include plugin_dir_path( __FILE__ ) . 'includes/options-page/options-page.php';
if( !class_exists( 'Mobile_Detect' ) ) {
	include plugin_dir_path( __FILE__ ) . 'includes/mobile-detect.php';
}

define('FULL_SCREEN'	, 1);
define('TOP_POSITION'	, 2);
define('BOTTOM_POSITION', 3);


class video_ads
{
	public function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'video_ads_frontend_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'video_ads_backend_scripts' ) );
		add_action( 'init', array( $this, 'video_ads_custom_post_type' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'video_advs_custom_columns' ) );
		add_action( 'after_setup_theme', array( $this, 'get_config_theme_option' ), 2 );

		add_filter( 'manage_video-advs_posts_columns', array( $this, 'video_advs_edit_columns' ) );

		add_shortcode( 'advs', array( $this, 'add_advs_to_video' ) );

		$this->register_configuration();
	}

	/*
	 * Enqueue Styles and Scripts
	 */
	function video_ads_frontend_scripts()
	{
		wp_enqueue_style( 'video-ads-management', plugins_url( "css/video-ads-management.css", __FILE__ ), array(), '20141005' );
		wp_enqueue_script( 'vimeo-api', 'http://f.vimeocdn.com/js/froogaloop2.min.js', array(), '20141005', true);
		wp_enqueue_script( 'video-ads-management', plugins_url( "js/video-ads-management.js", __FILE__ ), array(), '20141005', true);
	}
	function video_ads_backend_scripts()
	{
		wp_enqueue_script( 'video-ads-admin', plugins_url( "js/video-ads-admin.js", __FILE__ ), array(), '20141005', true);
	}


	function register_configuration(){
		global $ads_config;
		$ads_config = new Options_Page('ads_config',
									array(
										'option_file'=>dirname(__FILE__) . '/includes/options-page/options.xml',
										'page_title' => 'Ads Config',
										'menu_title' => 'Ads Config',
										'version'    => 'Video ads 2.0.2'
										),
									array(
										'submit_text' => 'Save'
										)
									);
	}

	function get_config_theme_option()
	{
		$theme_option_configs 									= array();
		$theme_option_configs['auto_play'] 						= ot_get_option('auto_play_video');
		$theme_option_configs['auto_load_next_video'] 			= ot_get_option('auto_load_next_video');
		$theme_option_configs['auto_load_next_video_options'] 	= ot_get_option('auto_load_next_prev');

		return $theme_option_configs;
	}

	/*
	 * Get all plugin options
	 */
	function video_ads_get_all_option()
	{
		$ads_options = array();
		//config ads and brand
		$enable_ads 	= op_get( 'ads_config', 'enable-ads' );
		if($enable_ads != '' && $enable_ads == 'yes')
		{
			$show_close_button 		= op_get( 'ads_config', 'show-close-button' );
			$close_button_position 	= op_get( 'ads_config', 'close-button-position' );
			$auto_turn_on_advs 		= op_get( 'ads_config', 'auto-turn-on-advs' );
		}
		else
		{
			$show_close_button 		= '';
			$close_button_position 	= '';
			$auto_turn_on_advs 		= '';
		}

		$enable_brand 	= op_get('ads_config', 'enable-brand');

		if($enable_brand != '' && $enable_brand == 'yes')
		{
			$brand_logo 	= op_get('ads_config', 'ads-logo');
			$brand_text 	= op_get('ads_config', 'ads-text');
			$brand_position = op_get('ads_config', 'ads-position');
			$brand_opacity 	= op_get('ads_config', 'ads-opacity');
			$brand_color 	= op_get('ads_config', 'ads-text-color');
		}
		else
		{
			$brand_logo 	= '';
			$brand_text 	= '';
			$brand_position = '';
			$brand_opacity 	= '';
			$brand_color 	= '';
		}

		$ads_options['enable_ads'] 				= $enable_ads;
		$ads_options['show_close_button'] 		= $show_close_button;
		$ads_options['close_button_position'] 	= $close_button_position;
		$ads_options['auto_turn_on_advs'] 		= $auto_turn_on_advs;
		$ads_options['enable_brand'] 			= $enable_brand;
		$ads_options['brand_logo'] 				= $brand_logo;
		$ads_options['brand_text'] 				= $brand_text;
		$ads_options['brand_position'] 			= $brand_position;
		$ads_options['brand_opacity'] 			= $brand_opacity;
		$ads_options['brand_color'] 			= $brand_color;
		return $ads_options;
	}

	function video_ads_detect_mobile()
	{
		$detect = new Mobile_Detect;
		$is_mobile_or_tablet = false;
		if( $detect->isMobile() || $detect->isTablet() ) {
			$is_mobile_or_tablet = true;
		}
		return $is_mobile_or_tablet;
	}





	// shortcode add advs to video front end
	function add_advs_to_video($atts, $content = "")
	{
		$ads_options = $this->video_ads_get_all_option();

		$enable_ads 			= $ads_options['enable_ads'];
		$show_close_button 		= $ads_options['show_close_button'];
		$close_button_position 	= $ads_options['close_button_position'];
		$auto_turn_on_advs 		= $ads_options['auto_turn_on_advs'];
		$enable_brand 			= $ads_options['enable_brand'];
		$brand_logo 			= $ads_options['brand_logo'];
		$brand_text 			= $ads_options['brand_text'];
		$brand_position 		= $ads_options['brand_position'];
		$brand_opacity 			= $ads_options['brand_opacity'];
		$brand_color 			= $ads_options['brand_color'];
		$is_mobile_or_tablet  	= $this->video_ads_detect_mobile();


		$theme_option_configs 	= $this->get_config_theme_option();

		if($is_mobile_or_tablet == true)
			$theme_option_configs['auto_play'] = 0;


		if($enable_ads != '' && $enable_ads == 'yes')
		{
			if(isset($atts['time']) && $atts['time'] != '')
			{
				$custom_show_close_button = $atts['time'];
			}
			if(isset($atts['id']) && $atts['id'] != '')
			{
				$expirydate = rwmb_meta( 'advs_expiry_date',array(), $atts['id'] );
				$files 		= rwmb_meta( 'advs_file_advanced', 'type=file', $atts['id'] );
				$video_url 	= rwmb_meta( 'advs_video_url',array(), $atts['id'] );
				$url 		= rwmb_meta( 'advs_url',array(), $atts['id'] );
				$adsense_code= rwmb_meta( 'advs_adsense_code',array(), $atts['id'] );
				$url_target = rwmb_meta( 'advs_target',array(), $atts['id'] );
				$position 	= rwmb_meta( 'advs_position',array(), $atts['id'] );

			}
			else
			{
				global $wpdb;
				$adv = $wpdb->get_results("select id from " . $wpdb->prefix . "posts inner join " . $wpdb->prefix ."postmeta on " . $wpdb->prefix ."posts.id = " . $wpdb->prefix . "postmeta.post_id where post_status='publish' and post_type='video-advs' and " . $wpdb->prefix ."postmeta.meta_key = 'advs_expiry_date' and " . $wpdb->prefix ."postmeta.meta_value >= NOW() order by rand() limit 1");

				if(is_object($adv[0]))
				{
					$expirydate = rwmb_meta( 'advs_expiry_date',array(), $adv[0]->id );
					$files 		= rwmb_meta( 'advs_file_advanced', 'type=file', $adv[0]->id );
					$video_url 	= rwmb_meta( 'advs_video_url',array(), $adv[0]->id );
					$url 		= rwmb_meta( 'advs_url',array(), $adv[0]->id );
					$adsense_code= rwmb_meta( 'advs_adsense_code',array(), $adv[0]->id );
					$url_target = rwmb_meta( 'advs_target',array(), $adv[0]->id );
					$position 	= rwmb_meta( 'advs_position',array(), $adv[0]->id );
				}
			}

			$target = $url_target != '' ? $url_target == 1 ? '_blank' : '_parent' : '_blank';

			$href = $url != '' ? "href='{$url}' target='" . $target . "'" : "href='javascript:void(0);'";
			if(strtotime($expirydate) >= strtotime(date('Y-m-d H:i')))
			{
				$output .= '';

				// if uploaded image or video to via media wordpress
				if(count($files) > 0)
				{
				    foreach ( $files as $file )
				    {
				    	if(preg_match('/.jpg|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.GIF/', $file['name']))
				    	{
					    	$data_ads = $file['url'];
				    		$data_ads_type = 'image';

				    	}
				    	else if(preg_match('/.mp4|.flv|.wmp|.MP4|.FLV|.WMP/', $file['name']))
				    	{
				    		// mp4
				    	}
				    }
				}
				else
				{
					if($is_mobile_or_tablet == false)
		    		{
						if($video_url != '')
						{
							if(preg_match('/youtube/', $video_url))
							{
								parse_str( parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars );
					    		$data_ads = $my_array_of_vars['v'];
					    		$data_ads_source = 'youtube';
							}
							else if(preg_match('/vimeo/', $video_url))
							{
								$vimeo_id = substr( $video_url, strrpos( $video_url, '/' )+1 );
								$data_ads = $vimeo_id;
								$data_ads_source = 'vimeo';
							}
							$data_ads_type = 'video';
						}
					}

					if($video_url == '' && $adsense_code != '')
					{
						$data_ads = str_replace('"', '', $adsense_code);
						$data_ads = do_shortcode($data_ads);
						$data_ads = str_replace('"', '', $data_ads);
						$data_ads_type = 'adsense';
						// echo '<input type="hidden" name="adsense_code" value="' . htmlspecialchars($adsense_code) . '"/>';
					}
				}

				$output .= '
					<div class="cactus-video-list">
				    	<div 	class="cactus-video-item"
				        		data-width 				= "900"
				                data-height				= "506"
				                data-source				= "@data-source"
				                data-link 				= "@data-link"
				                data-ads-type 			= "' . $data_ads_type . '"
				                data-ads 				= "' . $data_ads . '"
				                data-ads-source			= "' . $data_ads_source . '"
				                data-time-hide-ads 		= "' . $show_close_button . '"
				                data-close-button-name 	= "' . __('SKIP ADS >>','cactusthemes') . '"
				                data-link-redirect 		= "' . $url . '"
				                data-autoplay 			= "' . $theme_option_configs['auto_play'] . '"
				                ads-play-again-after 	= "' . $auto_turn_on_advs . '"
				                close-button-position 	= "' . $close_button_position . '"
				                ads-image-position 		= "' . $position . '"
				                auto-next-video 		= "' . $theme_option_configs['auto_load_next_video'] . '"
				                auto-next-video-options = "' . $theme_option_configs['auto_load_next_video_options'] . '"
				                is-mobile-or-tablet 	= "' . $is_mobile_or_tablet . '"
				                ';
				                if($enable_brand != '' && $enable_brand == 'yes')
			                    {
			                    	$output .= 'enable-brand="' . $enable_brand . '"';
			                	    $output .= 'brand-position="' . $brand_position . '"';

			                	    if($brand_logo != '')
			                	    {
			                	    	$output .= 'brand-logo="' . $brand_logo . '"';
			                	    }
			                	    else if($brand_text != '')
			                	    {
			                	    	$output .= 'brand-text="' . $brand_text . '"';
			                	    	$output .= 'brand-color="' . $brand_color . '"';
			                	    	$output .= 'brand-opacity="' . $brand_opacity . '"';
			                	    }
			                    }
                $output .='
				         >
				            <div class="cactus-video-details">
				            	<div class="cactus-video-content">
				                </div>
				            </div>

				            <div class="cactus-video-ads"></div>

				        </div>

				    </div>
				';
			}
			else
			{
				$output = do_shortcode($content);
			}
		}
		else
		{
			$output = do_shortcode($content);
		}
		return $output;

	}

	public function video_ads_custom_post_type()
	{

		//$label contain text realated post's name
		$label = array(
			'name' 			=> 'Advs',
			'singular_name' => 'Advs'
			);
		//args for custom post type
		$args = array(
			'labels' => $label,
			'description' => 'Post type about video advs management',
			'supports' => array(
	            'title'
	            // 'editor',
	            // 'excerpt',
	            // 'author',
	            // 'thumbnail',
	            // 'comments',
	            // 'trackbacks',
	            // 'revisions',
	            // 'custom-fields'
	        ), //Các tính năng được hỗ trợ trong post type
	        'taxonomies' => array(), //Các taxonomy được phép sử dụng để phân loại nội dung
	        'hierarchical' => false, //Cho phép phân cấp, nếu là false thì post type này giống như Post, true thì giống như Page
	        'public' => true, //Kích hoạt post type
	        'show_ui' => true, //Hiển thị khung quản trị như Post/Page
	        'show_in_menu' => true, //Hiển thị trên Admin Menu (tay trái)
	        'show_in_nav_menus' => true, //Hiển thị trong Appearance -> Menus
	        'show_in_admin_bar' => true, //Hiển thị trên thanh Admin bar màu đen.
	        'menu_position' => 5, //Thứ tự vị trí hiển thị trong menu (tay trái)
	        'menu_icon' => 'dashicons-format-gallery', //Đường dẫn tới icon sẽ hiển thị
	        'can_export' => true, //Có thể export nội dung bằng Tools -> Export
	        'has_archive' => true, //Cho phép lưu trữ (month, date, year)
	        'exclude_from_search' => false, //Loại bỏ khỏi kết quả tìm kiếm
	        'publicly_queryable' => true, //Hiển thị các tham số trong query, phải đặt true
	        'capability_type' => 'post' //
				);

		//register post type
		register_post_type('video-advs', $args);
	}


	/**
	*
	* start the Advs listing edit page
	*
	*/
	function video_advs_edit_columns( $columns ) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'id' => __( 'ID', APP_TD ),
			'title' => __( 'Description', APP_TD ),
			'expirydate' => __( 'Expiry Date', APP_TD ),
			'date' => __( 'Date', APP_TD ),
			'thumb' => __( 'Thumbnail', APP_TD ),
		);
		return $columns;
	}

	// return the values for each coupon column on edit.php page
	function video_advs_custom_columns( $column ) {
		global $post;
		switch ( $column ) {
			case 'expirydate':
				//echo get_post_meta($post->ID, 'advs_expiry_date', TRUE);
				echo rwmb_meta( 'advs_expiry_date' );
				break;
			case 'thumb' :
				    $images = rwmb_meta( 'advs_file_advanced', 'type=image' );
				    foreach ( $images as $image )
				    {
				    	echo "<a href='{$image['full_url']}' title='{$image['title']}' rel='file_advanced'><img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' /></a>";
				    }
				break;
		}
	}
}

$video_ads = new video_ads();


?>
