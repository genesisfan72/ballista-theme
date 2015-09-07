<?php
/**
 * Template for single live composer template posts.
 * @since 1.0
 */

get_header();
?>

<?php get_template_part( 'template-content/content', 'sidebar' ); ?>

<?php

$page_id = get_queried_object_id();
$meta = get_post_meta( $page_id );
$page_for = $meta[ 'dslc_template_for' ];
$template_to_load = '';
if ( count( $page_for ) > 0 ) $template_to_load = $page_for[ 0 ];
?>

<?php if ( strtolower( $template_to_load ) == 'case_study' ) { ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <?php
        $prev_post = get_previous_post();
        $prev_bg_style = "";
        $args = array( 'order' => 'ASC', 'post_status' => 'publish', 'orderby' => 'post_date', 'posts_per_page' => -1 );
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

        <div id="theGrid" class="main">
            <section>
                <article>
                    <header class="top-bar top-bar__single--header">
                        <div class="top-bar__post-nav--arrows">
                            <a href="<?php echo get_permalink( $prev_post->ID ); ?>">
                                <div class="post__nav--arrow post__nav--arrow-prev"><i class="fa fa-arrow-left"></i>
                                </div>
                            </a>
                            <a href="<?php echo get_permalink( $next_post->ID ); ?>">
                                <div class="post__nav--arrow post__nav--arrow-next"><i class="fa fa-arrow-right"></i>
                                </div>
                            </a>
                        </div>
                        <div class="social-icons">
                            <?php get_template_part( 'template-content/links', 'social' ); ?>
                        </div>

                    </header>

                    <?php the_content(); ?>

                    <?php get_template_part( 'template-content/nav', 'footer-post' ); ?>
                </article>
            </section>
        </div>

    <?php endwhile; // end of the loop. ?>

<?php } else { ?>
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
<?php } ?>

<?php get_footer(); ?>