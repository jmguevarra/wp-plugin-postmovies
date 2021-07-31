<?php
/**
 * Template Part: Sidebar Filtering
 * Description: This is a sidebar with filtering options for movies
 * 
 */


function movieSidebar($searchOption = []){ 
  if( empty($searchOption) ){ return; }

  define('SEARCH_FIELDS', ['all', 'title', 'genre', 'keywords', 'orderby']); //const array for search fields
  if( empty(array_intersect($searchOption, SEARCH_FIELDS)) ){ return; }
   
?>

  <div class="movies-sidebar">
    <div class="movie-sidebar-container">
      <h2 class="form-title">Filter Options</h2>
      <form class="movie-filter" action="movie_filtering">
        <?php if( in_array('title', $searchOption) || in_array('all', $searchOption) ): //title filter ?>
          <fieldset class="group single-line">
            <label class="main-label" for="movie-title">Search by title</label>
            <input class="input-text single" type="text" id="movie-title" name="movie-title" placeholder="Avengers: Infinity War">
          </fieldset>
        <?php endif; //end title filter ?>

        <?php if( in_array('genre', $searchOption) || in_array('all', $searchOption) ): //genre filter ?>
          <fieldset class="group single-line">
            <label class="main-label" for="movie-title">Genre</label>
            <?php
              $genres = get_terms( array(
                  'taxonomy' => 'genre',
                  'hide_empty' => false,
              ) );
            ?>
              <select class="input-select single" id="movie-genre" name="movie-genre">
                <option>Select genre</option>
                <?php foreach($genres as $genre) : ?>
                <option value="<?= $genre->term_id; ?>"><?= $genre->name; ?></option>
                <?php endforeach; ?>
              </select>
          </fieldset>
        <?php endif; //end genre filter ?>

        <?php if( in_array('keywords', $searchOption) || in_array('all', $searchOption) ): //keywords filter ?>
        <fieldset class="group single-line">
          <label class="main-label" for="movie-title">Keywords</label>
            <?php
            $keywords = get_terms( array(
                'taxonomy' => 'keyword',
                'hide_empty' => false,
            ) );
            foreach($keywords as $keyword) :
            ?>
          <div class="input-group">
            <div class="radio-fieldset">
              <input type="checkbox" id="<?= $keyword->slug; ?>" name="movie-keywords[]" value="<?= $keyword->term_id; ?>"><label for="<?= $keyword->slug; ?>"><?= $keyword->name; ?></label>
            </div>
          </div>
          <?php endforeach; ?>
        </fieldset>
        <?php endif; //end keyword filter ?>

        <?php if( in_array('orderby', $searchOption) || in_array('all', $searchOption) ): //orderby filter ?>
        <fieldset class="group single-line">
          <label class="main-label" for="movie-title">Order by</label>
          <select class="input-select single" id="movie-order" name="movie-order">
            <option value="">List Order</option>
            <option value="Popularity">Popularity</option>
            <option value="Alphabetical">Alphabetical</option>
          </select>
        </fieldset>
        <?php endif; //end orderby filter ?>

        <div class="form_footer">
            <input class="button movie-filer-btn" type="submit" name="movie-filter-submit" id="movie-filter-submit" value="Filter">
        </div>
      </form>
    </div>
  </div>


<?php

} //end of movieSidebar 

?>


