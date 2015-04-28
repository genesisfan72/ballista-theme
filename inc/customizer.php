<?php
/**
 * Ballista Theme Customizer
 *
 * @package Ballista
 */

/**
 * Front page layout sanitizer
 */
function ballista_sanitize_layout( $input )
{
    $valid = array(
        'blog' => 'Blog',
        'portfolio' => 'Portfolio',
        'portfolio-full' => 'Portfolio Full',
        'fullpage' => 'Full Page',
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ballista_customize_register( $wp_customize )
{

    /* General Section */
    $wp_customize->add_section( 'woc_layout_section', array(
        'title' => __( 'Homepage Options', 'woc_broadsword' ),
        'priority' => 1,
    ) );

    // Front page layout style
    require_once 'layout-picker-custom-control.php';
    $wp_customize->add_setting( 'woc_front_page_style', array(
        'default' => __( 'blog', 'ballista' ),
        'sanitize_callback' => 'ballista_sanitize_layout'
    ) );

    $wp_customize->add_control( new Layout_Picker_Custom_Control( $wp_customize, 'woc_front_page_style', array(
        'label' => __( 'Select Homepage Layout:', 'ballista' ),
        'section' => 'woc_layout_section',
        'settings' => 'woc_front_page_style',
        'priority' => 1
    ) ) );

    /* Social Media & Contact Section */
    $wp_customize->add_section( 'woc_social_media_contact_section', array(
        'title' => __( 'Social Media & Contact Options', 'ballista' ),
        'priority' => 31,
        'description' => __( 'Enter the account names for any of the following social media networks you wish to link on your site.', 'ballista' )
    ) );

    $wp_customize->add_setting( 'woc_facebook', array(
        'default' => '',
        'sanitize_callback' => 'esc_url'
    ) );

    $wp_customize->add_control( 'woc_facebook', array(
        'label' => __( 'Facebook', 'ballista' ),
        'section' => 'woc_social_media_contact_section',
        'type' => 'text',
        'priority' => 1
    ) );

    $wp_customize->add_setting( 'woc_twitter', array(
        'default' => '',
        'sanitize_callback' => 'esc_url'
    ) );

    $wp_customize->add_control( 'woc_twitter', array(
        'label' => __( 'Twitter', 'ballista' ),
        'section' => 'woc_social_media_contact_section',
        'type' => 'text',
        'priority' => 2
    ) );

    $wp_customize->add_setting( 'woc_googleplus', array(
        'default' => '',
        'sanitize_callback' => 'esc_url'
    ) );

    $wp_customize->add_control( 'woc_googleplus', array(
        'label' => __( 'Google+', 'ballista' ),
        'section' => 'woc_social_media_contact_section',
        'type' => 'text',
        'priority' => 3
    ) );

    $wp_customize->add_setting( 'woc_linkedin', array(
        'default' => '',
        'sanitize_callback' => 'esc_url'
    ) );

    $wp_customize->add_control( 'woc_linkedin', array(
        'label' => __( 'LinkedIn', 'ballista' ),
        'section' => 'woc_social_media_contact_section',
        'type' => 'text',
        'priority' => 4
    ) );

    $wp_customize->add_setting( 'woc_pinterest', array(
        'default' => '',
        'sanitize_callback' => 'esc_url'
    ) );

    $wp_customize->add_control( 'woc_pinterest', array(
        'label' => __( 'Pinterest', 'ballista' ),
        'section' => 'woc_social_media_contact_section',
        'type' => 'text',
        'priority' => 4
    ) );

    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}

add_action( 'customize_register', 'ballista_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ballista_customize_preview_js()
{
    wp_enqueue_script( 'ballista_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}

add_action( 'customize_preview_init', 'ballista_customize_preview_js' );
