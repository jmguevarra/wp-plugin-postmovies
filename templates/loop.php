<?php
/**
 * Title: Custom Loop for post tyep
 *
 * 
 */

 
function moviesLoopCard($filterOptions = []){

  $args = array(
    'post_type'       =>  'movie',
    'post_status'     =>  'publish',
    'posts_per_page'  =>  -1,
    'order'           =>  'ASC',
  );

  //for filtering options
  if( !empty($filterOptions) ){
    $moviesTitle = $filterOptions['movie-title'];
    $moviesGenre = $filterOptions['movie-genre'];
    $moviesKeywords = $filterOptions['movie-keywords'];
    $moviesOrder = $filterOptions['movie-order'];
    
    //search by title
    if( !empty($moviesTitle) ){ 
      $args['s'] = $moviesTitle; //add 's' to the query to search by word
    }

    //search by genre
    if( !empty($moviesGenre) ){
      $args['tax_query'] = array(
        array(
          'taxonomy'  =>  'genre', //taxonomy unique name
          'field'     =>  'term_id', //field id in database
          'terms'     =>  array($moviesGenre) //it requires terms id and should be in an array
        )
      );
    }

    //keywords
    if( !empty($moviesKeywords) ){
      $args['tax_query'] = array(
        array(
          'taxonomy'  =>  'keyword', //taxonomy unique name
          'field'     =>  'term_id', //field id in database
          'terms'     =>   $moviesKeywords //already in arrray
        )
      );
    }

    // //search by genre
    // if( !empty($moviesGenre) && !empty($moviesKeywords) ){
    //   $args['tax_query'] = array(
    //     'relation'  => 'OR',
    //     array(
    //       'taxonomy'  =>  'genre', //taxonomy unique name
    //       'field'     =>  'term_id', //field id in database
    //       'terms'     =>  array($moviesGenre) //it requires terms id and should be in an array
    //     ),
    //     array(
    //       'taxonomy'  =>  'keyword', //taxonomy unique name
    //       'field'     =>  'term_id', //field id in database
    //       'terms'     =>   $moviesKeywords //already in arrray
    //     )
    //   );
    // }

    //orderBy
    if( !empty($moviesOrder) ){
      $orderParam = '';

      if($moviesOrder == 'Alphabetical'){
        $orderParam = 'title';
      }elseif($moviesOrder == 'Popularity'){
        $orderParam = 'meta_value_num'; //
        $args['meta_key'] = '__movie-rating'; //metakey from custom metaboxes
        $args['order'] = 'DESC'; //to start in highs rating
      }else{
        $orderParam = 'date';
      }

      $args['orderby'] = $orderParam;
    }
    
  }

  

  $query = new WP_Query($args);
  $counter = 0;

  if($query->have_posts()): 
    while( $query->have_posts( ) ): 
      $query->the_post(); //interate the post
      
      $movieID = get_the_ID();
      $url = get_the_permalink();
      $title = get_the_title();
      $featuredImg = get_the_post_thumbnail_url();
      $excerpt = get_the_excerpt();
      $year = get_post_meta($movieID, '__movie-year', true);
      $rating = get_post_meta($movieID, '__movie-rating', true);
      $runtime = get_post_meta($movieID, '__movie-runtime', true);
      $taxonomy = 'genre';
      $counter++;


      // Get the term IDs assigned to post.
      $post_terms = wp_get_object_terms( $movieID, $taxonomy, array( 'fields' => 'ids' ) );
      // Separator between links.
      $separator = ', ';
      
      if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ) {
          $term_ids = implode( ',' , $post_terms );
          $terms = wp_list_categories( array(
              'title_li' => '',
              'style'    => 'none',
              'echo'     => false,
              'taxonomy' => $taxonomy,
              'include'  => $term_ids
          ) );
          $terms = rtrim( trim( str_replace( '<br />',  $separator, $terms ) ), $separator );
      }

      ?>
      <article class="movie-card">
        <div class="movie-wrapper">
          <div class="movie-thumbnail">
            <img class="featured-img" src="<?= $featuredImg; ?>" alt="<?= $title; ?>" />
          </div>
          <div class="movie-summary">
            <h2 class="title"><span class="number"><?= $counter; ?>. </span><a href="<?= $url;?>"><?= $title; ?></a> <span class="date">(<?= $year; ?>)</span></h2>
            <div class="movie-meta">
              <span class="rating"><?= $rating; ?></span> |
              <span class="runtime"><?= $runtime; ?></span> 
              <div class="categories">
                <?= $terms; ?>
              </div>
            </div>
            <?= $excerpt; ?>
          </div>
        </div>
      </article>

  <?php
    endwhile;
  else:
  ?>
    <article class="movie-card">
      <div class="movies-not-found">
          <p>Sorry, can't find anything</p>
      </div>
    </article>
  <?php   
  endif;
  wp_reset_postdata();  //reset the query after using you custom loop

}