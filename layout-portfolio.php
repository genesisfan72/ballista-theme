<?php
/**
 * Portfolio layout
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

                <a class="grid__item effect-sarah hover--overlay " data-id="<?php echo the_ID(); ?>" <?php echo $img; ?>>

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

                    <div class="portfolio__overlay">
                        <h2><?php the_title(); ?></span></h2>
                        <p>Short Description</p>
                        <p><i class="fa fa-heart-o"></i>4</p>
                    </div>

                </a>





            <?php endwhile; ?>

        <?php else : ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

        <section class="content">
            <div class="scroll-wrap">
            </div>
            <button class="close-button"><i class="fa fa-close"></i><span>Close</span></button>
        </section>

    </section>

</div>