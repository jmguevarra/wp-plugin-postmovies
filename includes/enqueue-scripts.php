<?php
/*
 * Enqueue All Scripts and Styling here
 * 
 */


/** Admin Scripts */
add_action('admin_enqueue_scripts', 'jmdev_adminScripts');
function jmdev_adminScripts(){

    global $pagenow;
    //Enqueue Scripts only on the page instead in the whole admin page
    if( $pagenow !== 'post.php'){
        return;
    }

    //Css
    wp_enqueue_style('movie-metaboxes-admin', plugins_url('jmdev-postmovies\src\assets\css\admin.css'), array(), PLUGIN_VERSION, 'all');

    //JS
    wp_enqueue_script('movie-metaboxes-admin', plugins_url('jmdev-postmovies\src\assets\js\admin.js'), array('jquery'), PLUGIN_VERSION, true );
}

/** Front End Scripts */
add_action('wp_enqueue_scripts', 'jmdev_wpFrontScripts');
function jmdev_wpFrontScripts(){
    //main
    wp_enqueue_style('movies', plugins_url('jmdev-postmovies\src\assets\css\movies.css'), array(), PLUGIN_VERSION, 'all');
    
    //filter for front end JS
    wp_register_script('movies-ajax-filter', plugins_url('jmdev-postmovies\src\assets\js\movies-filter.js'), array(), PLUGIN_VERSION, true);
   
    //localize the wp-ajax url
    wp_localize_script( 'movies-ajax-filter' , 'wpAjax', array('ajaxURL' => admin_url('admin-ajax.php')) );

    wp_enqueue_script('movies-ajax-filter');

}
    
