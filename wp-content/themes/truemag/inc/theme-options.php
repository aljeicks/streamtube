<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => '<i class="fa fa-cogs"><!-- --></i>General'
      ),
      array(
        'id'          => 'color',
        'title'       => '<i class="fa fa-magic"><!-- --></i>Colors & Background'
      ),
      array(
        'id'          => 'fonts',
        'title'       => '<i class="fa fa-font"><!-- --></i>Fonts Settings'
      ),
      array(
        'id'          => 'navigation',
        'title'       => '<i class="fa fa-compass"><!-- --></i>Main Navigation'
      ),
      array(
        'id'          => 'home',
        'title'       => '<i class="fa fa-home"><!-- --></i>Front Page'
      ),
      array(
        'id'          => 'single_video',
        'title'       => '<i class="fa fa-file-text-o"><!-- --></i>Single Post/Video'
      ),
      array(
        'id'          => 'single_page',
        'title'       => '<i class="fa fa-file"><!-- --></i>Single Page'
      ),
      array(
        'id'          => 'blog',
        'title'       => '<i class="fa fa-pencil-square"><!-- --></i>Blog'
      ),
      array(
        'id'          => 'cat_video',
        'title'       => '<i class="fa fa-th-large"><!-- --></i>Category'
      ),
	  array(
        'id'          => 'series',
        'title'       => '<i class="fa fa-film"><!-- --></i>Video Series'
      ),
      array(
        'id'          => 'headline_video',
        'title'       => '<i class="fa fa-bookmark"><!-- --></i>Headline Section'
      ),
      array(
        'id'          => 'search',
        'title'       => '<i class="fa fa-search"><!-- --></i>Search'
      ),
      array(
        'id'          => '404',
        'title'       => '<i class="fa fa-exclamation-triangle"><!-- --></i>404'
      ),
      array(
        'id'          => 'advertising',
        'title'       => '<i class="fa fa-bullhorn"><!-- --></i>Advertising'
      ),
      array(
        'id'          => 'social_account',
        'title'       => '<i class="fa fa-twitter-square"><!-- --></i>Social Account'
      ),
      array(
        'id'          => 'social_share',
        'title'       => '<i class="fa fa-share-square"><!-- --></i>Social Share'
      ),
	  array(
        'id'          => 'user_submit',
        'title'       => '<i class="fa fa-upload"><!-- --></i>User Submit Video'
      ),
	  array(
        'id'          => 'buddypress',
        'title'       => '<i class="fa fa-user"><!-- --></i>BuddyPress'
      ),
	  array(
        'id'          => 'bbpress',
        'title'       => '<i class="fa fa-group"><!-- --></i>BbPress'
      ),
	  array(
        'id'          => 'youtube_setting',
        'title'       => '<i class="fa fa-youtube"><!-- --></i>Youtube Settings'
      ),
	  array(
        'id'          => 'video-ads',
        'title'       => '<i class="fa fa-play"><!-- --></i>Video Ads'
      ),
      array(
        'id'          => 'theme_update',
        'title'       => '<i class="fa fa-cloud-download"><!-- --></i>Theme Update'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'theme_purpose',
        'label'       => 'Theme Purpose: Video / Magazine',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
		  array(
            'value'       => '0',
            'label'       => 'Magazine',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Video',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'theme_layout',
        'label'       => 'Theme Layout',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
		  array(
            'value'       => 0,
            'label'       => 'Full Width',
            'src'         => ''
          ),
          array(
            'value'       => 1,
            'label'       => 'Boxed',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'flat-style',
        'label'       => 'Flat style mode',
        'desc'        => 'Enable if you want your site looks more flat',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Enable Flat style',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'sidebar_width',
        'label'       => 'Sidebar Width',
        'desc'        => 'Select Sidebar Width',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => '1/3 Page width',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => '1/4 Page width',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'echo_meta_tags',
        'label'       => 'SEO - Echo Meta Tags',
        'desc'        => 'By default, TrueMag generates its own SEO meta tags (for example: Facebook Meta Tags). If you are using another SEO plugin like YOAST or a Facebook plugin, you can turn off this option',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
		  array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'copyright',
        'label'       => 'Copyright Text',
        'desc'        => 'Appear in footer',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'right_to_left',
        'label'       => 'RTL mode',
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Enable RTL',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'custom_css',
        'label'       => 'Custom CSS',
        'desc'        => 'Enter custom CSS. Ex: <i>.class{ font-size: 13px; }</i>',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'google_analytics_code',
        'label'       => 'Custom Code',
        'desc'        => 'Enter custom code or JS code here. For example, enter Google Analytics',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'favicon',
        'label'       => 'Favicon',
        'desc'        => 'Upload favicon (.ico)',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'logo_image',
        'label'       => 'Logo Image',
        'desc'        => 'Upload your logo image',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'retina_logo',
        'label'       => 'Retina Logo (optional)',
        'desc'        => 'Retina logo should be two time bigger than the custom logo. Retina Logo is optional, use this setting if you want to strictly support retina devices.',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'login_logo',
        'label'       => 'Login Logo Image',
        'desc'        => 'Upload your Admin Login logo image',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),  
      array(
        'id'          => 'quick_view_info',
        'label'       => 'Quick View Info / Quick View Video',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'loading_effect',
        'label'       => 'Pre-Loading Effect',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 0,
            'label'       => 'Disable',
            'src'         => ''
          ),
		  array(
            'value'       => 2,
            'label'       => 'Home Page only',
            'src'         => ''
          ),
		  array(
            'value'       => 1,
            'label'       => 'Enable',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'user_show_info',
        'label'       => 'Show Signed-In User Info',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 0,
            'label'       => 'No',
            'src'         => ''
          ),
		  array(
            'value'       => 1,
            'label'       => 'Yes',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'main_color_1',
        'label'       => 'Main color 1',
        'desc'        => 'Used in dark div',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'main_color_2',
        'label'       => 'Main color 2',
        'desc'        => 'Used in light div',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'content_color',
        'label'       => 'Content color',
        'desc'        => 'Used in almost content',
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'page_background',
        'label'       => 'Page Background',
        'desc'        => 'Whole page background in Fullwidth, and side background in Boxed mode',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'text_font',
        'label'       => 'Main Font',
        'desc'        => 'Enter font-family name here. <a href="http://www.google.com/fonts/" target="_blank">Google Fonts</a> are supported. For example, if you choose "Source Code Pro" Google Font with font-weight 400,500,600, enter <i>Source Code Pro:400,500,600</i>',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'text_size',
        'label'       => 'Content Text - Size',
        'desc'        => 'Enter font-size for content. Ex: "13px" or "1em"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'text_weight',
        'label'       => 'Content Text - Weight',
        'desc'        => 'Enter font weight for content. For example "200"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'h1_size',
        'label'       => 'H1 - Size',
        'desc'        => 'Enter font size for H1. For example, "18px" or "2em"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'h1_weight',
        'label'       => 'H1 - Weight',
        'desc'        => 'Enter font weight for H1. For example "200"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'h2_size',
        'label'       => 'H2 - Size',
        'desc'        => 'Enter font size for H2. For example "16px" or "1.2em"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'h2_weight',
        'label'       => 'H2 - Weight',
        'desc'        => 'Enter font weight for H2. For example "200"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'h3_size',
        'label'       => 'H3 - Size',
        'desc'        => 'Enter font size for H3. For example "14px" or "1em"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'h3_weight',
        'label'       => 'H3 - Weight',
        'desc'        => 'Enter font weight for H3. For example "200"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'nav_size',
        'label'       => 'Main Navigation - Size',
        'desc'        => 'Enter font size for Navigation. For example, "18px" or "2em"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'nav_weight',
        'label'       => 'Main Navigation - Weight',
        'desc'        => 'Enter font weight for Navigation. For example "200"',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'custom_font',
        'label'       => 'Upload Custom Font',
        'desc'        => 'Upload your font, uses this font with name "Custom Font" in above settings',
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'fonts',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'topnav_style',
        'label'       => 'Top Navigation Style',
        'desc'        => 'Select style for Main menu and Headline',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'dark',
            'label'       => 'Dark',
            'src'         => ''
          ),
          array(
            'value'       => 'light',
            'label'       => 'Light',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'topnav_layout',
        'label'       => 'Top Navigation Layout',
        'desc'        => 'Select Layout style for Main menu and Headline',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '',
            'label'       => 'Default',
            'src'         => ''
          ),
          array(
            'value'       => 'layout-2',
            'label'       => 'Layout 2 (Search box on Navigation)',
            'src'         => ''
          ),
          array(
            'value'       => 'layout-3',
            'label'       => 'Layout 3 (Headline on Top)',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'topnav_fixed',
        'label'       => 'Fixed Top Navigation',
        'desc'        => 'Select Enable to use Fixed Navigation',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 0,
            'label'       => 'Disable',
            'src'         => ''
          ),
          array(
            'value'       => 1,
            'label'       => 'Enable',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'topnav_height',
        'label'       => 'Main Navigation Height',
        'desc'        => 'Enter custom value (in pixels, for example: 100) to match with your logo size',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'disable_mainmenu',
        'label'       => 'Hide Main Navigation',
        'desc'        => 'If you are using another menu plugin (for example MashMenu), maybe you want to hide theme\'s default main navigation',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'no',
            'label'       => 'No',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'mobile_nav',
        'label'       => 'Mobile Navigation Style',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Off-Canvas',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Classic dropdown',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'megamenu',
        'label'       => 'Enable Megamenu',
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
      ),
      array(
        'id'          => 'mobile_width',
        'label'       => 'Activate Mobile Navigation When Browser Width Is',
        'desc'        => 'Enter value (in pixels, for example: 767) at which, menu turns into mobile mode',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'navigation',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'header_home_style',
        'label'       => 'Header Style',
        'desc'        => 'Select style header of Home page',
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
            'label'       => 'Classy Slider (Vertical)',
            'src'         => ''
          ),
		  array(
            'value'       => 'classy2',
            'label'       => 'Classy Slider 2 (Horizon)',
            'src'         => ''
          ),
		  array(
            'value'       => 'classy3',
            'label'       => 'Classy Slider 3 (Horizon & Big Image)',
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
        ),
      ),
	  array(
        'id'          => 'header_home_auto',
        'label'       => 'Auto Play Slider',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'home',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 1,
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 0,
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'header_home_auto_timeout',
        'label'       => 'Auto Play Timeout',
        'desc'        => 'Timeout in milisecond',
        'std'         => '3000',
        'type'        => 'numeric-slider',
        'section'     => 'home',
        'class'       => '',
		'min_max_step' => '500,10000,500',
        'choices'     => array(),
		'condition' => 'header_home_auto:is(1)'
      ),
	  array(
        'id'          => 'header_home_auto_duration',
        'label'       => 'Auto Play Duration',
        'desc'        => 'Transition Duration time in milisecond',
        'std'         => '800',
        'type'        => 'numeric-slider',
        'section'     => 'home',
        'class'       => '',
		'min_max_step' => '200,2000,100',
        'choices'     => array(),
		'condition' => 'header_home_auto:is(1)'
      ),
	  array(
        'id'          => 'header_home_use_player',
        'label'       => 'Header Video Item',
        'desc'        => 'Display player instead of thumbnail images (Use only for 3 Classy slider styles)',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'home',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 0,
            'label'       => 'Featured Image',
            'src'         => ''
          ),
          array(
            'value'       => 1,
            'label'       => 'Video Player',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'quick_view_for_slider',
        'label'       => 'Quick View Info / Quick View Video for Metro Carousel, Big Carousel',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'home',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 0,
            'label'       => 'Hide',
            'src'         => ''
          ),
          array(
            'value'       => 1,
            'label'       => 'Show',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'header_home_height',
        'label'       => 'Header Height',
        'desc'        => 'Use for Big Carousel, Metro Carousel (Ex: 400)',
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
        'id'          => 'header_home_hidecat',
        'label'       => 'Hide Category in Items\' Title',
        'desc'        => 'Check if you want to hide categories link below title',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 1,
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'maintop_layout',
        'label'       => 'Main Top Sidebar Layout (for Header Style - Sidebar)',
        'desc'        => 'Select layout for Main Top Sidebar',
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
            'value'       => 'full',
            'label'       => 'Full Width',
            'src'         => ''
          ),
          array(
            'value'       => 'boxed',
            'label'       => 'Boxed',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'header_home_bg',
        'label'       => 'Header Background (for Header Style - Classy)',
        'desc'        => '',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'home',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
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
      array(
        'id'          => 'show_hide_title',
        'label'       => 'Show/Hide Page Title',
        'desc'        => 'Show of Hide Page Title of Front Page',
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
            'value'       => 'hide',
            'label'       => 'Hide',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'front_page_layout',
        'label'       => 'Front page layout',
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
            'value'       => '1',
            'label'       => 'Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Full Width',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'auto_get_info',
        'label'       => 'Auto Fetch Data',
        'desc'        => 'This is an admin feature when adding new video post. Select which data to auto-fetch from video network (support YouTube and Vimeo) when entering video URL',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Fetch Video Title',
            'src'         => ''
          ),
          array(
            'value'       => '2',
            'label'       => 'Fetch Video Description',
            'src'         => ''
          ),
          array(
            'value'       => '3',
            'label'       => 'Fetch Video Tags',
            'src'         => ''
          ),
		  array(
            'value'       => '4',
            'label'       => 'Fetch Video Views',
            'src'         => ''
          ),
        ),
      ),
      array(
        'id'          => 'single_layout_video',
        'label'       => 'Video Player Layout',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'full_width',
            'label'       => 'Full-width',
            'src'         => ''
          ),
          array(
            'value'       => 'inbox',
            'label'       => 'Inbox',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'single_layout_blog',
        'label'       => 'Blog Layout',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'inbox',
            'label'       => 'Inbox',
            'src'         => ''
          ),
          array(
            'value'       => 'full_width',
            'label'       => 'Full-width',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'single_player_video',
        'label'       => 'Player for Video File',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'jwplayer',
            'label'       => 'JWPlayer',
            'src'         => ''
          ),
          array(
            'value'       => 'flowplayer',
            'label'       => 'FlowPlayer ',
            'src'         => ''
          ),
		  array(
            'value'       => 'videojs',
            'label'       => 'Video.js - HTML5 Video Player ',
            'src'         => ''
          ),
		  array(
            'value'       => 'mediaelement',
            'label'       => ' WordPress Native Player: MediaElement',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'force_videojs',
        'label'       => 'Force Using VideoJS for external videos',
        'desc'        => 'YouTube, Vimeo, DailyMotion',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'single_video',
        'rows'        => '',
		'condition'   => 'single_player_video:is(videojs)',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
      ),

      array(
        'id'          => 'single_layout_ct_video',
        'label'       => 'Page Layout',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => 'Sidebar Right',
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => 'Full Width',
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => 'Sidebar Left',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'auto_play_video',
        'label'       => 'Auto Play Video',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'no',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'auto_load_next_video',
        'label'       => 'Auto Load Next Video',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'no',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
	   array(
        'id'          => 'auto_load_next_prev',
        'label'       => 'Choose Next Video for Auto Load',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'condition'        => 'auto_load_next_video:is(1)',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'Newer Video',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Older Video',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'user_turnoff_load_next',
        'label'       => 'Auto Next button for Visitors',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'Disable',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Enable',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'auto_load_same_cat',
        'label'       => 'Navigate next/previous video by',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Category',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Tag',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'delay_video',
        'label'       => 'Delay',
        'desc'        => 'X seconds. Ex: 5',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'video_toolbar_position',
        'label'       => 'Video Toolbar Position',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'top',
            'label'       => 'Top of content',
            'src'         => ''
          ),
          array(
            'value'       => 'bottom',
            'label'       => 'Bottom of content',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'video_toolbar_for_post',
        'label'       => 'Enable Video Toolbar for Standard post',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 0,
            'label'       => 'Disable',
            'src'         => ''
          ),
          array(
            'value'       => 1,
            'label'       => 'Enable',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'number_of_more',
        'label'       => 'Number of More Videos',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),	  
      array(
        'id'          => 'sort_of_more',
        'label'       => 'More Videos same',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'Default',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Categories',
            'src'         => ''
          ),
		  array(
            'value'       => '2',
            'label'       => 'Tags',
            'src'         => ''
          ),
        ),
      ),
      array(
        'id'          => 'single_show_image',
        'label'       => 'Show Feature Image',
        'desc'        => 'Show/hide  Feature Image',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '2',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
	  
      array(
        'id'          => 'single_show_meta_view',
        'label'       => 'Show Video Views Count',
        'desc'        => 'Show/hide Video Views in single post',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'single_show_meta_comment',
        'label'       => 'Show Comments Count',
        'desc'        => 'Show/hide Video Comments Count in single post',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'single_show_meta_like',
        'label'       => 'Show Video Likes Count',
        'desc'        => 'Show/hide Video Likes Count in single post',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'single_show_meta_author',
        'label'       => 'Show Author Link',
        'desc'        => 'Show/hide Author Link in single post',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'single_show_meta_date',
        'label'       => 'Show Video Date',
        'desc'        => 'Show/hide Video Date in single post',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'onoff_more_video',
        'label'       => ' Show "More Videos"',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'onoff_related_video',
        'label'       => 'Show "Related Videos"',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'related_video_by',
        'label'       => 'Related Videos By',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'Tag',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Category',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'onoff_cat',
        'label'       => 'Show Categories',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'onoff_tag',
        'label'       => 'Show Tags',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'onoff_author',
        'label'       => 'Show About Author',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'showmore_content',
        'label'       => 'Enable Show More Content',
        'desc'        => 'Enable show more post content button',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Enable',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Disable',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'onoff_postnavi',
        'label'       => 'Show Posts Navigation',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'page_layout',
        'label'       => 'Single Page Layout',
        'desc'        => 'Choose default single page layout',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'single_page',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => 'Right Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => 'Left Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => 'Full Width',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_style',
        'label'       => 'Blog Style',
        'desc'        => 'Select style for listing',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
		  array(
            'value'       => 'blog',
            'label'       => 'Blog listing',
            'src'         => ''
          ),
          array(
            'value'       => 'video',
            'label'       => 'Video listing (Grid)',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_layout',
        'label'       => 'Blog Layout',
        'desc'        => 'Select layout for Blog listing page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => 'Right sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => 'Left sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => 'Full width',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'pagination_style',
        'label'       => 'Pagination',
        'desc'        => 'Select style for Pagination',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'page_ajax',
            'label'       => 'Ajax',
            'src'         => ''
          ),
          array(
            'value'       => 'page_navi',
            'label'       => 'WP PageNavi',
            'src'         => ''
          ),
          array(
            'value'       => 'page_def',
            'label'       => 'Default',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'show_image_or_player',
        'label'       => 'Show Feature Image or Video player in blog',
        'desc'        => 'Only style Video Listing Grid',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Video Player',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Feature Image',
            'src'         => ''
          )
        ),
      ),

      array(
        'id'          => 'show_blog_title',
        'label'       => 'Show/Hide Blog Page Title',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'show_blog_order',
        'label'       => 'Show/Hide Blog - Ordering Tool',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'show_blog_layout',
        'label'       => 'Show/Hide Blog - Layouts Switcher Tool',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'default_blog_order',
        'label'       => 'Choose Default Blog Order',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'Default (Latest)',
            'src'         => ''
          ),
          array(
            'value'       => 'title',
            'label'       => 'By Title',
            'src'         => ''
          ),
          array(
            'value'       => 'view',
            'label'       => 'By Views',
            'src'         => ''
          ),
          array(
            'value'       => 'like',
            'label'       => 'By Likes',
            'src'         => ''
          ),
          array(
            'value'       => 'comment',
            'label'       => 'By Comments',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'default_listing_layout',
        'label'       => 'Choose Default Listing Layout',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'Default - Small Grid (4 columns)',
            'src'         => ''
          ),
          array(
            'value'       => 'style-grid-2',
            'label'       => 'Big Grid (2 columns)',
            'src'         => ''
          ),
          array(
            'value'       => 'style-list-1',
            'label'       => 'Big detail 1 column',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'blog_show_meta_grid2',
        'label'       => ' Show Metadata in Medium Grid Layout (2 columns)',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_show_meta_view',
        'label'       => 'Show Views Count',
        'desc'        => 'Show/hide Views in listing page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_show_meta_comment',
        'label'       => 'Show Comments Count',
        'desc'        => 'Show/hide Comments Count in listing page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_show_meta_like',
        'label'       => 'Show Likes Count',
        'desc'        => 'Show/hide Likes Count in listing page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_show_meta_author',
        'label'       => 'Show Author Name',
        'desc'        => 'Show/hide Author in listing page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'blog_show_meta_date',
        'label'       => 'Show Date',
        'desc'        => 'Show/hide Date in listing page',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'blog',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'cat_header_style',
        'label'       => 'Category Header Style',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'cat_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'carousel',
            'label'       => 'Carousel',
            'src'         => ''
          ),
          array(
            'value'       => 'banner',
            'label'       => 'Banner Image',
            'src'         => ''
          ),
          array(
            'value'       => 0,
            'label'       => 'Do not show',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'con_top_cat_video',
        'label'       => 'Top Video Condition',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'cat_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'latest',
            'label'       => 'Latest',
            'src'         => ''
          ),
          array(
            'value'       => 'most_viewed',
            'label'       => 'Most viewed',
            'src'         => ''
          ),
          array(
            'value'       => 'likes',
            'label'       => 'Most liked',
            'src'         => ''
          ),
          array(
            'value'       => 'most_comments',
            'label'       => 'Most comment',
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
        'id'          => 'number_item_cat',
        'label'       => 'Item Count',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'cat_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'cat_show_meta_grid2',
        'label'       => ' Show Metadata in Medium Grid Layout (2 columns)',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'cat_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          )
        ),
      ),
	  
	  array(
        'id'          => 'enable_series',
        'label'       => 'Enable Video Series',
        'desc'        => 'Choose to enable Video Series Feature',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'series'
      ),
	  array(
        'id'          => 'series_header_style',
        'label'       => 'Series Header Style',
        'desc'        => 'Choose Series header style',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'series',
        'condition'   => 'enable_series:is(on)',
        'choices'     => array( 
          array(
            'value'       => 'playlist',
            'label'       => 'Playlist',
            'src'         => ''
          ),
          array(
            'value'       => 'banner',
            'label'       => 'Banner Image',
            'src'         => ''
          ),
          array(
            'value'       => 0,
            'label'       => 'Do not show',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'series_style',
        'label'       => 'Series Listing Style',
        'desc'        => 'Select style for listing',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'series',
		'condition'   => 'enable_series:is(on)',
        'choices'     => array( 
		  array(
            'value'       => 'video',
            'label'       => 'Video listing (Grid)',
            'src'         => ''
          ),
		  array(
            'value'       => 'blog',
            'label'       => 'Blog listing',
            'src'         => ''
          )
        ),
      ),
	   array(
        'id'          => 'series_slug',
        'label'       => 'Video Series Slug',
        'desc'        => 'You have to re-save Permalinks Settings after changing this option',
        'std'         => '',
		'condition'   => 'enable_series:is(on)',
        'type'        => 'text',
        'section'     => 'series'
      ),
	  
      array(
        'id'          => 'show_top_headline',
        'label'       => 'Show Headline',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'headline_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => 'hide',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'title_headline',
        'label'       => 'Title',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'headline_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'number_item_head_show',
        'label'       => 'Item Count',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'headline_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'icon_headline',
        'label'       => 'Icon',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'headline_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'cat_head_video',
        'label'       => 'Categories ID/ Slug',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'headline_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'headline_orderby',
        'label'       => 'Order by',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'headline_video',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'rand',
            'label'       => 'Random',
            'src'         => ''
          ),
          array(
            'value'       => 'date',
            'label'       => 'Date',
            'src'         => ''
          ),
		  array(
            'value'       => 'title',
            'label'       => 'Title',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'search_page',
        'label'       => 'Choose Search Page',
        'desc'        => 'Choose a page to be Search page',
        'std'         => '',
        'type'        => 'page-select',
        'section'     => 'search',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'show_search_form',
        'label'       => 'Show/Hide search form in result page',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'search',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'search_icon',
        'label'       => 'Search Icon',
        'desc'        => 'Enable Search Icon and Search box on Navigation',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'search',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 0,
            'label'       => 'Enable',
            'src'         => ''
          ),
		  array(
            'value'       => 1,
            'label'       => 'Disable',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'page404_title',
        'label'       => 'Title page 404',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => '404',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'page404_subtitle',
        'label'       => 'Subtitle page 404',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => '404',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'page404_content',
        'label'       => 'Content page 404',
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => '404',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'adsense_id',
        'label'       => 'Google AdSense Publisher ID',
        'desc'        => 'Enter your Google AdSense Publisher ID',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'adsense_slot_ad_top_1',
        'label'       => 'Top Ads 1 - AdSense Ad Slot ID',
        'desc'        => 'If you want to display Adsense in Top Ads 1 section, enter Google AdSense Ad Slot ID here. If left empty, "Top Ads 1 - Custom Code” will be used.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'ad_top_1',
        'label'       => 'Top Ads 1 - Custom Code',
        'desc'        => 'Enter custom code for Top Ads 1 position.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'adsense_slot_ad_top_2',
        'label'       => 'Top Ads 2 - AdSense Ad Slot ID',
        'desc'        => 'If you want to display Adsense in Top Ads 2 section, enter Google AdSense Ad Slot ID here. If left empty, "Top Ads 2 - Custom Code” will be used.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'ad_top_2',
        'label'       => 'Top Ads 2 - Custom Code',
        'desc'        => 'Enter custom code for Top Ads 2 position.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'adsense_slot_ad_body_1',
        'label'       => 'Body Ads 1 - AdSense Ad Slot ID',
        'desc'        => 'If you want to display Adsense in Body Ads 1 section, enter Google AdSense Ad Slot ID here. If left empty, "Body Ads 1 - Custom Code” will be used.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'ad_body_1',
        'label'       => 'Body Ads 1 - Custom Code',
        'desc'        => 'Enter custom code for Body Ads 1 position.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'adsense_slot_ad_body_2',
        'label'       => 'Body Ads 2 - AdSense Ad Slot ID',
        'desc'        => 'If you want to display Adsense in Body Ads 2  section, enter Google AdSense Ad Slot ID here. If left empty, "Body Ads 2  - Custom Code” will be used.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'ad_body_2',
        'label'       => 'Body Ads 2 - Custom Code',
        'desc'        => 'Enter custom code for Body Ads 2 position.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'adsense_slot_ad_foot',
        'label'       => 'Foot Ads - AdSense Ad Slot ID',
        'desc'        => 'If you want to display Adsense in Foot Ads  section, enter Google AdSense Ad Slot ID here. If left empty, "Foot Ads - Custom Code” will be used.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'ad_foot',
        'label'       => 'Foot Ads - Custom Code',
        'desc'        => 'Enter custom code for Foot Ads position.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'adsense_slot_ad_recurring',
        'label'       => 'Recuring Ads - AdSense Ad Slot ID',
        'desc'        => 'If you want to display Adsense in Recuring Ads section, enter Google AdSense Ad Slot ID here. If left empty, "Recuring Ads - Custom Code” will be used.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'ad_recurring',
        'label'       => 'Recuring Ads- Custom Code',
        'desc'        => 'Enter custom code for Recuring Ads position. This Ad will appear after each Ajax paginated-page in blog listing, categories or search result pages.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'adsense_slot_ad_single_content',
        'label'       => 'Single Content Ads - AdSense Ad Slot ID',
        'desc'        => 'If you want to display Adsense in Single Content Ads section, enter Google AdSense Ad Slot ID here. If left empty, "Single Content Ads - Custom Code” will be used.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'ad_single_content',
        'label'       => 'Single Content Ads - Custom Code',
        'desc'        => 'Enter custom code for Single Content Ads position.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'adsense_slot_ad_bg_left',
        'label'       => 'Left Side Ads - AdSense Ad Slot ID',
        'desc'        => 'If you want to display Adsense in Left Side Ads section, enter Google AdSense Ad Slot ID here. If left empty, "Left Side Ads - Custom Code” will be used.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'ad_bg_left',
        'label'       => 'Left Side Ads - Custom Code',
        'desc'        => 'Enter custom code for Left Side Ads position.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'adsense_slot_ad_bg_right',
        'label'       => 'Right Side Ads - AdSense Ad Slot ID',
        'desc'        => 'If you want to display Adsense in Right Side Ads section, enter Google AdSense Ad Slot ID here. If left empty, "Right Side Ads - Custom Code” will be used.',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'ad_bg_right',
        'label'       => 'Right Side Ads - Custom Code',
        'desc'        => 'Enter custom code for Right Side Ads position.',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'advertising',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'ad_bg_width',
        'label'       => 'Side Ads Width',
        'desc'        => 'Enter your side ads (Left & Right) width (Ex: 100px)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'advertising',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  	  array(
        'id'          => 'social_link_open',
        'label'       => 'Social Links open in',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_account',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 0,
            'label'       => 'Curent Tab',
            'src'         => ''
          ),
		  array(
            'value'       => 1,
            'label'       => 'New Tab',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'acc_facebook',
        'label'       => 'Facebook',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'acc_instagram',
        'label'       => 'Instagram',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'acc_envelope',
        'label'       => 'Email',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_twitter',
        'label'       => 'Twitter',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_linkedin',
        'label'       => 'LinkedIn',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_tumblr',
        'label'       => 'Tumblr',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_google-plus',
        'label'       => 'Google Plus',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_pinterest',
        'label'       => 'Pinterest',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_youtube',
        'label'       => 'Youtube',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'acc_flickr',
        'label'       => 'Flickr',
        'desc'        => 'Enter full link to your account (including http://)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'play_on_facebook',
        'label'       => 'Share video on facebook:',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 0,
            'label'       => 'Play video on Facebook',
            'src'         => ''
          ),
		  array(
            'value'       => 1,
            'label'       => 'Link back to video post URL',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'show_hide_sharethis',
        'label'       => 'Use Share This',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'sharethis_key',
        'label'       => 'Share This Publisher Key.',
        'desc'        => 'Enter your publisher key (http://developer.sharethis.com/member/register)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'social_like',
        'label'       => 'Show Facebook Like and Google +1 button?',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'share_facebook',
        'label'       => 'Show Facebook Share',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'share_twitter',
        'label'       => 'Show Twitter Share',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'share_linkedin',
        'label'       => 'Show LinkedIn Share',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'share_tumblr',
        'label'       => 'Show Tumblr Share',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'share_google_plus',
        'label'       => 'Show Google Plus Share',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'share_blogger',
        'label'       => 'Show Blogger Share',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'share_reddit',
        'label'       => 'Show Reddit Share',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'share_vk',
        'label'       => 'Show Vk Share',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'share_pinterest',
        'label'       => 'Show Pinterest Share',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'share_email',
        'label'       => 'Show Email Share',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'social_share',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'user_submit',
        'label'       => 'Enable User Submit Video Feature',
        'desc'        => 'When enable this, any Contact form 7 having a field name "video-url" will be saved to post',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'user_submit',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 0,
            'label'       => 'Disable',
            'src'         => ''
          ),
          array(
            'value'       => 1,
            'label'       => 'Enable',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'only_user_submit',
        'label'       => 'Login required to submit',
        'desc'        => 'Select whether only logged in users can submit or not',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'user_submit',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 0,
            'label'       => 'No',
            'src'         => ''
          ),
          array(
            'value'       => 1,
            'label'       => 'Yes',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'text_bt_submit',
        'label'       => 'Text on button submit',
        'desc'        => 'Enter text you want to show',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'user_submit',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array(),
      ),
	  array(
        'id'          => 'user_submit_status',
        'label'       => 'Post status for submitted videos',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'user_submit',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'pending',
            'label'       => 'Pending',
            'src'         => ''
          ),
          array(
            'value'       => 'publish',
            'label'       => 'Publish',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'user_submit_format',
        'label'       => 'Post Format for submitted videos',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'user_submit',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'video',
            'label'       => 'Video',
            'src'         => ''
          ),
          array(
            'value'       => '',
            'label'       => 'Standard',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'user_submit_cat_exclude',
        'label'       => 'Exclude Category from Category checkbox',
        'desc'        => 'Enter category ID that you dont want to be display in category checkbox (ex: 1,68,86)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'user_submit',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array(),
      ),
	  array(
        'id'          => 'user_submit_fetch',
        'label'       => 'Enable Auto Fetch Data for user\'s submited videos',
        'desc'        => 'Auto fill title, description, duration, views... for Youtube, Vimeo video url',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'user_submit',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
		  array(
            'value'       => 0,
            'label'       => 'Disable',
            'src'         => ''
          ),
          array(
            'value'       => 1,
            'label'       => 'Enable',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'user_submit_limit_tag',
        'label'       => 'Limit number of tags that users can enter',
        'desc'        => '0 is unlimited',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'user_submit',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array(),
      ),
	  array(
        'id'          => 'user_submit_notify',
        'label'       => 'Notification',
        'desc'        => 'Send notification email to user when post is published',
        'std'         => 1,
        'type'        => 'select',
        'section'     => 'user_submit',
        'choices'     => array(
		  array(
            'value'       => 1,
            'label'       => 'Enable',
            'src'         => ''
          ),
		  array(
            'value'       => 0,
            'label'       => 'Disable',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'login_page',
        'label'       => 'Choose Login Page',
        'desc'        => 'Choose a page to be default login page (Its template should be "Login page")',
        'std'         => '',
        'type'        => 'page-select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
      ),
	  array(
        'id'          => 'login_redirect',
        'label'       => 'Choose Redirect page after login successful',
        'desc'        => 'Choose a page to redirect to',
        'std'         => '',
        'type'        => 'page-select',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
      ),
	  array(
        'id'          => 'buddypress_layout',
        'label'       => 'Choose BuddyPress pages layout',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'buddypress',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
		'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => 'Right Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => 'Left Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => 'Full Width',
            'src'         => ''
          )
		)
      ),
	  array(
        'id'          => 'playlist_number',
        'label'       => 'Number of videos in playlist header',
        'desc'        => 'Enter nummber of videos to display in header of member playlist page (Enter -1 for all)',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'buddypress',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'bbpress_layout',
        'label'       => 'Choose bbPress pages layout',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'bbpress',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
		'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => 'Right Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'left',
            'label'       => 'Left Sidebar',
            'src'         => ''
          ),
          array(
            'value'       => 'full',
            'label'       => 'Full Width',
            'src'         => ''
          )
		)
      ),
	  
	array(
        'id'          => 'using_jwplayer_param',
        'label'       => 'Force Using JWPlayer for YouTube videos',
        'desc'        => '',
        'std'         => '0',
        'type'        => 'select',
        'section'     => 'youtube_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'onoff_related_yt',
        'label'       => 'Related youtube videos',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'youtube_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Hide',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Show',
            'src'         => ''
          )
        ),
      ),
      array(
        'id'          => 'onoff_html5_yt',
        'label'       => 'HTML5 (youtube) player',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'youtube_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          )
        ),
      ),	  
	  array(
        'id'          => 'onoff_info_yt',
        'label'       => 'Show info',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'youtube_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'Show',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Hide',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'remove_annotations',
        'label'       => 'Remove YouTube video annotations',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'youtube_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'using_yout_param',
        'label'       => 'Force using YouTube Embed Code',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'youtube_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'allow_full_screen',
        'label'       => 'Allow Full Screen',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'youtube_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'allow_networking',
        'label'       => 'Allow Networking',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'youtube_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'interactive_videos',
        'label'       => 'Interactive Videos',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'youtube_setting',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => 'Disable',
            'src'         => ''
          ),
          array(
            'value'       => '0',
            'label'       => 'Enable',
            'src'         => ''
          )
        ),
      ),
	  //scroll
	  array(
        'id'          => 'nice-scroll',
        'label'       => 'Enable Scroll Effect',
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'general',
        'min_max_step'=> '',
      ),
	  
	  
	  array(
        'id'          => 'video_ads',
        'label'       => 'Enable Video Ads',
        'desc'        => 'Turn on Video Ads for all video posts',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'video-ads',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
//update API
      array(
        'id'          => 'envato_username',
        'label'       => 'Envato Username',
        'desc'        => 'Enter your Envato username',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'theme_update',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'envato_api',
        'label'       => 'Envato API',
        'desc'        => 'Enter your Envato API. You can find your API under in Profile page &gt; My Settings &gt; API Keys',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'theme_update',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'envato_auto_update',
        'label'       => 'Allow Auto Update',
        'desc'        => 'Allow Auto Update or Not. If not, you can go to Appearance &gt; Themes and click on Update link',
        'std'         => '',
        'type'        => 'select',
        'section'     => 'theme_update',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => 'No',
            'src'         => ''
          ),
          array(
            'value'       => '1',
            'label'       => 'Yes',
            'src'         => ''
          )
        ),
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
}