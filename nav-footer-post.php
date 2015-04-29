<?php
/**
 * The template part for showing the nav boxes at the bottom of a single post
 *
 * @package Ballista
 */
?>

<?php

$prev_post = get_previous_post();
$prev_bg_style = "";
$args = array( 'order' => 'ASC', 'post_type' => 'case-study', 'post_status' => 'publish', 'orderby' => 'post_date', 'posts_per_page' => -1 );
$posts_array = get_posts( $args );
$first_post = count( $posts_array ) > 0 ? $posts_array[0] : NULL;
$last_post = count( $posts_array ) > 0 ? $posts_array[count($posts_array) - 1] : NULL;

if ( empty( $prev_post ) ) {
    $prev_post = $last_post;
}

if ( has_post_thumbnail( $prev_post->ID) ) {
    $prev_feat_image = wp_get_attachment_url( get_post_thumbnail_id($prev_post->ID) );
    $prev_bg_style = 'style="background: url(' . $prev_feat_image . ') 100% / cover"';
}

$next_post = get_next_post();
$next_bg_style = "";
if ( empty( $next_post ) ) {
    $next_post = $first_post;
}
if ( has_post_thumbnail( $next_post->ID) ) {
    $next_feat_image = wp_get_attachment_url( get_post_thumbnail_id($next_post->ID) );
    $next_bg_style = 'style="background: url(' . $next_feat_image . ') 100% / cover"';
}

?>

<div class="post-nav">
    <div class="grid__item grid__item--flex" data-id="<?php echo $prev_post->ID; ?>" <?php echo $prev_bg_style; ?>>
        <div class="excerpt--box">
            <div class="excerpt__title--row">
                <div class="excerpt__title">
                    <?php echo $prev_post->post_title; ?>
                </div>
                <div class="excerpt__likes">
                    <?php if ( function_exists( 'dot_irecommendthis' ) ) dot_irecommendthis(); ?>
                </div>
            </div>

            <div class="excerpt__byline--row">
                <?php //TODO - loop through categories and create filter links for each one ?>
                <?php echo __( 'By ', 'ballista' ) . get_the_author() . __( ' in ', 'ballista' ) . '<a href="#" class="case-study-filter post__link post__link--bold">' . esc_html( $term_classes ) . '</a>'; ?>
            </div>

            <div class="excerpt__content--row">
                <?php echo ballista_the_excerpt_max_charlength( 240 ); ?>
                <a class="post__link"
                   href="'<?php echo get_permalink( get_the_ID() ); ?>'"><?php echo __( 'Read More', 'ballista' ); ?></a>
            </div>
        </div>
    </div>

    <div class="grid__item grid__item--flex" data-id="<?php echo $next_post->ID; ?>" <?php echo $next_bg_style; ?>>
        <div class="excerpt--box">
            <div class="excerpt__title--row">
                <div class="excerpt__title">
                    <?php echo $next_post->post_title; ?>
                </div>
                <div class="excerpt__likes">
                    <?php if ( function_exists( 'dot_irecommendthis' ) ) dot_irecommendthis(); ?>
                </div>
            </div>

            <div class="excerpt__byline--row">
                <?php //TODO - loop through categories and create filter links for each one ?>
                <?php echo __( 'By ', 'ballista' ) . get_the_author() . __( ' in ', 'ballista' ) . '<a href="#" class="case-study-filter post__link post__link--bold">' . esc_html( $term_classes ) . '</a>'; ?>
            </div>

            <div class="excerpt__content--row">
                <?php echo ballista_the_excerpt_max_charlength( 240 ); ?>
                <a class="post__link"
                   href="'<?php echo get_permalink( get_the_ID() ); ?>'"><?php echo __( 'Read More', 'ballista' ); ?></a>
            </div>
        </div>
    </div>


</div>