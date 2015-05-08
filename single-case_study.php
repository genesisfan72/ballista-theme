<?php
/**
 * Template for single case study posts.
 * @since 1.0
 */

get_header();
?>

<?php get_template_part( 'content', 'sidebar' ); ?>

<?php while ( have_posts() ) : the_post(); ?>

    <?php
    $prev_post = get_previous_post();
    $prev_bg_style = "";
    $args = array( 'order' => 'ASC', 'post_type' => 'case_study', 'post_status' => 'publish', 'orderby' => 'post_date', 'posts_per_page' => -1 );
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
                        <div class="post__nav--arrow post__nav--arrow-prev"
                             data-id="<?php echo esc_attr( $prev_post->ID ); ?>"><i
                                class="fa fa-arrow-left"></i></div>
                        <div class="post__nav--arrow post__nav--arrow-next"
                             data-id="<?php echo esc_attr( $next_post->ID ); ?>"><i
                                class="fa fa-arrow-right"></i></div>
                    </div>
                    <div class="social-icons">
                        <?php get_template_part( 'links', 'social' ); ?>
                    </div>
                </header>

                <?php the_content(); ?>

                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>

                <?php get_template_part( 'nav', 'footer-post' ); ?>

            </article>
        </section>
    </div>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>