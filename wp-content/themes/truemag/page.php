<?php 
/* This is default template for page: Right Sidebar 
 *
 * Check theme option to display default layout
 */
global $global_page_layout;
$layout = get_post_meta(get_the_ID(),'sidebar',true);
if(!$layout){
	$layout = $global_page_layout ? $global_page_layout : ot_get_option('page_layout','right');
}
if(is_plugin_active('buddypress/bp-loader.php') && bp_current_component()){
	$layout = ot_get_option('buddypress_layout','right');
}elseif(function_exists('is_bbpress') && is_bbpress()){
	$layout = ot_get_option('bbpress_layout','right');
}
global $sidebar_width;
global $post;
get_header();
if(!is_front_page()&&!is_page_template('page-templates/front-page.php')){
$topnav_style = ot_get_option('topnav_style','dark');	
?>
	<div class="blog-heading <?php echo $topnav_style=='light'?'heading-light':'' ?>">
    	<div class="container">
            <h1><?php echo $post->post_title ?></h1>
            <?php if(is_plugin_active('buddypress/bp-loader.php') && bp_current_component()){ //buddypress
				if(bp_is_directory()){ //sitewide
					if(bp_is_activity_component()){
						//activity
					}elseif(bp_is_groups_component()){
						//groups
						?>
                        <div id="group-dir-search" class="dir-search pull-right" role="search">
							<?php bp_directory_groups_search_form(); ?>
                        </div><!-- #group-dir-search -->
                        <?php
					}elseif(bp_current_component('members')){
						//members
						?>
                        <div id="members-dir-search" class="dir-search pull-right" role="search">
							<?php bp_directory_members_search_form(); ?>
                        </div><!-- #members-dir-search -->
                        <?php
					}
				}
			} ?>
        </div>
    </div><!--blog-heading-->
<?php } ?>
    <div id="body">
        <div class="container">
            <div class="row">
            	<?php 
				$front_page_layout = ot_get_option('front_page_layout');
				if($front_page_layout=='0'&& is_front_page()){?>
                <div id="content" class="col-md-12" role="main">
                <?php } else {?>
  				<div id="content" class="<?php echo $layout!='full'?($sidebar_width?'col-md-9':'col-md-8'):'col-md-12' ?><?php echo ($layout == 'left') ? " revert-layout":"";?>" role="main">
                <?php }
					//content
					if (have_posts()) :
						while (have_posts()) : the_post();
							get_template_part('content','single');
						endwhile;
					endif;
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
					//author
					if(ot_get_option('page_show_authorbio',0) != 0){?>
						<div class="about-author">
							<div class="author-avatar">
								<?php echo tm_author_avatar(); ?>
							</div>
							<div class="author-info">
								<h5><?php echo __('About The Author','cactusthemes'); ?></h5>
								<?php the_author(); ?> - 
								<?php the_author_meta('description'); ?>
							</div>
							<div class="clearfix"></div>
						</div><!--/about-author-->
					<?php }
					comments_template( '', true );
					?>
                </div><!--#content-->
                <?php
				if($front_page_layout=='0'&& is_front_page()){
				}else if($layout != 'full'){
					get_sidebar();
				}?>
            </div><!--/row-->
        </div><!--/container-->
    </div><!--/body-->
<?php get_footer(); ?>