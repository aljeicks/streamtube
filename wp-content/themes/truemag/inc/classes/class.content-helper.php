<?php
class CT_ContentHelper{
	/* 
	 * Get related posts of a post based on conditions
	 *
	 * $posttypes: post types
	 * $tags: tag slug
	 * $postformat : post format
	 */
	function tm_get_related_posts($posttypes, $tags, $postformat, $count, $orderby, $args = array()){
		$args = '';
		$cat = '';
		if(ot_get_option('related_video_by')){
			$cat = $tags;
			$tags = '';
		}
		if($posttypes==''){$posttypes='post';}
		global $post;
		if($postformat=='video'){
		$args = array(
			'post_type' => $posttypes,
			'posts_per_page' => $count,
			'post_status' => 'publish',
			'post__not_in' =>  array(get_the_ID($post)),
			'ignore_sticky_posts' => 1,
			'orderby' => $orderby,
			'tag' => $tags,
			'cat' => $cat,
			'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => 'post-format-video',
			))
		);
		}
		else if($postformat=='standard')
		{
			$args = array(
			'post_type' => $posttypes,
			'posts_per_page' => $count,
			'post_status' => 'publish',
			'post__not_in' =>  array(get_the_ID($post)),
			'ignore_sticky_posts' => 1,
			'orderby' => $orderby,
			'tag' => $tags,
			'cat' => $cat,
			'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => 'post-format-video',
				'operator' => 'NOT IN'
			)),
		);
		}else {
			$args = array(
			'post_type' => $posttypes,
			'posts_per_page' => $count,
			'post_status' => 'publish',
			'post__not_in' =>  array(get_the_ID($post)),
			'orderby' => $orderby,
			'tag' => $tags,
			'cat' => $cat,
			'ignore_sticky_posts' => 1
		);	
		}
		
		$query = new WP_Query($args);
		
		return $query;
	}
	/* 
	 * Get item for trending, popular
	 * $conditions : most by :view, comment, likes, latest
	 * $number : Number of post
	 * $ids : List id
	 *
	 *
	 */
	function tm_get_popular_posts($conditions, $tags, $number, $ids,$sort_by, $categories, $args = array(), $themes_pur, $postformats=false){
		$args = '';
		if($postformats){
			$postformats = explode(',',$postformats);
			if($postformats == array('post-format-standard')){
				$format_query =	array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => array('post-format-quote','post-format-audio','post-format-gallery','post-format-image','post-format-link','post-format-video'),
						'operator' => 'NOT IN',
					)
				);
			}else{
				$format_query =	array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => $postformats,
						'operator' => 'IN',
					)
				);
			}
		}
		if($conditions=='most_viewed' && $ids==''){
			  $args = array(
				  'post_type' => 'post',
				  'posts_per_page' => $number,
				  'meta_key' => '_count-views_all',
				  'orderby' => 'meta_value_num',
				  'order' => $sort_by,
				  'post_status' => 'publish',
				  'tag' => $tags,
				  'ignore_sticky_posts' => 1,
					'tax_query' => array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => 'post-format-audio',
						'operator' => 'NOT IN'
					)),
				  
			  );
			  	if($postformats){
					$args['tax_query'] =  $format_query;
				}elseif($themes_pur!='0'){
				$args['tax_query'] =  array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => 'post-format-video',
					));
				}			
		}elseif($conditions=='most_comments'  && $ids==''){
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				'orderby' => 'comment_count',
				'order' => $sort_by,
				'post_status' => 'publish',
				'tag' => $tags,
				'ignore_sticky_posts' => 1,
					'tax_query' => array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => 'post-format-audio',
						'operator' => 'NOT IN'
					)),
				);
				if($postformats){
					$args['tax_query'] =  $format_query;
				}elseif($themes_pur!='0'){
				$args['tax_query'] =  array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => 'post-format-video',
					));
				}			

		}elseif($conditions=='high_rated'  && $ids==''){
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				'meta_key' => '_count-views_all',
				'orderby' => 'meta_value_num',
				'order' => $sort_by,
				'post_status' => 'publish',
				'tag' => $tags,
				'ignore_sticky_posts' => 1,
				);
				if($postformats){
					$args['tax_query'] =  $format_query;
				}elseif($themes_pur!='0'){
				$args['tax_query'] =  array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => 'post-format-video',
					));
				}			

		}elseif($conditions=='playlist'){
			$ids = explode(",", $ids);
			$gc = array();
			$dem=0;
			foreach ( $ids as $grid_cat ) {
				$dem++;
				array_push($gc, $grid_cat);
			}
			$args = array(
				'post_type' => 'post',
				'post__in' =>  $gc,
				'posts_per_page' => $number,
				'orderby' => 'post__in',
				'order' => $sort_by,
				'ignore_sticky_posts' => 1,
				'tax_query' => array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => 'post-format-video',
				)),
			);
		}elseif($ids!=''){
			$ids = explode(",", $ids);
			$gc = array();
			$dem=0;
			foreach ( $ids as $grid_cat ) {
				$dem++;
				array_push($gc, $grid_cat);
			}
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				'order' => $sort_by,
				'post_status' => 'publish',
				'tag' => $tags,
				'post__in' =>  $gc,
				'ignore_sticky_posts' => 1,
			);
		}elseif($ids=='' && $conditions=='latest'){
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				'order' => $sort_by,
				'post_status' => 'publish',
				'tag' => $tags,
				'ignore_sticky_posts' => 1,
				);
				if($postformats){
					$args['tax_query'] =  $format_query;
				}elseif($themes_pur!='0'){
				$args['tax_query'] =  array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => 'post-format-video',
					));
				}			

		}elseif($ids=='' && $conditions=='title'){
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				'order' => $sort_by,
				'orderby' => 'title',
				'post_status' => 'publish',
				'tag' => $tags,
				'ignore_sticky_posts' => 1,
				);
				if($postformats){
					$args['tax_query'] =  $format_query;
				}elseif($themes_pur!='0'){
				$args['tax_query'] =  array(
					array(
						'taxonomy' => 'post_format',
						'field' => 'slug',
						'terms' => 'post-format-video',
					));
				}			

		}elseif($ids=='' && $conditions=='random'){
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				'order' => $sort_by,
				'orderby' => 'rand',
				'post_status' => 'publish',
				'tag' => $tags,
				'ignore_sticky_posts' => 1,

			);
			if($postformats){
				$args['tax_query'] =  $format_query;
			}
		}elseif($ids=='' && $conditions=='likes'){
			//echo 'ok';
			global $wpdb;	
			$show_count = 1 ;
			$time_range = 'all';
			//$show_type = $instance['show_type'];
			$order_by = 'ORDER BY like_count DESC, post_title';
			$show_excluded_posts = get_option('wti_like_post_show_on_widget');
			$excluded_post_ids = explode(',', get_option('wti_like_post_excluded_posts'));
			
			if(!$show_excluded_posts && count($excluded_post_ids) > 0) {
				$where = "AND post_id NOT IN (" . get_option('wti_like_post_excluded_posts') . ")";
			}
			$query = "SELECT post_id, SUM(value) AS like_count, post_title FROM `{$wpdb->prefix}wti_like_post` L, {$wpdb->prefix}posts P ";
			$query .= "WHERE L.post_id = P.ID AND post_status = 'publish' AND value > -1 $where GROUP BY post_id $order_by";
			$posts = $wpdb->get_results($query);
			$cates_ar = $cates;
			$p_data = array();
			//print_r($posts);
			if(count($posts) > 0) {
				foreach ($posts as $post) {
					$p_data[] = $post->post_id;
				}
			}
			//$p_data = array_reverse($p_data);
			//print_r($p_data);
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				//'order' => $sort_by,
				'orderby'=> 'post__in',
    			'order' => 'ASC',
				'post_status' => 'publish',
				'tag' => $tags,
				'post__in' =>  $p_data,
				'ignore_sticky_posts' => 1,
			);
		}
		if(!is_array($categories)) {
			if(isset($categories)){
				$cats = explode(",",$categories);
				if(is_numeric($cats[0])){
					//$args += array('category__in' => $cats);
					$args['category__in'] = $cats;
				}else{			 
					$args['category_name'] = $categories;
				}
			}
		}else if(count($categories) > 0){
			$args += array('category__in' => $categories);
		}
		
		$query = new WP_Query($args);
		
		return $query;
	}


}

?>