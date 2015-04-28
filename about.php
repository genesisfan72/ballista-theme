<?php
/**
 * Template Name: About Page
 *
 * @package Ballista
 */

get_header(); ?>

<button id="menu-toggle" class="menu-toggle"><span>Menu</span></button>
<div id="theSidebar" class="sidebar">
    <div class="title-area">
        <button class="close-button fa fa-fw fa-close"></button>
        <h1><?php bloginfo( 'name' ); ?></h1>

        <div class="subtitle"><?php bloginfo( 'description' ); ?></div>
    </div>


    <div class="pages-nav">
        <nav>
            <?php wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id' => 'primary-menu',
                'depth' => 1,
                'menu_class' => 'menu' ) ); ?>
        </nav>
    </div>
</div>

<div id="theGrid" class="main">
    <section class="grid">
        <header class="top-bar">

            <?php get_template_part( 'filter', 'categories' ); ?>

            <div class="social-icons">
                <?php get_template_part( 'links', 'social' ); ?>
            </div>
        </header>

        <div class="grid__item__container">

            <?php while ( have_posts() ) : the_post(); ?>

                <div
                    class="grid__item grid__item--flex grid__item--portfolio--full effect-sarah hover--overlay <?php echo $term_classes; ?>"
                    data-id="<?php echo the_ID(); ?>" <?php echo $img; ?>>
                    <div class="portfolio__overlay">
                        <h2 class="title"><?php the_title(); ?></span></h2>
                    </div>
                </div>

                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; // end of the loop. ?>


        </div>

        <section class="content">
            <div class="scroll-wrap">
            </div>
            <button class="close-button"><i
                    class="fa fa-close"></i><span><?php echo __( 'Close', 'ballista' ); ?></span></button>
        </section>

    </section>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
