<?php
/* Register shortcode with Visual Composer */
add_action( 'after_setup_theme', 'reg_member' );
function reg_member(){
	if(function_exists('wpb_map')){
	wpb_map( array(
	   "name" => __("Member"),
	   "base" => "member",
	   "class" => "",
	   "controls" => "full",
	   "category" => __('Content'),
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("ID Member"),
			 "param_name" => "id",
			 "value" => '',
			 "description" => '',
		  ),
	   )
	));
	}
}