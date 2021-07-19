<?php
/*
 * Enqueue All Scripts and Styling here
 * 
 */


add_action('admin_enqueue_scripts', 'jmdev_EnqueueScripts');
function jmdev_EnqueueScripts(){

    global $pagenow;
    //Enqueue Scripts only on the page instead in the whole admin page
    if( $pagenow !== 'post.php'){
        return;
    }

    //Css
    wp_enqueue_style('movie-metaboxes-admin', plugins_url('jmdev-postmovies/src/assets/css/admin.css'), array(), '1.0.0', 'all');

    //JS
    wp_enqueue_script('movie-metaboxes-admin', plugins_url('jmdev-postmovie/src/assets/js/admin.js'), array('jquery'), '1.0.0', true );
}

