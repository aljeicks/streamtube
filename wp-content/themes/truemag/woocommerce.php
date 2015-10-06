<?php 
/* This is default template for Woo */
global $global_page_layout;
$layout = get_post_meta(get_the_ID(),'sidebar',true);
if(is_shop()){
	$layout = get_post_meta(get_option('woocommerce_shop_page_id'),'sidebar',true);
}
if(!$layout){
	$layout = $global_page_layout ? $global_page_layout : ot_get_option('page_layout','right');
}
if(is_product() && !is_active_sidebar( 'single_woo_sidebar' )){
	$layout = 'full';
}
global $sidebar_width;
global $post;
get_header();
$topnav_style = ot_get_option('topnav_style','dark');	
?>
	<div class="blog-heading <?php echo $topnav_style=='light'?'heading-light':'' ?>">
    	<div class="container">
            <h1><?php if(is_single()){ the_title(); }else{ woocommerce_page_title(); } ?></h1>
        </div>
    </div><!--blog-heading-->
    <div id="body">
        <div class="container">
            <div class="row">
  				<div id="content" class="<?php echo $layout!='full'?($sidebar_width?'col-md-9':'col-md-8'):'col-md-12' ?><?php echo ($layout == 'left') ? " revert-layout":"";?>" role="main">
                <?php
					//content
					woocommerce_content();
					//share
					$social_post= get_post_meta($post->ID,'showhide_social',true);
					if($social_post=='show'){ //check if show social share
						gp_social_share(get_the_ID());
					}
					if($social_post=='def'){
						if(ot_get_option( 'page_show_socialsharing', 1)){ //check if show social share
							gp_social_share(get_the_ID());
						}
					}
					?>
                </div><!--#content-->
                <?php
				if($layout != 'full'){
					get_sidebar();
				}?>
            </div><!--/row-->
        </div><!--/container-->
    </div><!--/body-->
<?php get_footer(); ?>