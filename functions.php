<?php
/**
 * Ballista functions and definitions
 *
 * @package Ballista
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( !isset( $content_width ) ) {
    $content_width = 640; /* pixels */
}

/**
 * Include the Live Composer template register file.
 */
require_once dirname( __FILE__ ) . '/inc/register-templates.php';

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'ballista_register_required_plugins' );


/**
 * Register the required plugins for this theme.
 */
function ballista_register_required_plugins() {

    $plugins = array(
        array(
            'name' => 'Live Composer',
            'slug' => 'ds-live-composer',
            'source'             => get_stylesheet_directory() . '/assets/plugins/livecomposer/ds-live-composer.zip',
            'required' => true
        ),
        array(
            'name' => 'Wordpress Retina 2x',
            'slug' => 'wp-retina-2x',
            'required' => true,
        ),
        array(
            'name' => 'I Recommend This',
            'slug' => 'i-recommend-this',
            'required' => true,
            'force_activation' => true
        ),
        array(
            'name' => 'Intuitive Custom Post Order',
            'slug' => 'intuitive-custom-post-order',
            'required' => false
        ),
        array(
            'name' => 'Instagram Feed',
            'slug' => 'instagram-feed',
            'required' => false
        )
    );

    $theme_text_domain = 'woc_broadsword';

    /**
     * Array of configuration settings. Uncomment and amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * uncomment the strings and domain.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain' => $theme_text_domain,
        'menu' => 'install-my-theme-plugins',
        'has_notices' => true,
        // Show admin notices
        'dismissable' => false,
        // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '',
        // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,
        // Automatically activate plugins after installation or not.
        'strings' => array(
            'page_title' => __( 'Install Recommended Plugins', $theme_text_domain ),
            'menu_title' => __( 'Install Plugins', $theme_text_domain ),
            'instructions_install' => __( 'The %1$s plugin is recommended for this theme. Click on the big blue button below to install and activate %1$s.', $theme_text_domain ),
            'instructions_activate' => __( 'The %1$s is installed but currently inactive. Please go to the <a href="%2$s">plugin administration page</a> page to activate it.', $theme_text_domain ),
            'button' => __( 'Install %s Now', $theme_text_domain ),
            'installing' => __( 'Installing Plugin: %s', $theme_text_domain ),
            'oops' => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            'notice_can_install' => __( 'This theme recommends the use of the %1$s plugin. <a href="%2$s"><strong>Click here to begin the installation process</strong></a>. You may be asked for FTP credentials based on your server setup.', $theme_text_domain ),
            'notice_cannot_install' => __( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', $theme_text_domain ),
            'notice_can_activate' => __( 'This theme recommends the use of the %1$s plugin. That plugin is currently inactive, so please go to the <a href="%2$s">plugin administration page</a> to activate it.', $theme_text_domain ),
            'notice_cannot_activate' => __( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', $theme_text_domain ),
            'return' => __( 'Return to Plugins Installer', $theme_text_domain ),
        ),
    );

    tgmpa( $plugins, $config );
}

if ( !function_exists( 'ballista_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function ballista_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Ballista, use a find and replace
         * to change 'ballista' to the name of your theme in all the template files
         */
        load_theme_textdomain( 'ballista', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
         */
        //add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'ballista' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
        ) );

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'aside', 'image', 'video', 'quote', 'link',
        ) );

        /*
         * Enable support for featured images
         */
        add_theme_support( 'post-thumbnails' );
    }
endif; // ballista_setup
add_action( 'after_setup_theme', 'ballista_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function ballista_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Sidebar', 'ballista' ),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h1 class="widget-title">',
        'after_title' => '</h1>',
    ) );
}

add_action( 'widgets_init', 'ballista_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ballista_scripts() {
    wp_enqueue_style( 'ballista-style', get_stylesheet_uri() );

    wp_enqueue_style( 'ballista', get_template_directory_uri() . '/assets/css/ballista.css' );

    wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/js/flexslider/flexslider.css' );

    wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );

    wp_enqueue_script( 'ballista-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );

    wp_enqueue_script( 'ballista-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.custom.js', array(), '20130115', true );

    wp_enqueue_script( 'classie', get_template_directory_uri() . '/assets/js/classie.js', array(), '20130115', true );

    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array(), '20130115', true );

    wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/js/flexslider/jquery.flexslider-min.js', array(), '20130115', true );

    wp_enqueue_script( 'ballista', get_template_directory_uri() . '/assets/js/ballista.js', array( 'jquery' ), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'ballista_scripts' );

/**
 * Filter the avatar display
 */
add_filter( 'get_avatar', 'ballista_change_avatar_css' );
function ballista_change_avatar_css( $class ) {
    $class = str_replace( "class='avatar", "class='meta__avatar ", $class );
    return $class;
}

/**
 * Remove any 'p' tags surrounding images in content
 */
function ballista_filter_ptags_on_images( $content ) {
    return preg_replace( '/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content );
}

// we want it to be run after the autop stuff... 10 is default.
add_filter( 'the_content', 'ballista_filter_ptags_on_images' );


/**
 * Find the first image in post content. Used for portfolio layouts.
 * @return string
 */
function ballista_first_image() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
    $first_img = $matches[ 1 ][ 0 ];

    if ( empty( $first_img ) ) {
        $first_img = "/path/to/default.png";
    }
    return $first_img;
}

/**
 * Add a 'Read more' string to the excerpt
 * @param $more
 * @return string
 */
function ballista_new_excerpt_more( $more ) {
    return '[...]<br/><br />';
}

add_filter( 'excerpt_more', 'ballista_new_excerpt_more' );

/**
 * Limit the excerpt length
 */
function ballista_new_excerpt_length( $length ) {
    return 20;
}

add_filter( 'excerpt_length', 'ballista_new_excerpt_length', 999 );

/**
 * Set the max length for custom excerpt entries
 * @param $charlength
 */
function ballista_the_excerpt_max_charlength( $charlength ) {
    $excerpt = get_the_excerpt();
    $charlength++;

    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = -( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo $subex;
        }
        echo '[...]<br /><br />';
    } else {
        echo $excerpt;
    }
}

function ballista_register_cpt_post_templates( $tpl ) {

    $tpl['case_study'] = __( 'Case Studies', 'ballista' );

    return $tpl;

} add_filter( 'dslc_post_templates_post_types', 'ballista_register_cpt_post_templates' );


/**
 * Load Google fonts
 */
function ballista_load_fonts() {
    // Set the protocol
    $protocol = is_ssl()
        ? 'https'
        : 'http';

    // Load the defaults
    wp_enqueue_style( "Roboto", "$protocol://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,700,700italic" );
    wp_enqueue_style( "RobotoSlab", "$protocol://http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700" );
}

add_action( 'wp_print_styles', 'ballista_load_fonts' );


/**
 * Live Composer Templates
 */
function ballista_load_lc_templates() {
    global $dslc_var_templates;

    $dslc_var_templates['ballista-about-page'] = array(
        'title' => __('About Page Default', 'ballista'),
        'id' => 'ballista-about-page',
        'code' => '[dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="10" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo4OntzOjc6ImNvbnRlbnQiO3M6MzY6IjxoMj5ISSwgV0UgQVJFIFdBUlJJT1JTIE9GIENPREU8L2gyPiI7czoxMjoiY3NzX2gyX2NvbG9yIjtzOjE1OiJyZ2IoNTEsIDUxLCA1MSkiO3M6MTY6ImNzc19oMl9mb250X3NpemUiO3M6MjoiMTQiO3M6MTg6ImNzc19oMl9mb250X2ZhbWlseSI7czo2OiJSb2JvdG8iO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czoyOiIzMCI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3NTMiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxNjoiRFNMQ19UZXh0X1NpbXBsZSI7fQ==[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="yes" size="6"] [dslc_module]YTo1OntzOjc6ImNvbnRlbnQiO3M6MzkwOiI8cD5JXCdtIGEgU3BhbGRpbmcgR3JheSBpbiBhIFJpY2sgRGVlcyB3b3JsZC4gRmFjdHMgYXJlIG1lYW5pbmdsZXNzLiBZb3UgY291bGQgdXNlIGZhY3RzIHRvIHByb3ZlIGFueXRoaW5nIHRoYXRcJ3MgZXZlbiByZW1vdGVseSB0cnVlISBXaGF0XCdzIHRoZSBwb2ludCBvZiBnb2luZyBvdXQ/IFdlXCdyZSBqdXN0IGdvaW5nIHRvIHdpbmQgdXAgYmFjayBoZXJlIGFueXdheS4gSSBjYW5cJ3QgZ28gdG8ganV2aWUuIFRoZXkgdXNlIGd1eXMgbGlrZSBtZSBhcyBjdXJyZW5jeS4gU2xvdyBkb3duLCBCYXJ0ISBNeSBsZWdzIGRvblwndCBrbm93IGhvdyB0byBiZSBhcyBsb25nIGFzIHlvdXJzLiBBYWFoISBOYXR1cmFsIGxpZ2h0ISBHZXQgaXQgb2ZmIG1lISBHZXQgaXQgb2ZmIG1lITwvcD4iO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7aTozMTtzOjc6InBvc3RfaWQiO3M6NDoiMTczNSI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjE2OiJEU0xDX1RleHRfU2ltcGxlIjt9[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="yes" first="no" size="6"] [dslc_module]YTo1OntzOjc6ImNvbnRlbnQiO3M6NDI5OiI8cD5Zb3Uga25vdywgdGhlIG9uZSB3aXRoIGFsbCB0aGUgd2VsbCBtZWFuaW5nIHJ1bGVzIHRoYXQgZG9uXCd0IHdvcmsgb3V0IGluIHJlYWwgbGlmZSwgdWgsIENocmlzdGlhbml0eS4gS2lkcywgd2UgbmVlZCB0byB0YWxrIGZvciBhIG1vbWVudCBhYm91dCBLcnVzdHkgQnJhbmQgQ2hldyBHb28gR3VtIExpa2UgU3Vic3RhbmNlLiBXZSBhbGwga25ldyBpdCBjb250YWluZWQgc3BpZGVyIGVnZ3MsIGJ1dCB0aGUgaGFudGF2aXJ1cz8gVGhhdCBjYW1lIG91dCBvZiBsZWZ0IGZpZWxkLiBTbyBpZiB5b3VcJ3JlIGV4cGVyaWVuY2luZyBudW1ibmVzcyBhbmQvb3IgY29tYXMsIHNlbmQgZml2ZSBkb2xsYXJzIHRvIGFudGlkb3RlLCBQTyBib3jigKYgVGhleSBvbmx5IGNvbWUgb3V0IGluIHRoZSBuaWdodC4gT3IgaW4gdGhpcyBjYXNlLCB0aGUgZGF5LjwvcD4iO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7aTozMjtzOjc6InBvc3RfaWQiO3M6NDoiMTczNSI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjE2OiJEU0xDX1RleHRfU2ltcGxlIjt9[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="10" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo5OntzOjc6ImNvbnRlbnQiO3M6MTc6IjxoMj5TZXJ2aWNlczwvaDI+IjtzOjE4OiJjc3NfaDJfYm9yZGVyX3RyYmwiO3M6MDoiIjtzOjE2OiJjc3NfaDJfZm9udF9zaXplIjtzOjI6IjE2IjtzOjE4OiJjc3NfaDJfZm9udF93ZWlnaHQiO3M6MzoiNjAwIjtzOjE4OiJjc3NfaDJfZm9udF9mYW1pbHkiO3M6NjoiUm9ib3RvIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MjoiNDYiO3M6NzoicG9zdF9pZCI7czo0OiIxNzUzIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="10" custom_class="" custom_id="" ] [dslc_modules_area last="no" first="yes" size="3"] [dslc_module]YTo4OntzOjc6ImNvbnRlbnQiO3M6MTA2OiI8cD48c3Ryb25nPkRFU0lHTjwvc3Ryb25nPjwvcD48dWw+PGxpPlVzZXIgRXhwZXJpZW5jZTwvbGk+PGxpPkludGVyYWN0aW9uPC9saT48bGk+VXNlciBJbnRlcmZhY2U8L2xpPjwvdWw+IjtzOjIyOiJjc3NfbWFpbl9tYXJnaW5fYm90dG9tIjtzOjE6IjUiO3M6MTg6ImNzc191bF9tYXJnaW5fbGVmdCI7czoxOiIwIjtzOjIzOiJjc3NfdWxfbGlfbWFyZ2luX2JvdHRvbSI7czoxOiIwIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO2k6MzM7czo3OiJwb3N0X2lkIjtzOjQ6IjE3MzUiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxNjoiRFNMQ19UZXh0X1NpbXBsZSI7fQ==[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="no" size="3"] [dslc_module]YTo4OntzOjc6ImNvbnRlbnQiO3M6MTA2OiI8cD48c3Ryb25nPkRFU0lHTjwvc3Ryb25nPjwvcD48dWw+PGxpPlVzZXIgRXhwZXJpZW5jZTwvbGk+PGxpPkludGVyYWN0aW9uPC9saT48bGk+VXNlciBJbnRlcmZhY2U8L2xpPjwvdWw+IjtzOjIyOiJjc3NfbWFpbl9tYXJnaW5fYm90dG9tIjtzOjE6IjUiO3M6MTg6ImNzc191bF9tYXJnaW5fbGVmdCI7czoxOiIwIjtzOjIzOiJjc3NfdWxfbGlfbWFyZ2luX2JvdHRvbSI7czoxOiIwIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO2k6MzQ7czo3OiJwb3N0X2lkIjtzOjQ6IjE3MzUiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxNjoiRFNMQ19UZXh0X1NpbXBsZSI7fQ==[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="no" size="3"] [dslc_module]YTo4OntzOjc6ImNvbnRlbnQiO3M6MTA2OiI8cD48c3Ryb25nPkRFU0lHTjwvc3Ryb25nPjwvcD48dWw+PGxpPlVzZXIgRXhwZXJpZW5jZTwvbGk+PGxpPkludGVyYWN0aW9uPC9saT48bGk+VXNlciBJbnRlcmZhY2U8L2xpPjwvdWw+IjtzOjIyOiJjc3NfbWFpbl9tYXJnaW5fYm90dG9tIjtzOjE6IjUiO3M6MTg6ImNzc191bF9tYXJnaW5fbGVmdCI7czoxOiIwIjtzOjIzOiJjc3NfdWxfbGlfbWFyZ2luX2JvdHRvbSI7czoxOiIwIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO2k6MzU7czo3OiJwb3N0X2lkIjtzOjQ6IjE3MzUiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxNjoiRFNMQ19UZXh0X1NpbXBsZSI7fQ==[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="yes" first="no" size="3"] [dslc_module]YTo4OntzOjc6ImNvbnRlbnQiO3M6MTA2OiI8cD48c3Ryb25nPkRFU0lHTjwvc3Ryb25nPjwvcD48dWw+PGxpPlVzZXIgRXhwZXJpZW5jZTwvbGk+PGxpPkludGVyYWN0aW9uPC9saT48bGk+VXNlciBJbnRlcmZhY2U8L2xpPjwvdWw+IjtzOjIyOiJjc3NfbWFpbl9tYXJnaW5fYm90dG9tIjtzOjE6IjUiO3M6MTg6ImNzc191bF9tYXJnaW5fbGVmdCI7czoxOiIwIjtzOjIzOiJjc3NfdWxfbGlfbWFyZ2luX2JvdHRvbSI7czoxOiIwIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO2k6MzY7czo3OiJwb3N0X2lkIjtzOjQ6IjE3MzUiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxNjoiRFNMQ19UZXh0X1NpbXBsZSI7fQ==[/dslc_module] [/dslc_modules_area] [/dslc_modules_section]',
        'section' => 'theme'
    );

    $dslc_var_templates['ballista-contact-page'] = array(
        'title' => __('Contact Page Default', 'ballista'),
        'id' => 'ballista-contact-page',
        'code' => '[dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="0" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo2OntzOjc6ImNvbnRlbnQiO3M6MjU6IjxoMj5EUk9QIFVTIEFOIEVNQUlMPC9oMj4iO3M6MTY6ImNzc19oMl9mb250X3NpemUiO3M6MjoiMTQiO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czoyOiI4NiI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3NzQiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxNjoiRFNMQ19UZXh0X1NpbXBsZSI7fQ==[/dslc_module] [dslc_module]YTo3OntzOjc6ImNvbnRlbnQiO3M6MTQ0OiI8cD5XZSBhcmUgYSBzbWFsbCwgbmltYmxlIHRlYW0gb2YgV29yZHByZXNzIHdhcnJpb3JzIHdpdGggYSByZWFsIHBhc3Npb24gdG8gZGVsaXZlciBzaW1wbGUgeWV0IGVmZmVjdGl2ZSB0aGVtZXMgZm9yIGEgYnJvYWQgcmFuZ2Ugb2YgbmljaGVzLjwvcD4iO3M6MTg6ImNzc19tYWluX2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoyMDoiY3NzX21haW5fZm9udF9mYW1pbHkiO3M6NjoiUm9ib3RvIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MjoiODciO3M6NzoicG9zdF9pZCI7czo0OiIxNzc0IjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="0" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo0OntzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO2k6OTI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3NzQiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoyODoiQmFsbGlzdGFfQ29udGFjdF9Gb3JtX01vZHVsZSI7fQ==[/dslc_module] [/dslc_modules_area] [/dslc_modules_section]',
        'section' => 'theme'
    );

    $dslc_var_templates['ballista-blog-page'] = array(
        'title' => __('Blog Page Default', 'ballista'),
        'id' => 'ballista-blog-page',
        'code' => '[dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="80" padding_h="0" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo3OntzOjY6ImFtb3VudCI7czoyOiIxMCI7czoxNToicGFnaW5hdGlvbl90eXBlIjtzOjg6InByZXZuZXh0IjtzOjc6ImNvbHVtbnMiO3M6MjoiMTIiO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czozOiIxMzUiO3M6NzoicG9zdF9pZCI7czozOiI3MDMiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czo5OiJEU0xDX0Jsb2ciO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section]',
        'section' => 'theme'
    );
}
add_action( 'init', 'ballista_load_lc_templates' );


if (class_exists('DSLC_Module')) {
    /**
     * Custom Ballista Contact Form Live Composer Module
     */
    add_action( 'dslc_hook_register_modules',
        create_function( '', 'return dslc_register_module( "Ballista_Contact_Form_Module" );' )
    );

    class Ballista_Contact_Form_Module extends DSLC_Module {

        // Module Attributes
        var $module_id = 'Ballista_Contact_Form_Module';
        var $module_title = 'Ballista Contact Form';
        var $module_icon = 'circle';
        var $module_category = 'general';

        // Module Options
        function options() {

            // The options array
            $options = array(

                // A simple text input option
                array(
                    'label' => 'Text Input',
                    'id' => 'text_input',
                    'std' => 'Default value',
                    'type' => 'text',
                ),

            );

            // Return the array
            return apply_filters( 'dslc_module_options', $options, $this->module_id );

        }

        // Module Output
        function output( $options ) {

            // REQUIRED
            $this->module_start( $options );

            // Your content
            echo '<form action="' . esc_url( get_the_permalink() ) . '" method="post" id="contactform" novalidate="">
                <span class="input input--nao">
					<input class="input__field input__field--nao" type="text" id="author">
					<label class="input__label input__label--nao" for="author">
                        <span class="input__label-content input__label-content--nao">' . __( 'Your name:', 'ballista' ) . '</span>
                    </label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
                        <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"></path>
                    </svg>
				</span>
				<span class="input input--nao">
					<input class="input__field input__field--nao" type="text" id="email">
					<label class="input__label input__label--nao" for="email">
                        <span class="input__label-content input__label-content--nao">' . __( 'Your email:', 'ballista' ) . '</span>
                    </label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
                        <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"></path>
                    </svg>
				</span>
				<span class="input input--nao">
					<input class="input__field input__field--nao" type="text" id="contactmessage">
					<label class="input__label input__label--nao" for="contactmessage">
                        <span class="input__label-content input__label-content--nao">' . __( 'Your message', 'ballista' ) . '</span>
                    </label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
                        <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"></path>
                    </svg>
				</span>

				<div class="form-group contact-form-human">
					<label for="human">' . __( 'Human verification:', 'woc_broadsword' ) . '</label>
					<input id="human" name="human" type="text" class="form-control" required value=""><span> + 3 = 5</span>
				</div>

                <p class="form-submit">
                    <input name="form_submit" type="submit" id="form_submit" value="' . __( 'Send', 'ballista' ) . '">
                </p>
            </form>';

            // REQUIRED
            $this->module_end( $options );

        }

    }
}

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Custom Post Types
 */
require_once get_template_directory() . '/inc/post-types/CPT.php';

/**
 * Portfolio Custom Post Type
 */
require_once get_template_directory() . '/inc/post-types/register-case-study.php';
