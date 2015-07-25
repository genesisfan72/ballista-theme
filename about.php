<?php
/**
 * Template Name: About Page
 *
 * @package Ballista
 */

get_header(); ?>

<?php get_template_part( 'template-content/content', 'sidebar' ); ?>

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

                <?php
                if ( get_theme_mod( 'woc_show_thumbnails', false ) == true ) {
                    if ( get_theme_mod( 'woc_about_images' ) == 'instagram' ) {
                        echo do_shortcode( '[instagram-feed num=5 cols=5 showheader=false imagepadding=0 showbutton=false showfollow=false height=125 heightunit=px]' );
                    } else {
                        $images = array();

                        array_push( $images, get_theme_mod( 'woc_about_page_image_1', '' ) );
                        array_push( $images, get_theme_mod( 'woc_about_page_image_2', '' ) );
                        array_push( $images, get_theme_mod( 'woc_about_page_image_3', '' ) );
                        array_push( $images, get_theme_mod( 'woc_about_page_image_4', '' ) );
                        array_push( $images, get_theme_mod( 'woc_about_page_image_5', '' ) );

                        $image_count = 0;
                        $valid_images = array();
                        foreach ( $images as $i => $image ) {
                            if ( $image != '' ) {
                                $image_count++;
                                array_push($valid_images, $i);
                            }
                        }

                        echo '<div class="flex-display">';
                        for ($i = 0; $i < $image_count; $i++) {
                            echo '<div class="flex-centered thumb-container"><img src="' . $images[$i] . '" alt=""/></div>';
                        }
                        echo '</div>';

                    }
                }
                ?>

                <?php get_template_part( 'template-content/content', 'page' ); ?>

            <?php endwhile; // end of the loop. ?>

        </div>
    </section>
</div>

<?php get_footer(); ?>
