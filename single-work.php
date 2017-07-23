<?php

//* Template Name: Works Detail
remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
remove_action( 'genesis_entry_content', 'genesis_do_post_permalink', 14 );

remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );
remove_action( 'genesis_after_entry', 'genesis_adjacent_entry_nav' );
remove_action( 'genesis_after_entry', 'genesis_get_comments_template' );

add_action('genesis_entry_content', 'work_detail_data');

function work_detail_data() {
	echo the_field('year') . '<br>';
	echo the_field('medium') . '<br>';
	echo the_field('dimensions') . '<br>';
	echo the_field('catalogue_id') . '<br>';
	echo the_field('description') . '<br>';
	echo the_field('collection') . '<br>';
	echo the_field('type') . '<br>';

	$image = get_field('picture');
			
		if( !empty($image) ){
			echo '<img src="' . $image['sizes']['thumbnail'] . '" /> <br>';

		}
	echo '<br>';
	echo 'Related Works <br>';
	$works = get_field('related_works');
	if( $works ){
		foreach( $works as $work){ // variable must not be called $post (IMPORTANT)
			
			echo get_the_title( $work->ID ) . '<br>';
			$image = get_field('picture', $work->ID);
			
			if( !empty($image) ){
				echo '<img src="' . $image['sizes']['thumbnail'] . '" /> <br>';

			}
			echo the_field('year', $work->ID) . '<br>';
			echo the_field('medium', $work->ID) . '<br>';
			echo the_field('dimensions', $work->ID) . '<br>';
			echo the_field('catalogue_id', $work->ID) . '<br>';
			echo the_permalink( $work->ID ) . '<br>';

		}
		
	}

	echo '<br>';
	echo 'Selected Exhibitions <br>';
	$exhibitions = get_field('selected_exhibitions');
	if( $exhibitions ){
		foreach( $exhibitions as $exhibition){ // variable must be called $post (IMPORTANT)
			
			echo get_the_title($exhibition->ID) . '<br>';
			echo the_field('institution', $exhibition->ID) . '<br>';
			echo the_field('exhibition_id', $exhibition->ID) . '<br>';
			$image = get_field('main_image', $exhibition->ID);
			
			if( !empty($image) ){
				echo '<img src="' . $image['sizes']['thumbnail'] . '" /> <br>';

			}
			echo the_permalink($exhibition->ID) . '<br>';


		}
		
	}

	echo '<br>';
	echo 'Selected Publications <br>';
	$publications = get_field('selected_publication');
	if( $publications ){

		foreach( $publications as $publication){ // variable must be called $post (IMPORTANT)
			
			echo get_the_title($publication->ID) . '<br>';

			if( have_rows('authors', $publication->ID) ){
				while ( have_rows('authors', $publication->ID) ){
					the_row();
					echo the_sub_field('name', $publication->ID) . '<br>';

				}
			}


			echo the_field('author_date', $publication->ID) . '<br>';
			$image = get_field('cover_image', $publication->ID);
			
			if( !empty($image) ){
				echo '<img src="' . $image['sizes']['thumbnail'] . '" /> <br>';

			}
			echo the_permalink($publication->ID) . '<br>';


		}
		
	}

}



genesis();
