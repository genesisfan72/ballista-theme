<?php

$case_study = new CPT( array(
    'post_type_name' => 'case_study',
    'singular' => __( 'Case Study', 'ballista' ),
    'plural' => __( 'Case Studies', 'ballista' ),
    'slug' => 'case-study'
),
    array(
        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments' ),
        'menu_icon' => 'dashicons-portfolio'
    ) );

$case_study->register_taxonomy( array(
    'taxonomy_name' => 'case_study_tags',
    'singular' => __( 'Case Study Tag', 'ballista' ),
    'plural' => __( 'Case Studies Tags', 'ballista' ),
    'slug' => 'case-study-tag'
) );