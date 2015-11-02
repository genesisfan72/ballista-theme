<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Ballista
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php // You can start editing here -- including this comment! ?>

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            printf( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'ballista' ),
                number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </h2>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'ballista' ); ?></h2>

                <div class="nav-links">

                    <div
                        class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'ballista' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'ballista' ) ); ?></div>

                </div>
                <!-- .nav-links -->
            </nav><!-- #comment-nav-above -->
        <?php endif; // check for comment navigation ?>

        <?php wp_list_comments(array('walker' => new comment_walker() )); ?>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'ballista' ); ?></h2>

                <div class="nav-links">

                    <div
                        class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'ballista' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'ballista' ) ); ?></div>

                </div>
                <!-- .nav-links -->
            </nav><!-- #comment-nav-below -->
        <?php endif; // check for comment navigation ?>

    <?php endif; // have_comments() ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( !comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        ?>
        <p class="no-comments"><?php _e( 'Comments are closed.', 'ballista' ); ?></p>
    <?php endif; ?>

    <?php
    $fields =  array(

        'author' =>
            '<div class="comment-form-field"><label for="author">' . __( 'Name', 'ballista' ) .
            ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
            '" size="30" /></div>',

        'email' =>
            '<div class="comment-form-field"><label for="email">' . __( 'Email', 'ballista' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
            '" size="30" /></div>',

        'url' =>
            '<div class="comment-form-field"><label for="url">' . __( 'Website', 'ballista' ) . '</label>' .
            '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
            '" size="30" /></div>',
    );
    ?>

    <?php comment_form( array( 'fields' => apply_filters( 'comment_form_default_fields', $fields ), 'comment_field' =>  '<div class="comment-form-field"><label for="comment">' . __( 'Comment', 'ballista' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>' ) ); ?>

</div><!-- #comments -->
