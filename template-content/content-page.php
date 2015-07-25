<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Ballista
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
    <!-- .entry-content -->

    <footer class="entry-footer">
        <?php edit_post_link( __( 'Edit', 'ballista' ), '<span class="edit-link">', '</span>' ); ?>
    </footer>
    <!-- .entry-footer -->
</article><!-- #post-## -->
