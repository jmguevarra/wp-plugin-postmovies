<?php
/**
 * Title: Shortcode Creation
 * Description: all shortcode of the plugin is define here
 */



 function  displayMovies($atts, $content = null){
    $attr = shortcode_atts( array(
        'filter'   =>  'false'
    ), $atts);

    ob_start();

    if( $attr['filter'] == 'true'): ?>
        <div class="movies-container movies-filter">
            <div class="movie-filter-card">
                <?php include_once PLUGIN_DIR . '/templates/sidebar.php'; ?>
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