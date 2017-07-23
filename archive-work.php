<?php
/**
 * Template Name: Testimonial Archives
 * Description: Used as a page template to show page contents, followed by a loop through a CPT archive 
 */
remove_action ('genesis_loop', 'genesis_do_loop'); // Remove the standard loop
add_action( 'genesis_loop', 'custom_do_grid_loop' ); // Add custom loop
function custom_do_grid_loop() { 
 

    $args = array(
        'post_type' => 'work', // enter your custom post type
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
                $image = get_field('picture');
            
            if( !empty($image) ){
                echo '<img src="' . $image['sizes']['thumbnail'] . '" /> <br>';

            }
            echo '<br>';
            echo the_field('year') . '<br>';
            echo the_field('medium') . '<br>';
            echo the_field('dimensions') . '<br>';
            echo the_field('catalogue_id') . '<br>';
            echo the_field('collection') . '<br>';
            echo the_field('type') . '<br>';
            echo the_permalink() . '<br>';
            echo '__________________________<br>';

         
        }

    }
     
}
 
/** Remove Post Info */
remove_action('genesis_before_post_content','genesis_post_info');
remove_action('genesis_after_post_content','genesis_post_meta');
 
genesis();