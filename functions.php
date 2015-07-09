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
            'source' => get_stylesheet_directory() . '/assets/plugins/livecomposer/ds-live-composer.zip',
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

    $tpl[ 'case_study' ] = __( 'Case Studies', 'ballista' );

    return $tpl;

}

add_filter( 'dslc_post_templates_post_types', 'ballista_register_cpt_post_templates' );


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

    $dslc_var_templates[ 'ballista-about-page' ] = array(
        'title' => __( 'About Page Default', 'ballista' ),
        'id' => 'ballista-about-page',
        'code' => '[dslc_modules_section show_on="desktop tablet phone " type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="41" padding="0" padding_h="10" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo2OntzOjE2OiJjc3NfYm9yZGVyX2NvbG9yIjtzOjExOiJ0cmFuc3BhcmVudCI7czo2OiJoZWlnaHQiO3M6MjoiMjQiO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czozOiIxNDAiO3M6NzoicG9zdF9pZCI7czo0OiIxNzUzIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTQ6IkRTTENfU2VwYXJhdG9yIjt9[/dslc_module] [dslc_module]YTo3OntzOjE1OiJjc3NfZm9udF93ZWlnaHQiO3M6MzoiNjAwIjtzOjE1OiJjc3NfZm9udF9mYW1pbHkiO3M6MTE6IlJvYm90byBTbGFiIjtzOjE4OiJjc3NfdGV4dF90cmFuc2Zvcm0iO3M6OToidXBwZXJjYXNlIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MzoiMTM5IjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MyI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjEzOiJEU0xDX1RQX1RpdGxlIjt9[/dslc_module] [dslc_module]YToxMTp7czo3OiJjb250ZW50IjtzOjI3OiJISSwgV0UgQVJFIFdBUlJJT1JTIE9GIENPREUiO3M6MTQ6ImNzc19tYWluX2NvbG9yIjtzOjE1OiJyZ2IoNTEsIDUxLCA1MSkiO3M6MTg6ImNzc19tYWluX2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoyMDoiY3NzX21haW5fZm9udF9mYW1pbHkiO3M6NjoiUm9ib3RvIjtzOjEyOiJjc3NfaDJfY29sb3IiO3M6MTU6InJnYig1MSwgNTEsIDUxKSI7czoxNjoiY3NzX2gyX2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoxODoiY3NzX2gyX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6IjMwIjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MyI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjE2OiJEU0xDX1RleHRfU2ltcGxlIjt9[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="yes" size="6"] [dslc_module]YTo4OntzOjc6ImNvbnRlbnQiO3M6MzkwOiI8cD5JXCdtIGEgU3BhbGRpbmcgR3JheSBpbiBhIFJpY2sgRGVlcyB3b3JsZC4gRmFjdHMgYXJlIG1lYW5pbmdsZXNzLiBZb3UgY291bGQgdXNlIGZhY3RzIHRvIHByb3ZlIGFueXRoaW5nIHRoYXRcJ3MgZXZlbiByZW1vdGVseSB0cnVlISBXaGF0XCdzIHRoZSBwb2ludCBvZiBnb2luZyBvdXQ/IFdlXCdyZSBqdXN0IGdvaW5nIHRvIHdpbmQgdXAgYmFjayBoZXJlIGFueXdheS4gSSBjYW5cJ3QgZ28gdG8ganV2aWUuIFRoZXkgdXNlIGd1eXMgbGlrZSBtZSBhcyBjdXJyZW5jeS4gU2xvdyBkb3duLCBCYXJ0ISBNeSBsZWdzIGRvblwndCBrbm93IGhvdyB0byBiZSBhcyBsb25nIGFzIHlvdXJzLiBBYWFoISBOYXR1cmFsIGxpZ2h0ISBHZXQgaXQgb2ZmIG1lISBHZXQgaXQgb2ZmIG1lITwvcD4iO3M6MTQ6ImNzc19tYWluX2NvbG9yIjtzOjE4OiJyZ2IoMTM2LCAxMzYsIDEzNikiO3M6MTg6ImNzc19tYWluX2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoyMDoiY3NzX21haW5fZm9udF9mYW1pbHkiO3M6NjoiUm9ib3RvIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MjoiMzEiO3M6NzoicG9zdF9pZCI7czo0OiIxNzUzIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="yes" first="no" size="6"] [dslc_module]YTo4OntzOjc6ImNvbnRlbnQiO3M6MzkwOiI8cD5JXCdtIGEgU3BhbGRpbmcgR3JheSBpbiBhIFJpY2sgRGVlcyB3b3JsZC4gRmFjdHMgYXJlIG1lYW5pbmdsZXNzLiBZb3UgY291bGQgdXNlIGZhY3RzIHRvIHByb3ZlIGFueXRoaW5nIHRoYXRcJ3MgZXZlbiByZW1vdGVseSB0cnVlISBXaGF0XCdzIHRoZSBwb2ludCBvZiBnb2luZyBvdXQ/IFdlXCdyZSBqdXN0IGdvaW5nIHRvIHdpbmQgdXAgYmFjayBoZXJlIGFueXdheS4gSSBjYW5cJ3QgZ28gdG8ganV2aWUuIFRoZXkgdXNlIGd1eXMgbGlrZSBtZSBhcyBjdXJyZW5jeS4gU2xvdyBkb3duLCBCYXJ0ISBNeSBsZWdzIGRvblwndCBrbm93IGhvdyB0byBiZSBhcyBsb25nIGFzIHlvdXJzLiBBYWFoISBOYXR1cmFsIGxpZ2h0ISBHZXQgaXQgb2ZmIG1lISBHZXQgaXQgb2ZmIG1lITwvcD4iO3M6MTQ6ImNzc19tYWluX2NvbG9yIjtzOjE4OiJyZ2IoMTM2LCAxMzYsIDEzNikiO3M6MTg6ImNzc19tYWluX2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoyMDoiY3NzX21haW5fZm9udF9mYW1pbHkiO3M6NjoiUm9ib3RvIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MjoiNjYiO3M6NzoicG9zdF9pZCI7czo0OiIxNzUzIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="96" padding="0" padding_h="10" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YToxMDp7czo3OiJjb250ZW50IjtzOjQwOiI8aDIgY2xhc3M9XCJ1bmRlcmxpbmVcIj5GZWF0dXJlZCBJbjwvaDI+IjtzOjE3OiJjc3NfbWFyZ2luX2JvdHRvbSI7czoyOiIzMCI7czoxODoiY3NzX2gyX2JvcmRlcl90cmJsIjtzOjA6IiI7czoxNjoiY3NzX2gyX2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxODoiY3NzX2gyX2ZvbnRfd2VpZ2h0IjtzOjM6IjYwMCI7czoxODoiY3NzX2gyX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6IjQ4IjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MyI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjE2OiJEU0xDX1RleHRfU2ltcGxlIjt9[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="yes" size="2"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjQ6IjE2OTEiO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czoyOiI1MSI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3NTMiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxMDoiRFNMQ19JbWFnZSI7fQ==[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="no" size="2"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjM6Ijc2NSI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6IjUyIjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MyI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjEwOiJEU0xDX0ltYWdlIjt9[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="no" size="2"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjM6Ijc2MSI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6IjUzIjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MyI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjEwOiJEU0xDX0ltYWdlIjt9[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="no" size="2"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjM6Ijc1NCI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6IjU0IjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MyI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjEwOiJEU0xDX0ltYWdlIjt9[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="no" size="2"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjQ6IjEwNDUiO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czoyOiI1MCI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3NTMiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxMDoiRFNMQ19JbWFnZSI7fQ==[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="10" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YToxMDp7czo3OiJjb250ZW50IjtzOjM3OiI8aDIgY2xhc3M9XCJ1bmRlcmxpbmVcIj5TZXJ2aWNlczwvaDI+IjtzOjE3OiJjc3NfbWFyZ2luX2JvdHRvbSI7czoyOiIzMCI7czoxODoiY3NzX2gyX2JvcmRlcl90cmJsIjtzOjA6IiI7czoxNjoiY3NzX2gyX2ZvbnRfc2l6ZSI7czoyOiIxNiI7czoxODoiY3NzX2gyX2ZvbnRfd2VpZ2h0IjtzOjM6IjYwMCI7czoxODoiY3NzX2gyX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6IjQ2IjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MyI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjE2OiJEU0xDX1RleHRfU2ltcGxlIjt9[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="10" custom_class="" custom_id="" ] [dslc_modules_area last="no" first="yes" size="2"] [dslc_module]YTo5OntzOjc6ImNvbnRlbnQiO3M6NjoiREVTSUdOIjtzOjE3OiJjc3NfbWFyZ2luX2JvdHRvbSI7czoxOiI1IjtzOjE0OiJjc3NfbWFpbl9jb2xvciI7czoxNToicmdiKDUxLCA1MSwgNTEpIjtzOjE4OiJjc3NfbWFpbl9mb250X3NpemUiO3M6MjoiMTQiO3M6MjA6ImNzc19tYWluX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6IjU1IjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MyI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjE2OiJEU0xDX1RleHRfU2ltcGxlIjt9[/dslc_module] [dslc_module]YToxNTp7czo3OiJjb250ZW50IjtzOjc2OiI8dWw+PGxpPlVzZXIgRXhwZXJpZW5jZTwvbGk+PGxpPkludGVyYWN0aW9uPC9saT48bGk+VXNlciBJbnRlcmZhY2U8L2xpPjwvdWw+IjtzOjE0OiJjc3NfbWFpbl9jb2xvciI7czoxODoicmdiKDEzNiwgMTM2LCAxMzYpIjtzOjE4OiJjc3NfbWFpbl9mb250X3NpemUiO3M6MjoiMTQiO3M6MjA6ImNzc19tYWluX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoyMjoiY3NzX21haW5fbWFyZ2luX2JvdHRvbSI7czoxOiI1IjtzOjEyOiJjc3NfbGlfY29sb3IiO3M6MTg6InJnYigxMzYsIDEzNiwgMTM2KSI7czoxNjoiY3NzX2xpX2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoxODoiY3NzX2xpX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoxODoiY3NzX3VsX21hcmdpbl9sZWZ0IjtzOjE6IjAiO3M6MTI6ImNzc191bF9zdHlsZSI7czo0OiJub25lIjtzOjIzOiJjc3NfdWxfbGlfbWFyZ2luX2JvdHRvbSI7czoxOiIwIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MjoiMzMiO3M6NzoicG9zdF9pZCI7czo0OiIxNzUzIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="no" size="2"] [dslc_module]YTo5OntzOjc6ImNvbnRlbnQiO3M6MTE6IkRFVkVMT1BNRU5UIjtzOjE3OiJjc3NfbWFyZ2luX2JvdHRvbSI7czoxOiI1IjtzOjE0OiJjc3NfbWFpbl9jb2xvciI7czoxNToicmdiKDUxLCA1MSwgNTEpIjtzOjE4OiJjc3NfbWFpbl9mb250X3NpemUiO3M6MjoiMTQiO3M6MjA6ImNzc19tYWluX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6IjY3IjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MyI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjE2OiJEU0xDX1RleHRfU2ltcGxlIjt9[/dslc_module] [dslc_module]YToxNTp7czo3OiJjb250ZW50IjtzOjc2OiI8dWw+PGxpPlVzZXIgRXhwZXJpZW5jZTwvbGk+PGxpPkludGVyYWN0aW9uPC9saT48bGk+VXNlciBJbnRlcmZhY2U8L2xpPjwvdWw+IjtzOjE0OiJjc3NfbWFpbl9jb2xvciI7czoxODoicmdiKDEzNiwgMTM2LCAxMzYpIjtzOjE4OiJjc3NfbWFpbl9mb250X3NpemUiO3M6MjoiMTQiO3M6MjA6ImNzc19tYWluX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoyMjoiY3NzX21haW5fbWFyZ2luX2JvdHRvbSI7czoxOiI1IjtzOjEyOiJjc3NfbGlfY29sb3IiO3M6MTg6InJnYigxMzYsIDEzNiwgMTM2KSI7czoxNjoiY3NzX2xpX2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoxODoiY3NzX2xpX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoxODoiY3NzX3VsX21hcmdpbl9sZWZ0IjtzOjE6IjAiO3M6MTI6ImNzc191bF9zdHlsZSI7czo0OiJub25lIjtzOjIzOiJjc3NfdWxfbGlfbWFyZ2luX2JvdHRvbSI7czoxOiIwIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MjoiNjgiO3M6NzoicG9zdF9pZCI7czo0OiIxNzUzIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="no" size="2"] [dslc_module]YTo5OntzOjc6ImNvbnRlbnQiO3M6MTE6IlBIT1RPR1JBUEhZIjtzOjE3OiJjc3NfbWFyZ2luX2JvdHRvbSI7czoxOiI1IjtzOjE0OiJjc3NfbWFpbl9jb2xvciI7czoxNToicmdiKDUxLCA1MSwgNTEpIjtzOjE4OiJjc3NfbWFpbl9mb250X3NpemUiO3M6MjoiMTQiO3M6MjA6ImNzc19tYWluX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6IjY5IjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MyI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjE2OiJEU0xDX1RleHRfU2ltcGxlIjt9[/dslc_module] [dslc_module]YToxNTp7czo3OiJjb250ZW50IjtzOjc2OiI8dWw+PGxpPlVzZXIgRXhwZXJpZW5jZTwvbGk+PGxpPkludGVyYWN0aW9uPC9saT48bGk+VXNlciBJbnRlcmZhY2U8L2xpPjwvdWw+IjtzOjE0OiJjc3NfbWFpbl9jb2xvciI7czoxODoicmdiKDEzNiwgMTM2LCAxMzYpIjtzOjE4OiJjc3NfbWFpbl9mb250X3NpemUiO3M6MjoiMTQiO3M6MjA6ImNzc19tYWluX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoyMjoiY3NzX21haW5fbWFyZ2luX2JvdHRvbSI7czoxOiI1IjtzOjEyOiJjc3NfbGlfY29sb3IiO3M6MTg6InJnYigxMzYsIDEzNiwgMTM2KSI7czoxNjoiY3NzX2xpX2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoxODoiY3NzX2xpX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoxODoiY3NzX3VsX21hcmdpbl9sZWZ0IjtzOjE6IjAiO3M6MTI6ImNzc191bF9zdHlsZSI7czo0OiJub25lIjtzOjIzOiJjc3NfdWxfbGlfbWFyZ2luX2JvdHRvbSI7czoxOiIwIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MjoiNzAiO3M6NzoicG9zdF9pZCI7czo0OiIxNzUzIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="no" size="2"] [dslc_module]YTo5OntzOjc6ImNvbnRlbnQiO3M6OToiTUFSS0VUSU5HIjtzOjE3OiJjc3NfbWFyZ2luX2JvdHRvbSI7czoxOiI1IjtzOjE0OiJjc3NfbWFpbl9jb2xvciI7czoxNToicmdiKDUxLCA1MSwgNTEpIjtzOjE4OiJjc3NfbWFpbl9mb250X3NpemUiO3M6MjoiMTQiO3M6MjA6ImNzc19tYWluX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6IjcxIjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MyI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjE2OiJEU0xDX1RleHRfU2ltcGxlIjt9[/dslc_module] [dslc_module]YToxNTp7czo3OiJjb250ZW50IjtzOjc2OiI8dWw+PGxpPlVzZXIgRXhwZXJpZW5jZTwvbGk+PGxpPkludGVyYWN0aW9uPC9saT48bGk+VXNlciBJbnRlcmZhY2U8L2xpPjwvdWw+IjtzOjE0OiJjc3NfbWFpbl9jb2xvciI7czoxODoicmdiKDEzNiwgMTM2LCAxMzYpIjtzOjE4OiJjc3NfbWFpbl9mb250X3NpemUiO3M6MjoiMTQiO3M6MjA6ImNzc19tYWluX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoyMjoiY3NzX21haW5fbWFyZ2luX2JvdHRvbSI7czoxOiI1IjtzOjEyOiJjc3NfbGlfY29sb3IiO3M6MTg6InJnYigxMzYsIDEzNiwgMTM2KSI7czoxNjoiY3NzX2xpX2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoxODoiY3NzX2xpX2ZvbnRfZmFtaWx5IjtzOjY6IlJvYm90byI7czoxODoiY3NzX3VsX21hcmdpbl9sZWZ0IjtzOjE6IjAiO3M6MTI6ImNzc191bF9zdHlsZSI7czo0OiJub25lIjtzOjIzOiJjc3NfdWxfbGlfbWFyZ2luX2JvdHRvbSI7czoxOiIwIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MjoiNzIiO3M6NzoicG9zdF9pZCI7czo0OiIxNzUzIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section]',
        'section' => 'theme'
    );

    $dslc_var_templates[ 'ballista-about-page-variant' ] = array(
        'title' => __( 'About Page Variant', 'ballista' ),
        'id' => 'ballista-about-page-variant',
        'code' => '[dslc_modules_section show_on="desktop tablet phone " type="full" columns_spacing="nospacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="10" custom_class="vertical-align" custom_id="" ] [dslc_modules_area last="no" first="yes" size="6"] [dslc_module]YTo5OntzOjEzOiJjc3NfZm9udF9zaXplIjtzOjI6IjI4IjtzOjE1OiJjc3NfZm9udF93ZWlnaHQiO3M6MzoiNjAwIjtzOjE1OiJjc3NfZm9udF9mYW1pbHkiO3M6MTE6IlJvYm90byBTbGFiIjtzOjE4OiJjc3NfdGV4dF90cmFuc2Zvcm0iO3M6OToidXBwZXJjYXNlIjtzOjg6ImNzc19hbmltIjtzOjEwOiJkc2xjRmFkZUluIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MzoiMTAyIjtzOjc6InBvc3RfaWQiO3M6NDoiMTc2MSI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjEzOiJEU0xDX1RQX1RpdGxlIjt9[/dslc_module] [dslc_module]YTo3OntzOjc6ImNvbnRlbnQiO3M6MzQ6IjxwPkhJLCBXRSBBUkUgV0FSUklPUlMgT0YgQ09ERTwvcD4iO3M6MTQ6ImNzc19tYWluX2NvbG9yIjtzOjE1OiJyZ2IoNTEsIDUxLCA1MSkiO3M6ODoiY3NzX2FuaW0iO3M6MTA6ImRzbGNGYWRlSW4iO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czozOiIxMDUiO3M6NzoicG9zdF9pZCI7czo0OiIxNzYxIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [dslc_module]YTo5OntzOjc6ImNvbnRlbnQiO3M6MjU1OiI8cCBjbGFzcz1cInByLTNcIj5JXCdtIGEgU3BhbGRpbmcgR3JheSBpbiBhIFJpY2sgRGVlcyB3b3JsZC4gRmFjdHMgYXJlIG1lYW5pbmdsZXNzLiBZb3UgY291bGQgdXNlIGZhY3RzIHRvIHByb3ZlIGFueXRoaW5nIHRoYXRcJ3MgZXZlbiByZW1vdGVseSB0cnVlISBXaGF0XCdzIHRoZSBwb2ludCBvZiBnb2luZyBvdXQ/IFdlXCdyZSBqdXN0IGdvaW5nIHRvIHdpbmQgdXAgYmFjayBoZXJlIGFueXdheS4gSSBjYW5cJ3QgZ28gdG8ganV2aWUuIDwvcD4iO3M6MTQ6ImNzc19tYWluX2NvbG9yIjtzOjE4OiJyZ2IoMTM2LCAxMzYsIDEzNikiO3M6MTg6ImNzc19tYWluX2ZvbnRfc2l6ZSI7czoyOiIxNCI7czoyMDoiY3NzX21haW5fZm9udF9mYW1pbHkiO3M6NjoiUm9ib3RvIjtzOjg6ImNzc19hbmltIjtzOjEwOiJkc2xjRmFkZUluIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MjoiODMiO3M6NzoicG9zdF9pZCI7czo0OiIxNzYxIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="yes" first="no" size="6"] [dslc_module]YTo2OntzOjU6ImltYWdlIjtzOjM6Ijc2MSI7czo4OiJjc3NfYW5pbSI7czoxMDoiZHNsY0ZhZGVJbiI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjM6IjEwNiI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3NjEiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxMDoiRFNMQ19JbWFnZSI7fQ==[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone " type="full" columns_spacing="nospacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="10" custom_class="" custom_id="" ] [dslc_modules_area last="no" first="yes" size="6"] [dslc_module]YTo2OntzOjU6ImltYWdlIjtzOjM6Ijc1NiI7czo4OiJjc3NfYW5pbSI7czoxMDoiZHNsY0ZhZGVJbiI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjM6IjEzMSI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3NjEiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxMDoiRFNMQ19JbWFnZSI7fQ==[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="yes" first="no" size="6"] [dslc_module]YToxMTp7czo3OiJjb250ZW50IjtzOjk0OiI8ZGl2IGNsYXNzPVwicmVsYXRpdmUgbWwtMyBtdC0zXCI+CjxoMiBjbGFzcz1cIiB1bmRlcmxpbmVcIiA9XCJcIj1cIlwiPkZlYXR1cmVkIEluCjwvaDI+PC9kaXY+IjtzOjE4OiJjc3NfaDJfYm9yZGVyX3RyYmwiO3M6MDoiIjtzOjE2OiJjc3NfaDJfZm9udF9zaXplIjtzOjI6IjE2IjtzOjE4OiJjc3NfaDJfZm9udF93ZWlnaHQiO3M6MzoiNjAwIjtzOjE4OiJjc3NfaDJfZm9udF9mYW1pbHkiO3M6NjoiUm9ib3RvIjtzOjg6ImNzc19hbmltIjtzOjEwOiJkc2xjRmFkZUluIjtzOjE1OiJjc3NfbG9hZF9wcmVzZXQiO3M6MTI6ImgyLXVuZGVybGluZSI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjM6IjE0MSI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3NjEiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxNjoiRFNMQ19UZXh0X1NpbXBsZSI7fQ==[/dslc_module] [dslc_module]YTo0OntzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MzoiMTM4IjtzOjc6InBvc3RfaWQiO3M6NDoiMTc2MSI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjI3OiJCYWxsaXN0YV9GZWF0dXJlZF9Jbl9Nb2R1bGUiO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone " type="full" columns_spacing="nospacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="10" custom_class="vertical-align" custom_id="" ] [dslc_modules_area last="no" first="yes" size="6"] [dslc_module]YTo2OntzOjE2OiJjc3NfYm9yZGVyX2NvbG9yIjtzOjExOiJ0cmFuc3BhcmVudCI7czo2OiJoZWlnaHQiO3M6MjoiNDQiO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czozOiIxNjAiO3M6NzoicG9zdF9pZCI7czo0OiIxNzYxIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTQ6IkRTTENfU2VwYXJhdG9yIjt9[/dslc_module] [dslc_module]YToxMTp7czo3OiJjb250ZW50IjtzOjM3OiI8aDIgY2xhc3M9XCJ1bmRlcmxpbmVcIj5TZXJ2aWNlczwvaDI+IjtzOjE4OiJjc3NfaDJfYm9yZGVyX3RyYmwiO3M6MDoiIjtzOjE2OiJjc3NfaDJfZm9udF9zaXplIjtzOjI6IjE2IjtzOjE4OiJjc3NfaDJfZm9udF93ZWlnaHQiO3M6MzoiNjAwIjtzOjE4OiJjc3NfaDJfZm9udF9mYW1pbHkiO3M6NjoiUm9ib3RvIjtzOjg6ImNzc19hbmltIjtzOjEwOiJkc2xjRmFkZUluIjtzOjE1OiJjc3NfbG9hZF9wcmVzZXQiO3M6MTI6ImgyLXVuZGVybGluZSI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjM6IjE1NyI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3NjEiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxNjoiRFNMQ19UZXh0X1NpbXBsZSI7fQ==[/dslc_module] [dslc_module]YTo2OntzOjc6ImNvbnRlbnQiO3M6NTM3OiI8ZGl2IGNsYXNzPVwiZHNsYy00LWNvbCBkc2xjLWNvbFwiPgo8ZGl2IGNsYXNzPVwicm9ib3RvIGRhcmsgYm9sZFwiPkRFU0lHTjwvZGl2Pgo8dWwgY2xhc3M9XCJ1bC1saXN0LW5vbmVcIj48bGk+VXNlciBFeHBlcmllbmNlPC9saT48bGk+SW50ZXJhY3Rpb248L2xpPjxsaT5Vc2VyIEludGVyZmFjZTwvbGk+PC91bD4KPC9kaXY+Cgo8ZGl2IGNsYXNzPVwiZHNsYy00LWNvbCBkc2xjLWNvbFwiPgo8ZGl2IGNsYXNzPVwicm9ib3RvIGRhcmsgYm9sZFwiPkRFVkVMT1BNRU5UPC9kaXY+Cjx1bCBjbGFzcz1cInVsLWxpc3Qtbm9uZVwiPjxsaT5IVE1MNTwvbGk+PGxpPkNTUzM8L2xpPjxsaT5KYXZhU2NyaXB0PC9saT48L3VsPgo8L2Rpdj4KCjxkaXYgY2xhc3M9XCJkc2xjLTQtY29sIGRzbGMtY29sXCI+CjxkaXYgY2xhc3M9XCJyb2JvdG8gZGFyayBib2xkXCI+UEhPVE9HUkFQSFk8L2Rpdj4KPHVsIGNsYXNzPVwidWwtbGlzdC1ub25lXCI+PGxpPkNhbXBhaWduPC9saT48bGk+UG9ydHJhaXRzPC9saT48bGk+RXZlbnRzPC9saT48L3VsPgo8L2Rpdj4iO3M6ODoiY3NzX2FuaW0iO3M6MTA6ImRzbGNGYWRlSW4iO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czozOiIxNTkiO3M6NzoicG9zdF9pZCI7czo0OiIxNzYxIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="yes" first="no" size="6"] [dslc_module]YTo2OntzOjU6ImltYWdlIjtzOjM6Ijc1NCI7czo4OiJjc3NfYW5pbSI7czoxMDoiZHNsY0ZhZGVJbiI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjM6IjE1MiI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3NjEiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxMDoiRFNMQ19JbWFnZSI7fQ==[/dslc_module] [/dslc_modules_area] [/dslc_modules_section]',
        'section' => 'theme'
    );

    $dslc_var_templates[ 'ballista-contact-page' ] = array(
        'title' => __( 'Contact Page Default', 'ballista' ),
        'id' => 'ballista-contact-page',
        'code' => '[dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="0" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo2OntzOjc6ImNvbnRlbnQiO3M6MjU6IjxoMj5EUk9QIFVTIEFOIEVNQUlMPC9oMj4iO3M6MTY6ImNzc19oMl9mb250X3NpemUiO3M6MjoiMTQiO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7aToxO3M6NzoicG9zdF9pZCI7czo0OiIxOTAxIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="0" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo0OntzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO2k6MjtzOjc6InBvc3RfaWQiO3M6NDoiMTkwMSI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjE1OiJEU0xDX1RQX0NvbnRlbnQiO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] ',
        'section' => 'theme'
    );

    $dslc_var_templates[ 'ballista-blog-page' ] = array(
        'title' => __( 'Blog Page Default', 'ballista' ),
        'id' => 'ballista-blog-page',
        'code' => '[dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="80" padding_h="0" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo3OntzOjY6ImFtb3VudCI7czoyOiIxMCI7czoxNToicGFnaW5hdGlvbl90eXBlIjtzOjg6InByZXZuZXh0IjtzOjc6ImNvbHVtbnMiO3M6MjoiMTIiO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czozOiIxMzUiO3M6NzoicG9zdF9pZCI7czozOiI3MDMiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czo5OiJEU0xDX0Jsb2ciO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section]',
        'section' => 'theme'
    );
}

add_action( 'init', 'ballista_load_lc_templates' );


if ( class_exists( 'DSLC_Module' ) ) {
    /**
     * Custom Ballista 'Featured In' Live Composer Module
     */
    add_action( 'dslc_hook_register_modules',
        create_function( '', 'return dslc_register_module( "Ballista_Featured_In_Module" );' )
    );

    class Ballista_Featured_In_Module extends DSLC_Module {

        // Module Attributes
        var $module_id = 'Ballista_Featured_In_Module';
        var $module_title = 'Ballista Featured In Grid';
        var $module_icon = 'square';
        var $module_category = 'general';

        // Module Options
        function options() {

            // The options array
            $options = array(

                // A simple text input option
                array(
                    'label' => __( 'First Image' ),
                    'id' => 'first_image',
                    'std' => '',
                    'type' => 'image',
                    'affect_on_change_el' => '.first-grid-image',
                    'affect_on_change_rule' => 'url'
                ),

                array(
                    'label' => __( 'Second Image' ),
                    'id' => 'second_image',
                    'std' => '',
                    'type' => 'image',
                    'affect_on_change_el' => '.second-grid-image',
                    'affect_on_change_rule' => 'url'
                ),

                array(
                    'label' => __( 'Third Image' ),
                    'id' => 'third_image',
                    'std' => '',
                    'type' => 'image',
                    'affect_on_change_el' => '.third-grid-image',
                    'affect_on_change_rule' => 'url'
                ),

                array(
                    'label' => __( 'Fourth Image' ),
                    'id' => 'fourth_image',
                    'std' => '',
                    'type' => 'image',
                    'affect_on_change_el' => '.fourth-grid-image',
                    'affect_on_change_rule' => 'url'
                )

            );

            // Return the array
            return apply_filters( 'dslc_module_options', $options, $this->module_id );

        }

        // Module Output
        function output( $options ) {

            // REQUIRED
            $this->module_start( $options );

            // Your content
            echo
                '<div class="flex-grid flex-display flex-wrap">' .
                '<div class="grid-item flex-display flex-centered"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Intel-logo.svg/2000px-Intel-logo.svg.png" /></div>' .
                '<div class="grid-item flex-display flex-centered"><img src="http://cdn.pastemagazine.com/www/articles/skype-logo-feb_2012_rgb_500.png" /></div>' .
                '<div class="grid-item flex-display flex-centered"><img src="http://www.vectortemplates.com/raster/batman-logo-big.gif" /></div>' .
                '<div class="grid-item flex-display flex-centered"><img src="http://www.vikan.com/media/134081/vikan_logo_simplified_panto_farver.jpg" /></div>' .
                '</div>';

            // REQUIRED
            $this->module_end( $options );

        }

    }
}

if ( class_exists( 'DSLC_Module' ) ) {
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
