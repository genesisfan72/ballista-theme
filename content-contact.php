<?php
/**
 * The template used for displaying the contact page content.
 *
 * @package Ballista
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <div class="contact__form">
            <?php global $response; ?>
            <?php echo $response; ?>

            <?php the_content(); ?>

            <?php /*

            <form action="<?php esc_url( the_permalink() ); ?>" method="post" id="contactform" novalidate="">
                <span class="input input--nao">
					<input class="input__field input__field--nao" type="text" id="author">
					<label class="input__label input__label--nao" for="author">
                        <span class="input__label-content input__label-content--nao"><?php echo __( 'Your name:' , 'ballista' ); ?></span>
                    </label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
                        <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"></path>
                    </svg>
				</span>
				<span class="input input--nao">
					<input class="input__field input__field--nao" type="text" id="email">
					<label class="input__label input__label--nao" for="email">
                        <span class="input__label-content input__label-content--nao"><?php echo __( 'Your email:' , 'ballista' ); ?></span>
                    </label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
                        <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"></path>
                    </svg>
				</span>
				<span class="input input--nao">
					<input class="input__field input__field--nao" type="text" id="contactmessage">
					<label class="input__label input__label--nao" for="contactmessage">
                        <span class="input__label-content input__label-content--nao"><?php echo __( 'Your message' , 'ballista' ); ?></span>
                    </label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
                        <path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"></path>
                    </svg>
				</span>

                <p class="form-submit">
                    <input name="form_submit" type="submit" id="form_submit" value="<?php echo __( 'Send' , 'ballista' ); ?>">
                </p>
            </form>

 */ ?>
        </div>
    </div><!-- .entry-content -->

</article><!-- #post-## -->
