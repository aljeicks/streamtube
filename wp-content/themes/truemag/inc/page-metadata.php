<?php

/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'ct_page_meta_boxes' );

if ( ! function_exists( 'ct_page_meta_boxes' ) ){
	function ct_page_meta_boxes() {
	  $page_meta_box = array(
		'id'        => 'page_meta_box',
		'title'     => 'Page Settings',
		'desc'      => '',
		'pages'     => array( 'page' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
			  'id'          => 'sidebar',
			  'label'       => __('Sidebar','cactusthemes'),
			  'desc'        => __('Main Sidebar appearance','cactusthemes'),
			  'std'         => '',
			  'type'        => 'select',
			  'class'       => '',
			  'choices'     => array(
			  	  array(
					'value'       => '',
					'label'       => 'Default',
					'src'         => ''
				  ),
				  array(
					'value'       => 'left',
					'label'       => 'Left Sidebar',
					'src'         => ''
				  ),
				  array(
					'value'       => 'right',
					'label'       => 'Right Sidebar',
					'src'         => ''
				  ),
				  array(
					'value'       => 'full',
					'label'       => 'No Sidebar',
					'src'         => ''
				  )
			   )
			),
			array(	
					'id'          => 'background',
				  'label'       => __('Background','cactusthemes'),
				  'desc'        => __('If used with Page Template "Front Page" and Header Style is "Sidebar" or "Classy", this will be header background','cactusthemes'),
				  'std'         => '',
				  'type'        => 'background'
			)
		 )
	  );
	  ot_register_meta_box( $page_meta_box );
	  
	  //front page metabox
	  $front_meta_box = array(
		'id'        => 'front_meta_box',
		'title'     => 'Front Page Settings',
		'desc'      => '',
		'pages'     => array( 'page' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
			  'id'          => 'header_style',
			  'label'       => __('Header Stye','cactusthemes'),
			  'desc'        => __('Only use with Page template "Front Page"','cactusthemes'),
			  'std'         => '',
			  'type'        => 'select',
			  'class'       => '',
			  'choices'     => array(
			  	  array(
					'value'       => 0,
					'label'       => 'Default',
					'src'         => ''
				  ),
				  array(
					'value'       => 'carousel',
					'label'       => 'Big Carousel',
					'src'         => ''
				  ),
				  array(
					'value'       => 'metro',
					'label'       => 'Metro Carousel',
					'src'         => ''
				  ),
				  array(
					'value'       => 'classy',
					'label'       => 'Classy Slider',
					'src'         => ''
				  ),
				  array(
					'value'       => 'classy2',
					'label'       => 'Classy Slider 2',
					'src'         => ''
				  ),
				  array(
					'value'       => 'classy3',
					'label'       => 'Classy Slider 3',
					'src'         => ''
				  ),
				  array(
					'value'       => 'amazing',
					'label'       => 'Amazing Slider',
					'src'         => ''
				  ),
				  array(
					'value'       => 'video_slider',
					'label'       => 'Video Slider',
					'src'         => ''
				  ),
				  array(
					'value'       => 'sidebar',
					'label'       => 'Sidebar',
					'src'         => ''
				  )
			   )
			),
			array(
				'id'          => 'header_home_postids',
				'label'       => 'Header - Items IDs',
				'desc'        => 'Include post IDs to show on Header of Front Page',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'home',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => ''
			  ),
			  array(
				'id'          => 'header_home_condition',
				'label'       => 'Header - Condition',
				'desc'        => 'Select condition to query post on Header of Front Page',
				'std'         => '',
				'type'        => 'select',
				'section'     => 'home',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'choices'     => array( 
				  array(
					'value'       => 0,
					'label'       => 'Default',
					'src'         => ''
				  ),
				  array(
					'value'       => 'latest',
					'label'       => 'Lastest',
					'src'         => ''
				  ),
				  array(
					'value'       => 'most_viewed',
					'label'       => 'Most Viewed',
					'src'         => ''
				  ),
				  array(
					'value'       => 'most_comments',
					'label'       => 'Most Comments',
					'src'         => ''
				  ),
				  array(
					'value'       => 'most_liked',
					'label'       => 'Most liked',
					'src'         => ''
				  ),
				  array(
					'value'       => 'title',
					'label'       => 'Title',
					'src'         => ''
				  ),
				  array(
					'value'       => 'modified',
					'label'       => 'Modified',
					'src'         => ''
				  ),
				  array(
					'value'       => 'random',
					'label'       => 'Random',
					'src'         => ''
				  )
				),
			  ),
			  array(
				'id'          => 'header_home_cat',
				'label'       => 'Header - Category (ID or slug)',
				'desc'        => 'Include Category ID, slug to show on Header Home section (Ex: 15,26,37 or foo,bar,jazz)',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'home',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => ''
			  ),
			  array(
				'id'          => 'header_home_tag',
				'label'       => 'Header - Items Tags',
				'desc'        => 'Include Tags to show on Header Home section (Ex: foo,bar)',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'home',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => ''
			  ),
			  array(
				'id'          => 'header_home_order',
				'label'       => 'Header - Items Order',
				'desc'        => '',
				'std'         => '',
				'type'        => 'select',
				'section'     => 'home',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => '',
				'choices'     => array( 
				  array(
					'value'       => 0,
					'label'       => 'Default',
					'src'         => ''
				  ),
				  array(
					'value'       => 'desc',
					'label'       => 'DESC',
					'src'         => ''
				  ),
				  array(
					'value'       => 'asc',
					'label'       => 'ASC',
					'src'         => ''
				  )
				),
			  ),
			  array(
				'id'          => 'header_home_number',
				'label'       => 'Header - Number of Items',
				'desc'        => 'Adjust this value to have best layout that fits screen',
				'std'         => '',
				'type'        => 'text',
				'section'     => 'home',
				'rows'        => '',
				'post_type'   => '',
				'taxonomy'    => '',
				'min_max_step'=> '',
				'class'       => ''
			  ),
			
		 )
	  );
	  ot_register_meta_box( $front_meta_box );
	  

	}
}


