<?php
/**
 * Template Name: About Page
 *
 * @package Ballista
 */

get_header(); ?>

<button id="menu-toggle" class="menu-toggle"><span>Menu</span></button>

<?php get_template_part( 'content', 'sidebar' ); ?>

<div id="theGrid" class="main">
    <section class="grid">
        <div class="grid__item__container">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php
                $img = '';
                if ( has_post_thumbnail() ) {
                    $thumb_id = get_post_thumbnail_id();
                    $thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail-size', true );
                    $thumb_url = $thumb_url_array[ 0 ];
                    $img = 'style="background: url(' . esc_url( $thumb_url ) . ') 60% / cover"';
                }
                ?>

                <div class="page__hero transparent quick-transition" <?php echo $img; ?>></div>

                <?php echo do_shortcode( '[instagram-feed num=5 cols=5]' ); ?>

                <?php get_template_part( 'content', 'page' ); ?>

            <?php endwhile; // end of the loop. ?>

        </div>
    </section>
</div>

<?php get_footer(); ?>
