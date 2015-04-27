<?php
/**
 * Handles the generation of the posts loop for Ballista
 * @since 1.0
 */

// Includes
define( 'WP_USE_THEMES', false );
require_once( '../../../wp-load.php' );

// Post variables
global $post;

// TODO return on no variable
$post_id = isset( $_POST[ 'post_id' ] ) ? $_POST[ 'post_id' ] : 0;

$post = get_post( $post_id );

setup_postdata( $post );
?>


<article class="content__item">
    <?php
    $categories = array();
    foreach ( get_the_category() as $category ) {
        $categories[ ] = $category->name;
    }
    $cat_string = implode( ' / ', $categories );

    ?>
    <span class="category category--full"><?php echo esc_html( $cat_string ); ?></span>

    <h2 class="title title--full"><?php the_title(); ?></h2>

    <div class="meta meta--full">
        <?php echo get_avatar( get_the_author_meta( 'user_email' ), 40 ); ?>
        <span class="meta__author"><?php the_author(); ?></span>
        <span class="meta__date"><i class="fa fa-calendar-o"></i> 9 Apr</span>
        <span class="meta__reading-time"><i class="fa fa-clock-o"></i> 3 min read</span>
    </div>

    <?php
    // check if the post has a Post Thumbnail assigned to it.
    if ( has_post_thumbnail() ) {
        the_post_thumbnail();
    }
    the_content();

    if( function_exists('dot_irecommendthis') ) dot_irecommendthis();
    ?>

</article>

