<?php
/**
 * Displays the header image at the top of pages and posts
 *
 * @package Ballista
 */
?>

<?php
$img = '';
if ( has_post_thumbnail() ) {
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail-size', true );
    $thumb_url = $thumb_url_array[ 0 ];
    $img = 'style="background: url(' . esc_url( $thumb_url ) . ') 60% / cover"';
}
?>

<div class="header-image transparent quick-transition" <?php echo $img; ?>></div>