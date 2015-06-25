<?php
/**
 * The template used for displaying the custom Ballista sidebar
 *
 * @package Ballista
 */
?>

<button id="menu-toggle" class="menu-toggle"><span>Menu</span></button>

<div id="theSidebar" class="sidebar">
    <div class="title-area">
        <button class="close-button fa fa-fw fa-close"></button>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php if ( get_theme_mod( 'woc_logo' ) ) { ?>
                <img src="<?php echo get_theme_mod( 'woc_logo' ); ?>" alt="<?php echo get_bloginfo( 'name' ) . ' - ' . get_bloginfo( 'description' ); ?>" />
            <?php } else { ?>
                <h1><?php bloginfo( 'name' ); ?></h1>
            <?php } ?>
        </a>

        <div class="subtitle"><?php bloginfo( 'description' ); ?></div>
    </div>


    <div class="pages-nav">
        <nav>
            <?php wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_id' => 'primary-menu',
                'depth' => 1,
                'menu_class' => 'menu' ) ); ?>
        </nav>
    </div>

    <div class="site-info">
        <?php echo get_theme_mod( 'woc_copyright_text' ); ?>
    </div><!-- .site-info -->
</div>
