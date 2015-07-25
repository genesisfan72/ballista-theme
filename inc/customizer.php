<?php
/**
 * Ballista Theme Customizer
 *
 * @package Ballista
 */

/**
 * Text sanitizer
 */
function ballista_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
    // TODO - Need to write a proper callback that allows iframes
}

/**
 * Front page layout sanitizer
 */
function ballista_sanitize_layout( $input ) {
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
function ballista_customize_register( $wp_customize ) {

    /**
     * General Section
     */
    $wp_customize->add_section( 'woc_layout_section', array(
        'title' => __( 'Homepage Options', 'ballista' ),
        'priority' => 1,
    ) );

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

    /**
     * Logo Section
     */
    $wp_customize->add_section( 'woc_logo_section', array(
        'title' => __( 'Logo', 'ballista' ),
        'priority' => 3,
    ) );


    // Logo
    $wp_customize->add_setting( 'woc_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw' ) );

    $wp_customize->add_control( new WP_Customize_Image_Control (
        $wp_customize,
        'woc_logo',
        array(
            'label' => __( 'The logo for your site. Suggested size of roughly 200px by 30px.', 'ballista' ),
            'section' => 'woc_logo_section',
            'settings' => 'woc_logo',
            'priority' => 3
        )
    ) );

    /* Typography Section */
    $wp_customize->add_section( 'woc_typography_section', array(
        'title' => __( 'Typography', 'ballista' ),
        'priority' => 4,
    ) );

    // Set up Google Fonts
    include 'google-fonts.php';

    $wp_customize->add_setting( 'woc_primary_font', array(
        'sanitize_callback' => 'ballista_sanitize_text',
        'default' => serialize( array(
            'font-family' => "'Martel Sans', sans-serif;",
            'css-name' => 'Martel+Sans'
        ) ),
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control( 'woc_primary_font',
        array(
            'label' => __( 'Select your primary font. This is the main body text.', 'ballista' ),
            'section' => 'woc_typography_section',
            'settings' => 'woc_primary_font',
            'type' => 'select',
            'choices' => $google_fonts
        )
    );


    // Secondary font
    $wp_customize->add_setting( 'woc_secondary_font', array(
        'sanitize_callback' => 'ballista_sanitize_text',
        'default' => serialize( array(
            'font-family' => "'Roboto Slab', serif;",
            'css-name' => 'Roboto+Slab'
        ) ),
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control( 'woc_secondary_font',
        array(
            'label' => __( 'Select your secondary font. Used for H1 tags and the title font.', 'ballista' ),
            'section' => 'woc_typography_section',
            'settings' => 'woc_secondary_font',
            'type' => 'select',
            'choices' => $google_fonts
        )
    );

    // Tertiary font
    $wp_customize->add_setting( 'woc_tertiary_font', array(
        'sanitize_callback' => 'ballista_sanitize_text',
        'default' => serialize( array(
            'font-family' => "'Roboto', sans-serif;",
            'css-name' => 'Roboto'
        ) ),
        'transport' => 'refresh'
    ) );

    $wp_customize->add_control( 'woc_tertiary_font',
        array(
            'label' => __( 'Select your third level font. Used primarily for h2 tags, subtitles, and smaller titles.', 'ballista' ),
            'section' => 'woc_typography_section',
            'settings' => 'woc_tertiary_font',
            'type' => 'select',
            'choices' => $google_fonts
        )
    );

    /**
     * Social Media & Contact Section
     */
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


    /**
     * About Page Section
     */
    $wp_customize->add_section( 'woc_about_section', array(
        'title' => __( 'About Page', 'ballista' ),
        'priority' => 2,
    ) );

    $wp_customize->add_setting( 'woc_show_thumbnails', array(
        'default' => 0,
        'transport' => 'refresh' ) );

    $wp_customize->add_setting( 'woc_about_images', array(
        'default' => 1,
        'transport' => 'refresh' ) );

    $wp_customize->add_control( 'woc_about_image_source',
        array(
            'label' => __( 'Select your source for your About page thumbnail section.', 'ballista' ),
            'section' => 'woc_about_section',
            'settings' => 'woc_about_images',
            'type' => 'select',
            'choices' => array( 'library' => __( 'Media Library', 'ballista' ),
                'instagram' => __( 'Instagram', 'ballista' ) ),
            'priority' => 3
        )
    );

    $wp_customize->add_control( 'woc_show_thumbnails', array(
        'label' => __( 'Show logo icons slider on about page.', 'ballista' ),
        'section' => 'woc_about_section',
        'type' => 'checkbox',
        'settings' => 'woc_show_thumbnails',
        'priority' => 3
    ) );

    $wp_customize->add_setting( 'woc_about_page_image_1', array(
        'default' => '',
        'transport' => 'refresh' ) );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'woc_about_page_image_1',
            array(
                'label' => __( 'Image #1', 'ballista' ),
                'section' => 'woc_about_section',
                'settings' => 'woc_about_page_image_1'
            )
        )
    );

    $wp_customize->add_setting( 'woc_about_page_image_2', array(
        'default' => '',
        'transport' => 'refresh' ) );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'woc_about_page_image_2',
            array(
                'label' => __( 'Image #2', 'ballista' ),
                'section' => 'woc_about_section',
                'settings' => 'woc_about_page_image_2'
            )
        )
    );

    $wp_customize->add_setting( 'woc_about_page_image_3', array(
        'default' => '',
        'transport' => 'refresh' ) );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'woc_about_page_image_3',
            array(
                'label' => __( 'Image #3', 'ballista' ),
                'section' => 'woc_about_section',
                'settings' => 'woc_about_page_image_3'
            )
        )
    );

    $wp_customize->add_setting( 'woc_about_page_image_4', array(
        'default' => '',
        'transport' => 'refresh' ) );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'woc_about_page_image_4',
            array(
                'label' => __( 'Image #4', 'ballista' ),
                'section' => 'woc_about_section',
                'settings' => 'woc_about_page_image_4'
            )
        )
    );

    $wp_customize->add_setting( 'woc_about_page_image_5', array(
        'default' => '',
        'transport' => 'refresh' ) );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'woc_about_page_image_5',
            array(
                'label' => __( 'Image #5', 'ballista' ),
                'section' => 'woc_about_section',
                'settings' => 'woc_about_page_image_5'
            )
        )
    );

    /**
     * Contact Page Section
     */
    $wp_customize->add_section( 'woc_contact_section', array(
        'title' => __( 'Contact Page', 'ballista' ),
        'priority' => 2,
    ) );

    $wp_customize->add_setting( 'woc_contact_page_header_left', array(
        'default' => '',
        'transport' => 'refresh' ) );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'woc_contact_page_header_left',
            array(
                'label' => __( 'Left Side Image', 'ballista' ),
                'section' => 'woc_contact_section',
                'settings' => 'woc_contact_page_header_left',
                'priority' => 5
            )
        )
    );

    $wp_customize->add_setting( 'woc_contact_page_header_right', array(
        'default' => __( '', 'ballista' ),
        'sanitize_callback' => 'ballista_sanitize_text'
    ) );

    $wp_customize->add_control( 'woc_google_map', array(
        'label' => __( 'Enter the <iframe> code generated by Google Maps.', 'ballista' ),
        'settings' => 'woc_contact_page_header_right',
        'section' => 'woc_contact_section',
        'type' => 'text',
        'priority' => 6
    ) );

    /**
     * Footer Section
     */
    $wp_customize->add_section( 'woc_footer_section', array(
        'title' => __( 'Footer', 'ballista' ),
        'priority' => 2,
    ) );

    $default_footer_text = '<a href="' . esc_url( 'http://wordpress.org/' ) . '">' . __( 'Proudly powered by Wordpress', 'ballista' ) . '</a>
<span class="sep"> | </span>' . __( 'Theme: Ballista by', 'ballista' ) . ' <a href="' . esc_url( 'http://www.warriorsofcode.com' ) . '" rel="designer">' . __( 'Warriors of Code', 'ballista' ) . '</a>.';
    $wp_customize->add_setting( 'woc_copyright_text', array(
        'default' => $default_footer_text,
        'sanitize_callback' => 'ballista_sanitize_text'
    ) );

    $wp_customize->add_control( 'woc_copyright_text', array(
        'label' => __( 'Enter the text to appear at the bottom of the sidebar.', 'ballista' ),
        'settings' => 'woc_copyright_text',
        'section' => 'woc_footer_section',
        'type' => 'text',
        'priority' => 6
    ) );

    /**
     * Page Header Image Section
     */
    $wp_customize->add_section( 'woc_default_pages_section', array(
        'title' => __( 'Page Header Images', 'ballista' ),
        'priority' => 7,
    ) );

    $wp_customize->add_setting( 'woc_blog_image_header', array(
        'default' => '',
        'transport' => 'refresh' ) );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'woc_blog_image_header',
            array(
                'label' => __( 'Blog Page Header Image', 'ballista' ),
                'section' => 'woc_default_pages_section',
                'settings' => 'woc_blog_image_header'
            )
        )
    );

    $wp_customize->add_setting( 'woc_archive_image_header', array(
        'default' => '',
        'transport' => 'refresh' ) );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'woc_archive_image_header',
            array(
                'label' => __( 'Archive Page Header Image', 'ballista' ),
                'section' => 'woc_default_pages_section',
                'settings' => 'woc_archive_image_header'
            )
        )
    );

    $wp_customize->add_setting( 'woc_search_image_header', array(
        'default' => '',
        'transport' => 'refresh' ) );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'woc_search_image_header',
            array(
                'label' => __( 'Search Page Header Image', 'ballista' ),
                'section' => 'woc_default_pages_section',
                'settings' => 'woc_search_image_header'
            )
        )
    );

    $wp_customize->add_setting( 'woc_404_image_header', array(
        'default' => '',
        'transport' => 'refresh' ) );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'woc_404_image_header',
            array(
                'label' => __( '404 Page Header Image', 'ballista' ),
                'section' => 'woc_default_pages_section',
                'settings' => 'woc_404_image_header'
            )
        )
    );

    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}

add_action( 'customize_register', 'ballista_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ballista_customize_preview_js() {
    wp_enqueue_script( 'ballista_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}

add_action( 'customize_preview_init', 'ballista_customize_preview_js' );


function my_customizer_script() {
    ?>
    <script type="text/javascript">

        "use strict";

        jQuery(document).ready(function ($) {
            let aboutSelect = $("select[data-customize-setting-link='woc_about_images']");

            if (aboutSelect.val() === 'instagram') {
                $("li[id^='customize-control-woc_about_page_image_'").hide();
            }

            $(document).on('change', aboutSelect, function () {
                if (aboutSelect.val() === 'instagram') {
                    $("li[id^='customize-control-woc_about_page_image_'").hide();
                }
                else {
                    $("li[id^='customize-control-woc_about_page_image_'").show();
                }
            });
        });
    </script>
<?php
}

add_action( 'customize_controls_print_footer_scripts', 'my_customizer_script' );
