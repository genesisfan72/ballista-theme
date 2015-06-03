<?php
/**
 * The case studies front page template for Ballista
 *
 * Template Name: Case Studies Front Page
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

$layout = get_theme_mod( 'woc_front_page_style', 'blog' );

if ( isset( $_GET[ 'fp_layout' ] ) ) $layout = $_GET[ 'fp_layout' ];
?>

<?php get_header(); ?>

    <?php get_template_part( 'template-content/content', 'sidebar' ); ?>

<?php
if ( $layout === 'blog' || $layout === 'portfolio' || $layout === 'portfolio-full' ) {
    get_template_part( 'template-content/layout', 'grid' );
}

if ( $layout === 'fullpage') {
    get_template_part( 'template-content/layout', 'full' );
}
?>

<?php get_footer(); ?>