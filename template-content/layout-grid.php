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
    <section class="grid">

        <?php get_template_part( 'template-content/content', 'top-bar' ); ?>

        <div class="grid__item__container">

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

                    $terms = woc_custom_taxonomies_terms_links();
                    $term_classes = [];
                    $term_links = "";
                    if ( $terms && !is_wp_error( $terms ) ) {
                        $i = 0;
                        foreach ( $terms as $term ) {
                            $term_link = get_term_link( $term );
                            // If there was an error, continue to the next term.
                            if ( is_wp_error( $term_link ) ) {
                                continue;
                            }
                            $term_classes[] = strtolower( str_replace( " ", "-", "filter-" . $term->name ) );
                            if ( $i > 0 ) {
                                $term_links .= " / ";
                            }
                            $term_links .= '<a href="' . esc_url( $term_link ) . '" class="case-study-filter post__link post__link--bold">' . strtolower( str_replace( " ", "-", $term->name ) ) . '</a>';
                            $i++;
                        }
                    }
                    $term_classes_string = implode( ' ', $term_classes );

//                    $categories = array();
//                    $i = 0;
//                    $cat_string = "";
//                    foreach ( get_the_category() as $category ) {
//                        if ( $i > 0 ) {
//                            $cat_string .= ', ';
//                        }
//                        $cat_string .= '<a class="post__link post__link--bold" href="' . get_category_link( $category->cat_ID ) . '">' . $category->name . '</a>';
//                    }
                    ?>

                    <?php if ( $layout === 'blog' ) { ?>
                        <div
                            class="grid__item grid__item--flex transparent quick-transition <?php echo $term_classes_string; ?>"
                            data-href="<?php echo the_permalink(); ?>" <?php echo $img; ?>>
                            <div class="excerpt--box">

                                <div class="excerpt__title--row">
                                    <div class="excerpt__title">
                                        <?php the_title(); ?>
                                    </div>
                                    <div class="excerpt__likes">
                                        <?php if ( function_exists( 'dot_irecommendthis' ) ) dot_irecommendthis(); ?>
                                    </div>
                                </div>

                                <div class="excerpt__byline--row">
                                    <?php //TODO - loop through categories and create filter links for each one ?>
                                    <?php echo __( 'By ', 'ballista' ) . get_the_author() . __( ' in ', 'ballista' ) . $term_links; ?>
                                </div>

                                <div class="excerpt__content--row">
                                    <?php echo ballista_the_excerpt_max_charlength( 240 ); ?>
                                    <?php $url = get_the_permalink(); ?>
                                    <a class="post__link"
                                       href="<?php echo $url; ?>"><?php echo __( 'Read More', 'ballista' ); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php } else if ( $layout === 'portfolio' ) { ?>
                        <div
                            class="grid__item grid__item--flex effect-ballista-case-study hover--overlay transparent quick-transition <?php echo $term_classes_string; ?>"
                            data-href="<?php echo the_permalink(); ?>" <?php echo $img; ?>>
                            <div class="portfolio__overlay">
                                <?php $url = get_the_permalink(); ?>
                                <a class="post__link" href="<?php echo $url; ?>">
                                    <h2 class="title"><?php the_title(); ?></span></h2>
                                </a>

                                <div class="details">
                                    <p><?php echo $term_links; ?></p>

                                    <div class="excerpt__likes">
                                        <?php if ( function_exists( 'dot_irecommendthis' ) ) dot_irecommendthis(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else if ( $layout === 'portfolio-full' ) { ?>
                        <div
                            class="grid__item grid__item--flex grid__item--portfolio--full effect-ballista-case-study hover--overlay transparent quick-transition <?php echo $term_classes_string; ?>"
                            data-href="<?php echo the_permalink(); ?>" <?php echo $img; ?>>
                            <div class="portfolio__overlay">
                                <?php $url = get_the_permalink(); ?>
                                <a class="post__link" href="<?php echo $url; ?>">
                                    <h2 class="title"><?php the_title(); ?></span></h2>
                                </a>

                                <div class="details">
                                    <p><?php echo $term_links; ?></p>

                                    <div class="excerpt__likes">
                                        <?php if ( function_exists( 'dot_irecommendthis' ) ) dot_irecommendthis(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                <?php endwhile;
                wp_reset_query(); ?>

            <?php else : ?>

                <?php get_template_part( 'content', 'none' ); ?>

            <?php endif; ?>
        </div>
    </section>

</div>