<?php
/**
 * @package Ballista
 */
?>

<?php
$post_categories = wp_get_post_categories( get_the_ID() );
$cats = array();

foreach ( $post_categories as $c ) {
    $cat = get_category( $c );
    $cats[ ] = array( 'name' => $cat->name, 'slug' => $cat->slug );
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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

        <div class="excerpt-meta flex-display flex-direction-row flex-nowrap flex-centered">
            <div class="post-meta post-date"><i class="fa fa-clock-o"></i><?php the_date(); ?></div>
            <div class="post-meta post-author"><i
                    class="fa fa-user"></i><?php echo __( 'Posted by', 'ballista' ) . ' ' . get_the_author_meta( 'display_name' ); ?>
            </div>
            <div class="post-meta num-comments"><i class="fa fa-comment"></i><?php comments_number(); ?></div>
        </div>
    </header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ballista' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
