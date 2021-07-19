<?php

function movieMetaBoxes(){
	add_meta_box(
		'_mb-movie-fields',
		'Other Specification',
		'mbMovie_callback',
		'movie',
		'normal',
		'default'
	);
}
add_action('add_meta_boxes', 'movieMetaBoxes'); 

function mbMovie_callback($post){
	$textDomain = 'jmdev-postmovies';
	$movieYearValue = get_post_meta($post->ID, '__movie-year' ,true);
	$movieRatingValue = get_post_meta($post->ID, '__movie-rating' ,true);
	$movieRuntimeValue = get_post_meta($post->ID, '__movie-runtime' ,true);

	//nonce field
	wp_nonce_field('_mb_movie_nonce_field', '_mb_movie_nonce');
	?>
		<div class="movie-metaboxes">
			<div class="fields">
				<div class="field single-line-field">
					<label class="main-label"><?php _e('Film Released', $textDomain); ?></label>
					<input class="single text" type="text" id="movie-year" name="movie-year" placeholder="Year" value=" <?php echo esc_attr( $movieYearValue ); ?> ">
				</div>
				<div class="field single-line-field">
					<label class="main-label"><?php _e('Rating', $textDomain); ?> </label>
					<select class="single select" id="movie-rating" name="movie-rating">
						<?php
							for($i=0; $i <= 5; $i++){
								if( $movieRatingValue == $i ){ 
									echo '<option value="'. $i .'" selected="selected">'. $i .'</option>';
								}else{
									echo '<option value="'. $i .'">'. $i .'</option>';
								}
							}
						?>
			        </select>
				</div>
				<div class="field single-line-field">
					<label class="main-label"><?php _e('Runtime', $textDomain); ?></label>
					<input class="single text" type="text" id="movie-runtime" name="movie-runtime" placeholder="length" value=" <?php echo esc_attr( $movieRuntimeValue ); ?> ">
				</div>
			</div>
		</div>
	<?php
}

function saveMoviePostMeta($post_id, $post){

	//check user Compatibility
	$editCap = get_post_type_object( $post->post_type )->cap->edit_post;
	if(!current_user_can( $editCap, $post_id ) ){ 
		return; 
	}

	//check nonce field
	if( !isset( $_POST['_mb_movie_nonce'] ) || !wp_verify_nonce( $_POST['_mb_movie_nonce'], '_mb_movie_nonce_field') ){ 
		return; 
	}

	//check auto save status
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	if( $is_autosave || $is_revision){
		return;
	}

	//insertion/updating data for wp_postmeta table
	$movieYearField = ( isset($_POST['movie-year']) ? $_POST['movie-year'] : false );
	$movieRatingField = ( isset($_POST['movie-rating']) ? $_POST['movie-rating'] : false );
	$movieRuntimeField = ( isset($_POST['movie-runtime']) ? $_POST['movie-runtime'] : false );

	if( $movieYearField ){
		update_post_meta( $post_id, '__movie-year', sanitize_text_field($movieYearField) );
	}
	if( $movieRatingField ){
		update_post_meta( $post_id, '__movie-rating', $movieRatingField );
	}
	if( $movieRuntimeField ){
		update_post_meta( $post_id, '__movie-runtime', sanitize_text_field($movieRuntimeField) );
	}

}
add_action('save_post', 'saveMoviePostMeta', 10, 2);
