<?php
/**
 * It handles Ajax Request for sidebar filtering
 * 
 */

require_once( PLUGIN_DIR . '/templates/loop.php' );

function moviesFiltering(){
   moviesLoopCard($_POST);
   
   die();
}

add_action('wp_ajax_nopriv_movies_filtering', 'moviesFiltering');
add_action('wp_ajax_movies_filtering', 'moviesFiltering');
