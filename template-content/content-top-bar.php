<?php
/**
 * The template used for displaying the main top bar above the content
 *
 * @package Ballista
 */
?>

<header class="top-bar">

    <?php get_template_part( 'template-content/filter', 'categories' ); ?>

    <div class="social-icons">
        <?php get_template_part( 'template-content/links', 'social' ); ?>
    </div>
</header>
