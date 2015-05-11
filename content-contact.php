<?php
/**
 * The template used for displaying the contact page content.
 *
 * @package Ballista
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <div class="contact__form">
            <?php global $response; ?>
            <?php echo $response; ?>

            <?php the_content(); ?>
        </div>
    </div><!-- .entry-content -->

</article><!-- #post-## -->
