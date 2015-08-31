<?php
/**
 * The template part for showing the case study category filters
 *
 * @package Ballista
 */
?>

<div class="categories">
    <?php
    $customPostTaxonomies = get_object_taxonomies( get_theme_mod( 'woc_fp_source', 'post' ) );

    if ( count( $customPostTaxonomies ) > 0 ) {
        $cat_string = '<a href="#" data-filter=".grid__item" class="case-study-filter selected">' . __( 'All', 'ballista' ) . '</a>';
        foreach ( $customPostTaxonomies as $tax ) {
            $args = array(
                'orderby' => 'name',
                'show_count' => 0,
                'pad_counts' => 0,
                'hierarchical' => 1,
                'taxonomy' => $tax,
                'title_li' => ''
            );

            $categories = get_categories( $args );
            foreach ( $categories as $category ) {
                $cat_string .= '<a href="#" data-filter=".filter-' . strtolower( str_replace( " ", "-", $category->name ) ) . '" class="case-study-filter">' . $category->name . '</a>';
            }
        }

        echo $cat_string;
    }
    ?>
</div>