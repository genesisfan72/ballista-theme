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
?>


<article class="content__item">

    <header class="top-bar">

        <?php get_template_part( 'filter', 'categories' ); ?>

        <div class="social-icons">
            <?php get_template_part( 'links', 'social' ); ?>
        </div>
    </header>

    <?php the_content(); ?>

    <?php get_template_part( 'nav', 'footer-post' ); ?>

</article>

