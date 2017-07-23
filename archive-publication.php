<?php
/**
 * Template Name: Testimonial Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive 
 */
remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_grid_loop' ); // Add custom loop
function custom_do_grid_loop() { 
 

    $args = array(
        'post_type' => 'publication', // enter your custom post type
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'posts_per_page'=> '12', // overrides posts per page in theme settings
    );

    $loop = new WP_Query( $args );
    if( $loop->have_posts() ){

        while( $loop->have_posts() ){
            $loop->the_post(); 
            global $post;

            echo get_the_title() . '<br>';
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
            echo the_permalink() . '<br>';
            echo '__________________________<br>';
        }

    }
     
}
 
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();