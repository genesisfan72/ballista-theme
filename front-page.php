<?php
/**
 * The main front-page template file for Ballista
 *
 * @package Ballista
 * @since 1.0
 */
?>

<?php

/**
 * Four styles:
 *
 * 1. Portfolio grid
 * 2. Portfolio full page
 * 3. Full page
 * 4. Blog - default
 */

$layout = get_theme_mod( 'woc_front_page_style' );

if ( isset( $_GET[ 'fp_layout' ] ) ) $layout = $_GET[ 'fp_layout' ];
?>

<?php get_header(); ?>

    <button id="menu-toggle" class="menu-toggle"><span>Menu</span></button>

    <?php get_template_part( 'content', 'sidebar' ); ?>

<?php
if ( $layout === 'blog' || $layout === 'portfolio' || $layout === 'portfolio-full' ) {
    get_template_part( 'layout', 'grid' );
}

if ( $layout === 'fullpage') {
    get_template_part( 'layout', 'full' );
}
?>

<?php get_footer(); ?>