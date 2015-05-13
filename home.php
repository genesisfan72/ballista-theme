<?php
/**
 * The main template file.
 *
 * @package Ballista
 */

get_header(); ?>

<button id="menu-toggle" class="menu-toggle"><span>Menu</span></button>

<?php get_template_part( 'template-content/content', 'sidebar' ); ?>

<div id="theGrid" class="main">
    <section class="grid">


            <?php
            // Get the header image for the blog page
            $src = get_theme_mod('woc_blog_image_header');

            if ($src != '') {
                $img = 'style="background: url(' . esc_url( $src ) . ') 60% / cover"';
            ?>
                <div class="header-image transparent quick-transition" <?php echo $img; ?>></div>
            <?php } ?>

            <?php if ( have_posts() ) : ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'template-content/content', 'blog' ); ?>

                <?php endwhile; // end of the loop. ?>

            <?php else : ?>

                <?php get_template_part( 'template-content/content', 'none' ); ?>

            <?php endif; ?>


    </section>
</div>

<?php get_footer(); ?>
