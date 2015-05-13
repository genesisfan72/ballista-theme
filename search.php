<?php
/**
 * The template for displaying search results pages.
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
        $src = get_theme_mod('woc_search_image_header');

        if ($src != '') {
            $img = 'style="background: url(' . esc_url( $src ) . ') 60% / cover"';
            ?>
            <div class="header-image transparent quick-transition" <?php echo $img; ?>></div>
        <?php } ?>

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'ballista' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            </header><!-- .page-header -->

            <?php while ( have_posts() ) : the_post(); ?>

                <?php
                /**
                * Run the loop for the search to output the results.
                * If you want to overload this in a child theme then include a file
                * called content-search.php and that will be used instead.
                */
                ?>

                <?php get_template_part( 'template-content/content', 'blog' ); ?>

            <?php endwhile; // end of the loop. ?>

            <?php the_posts_navigation(); ?>

        <?php else : ?>

            <?php get_template_part( 'template-content/content', 'none' ); ?>

        <?php endif; ?>


    </section>
</div>
<?php get_footer(); ?>
