<?php
/**
 * Blog layout
 */
?>

<div id="theGrid" class="main">
    <section class="grid">
        <header class="top-bar">

            <div class="categories">
                <?php
                $args = array(
                    'orderby' => 'name',
                    'parent' => 0,
                    'number' => 5
                );
                $categories = get_categories( $args );
                foreach ( $categories as $category ) {
                    echo '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a>';
                }
                ?>
            </div>

            <div class="social-icons">
                <span>Filter by:</span>
                <span class="dropdown">Popular</span>
            </div>
        </header>

        <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

                <?php
                $img = '';
                if ( has_post_thumbnail() ) {
                    $thumb_id = get_post_thumbnail_id();
                    $thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail-size', true );
                    $thumb_url = $thumb_url_array[ 0 ];
                    $img = 'style="background: url(' . esc_url( $thumb_url ) . ') 40% / cover"';
                }
                ?>

                <div class="grid__item" data-id="<?php echo the_ID(); ?>" <?php echo $img; ?>>

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
                            <?php echo __( 'By ', 'ballista' ) . get_the_author() . __( ' in ') . '<a class="post__link post__link--bold">' . $cat_string . '</span>'; ?>
                        </div>

                        <div class="excerpt__content--row">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>

                </div>

            <?php endwhile; ?>

        <?php else : ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

        <section class="content">
            <div class="scroll-wrap">
            </div>
            <button class="close-button"><i class="fa fa-close"></i><span>Close</span></button>
        </section>

        <footer class="page-meta">
            <span>Load more...</span>
        </footer>
    </section>

</div>