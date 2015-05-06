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
            'name' => 'Wordpress Retina 2x',
            'slug' => 'wp-retina-2x',
            'required' => true,
        ),
        array(
            'name' => 'I Recommend This',
            'slug' => 'i-recommend-this',
            'required' => true,
        ),
        array(
            'name' => 'Responsive Lightbox',
            'slug' => 'responsive-lightbox',
            'required' => false,
        ),
        array(
            'name' => 'Intuitive Custom Post Order',
            'slug' => 'intuitive-custom-post-order',
            'required' => false
        ),
        array(
            'name' => 'Logo Slider',
            'slug' => 'logo-slider',
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

/**
 * Custom padding shortcode
 * @param $atts
 * @param null $content
 * @return string
 */
function ballista_padding( $atts, $content = null ) {
    extract( shortcode_atts( array( 'left' => 0, 'right' => 0, 'top' => 0, 'bottom' => 0 ), $atts ) );
    return '<div style="padding: ' . $top . 'px ' . $right . 'px ' . $bottom . 'px ' . $left . 'px">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'bPadding', 'ballista_padding' );

/**
 * Custom columns shortcode
 * @param $atts
 * @param null $content
 * @return string
 */
function ballista_columns( $atts, $content = null ) {
    extract( shortcode_atts( array( 'cols' => 1, 'gap' => 20 ), $atts ) );
    return '<div style="-webkit-column-count: ' . $cols . ';
  -moz-column-count: ' . $cols . ';
  column-count: ' . $cols . ';
  -webkit-column-gap: ' . $gap . 'px;
  -moz-column-gap: ' . $gap . 'px;
  column-gap: ' . $gap . 'px;">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'bColumns', 'ballista_columns' );


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
