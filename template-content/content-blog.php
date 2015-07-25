<?php
/**
 * The template used for displaying page content in page.php
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
    $img = 'style="background: url(' . esc_url( $thumb_url ) . ') 80% / cover"';
}
?>

<article
    id="post-<?php the_ID(); ?>" <?php post_class( array( 'blog-excerpt', 'flex-display', 'flex-direction-row', 'flex-nowrap', 'flex-centered' ) ); ?> >

    <div class="excerpt-background" <?php echo $img; ?>></div>

    <?php get_template_part( 'template-content/content', 'blog-header' ); ?>

    <footer class="entry-footer">
        <?php edit_post_link( __( 'Edit', 'ballista' ), '<span class="edit-link">', '</span>' ); ?>
    </footer>
</article>
