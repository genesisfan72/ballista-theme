<?php
/**
 * The template part for displaying social media links
 *
 * @package Ballista
 */
?>

<?php
// Social media icons
if ( get_theme_mod( 'woc_facebook' ) != "" ) {
    echo '<span class="icon-container"><a href="' . esc_url( get_theme_mod( 'woc_facebook' ) ) . '"><i class="fa fa-facebook"></i></a></span>';
}

if ( get_theme_mod( 'woc_twitter' ) != "" ) {
    echo '<span class="icon-container"><a href="' . esc_url( get_theme_mod( 'woc_twitter' ) ) . '"><i class="fa fa-twitter"></i></a></span>';
}

if ( get_theme_mod( 'woc_googleplus' ) != "" ) {
    echo '<span class="icon-container"><a href="' . esc_url( get_theme_mod( 'woc_googleplus' ) ) . '"><i class="fa fa-google-plus"></i></a></span>';
}

if ( get_theme_mod( 'woc_linkedin' ) != "" ) {
    echo '<span class="icon-container"><a href="' . esc_url( get_theme_mod( 'woc_linkedin' ) ) . '"><i class="fa fa-linkedin"></i></a></span>';
}

if ( get_theme_mod( 'woc_pinterest' ) != "" ) {
    echo '<span class="icon-container"><a href="' . esc_url( get_theme_mod( 'woc_pinterest' ) ) . '"><i class="fa fa-pinterest"></i></a></span>';
}
?>
