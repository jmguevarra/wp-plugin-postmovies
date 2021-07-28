<?php
/**
 * It handles Ajax Request for sidebar filtering
 * 
 */

function moviesFiltering(){
   $title = $_POST["movie-title"];
   $genre = $_POST["movie-genre"];
   $keywords = $_POST["movie-keywords"];
   $order = $_POST["movie-order"];
   

   echo $title;
   echo $genre;
   echo $order;
   die();
}

add_action('wp_ajax_nopriv_movies_filtering', 'moviesFiltering');
add_action('wp_ajax_movies_filtering', 'moviesFiltering');
