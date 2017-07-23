<?php

//* Template Name: Publication Detail
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

add_action('genesis_entry_content', 'publication_detail_data');

function publication_detail_data() {

    if( have_rows('authors') ){
        while ( have_rows('authors') ){
            the_row();
            echo the_sub_field('name') . '<br>';

        }
    }

    echo the_field('publication_year') . '<br>';

    $image = get_field('cover_image');
        
    if( !empty($image) ){
        echo '<img src="' . $image['sizes']['thumbnail'] . '" /> <br>';

    }
    echo the_field('id') . '<br>';
    echo the_field('publication_type') . '<br>';
    echo the_field('subject') . '<br>';
    echo the_field('publication_company') . '<br>';
}


genesis();