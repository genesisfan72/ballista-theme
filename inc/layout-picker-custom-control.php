<?php
if ( !class_exists( 'WP_Customize_Control' ) )
    return NULL;

/**
 * Class to create a custom layout control
 */
class Layout_Picker_Custom_Control extends WP_Customize_Control {

    public function render_content() {
        $imageDirectory = get_template_directory_uri() . '/assets/img/';
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <ul>
            <li style="position: relative"><img src="<?php echo $imageDirectory; ?>vertical-col-full.jpg"
                                                alt="Vertical Full BG."/><span
                    style="position: absolute; top: 29%; left: 19%"><input type="radio" name="<?php echo $this->id; ?>"
                                                                           value="blog"
                                                                           data-customize-setting-link="woc_front_page_style"/><?php echo __( 'Grid', 'ballista' ); ?></span>
            </li>
            <li style="position: relative"><img src="<?php echo $imageDirectory; ?>vertical-col-bg.jpg"
                                                alt="Vertical Column BG."/><span
                    style="position: absolute; top: 29%; left: 19%"><input type="radio" name="<?php echo $this->id; ?>"
                                                                           value="portfolio"
                                                                           data-customize-setting-link="woc_front_page_style"/><?php echo __( 'Portfolio', 'ballista' ); ?></span>
            </li>
            <li style="position: relative"><img src="<?php echo $imageDirectory; ?>horizontal-row-full.jpg"
                                                alt="Horizontal Full BG."/><span
                    style="position: absolute; top: 29%; left: 19%"><input type="radio" name="<?php echo $this->id; ?>"
                                                                           value="portfolio-full"
                                                                           data-customize-setting-link="woc_front_page_style"/><?php echo __( 'Portfolio Full', 'ballista' ); ?></span>
            </li>
            <li style="position: relative"><img src="<?php echo $imageDirectory; ?>horizontal-row-bg.jpg"
                                                alt="Horizontal Row BG."/><span
                    style="position: absolute; top: 29%; left: 19%"><input type="radio" name="<?php echo $this->id; ?>"
                                                                           value="fullpage"
                                                                           data-customize-setting-link="woc_front_page_style"/><?php echo __( 'Full Page', 'ballista' ); ?></span>
            </li>
        </ul>
    <?php
    }
}

?>