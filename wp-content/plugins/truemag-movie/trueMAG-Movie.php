<?php
   /*
   Plugin Name: TrueMAG - Movie
   Plugin URI: http://www.cactusthemes.com
   Description: TrueMAG - Movie post type functions
   Version: 3.0.1
   Author: Cactusthemes
   Author URI: http://www.cactusthemes.com
   License: Commercial
   */
   
if ( ! defined( 'TM_MOVIE_BASE_FILE' ) )
    define( 'TM_MOVIE_BASE_FILE', __FILE__ );
if ( ! defined( 'TM_MOVIE_BASE_DIR' ) )
    define( 'TM_MOVIE_BASE_DIR', dirname( TM_MOVIE_BASE_FILE ) );
if ( ! defined( 'TM_MOVIE_PLUGIN_URL' ) )
    define( 'TM_MOVIE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
include('widget-popular-video.php');
//include('tm-like-post.php');
include('widget-trending-video.php');
include('tm-ajax-load-posts.php');
include('widget-topauthor.php');
include('widget-top-cat.php');
include('widget-related-video.php');
include('widget-recent-comment.php');
include('widget-most-like.php');
include('widget-most-view.php');
include('video-series.php');

