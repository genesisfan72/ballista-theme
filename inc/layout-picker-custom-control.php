<?php
if ( !class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Class to create a custom layout control
 */
class Layout_Picker_Custom_Control extends WP_Customize_Control {

    public function render_content() {
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <ul>
            <li style="position: relative"><input type="radio" name="<?php echo $this->id; ?>"
                                                                           value="blog"
                                                                           data-customize-setting-link="woc_front_page_style"/><?php echo __( 'Grid', 'ballista' ); ?>
            </li>
            <li style="position: relative"><input type="radio" name="<?php echo $this->id; ?>"
                                                                           value="portfolio"
                                                                           data-customize-setting-link="woc_front_page_style"/><?php echo __( 'Portfolio', 'ballista' ); ?>
            </li>
            <li style="position: relative"><input type="radio" name="<?php echo $this->id; ?>"
                                                                           value="portfolio-full"
                                                                           data-customize-setting-link="woc_front_page_style"/><?php echo __( 'Portfolio Full', 'ballista' ); ?>
            </li>
            <li style="position: relative"><input type="radio" name="<?php echo $this->id; ?>"
                                                                           value="fullpage"
                                                                           data-customize-setting-link="woc_front_page_style"/><?php echo __( 'Full Page', 'ballista' ); ?>
            </li>
        </ul>
    <?php
    }
}

?>