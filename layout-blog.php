<?php
/**
 * Blog layout
 */
?>

<div id="theGrid" class="main">
    <section class="grid">
        <header class="top-bar">

            <?php get_template_part( 'filter', 'categories' ); ?>

            <div class="social-icons">
                <span>Filter by:</span>
                <span class="dropdown">Popular</span>
            </div>
        </header>

        <div class="grid__item__container">

            <?php
            $loop = new WP_Query( array( 'post_type' => 'case_study', 'posts_per_page' => -1 ) );

            if ( $loop->have_posts() ) : ?>

                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

                    <?php
                    $img = '';
                    if ( has_post_thumbnail() ) {
                        $thumb_id = get_post_thumbnail_id();
                        $thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail-size', true );
                        $thumb_url = $thumb_url_array[ 0 ];
                        $img = 'style="background: url(' . esc_url( $thumb_url ) . ') 40% / cover"';
                    }

                    $terms = get_the_terms( $post->ID, 'case_study_tags' );
                    $term_classes = "";
                    if ( $terms && ! is_wp_error( $terms ) ) {
                        foreach ( $terms as $term ) {
                            $term_classes .= " " . strtolower( str_replace(" ", "-", $term->name ) );
                        }

                    }

                    ?>

                    <div class="grid__item <?php echo $term_classes; ?>" data-id="<?php echo the_ID(); ?>" <?php echo $img; ?>>

                        <?php
                        $categories = array();
                        $i = 0;
                        $cat_string = "";
                        foreach ( get_the_category() as $category ) {
                            if ( $i > 0 ) {
                                $cat_string .= ', ';
                            }
                            $cat_string .= '<a class="post__link post__link--bold" href="' . get_category_link($category->cat_ID) . '">' . $category->name . '</a>';
                        }
                        ?>

    <!--                    <div class="loader"></div>-->

                        <div class="excerpt--box">
                            <div class="excerpt__title--row">
                                <div class="excerpt__title">
                                    <? the_title(); ?>
                                </div>
                                <div class="excerpt__likes">
                                    <i class="fa fa-heart"></i>4
                                </div>
                            </div>

                            <div class="excerpt__byline--row">
                                <?php echo __( 'By ', 'ballista' ) . get_the_author() . __( ' in ') . '<a class="post__link post__link--bold">' . $term_classes . '</a>'; ?>
                            </div>

                            <div class="excerpt__content--row">
                                <?php //the_excerpt(); ?>
                                <?php echo ballista_the_excerpt_max_charlength(240); ?>
                                <a class="post__link" href="'<?php echo get_permalink( get_the_ID() ); ?>'"><?php echo  __('Read More', 'ballista'); ?></a>
                            </div>
                        </div>

                    </div>

                <?php endwhile; wp_reset_query(); ?>

            <?php else : ?>

                <?php get_template_part( 'content', 'none' ); ?>

            <?php endif; ?>
        </div>

        <section class="content">
            <div class="scroll-wrap">
            </div>
            <button class="close-button"><i class="fa fa-close"></i><span>Close</span></button>
        </section>

    </section>

</div>