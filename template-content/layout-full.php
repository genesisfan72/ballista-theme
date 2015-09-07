<?php
/**
 * Grid style layout - blog and portfolio
 */
?>

<?php
$layout = get_theme_mod( 'woc_front_page_style' );

if ( isset( $_GET[ 'fp_layout' ] ) ) $layout = $_GET[ 'fp_layout' ];
?>

<div id="theGrid" class="main">
    <section class="full-page-display">

        <?php get_template_part( 'template-content/content', 'top-bar' ); ?>

        <div class="ballista-slider">
            <div class="flexslider">
                <ul id="flexSlides" class="slides">

                    <?php
                    $loop = new WP_Query( array( 'post_type' => get_theme_mod( 'woc_fp_source', 'post' ), 'posts_per_page' => -1 ) );

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

                            $categories = array();
                            $i = 0;
                            $cat_string = "";
                            $term_classes = [];
                            foreach ( get_the_category() as $category ) {
                                $term_classes[] = strtolower( str_replace( " ", "-", "filter-" . $category->name ) );
                                if ( $i > 0 ) {
                                    $cat_string .= ' / ';
                                }
                                $cat_string .= '<a class="post__link post__link--bold" href="' . get_category_link( $category->cat_ID ) . '">' . $category->name . '</a>';
                                $i++;
                            }
                            $term_classes_string = implode( ' ', $term_classes );
                            ?>

                            <li class="<?php echo $term_classes_string; ?>">
                                <div class="slide-content" <?php echo $img; ?>>
                                    <div class="excerpt--box">
                                        <div class="excerpt__title--row">
                                            <div class="excerpt__title">
                                                <?php the_title(); ?>
                                            </div>

                                            <div class="excerpt__byline--row">
                                                <?php echo __( 'By ', 'ballista' ) . get_the_author() . __( ' in ', 'ballista' ) . $cat_string; ?>
                                            </div>
                                        </div>

                                        <div class="excerpt__content--row content--columns">
                                            <?php echo ballista_the_excerpt_max_charlength( 240 ); ?>
                                            <?php $url = post_permalink( get_the_ID() ); ?>
                                            <a class="post__link"
                                               href="<?php echo $url; ?>"><?php echo __( 'Read More', 'ballista' ); ?></a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        <?php endwhile;
                        wp_reset_query(); ?>

                    <?php else : ?>

                        <?php get_template_part( 'content', 'none' ); ?>

                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </section>

</div>