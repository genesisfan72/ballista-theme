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

if ( !function_exists( 'ballista_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function ballista_setup()
    {

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
function ballista_widgets_init()
{
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
function ballista_scripts()
{
    wp_enqueue_style( 'ballista-style', get_stylesheet_uri() );

    wp_enqueue_style( 'ballista', get_template_directory_uri() . '/assets/css/ballista.css' );

    wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );

    wp_enqueue_script( 'ballista-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20120206', true );

    wp_enqueue_script( 'ballista-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20130115', true );

    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.custom.js', array(), '20130115', true );

    wp_enqueue_script( 'classie', get_template_directory_uri() . '/assets/js/classie.js', array(), '20130115', true );

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
function ballista_change_avatar_css( $class )
{
    $class = str_replace( "class='avatar", "class='meta__avatar ", $class );
    return $class;
}

/**
 * Find the first image in post content. Used for portfolio layouts.
 * @return string
 */
function ballista_first_image()
{
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
function ballista_new_excerpt_more( $more )
{
    return '[...]<br/><a class="post__link" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'ballista') . '</a>';
}

add_filter( 'excerpt_more', 'ballista_new_excerpt_more' );


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
