<?php
//http://www.mygeekpal.com/creating-an-ajax-powered-pagination-in-wordpress/
 function tm_alp_init() {
 	global $wp_query;
	$num_page =0;
 	// Add code to index pages.
 	if( !is_singular()|| is_page_template('page-templates/tpl-video-listing.php') || is_page_template('page-templates/tpl-blog-listing.php')) {	
 		// Queue JS and CSS
 		wp_enqueue_script(
 			'pbd-alp-load-posts',
 			plugin_dir_url( __FILE__ ) . 'js/load-posts.js',
 			array('jquery'),
 			'1.0',
 			true
 		);
 		
 		wp_enqueue_style(
 			'pbd-alp-style',
 			plugin_dir_url( __FILE__ ) . 'css/style.css',
 			false,
 			'1.0',
 			'all'
 		);
 		
 	
 		
 		// What page are we on? And what is the pages limit?
		if(is_page_template('page-templates/tpl-video-listing.php')){
			$paged = get_query_var('paged')?get_query_var('paged'):1;
			$args=array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'paged' => $paged,
				'tax_query' => array(
					array(                
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array(
							'post-format-video'
						),
						'operator' => 'IN'
					)
				)
			);
			$listing_query = new WP_Query($args);
			$num_page = $listing_query->max_num_pages;
		}
		if(is_page_template('page-templates/tpl-blog-listing.php')){
			$paged = get_query_var('paged')?get_query_var('paged'):1;
			$args=array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'paged' => $paged,
				'tax_query' => array(
					array(                
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array(
							'post-format-video'
						),
						'operator' => 'NOT IN'
					)
				)
			);
			$listing_query = new WP_Query($args);
			$num_page = $listing_query->max_num_pages;
		}
		if($num_page!=0){$max = $num_page;}
		else{
 			$max = $wp_query->max_num_pages;
		}
		$q_v = get_template_directory_uri().'/js/colorbox/jquery.colorbox-min.js';
 		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
		$text_lb1 = __('MORE','cactusthemes');
		$text_lb2 = __('LOADING POSTS','cactusthemes');
 		// Add some parameters for the JS.
		$ot_permali = get_option('permalink_structure');
 		wp_localize_script(
 			'pbd-alp-load-posts',
 			'pbd_alp',
 			array(
 				'startPage' => $paged,
 				'maxPages' => $max,
				'textLb1' => $text_lb1,
				'textLb2' => $text_lb2,
				'ot_permali' => $ot_permali,
 				'nextLink' => next_posts($max, false),
				'quick_view' => $q_v
 			)
 		);
 	}
 }
 add_action('template_redirect', 'tm_alp_init');
 
 ?>