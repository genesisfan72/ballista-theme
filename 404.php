<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Ballista
 */

get_header(); ?>

<?php get_template_part( 'template-content/content', 'sidebar' ); ?>

<div id="theGrid" class="main">
    <section class="grid">


        <?php
        // Get the header image for the blog page
        $src = get_theme_mod('woc_404_image_header');

        if ($src != '') {
            $img = 'style="background: url(' . esc_url( $src ) . ') 100% / cover"';
            ?>
            <div class="header-image transparent quick-transition" <?php echo $img; ?>></div>
        <?php } ?>

        <div class="page-content animated flex-display flex-nowrap flex-direction-column flex-centered fadeIn">
            <header class="page-header">
                <h1 class="page-title"><?php echo __('404', 'ballista'); ?></h1>
                <h2><?php echo __( 'PAGE NOT FOUND', 'ballista' ); ?></h2>
            </header><!-- .page-header -->

            <div class="error-content">
                <div class="content-message">
                    <?php echo __( "Return home, there's nothing here", "ballista" ); ?>
                </div>
            </div>

            <div class="social-icons">
                <?php get_template_part( 'template-content/links', 'social' ); ?>
            </div>

        </div><!-- .page-content -->
    </section>
</div>


<?php get_footer(); ?>
