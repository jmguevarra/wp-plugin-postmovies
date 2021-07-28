<?php
/*
Plugin Name:  JM Post Movies
Plugin URI: https://github.com/jmguevarra/
Description: This is a custom post type for movies. It also included different shortcodes for filtering, display movies.
Version: 1.0.0
Author: Jaime Guevarra Jr.
Author URI: https://github.com/jmguevarra
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
Text Domain: jmplugins-metaboxes
*/

if(  !defined('WPINC') ){
    die;
}

//defin variables
define('PLUGIN_DIR', dirname(__FILE__));
define('PLUGIN_VERSION', '1.0.0');

//Add Movie Custom Post Type
include_once('includes/post-type-movies.php');
include_once('includes/metaboxes.php');

//WP-AJAX
require_once('includes/wp-ajax-movies.php');

//Added Taxonomies for the movies
require_once('includes/genres.php');
require_once('includes/keywords.php');
require_once('includes/filter-movies.php');

//Shortcode
include_once('includes/shortcodes.php');

//Enqueue Scripts and Styling
include_once('includes/enqueue-scripts.php');

