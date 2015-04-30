<?php
/**
 * Handles the generation of the posts loop for Ballista
 * @since 1.0
 */

// Includes
define( 'WP_USE_THEMES', false );
require_once( '../../../wp-load.php' );

// Post variables
global $post;

// TODO return on no variable
$post_id = isset( $_POST[ 'post_id' ] ) ? $_POST[ 'post_id' ] : 0;

$post = get_post( $post_id );

setup_postdata( $post );


$prev_post = get_previous_post();
$prev_bg_style = "";
$args = array( 'order' => 'ASC', 'post_type' => 'case_study', 'post_status' => 'publish', 'orderby' => 'post_date', 'posts_per_page' => -1 );
$posts_array = get_posts( $args );
$first_post = count( $posts_array ) > 0 ? $posts_array[ 0 ] : NULL;
$last_post = count( $posts_array ) > 0 ? $posts_array[ count( $posts_array ) - 1 ] : NULL;

if ( empty( $prev_post ) ) {
    $prev_post = $last_post;
}

$next_post = get_next_post();
$next_bg_style = "";
if ( empty( $next_post ) ) {
    $next_post = $first_post;
}
?>


<article class="content__item">

    <header class="top-bar top-bar__single--header">

        <div class="top-bar__post-nav--arrows">
            <div class="post__nav--arrow post__nav--arrow-prev" data-id="<?php echo esc_attr( $prev_post->ID ); ?>"><i
                    class="fa fa-arrow-left"></i></div>
            <div class="post__nav--arrow post__nav--arrow-next" data-id="<?php echo esc_attr( $next_post->ID ); ?>"><i
                    class="fa fa-arrow-right"></i></div>
        </div>

        <div class="social-icons">
            <?php get_template_part( 'links', 'social' ); ?>
        </div>
    </header>

    <?php the_content(); ?>

    <?php get_template_part( 'nav', 'footer-post' ); ?>

</article>

