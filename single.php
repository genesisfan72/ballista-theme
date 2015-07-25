<?php
/**
 * The template for displaying all single posts.
 *
 * @package Ballista
 */

get_header(); ?>

<?php get_template_part( 'template-content/content', 'sidebar' ); ?>

<div id="theGrid" class="main">
    <section class="grid">
        <div class="grid__item__container">
            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'template-content/content', 'header-image' ); ?>

                <div class="content-container">

                    <?php get_template_part( 'template-content/content', 'single' ); ?>

                    <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                    ?>
                </div>

                <?php ballista_post_navigation(); ?>

            <?php endwhile; // end of the loop. ?>
        </div>
    </section>
</div>

<?php get_footer(); ?>