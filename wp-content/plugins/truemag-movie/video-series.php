<?php
add_action( 'init', 'create_series_taxonomies', 0 );
function create_series_taxonomies(){
	if(function_exists('ot_get_option') && ot_get_option('enable_series','on')!='off'){
	$series_label = array(
		'name'              => __( 'Series', 'cactusthemes' ),
		'singular_name'     => __( 'Series', 'cactusthemes' ),
		'search_items'      => __( 'Search' ),
		'all_items'         => __( 'All Series' ),
		'parent_item'       => __( 'Parent Series' ),
		'parent_item_colon' => __( 'Parent Series:' ),
		'edit_item'         => __( 'Edit Series' ),
		'update_item'       => __( 'Update Series' ),
		'add_new_item'      => __( 'Add New Series' ),
		'new_item_name'     => __( 'New Genre Series' ),
		'menu_name'         => __( 'Series' ),
	);
	$args = array(
		'hierarchical'          => true,
		'labels'                => $series_label,
		'show_admin_column'     => true,
		'rewrite'               => array( 'slug' => ot_get_option('series_slug','video-series') ),
	);
	register_taxonomy('video-series', 'post', $args);
	}
}
function get_post_series($post_id = '', $series_id = '', $ids = '', $count = ''){
	$post_id = $post_id?$post_id:get_the_ID();
	$count = $count?$count:-1;
	$args = array();
	if($ids){
		$args = array(
			'post__in' => explode(',',$ids),
			'posts_per_page' => $count,
			'ignore_sticky_posts' => true,
			'order' => 'ASC'
		);
	}elseif($series_id){
		if(is_numeric($series_id)){
			$series = get_term_by('id', $series_id, 'video-series');
			$series_slug = $series->slug;
		}else{
			$series_slug = $series_id;
		}
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $count,
			'ignore_sticky_posts' => true,
			'order' => 'ASC',
			'video-series' => $series_slug,
		);
	}else{
		$series = wp_get_post_terms($post_id, 'video-series', array("fields" => "all"));
		$series_slug = $series[0]->slug;
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $count,
			'ignore_sticky_posts' => true,
			'order' => 'ASC',
			'video-series' => $series_slug,
		);
	}
	
	if(!empty($args)){
		$series_query = new WP_Query( $args );
		if($series_query->have_posts()){
			echo '<ul class="video-series-list list-inline">';
			echo '<li class="series-title">'.__('EPISODES','cactusthemes').':</li>';
			while($series_query->have_posts()){
				$series_query->the_post(); ?>
				<li><a class="btn btn-sm btn-default <?php echo get_the_ID()==$post_id?'series-current':'' ?>" href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>"><i class="fa fa-play"></i> <?php the_title() ?></a></li>
			<?php
            }
			echo '</ul>';
		}//if have post
		wp_reset_postdata();
	}
}

function parse_video_series($atts, $content){	
	$series = isset($atts['series']) ? $atts['series'] : '';
	$ids = isset($atts['ids']) ? $atts['ids'] : '';
	$count = isset($atts['count']) ? $atts['count'] : '';
	ob_start();
	get_post_series('', $series, $ids, $count);
	$html = ob_get_clean();
	return $html;	
}
add_shortcode( 'movie-series', 'parse_video_series' );

add_action( 'after_setup_theme', 'reg_series' );
function reg_series(){
	if(function_exists('wpb_map')){
	wpb_map( array(
	   "name" => __("Series"),
	   "base" => "movie-series",
	   "icon" => "movie-series",
	   "class" => "",
	   "controls" => "full",
	   "category" => __('Content'),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Series"),
			 "param_name" => "series",
			 "value" => '',
			 "description" => 'Enter Video Series ID or slug',
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Post IDs"),
			 "param_name" => "ids",
			 "value" => '',
			 "description" => 'Enter specify post IDs to display (ex: 6,9,18)',
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Count"),
			 "param_name" => "count",
			 "value" => '',
			 "description" => 'Enter number of posts (Leave blank to display all)',
		  ),
	   )
	));
	}
}