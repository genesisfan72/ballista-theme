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
        <div class="grid__item__container">

            <?php if ( have_posts() ) : ?>

                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php
                    /* Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part( 'template-content/content', get_post_format() );
                    ?>

                <?php endwhile; ?>

                <?php the_posts_navigation(); ?>

            <?php else : ?>

                <?php get_template_part( 'template-content/content', 'none' ); ?>

            <?php endif; ?>

        </div>
    </section>
</div>

<?php get_footer(); ?>
