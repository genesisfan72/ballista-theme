<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Ballista
 */
?>

<a href="<?php the_permalink(); ?>">
    <article
        id="post-<?php the_ID(); ?>" <?php post_class( array( 'blog-excerpt', 'flex-row-container', 'flex-centered' ) ); ?> >

        <div class="excerpt-background" <?php echo $img; ?>></div>

        <?php get_template_part('content', 'blog-header'); ?>

        <footer class="entry-footer">
            <?php edit_post_link( __( 'Edit', 'ballista' ), '<span class="edit-link">', '</span>' ); ?>
        </footer>

    </article>
</a>
