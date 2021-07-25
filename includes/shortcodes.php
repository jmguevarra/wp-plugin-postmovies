<?php
/**
 * Title: Shortcode Creation
 * Description: all shortcode of the plugin is define here
 */


//requires
require_once( PLUGIN_DIR . '/templates/sidebar.php' );

function  displayMovies($atts, $content = null){
    ob_start();

    $attr = shortcode_atts( array(
        'filter'    =>  'false',
        'searchby'  =>  'all'
    ), $atts);

    //Search Fields
    $cleanedSearchBy = preg_replace('/\s+/', '', $attr['searchby']); //remove white spaces
    $searchfields = explode( ',', $cleanedSearchBy ); //explode to array

    if( $attr['filter'] == 'true'): ?>
        <div class="movies-container movies-filter">
            <div class="movie-filter-card">
                <?php 
                   movieSidebar($searchfields);
                ?>
            </div>
            <div class="movie-cards">
                <?php include_once PLUGIN_DIR . '/templates/loop.php'; ?>
            </div>
        </div>
    <?php
    else:
        include_once PLUGIN_DIR . '/templates/loop.php';
    endif;

    return ob_get_clean();
}
add_shortcode('movies', 'displayMovies');