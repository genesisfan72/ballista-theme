<?php
/**
 * The template used for displaying the blog header section
 *
 * @package Ballista
 */
?>

<?php
$img = '';
if ( has_post_thumbnail() ) {
    $thumb_id = get_post_thumbnail_id();
    $thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail-size', true );
    $thumb_url = $thumb_url_array[ 0 ];
    $img = 'style="background: url(' . esc_url( $thumb_url ) . ') 80% / cover"';
}

$post_categories = wp_get_post_categories( get_the_ID() );
$cats = array();

foreach ( $post_categories as $c ) {
    $cat = get_category( $c );
    $cats[ ] = array( 'name' => $cat->name, 'slug' => $cat->slug );
}
?>

<header class="entry-header">
    <div class="excerpt-categories">
        <?php
        $cat_string = '';
        $count = count( $cats );
        for ( $i = 0; $i < $count; $i++ ) {
            $cat_string .= esc_html( __( $cats[ $i ][ 'name' ] ) );

            if ( $i < ( $count - 1 ) ) {
                $cat_string .= ', ';
            }
        }
        echo $cat_string;
        ?>
    </div>

    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

    <div class="excerpt-meta flex-row-container flex-centered">
        <div class="post-meta post-date"><i class="fa fa-clock-o"></i><?php the_date(); ?></div>
        <div class="post-meta post-author"><i class="fa fa-user"></i><?php the_author_meta( 'display_name' ); ?>
        </div>
        <div class="post-meta num-comments"><i class="fa fa-comment"></i><?php comments_number(); ?></div>
    </div>
</header>