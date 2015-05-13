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
$args = array( 'order' => 'ASC', 'post_type' => 'case_study', 'post_status' => 'publish', 'orderby' => 'post_date', 'posts_per_page' => -1 );
$posts_array = get_posts( $args );
$first_post = count( $posts_array ) > 0 ? $posts_array[ 0 ] : NULL;
$last_post = count( $posts_array ) > 0 ? $posts_array[ count( $posts_array ) - 1 ] : NULL;

if ( empty( $prev_post ) ) {
    $prev_post = $last_post;
}

if ( has_post_thumbnail( $prev_post->ID ) ) {
    $prev_feat_image = wp_get_attachment_url( get_post_thumbnail_id( $prev_post->ID ) );
    $prev_bg_style = 'style="background: url(' . $prev_feat_image . ') 100% / cover"';
}

$next_post = get_next_post();
$next_bg_style = "";
if ( empty( $next_post ) ) {
    $next_post = $first_post;
}
if ( has_post_thumbnail( $next_post->ID ) ) {
    $next_feat_image = wp_get_attachment_url( get_post_thumbnail_id( $next_post->ID ) );
    $next_bg_style = 'style="background: url(' . $next_feat_image . ') 100% / cover"';
}

?>

<div class="post-nav">
    <div class="grid__item grid__item--flex text-center"
         data-id="<?php echo esc_attr( $prev_post->ID ); ?>" <?php echo $prev_bg_style; ?>>
        <div class="excerpt--box">
            <div class="excerpt__title--row">
                <div class="excerpt__likes">
                    <i class="fa fa-long-arrow-left"></i>
                </div>
                <div class="excerpt__title">
                    <?php echo $prev_post->post_title; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="grid__item grid__item--flex text-center"
         data-id="<?php echo esc_attr( $next_post->ID ); ?>" <?php echo $next_bg_style; ?>>
        <div class="excerpt--box">
            <div class="excerpt__title--row">
                <div class="excerpt__title">
                    <?php echo $next_post->post_title; ?>
                </div>
                <div class="excerpt__likes">
                    <i class="fa fa-long-arrow-right"></i>
                </div>
            </div>
        </div>
    </div>
</div>