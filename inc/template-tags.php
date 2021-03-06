<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Ballista
 */

if ( !function_exists( 'the_posts_navigation' ) ) :
    /**
     * Display navigation to next/previous set of posts when applicable.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     */
    function the_posts_navigation() {
        // Don't print empty markup if there's only one page.
        if ( $GLOBALS[ 'wp_query' ]->max_num_pages < 2 ) {
            return;
        }
        ?>
        <nav class="navigation posts-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'ballista' ); ?></h2>

            <div class="nav-links">

                <?php if ( get_next_posts_link() ) : ?>
                    <div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'ballista' ) ); ?></div>
                <?php endif; ?>

                <?php if ( get_previous_posts_link() ) : ?>
                    <div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'ballista' ) ); ?></div>
                <?php endif; ?>

            </div>
            <!-- .nav-links -->
        </nav><!-- .navigation -->
    <?php
    }
endif;

if ( !function_exists( 'the_post_navigation' ) ) :
    /**
     * Display navigation to next/previous post when applicable.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     */
    function the_post_navigation() {
        // Don't print empty markup if there's nowhere to navigate.
        $previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
        $next = get_adjacent_post( false, '', false );

        if ( !$next && !$previous ) {
            return;
        }
        ?>
        <nav class="navigation post-navigation" role="navigation">
            <h2 class="screen-reader-text"><?php _e( 'Post navigation', 'ballista' ); ?></h2>

            <div class="nav-links">
                <?php
                previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
                next_post_link( '<div class="nav-next">%link</div>', '%title' );
                ?>
            </div>
            <!-- .nav-links -->
        </nav><!-- .navigation -->
    <?php
    }
endif;

if ( !function_exists( 'ballista_post_navigation' ) ) :
    /**
     * Display navigation to next/previous post when applicable.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     */
    function ballista_post_navigation() {
        $prev_post = get_previous_post();
        $post_type = get_post_type( $prev_post );
        $prev_bg_style = "";
        $args = array( 'order' => 'ASC', 'post_type' => $post_type, 'post_status' => 'publish', 'orderby' => 'post_date', 'posts_per_page' => -1 );
        $posts_array = get_posts( $args );
        $first_post = count( $posts_array ) > 0 ? $posts_array[ 0 ] : NULL;
        $last_post = count( $posts_array ) > 0 ? $posts_array[ count( $posts_array ) - 1 ] : NULL;

        if ( empty( $prev_post ) ) {
            $prev_post = $last_post;
        }

        if ( has_post_thumbnail( $prev_post->ID ) ) {
            $prev_feat_image = wp_get_attachment_url( get_post_thumbnail_id( $prev_post->ID ) );
            $prev_bg_style = 'style="background: url(' . $prev_feat_image . ') 100% / cover"';
        }

        $next_post = get_next_post();
        $next_bg_style = "";
        if ( empty( $next_post ) ) {
            $next_post = $first_post;
        }
        if ( has_post_thumbnail( $next_post->ID ) ) {
            $next_feat_image = wp_get_attachment_url( get_post_thumbnail_id( $next_post->ID ) );
            $next_bg_style = 'style="background: url(' . $next_feat_image . ') 100% / cover"';
        }

        ?>

        <div class="post-nav relative">
            <div class="grid__item grid__item--flex text-center post-nav-block relative"
                 data-id="<?php echo esc_attr( $prev_post->ID ); ?>">
                <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="full-width">
                    <div class="quick-transition post-nav-background" <?php echo $prev_bg_style; ?>></div>
                    <div class="excerpt--box">
                        <div class="excerpt__title--row">
                            <div class="excerpt__likes">
                                <i class="fa fa-long-arrow-left"></i>
                            </div>
                            <div class="excerpt__title">
                                <?php echo $prev_post->post_title; ?>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="grid__item grid__item--flex text-center post-nav-block relative"
                 data-id="<?php echo esc_attr( $next_post->ID ); ?>">
                <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="full-width">
                    <div class="quick-transition post-nav-background" <?php echo $next_bg_style; ?>></div>
                    <div class="excerpt--box">
                        <div class="excerpt__title--row">
                            <div class="excerpt__title">
                                <?php echo $next_post->post_title; ?>
                            </div>
                            <div class="excerpt__likes">
                                <i class="fa fa-long-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    <?php
    }
endif;

if ( !function_exists( 'ballista_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function ballista_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
            _x( 'Posted on %s', 'post date', 'ballista' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
            _x( 'by %s', 'post author', 'ballista' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

    }
endif;

if ( !function_exists( 'ballista_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function ballista_entry_footer() {
        // Hide category and tag text for pages.
        if ( 'post' == get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( __( ', ', 'ballista' ) );
            if ( $categories_list && ballista_categorized_blog() ) {
                printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'ballista' ) . '</span>', $categories_list );
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', __( ', ', 'ballista' ) );
            if ( $tags_list ) {
                printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'ballista' ) . '</span>', $tags_list );
            }
        }

        if ( !is_single() && !post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link( __( 'Leave a comment', 'ballista' ), __( '1 Comment', 'ballista' ), __( '% Comments', 'ballista' ) );
            echo '</span>';
        }

        edit_post_link( __( 'Edit', 'ballista' ), '<span class="edit-link">', '</span>' );
    }
endif;

if ( !function_exists( 'the_archive_title' ) ) :
    /**
     * Shim for `the_archive_title()`.
     *
     * Display the archive title based on the queried object.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     *
     * @param string $before Optional. Content to prepend to the title. Default empty.
     * @param string $after Optional. Content to append to the title. Default empty.
     */
    function the_archive_title( $before = '', $after = '' ) {
        if ( is_category() ) {
            $title = sprintf( __( 'Category: %s', 'ballista' ), single_cat_title( '', false ) );
        } elseif ( is_tag() ) {
            $title = sprintf( __( 'Tag: %s', 'ballista' ), single_tag_title( '', false ) );
        } elseif ( is_author() ) {
            $title = sprintf( __( 'Author: %s', 'ballista' ), '<span class="vcard">' . get_the_author() . '</span>' );
        } elseif ( is_year() ) {
            $title = sprintf( __( 'Year: %s', 'ballista' ), get_the_date( _x( 'Y', 'yearly archives date format', 'ballista' ) ) );
        } elseif ( is_month() ) {
            $title = sprintf( __( 'Month: %s', 'ballista' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'ballista' ) ) );
        } elseif ( is_day() ) {
            $title = sprintf( __( 'Day: %s', 'ballista' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'ballista' ) ) );
        } elseif ( is_tax( 'post_format' ) ) {
            if ( is_tax( 'post_format', 'post-format-aside' ) ) {
                $title = _x( 'Asides', 'post format archive title', 'ballista' );
            } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
                $title = _x( 'Galleries', 'post format archive title', 'ballista' );
            } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
                $title = _x( 'Images', 'post format archive title', 'ballista' );
            } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
                $title = _x( 'Videos', 'post format archive title', 'ballista' );
            } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
                $title = _x( 'Quotes', 'post format archive title', 'ballista' );
            } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
                $title = _x( 'Links', 'post format archive title', 'ballista' );
            } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
                $title = _x( 'Statuses', 'post format archive title', 'ballista' );
            } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
                $title = _x( 'Audio', 'post format archive title', 'ballista' );
            } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
                $title = _x( 'Chats', 'post format archive title', 'ballista' );
            }
        } elseif ( is_post_type_archive() ) {
            $title = sprintf( __( 'Archives: %s', 'ballista' ), post_type_archive_title( '', false ) );
        } elseif ( is_tax() ) {
            $tax = get_taxonomy( get_queried_object()->taxonomy );
            /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
            $title = sprintf( __( '%1$s: %2$s', 'ballista' ), $tax->labels->singular_name, single_term_title( '', false ) );
        } else {
            $title = __( 'Archives', 'ballista' );
        }

        /**
         * Filter the archive title.
         *
         * @param string $title Archive title to be displayed.
         */
        $title = apply_filters( 'get_the_archive_title', $title );

        if ( !empty( $title ) ) {
            echo $before . $title . $after;
        }
    }
endif;

if ( !function_exists( 'the_archive_description' ) ) :
    /**
     * Shim for `the_archive_description()`.
     *
     * Display category, tag, or term description.
     *
     * @todo Remove this function when WordPress 4.3 is released.
     *
     * @param string $before Optional. Content to prepend to the description. Default empty.
     * @param string $after Optional. Content to append to the description. Default empty.
     */
    function the_archive_description( $before = '', $after = '' ) {
        $description = apply_filters( 'get_the_archive_description', term_description() );

        if ( !empty( $description ) ) {
            /**
             * Filter the archive description.
             *
             * @see term_description()
             *
             * @param string $description Archive description to be displayed.
             */
            echo $before . $description . $after;
        }
    }
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function ballista_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'ballista_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields' => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number' => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'ballista_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so ballista_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so ballista_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in ballista_categorized_blog.
 */
function ballista_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'ballista_categories' );
}

add_action( 'edit_category', 'ballista_category_transient_flusher' );
add_action( 'save_post', 'ballista_category_transient_flusher' );
