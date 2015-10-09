<?php
/**
 * The template used for displaying the blog header section
 *
 * @package Ballista
 */
?>

<?php
$post_categories = wp_get_post_categories( get_the_ID() );
$cats = array();

foreach ( $post_categories as $c ) {
    $cat = get_category( $c );
    $cats[ ] = array( 'name' => $cat->name, 'slug' => $cat->slug, 'id' => $cat->cat_ID );
}
?>

<header class="entry-header">
    <div class="excerpt-categories">
        <?php
        $cat_string = '';
        $count = count( $cats );
        for ( $i = 0; $i < $count; $i++ ) {
            $category_link = get_category_link( $cats[ $i ][ 'id' ] );

            $cat_string .= '<a href="' . esc_url( $category_link ) . '">';
            $cat_string .= esc_html( __( $cats[ $i ][ 'name' ], 'ballista' ) );
            $cat_string .= '</a>';

            if ( $i < ( $count - 1 ) ) {
                $cat_string .= ', ';
            }
        }

        echo $cat_string;
        ?>
    </div>

    <a href="<?php the_permalink(); ?>">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </a>

    <div class="excerpt-meta flex-display flex-direction-row flex-nowrap flex-centered">
        <div class="post-meta post-date"><i class="fa fa-clock-o"></i><?php the_date(); ?></div>
        <div class="post-meta post-author"><i
                class="fa fa-user"></i><?php echo __( 'Posted by', 'ballista' ); ?>  <?php the_author_posts_link(); ?>
        </div>
        <div class="post-meta num-comments"><i class="fa fa-comment"></i><?php comments_number(); ?></div>
    </div>
</header>