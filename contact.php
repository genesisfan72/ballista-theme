<?php
/**
 * Template Name: Contact Page
 *
 * @package Ballista
 */

//response generation function
$response = "";

//function to generate response
function ballista_contact_form_generate_response( $type, $message ) {

    global $response;

    if ( $type === "success" ) $response = "<div class='alert alert-success'>{$message}</div>";
    else $response = "<div class='alert alert-danger'>{$message}</div>";

}

//response messages
$not_human = __( 'Human verification incorrect.', 'ballista' );
$missing_content = __( 'Please supply all information.', 'ballista' );
$email_invalid = __( 'Email Address Invalid.', 'ballista' );
$message_unsent = __( 'Message was not sent. Try Again.', 'ballista' );
$message_sent = __( 'Thanks! Your message has been sent.', 'ballista' );

//post variables
$name = $email = $message = $human = "";

//user posted variables
if ( isset( $_POST[ 'author' ] ) ) $name = sanitize_text_field( $_POST[ 'author' ] );
if ( isset( $_POST[ 'email' ] ) ) $email = sanitize_email( $_POST[ 'email' ] );
if ( isset( $_POST[ 'contactmessage' ] ) ) $message = esc_textarea( $_POST[ 'contactmessage' ] );
if ( isset( $_POST[ 'human' ] ) ) $human = sanitize_text_field( $_POST[ 'human' ] );

//php mailer variables
$to = get_option( 'admin_email' );
$subject = __( 'Someone sent a message from ', 'ballista' ) . get_bloginfo( 'name' );
$headers = 'From: ' . $email . "rn" .
    'Reply-To: ' . $email . "rn";

if ( !$human == 0 ) {
    if ( $human != 2 ) ballista_contact_form_generate_response( "error", $not_human ); //not human!
    else {
        //validate email
        if ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
            ballista_contact_form_generate_response( "error", $email_invalid );
        } else { //email is valid
            //validate presence of name and message
            if ( empty( $name ) || empty( $message ) ) {
                ballista_contact_form_generate_response( "error", $missing_content );
            } else { //ready to go!
                $sent = wp_mail( $to, $subject, strip_tags( $message ), $headers );
                if ( $sent ) ballista_contact_form_generate_response( "success", $message_sent ); //message sent!
                else ballista_contact_form_generate_response( "error", $message_unsent ); //message wasn't sent

                $name = '';
                $message = '';
            }
        }
    }
} else {
    if ( isset( $_POST[ 'submitted' ] ) ) {
        if ( $_POST[ 'submitted' ] ) ballista_contact_form_generate_response( "error", $missing_content );
    }
}

get_header(); ?>

<button id="menu-toggle" class="menu-toggle"><span>Menu</span></button>

<?php get_template_part( 'template-content/content', 'sidebar' ); ?>

<div id="theGrid" class="main">
    <section class="grid">
        <div class="grid__item__container">

            <?php while ( have_posts() ) : the_post(); ?>

                <div class="page__hero transparent quick-transition">
                    <?php
                    $left_block = get_theme_mod( 'woc_contact_page_header_left' );
                    $right_block = get_theme_mod( 'woc_contact_page_header_right' );

                    if ( $left_block != '' ) {
                        $img = '';
                        $left_fullwidth = '';
                        if ( $right_block == '' ) $left_fullwidth = 'fullwidth';
                        $img = 'style="background: url(' . esc_url( $left_block ) . ') 100% / cover"';
                        ?>
                        <div
                            class="contact__hero contact__hero--left <?php echo esc_attr( $left_fullwidth ); ?>" <?php echo $img; ?>></div>
                    <?php }

                    if ( $right_block != '' ) {
                        $right_fullwidth = '';
                        if ( $left_block == '' ) $right_fullwidth = 'fullwidth';
                        ?>
                        <div
                            class="contact__hero contact__hero--right <?php echo esc_attr( $right_fullwidth ); ?>"><?php echo $right_block; ?></div>
                    <?php } ?>
                </div>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                    </header>
                    <!-- .entry-header -->

                    <div class="entry-content">
                        <div class="contact__form">
                            <?php global $response; ?>
                            <?php echo $response; ?>

                            <?php the_content(); ?>

                            <form action="<?php echo esc_url( get_the_permalink() ); ?>" method="post" id="contactform"
                                  novalidate="">
                                <span class="input input--nao">
                                    <input class="input__field input__field--nao" type="text" name="author" id="author">
                                    <label class="input__label input__label--nao" for="author">
                                        <span
                                            class="input__label-content input__label-content--nao"><?php echo __( 'Your name:', 'ballista' ); ?></span>
                                    </label>
                                    <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                                         preserveAspectRatio="none">
                                        <path
                                            d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"></path>
                                    </svg>
                                </span>
                                <span class="input input--nao">
                                    <input class="input__field input__field--nao" type="text" name="email" id="email">
                                    <label class="input__label input__label--nao" for="email">
                                        <span
                                            class="input__label-content input__label-content--nao"><?php echo __( 'Your email:', 'ballista' ); ?></span>
                                    </label>
                                    <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                                         preserveAspectRatio="none">
                                        <path
                                            d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"></path>
                                    </svg>
                                </span>
                                <span class="input input--nao">
                                    <input class="input__field input__field--nao" type="text" name="contactmessage" id="contactmessage">
                                    <label class="input__label input__label--nao" for="contactmessage">
                                        <span
                                            class="input__label-content input__label-content--nao"><?php echo __( 'Your message', 'ballista' ); ?></span>
                                    </label>
                                    <svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60"
                                         preserveAspectRatio="none">
                                        <path
                                            d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"></path>
                                    </svg>
                                </span>

                                <div class="form-group contact-form-human">
                                    <label
                                        for="human"><?php echo __( 'Human verification:', 'ballista' ); ?></label>
                                    <input id="human" name="human" type="text" class="form-control" required
                                           value=""><span> + 3 = 5</span>
                                </div>

                                <p class="form-submit">
                                    <input name="form_submit" type="submit" id="form_submit"
                                           value="<?php echo __( 'Send', 'ballista' ); ?>">
                                </p>
                            </form>
                        </div>
                    </div>
                    <!-- .entry-content -->

                </article><!-- #post-## -->

            <?php endwhile; // end of the loop. ?>

        </div>
    </section>
</div>

<?php get_footer(); ?>
