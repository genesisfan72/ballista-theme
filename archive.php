<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Ballista
 */

get_header(); ?>

<?php get_template_part( 'template-content/content', 'sidebar' ); ?>

<div id="theGrid" class="main">
    <section class="grid">


            <?php
            // Get the header image for the blog page
            $src = get_theme_mod('woc_archive_image_header');

            if ($src != '') {
                $img = 'style="background: url(' . esc_url( $src ) . ') 60% / cover"';
                ?>
                <div class="header-image transparent quick-transition" <?php echo $img; ?>></div>
            <?php } ?>

            <?php if ( have_posts() ) : ?>

                <header class="page-header">
                    <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                    ?>
                </header><!-- .page-header -->

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'template-content/content', 'blog' ); ?>

                <?php endwhile; // end of the loop. ?>

                <?php the_posts_navigation(); ?>

            <?php else : ?>

                <?php get_template_part( 'template-content/content', 'none' ); ?>

            <?php endif; ?>


    </section>
</div>

<?php get_footer(); ?>


