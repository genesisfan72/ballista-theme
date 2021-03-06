<?php
/**
 * Installing post template - Step 2
 *
 * If there are no templates show the install message,
 * if there are templates do not show step 2 again
 */
function ds_default_post_templates_step_2() {

    if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

        // If not step 3 and the "option" to proceed is set and LC is active
        if ( !isset( $_GET[ 'ds_install_lc_tpl' ] ) && get_option( 'ds_def_tpl_install' ) == 'step_2' && in_array( 'ds-live-composer/ds-live-composer.php', get_option( 'active_plugins' ) ) ) :

            // Get the amount of templates
            $count = wp_count_posts( 'dslc_templates' );

            // There are no templates
            if ( $count->publish == 0 ) {

                ?>
                <div class="update-nag">
                    <p><strong>Important:</strong> You should install the default Live Composer "post templates" that
                        come with the theme. <a
                            href="<?php echo add_query_arg( array( 'ds_install_lc_tpl' => 'install' ), get_admin_url() ); ?>">Install</a>
                    </p>
                </div>
                <?php

                // There are templates
            } else {

                // Remove the "option" to avoid rechecking
                delete_option( 'ds_def_tpl_install' );

            }

        endif;

    }

}

add_action( 'admin_notices', 'ds_default_post_templates_step_2' );


/**
 * Installing Post Templates - Step 3
 *
 * Install the templates and remove the "option" not to do checks again
 */
function ds_default_post_templates_step_3() {

    if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

        // Check if installation should proceed
        if ( isset( $_GET[ 'ds_install_lc_tpl' ] ) && $_GET[ 'ds_install_lc_tpl' ] == 'install' ) {

            // Get amount of templates
            $count = wp_count_posts( 'dslc_templates' );

            // If no templates let's add the default ones
            if ( $count->publish == 0 ) {

                ds_default_post_templates_install();

                // Remove the option ( so the step 2 does not fire again )
                delete_option( 'ds_def_tpl_install' );

                ?>
                <div class="updated">
                    <p>"Case Study templates" successfully installed.</p>
                </div>
            <?php
            }

        }

    }

}

add_action( 'admin_notices', 'ds_default_post_templates_step_3' );

function ds_default_post_templates_install() {

    if ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {

        /* Start register Templates */

        $single_post_templates = array();

        $single_post_templates[ 'case_study_default' ] = array(
            'title' => __( 'Case Study Default', 'ballista' ),
            'custom_fields' => array(
                'dslc_template_base' => 'theme',
                'dslc_template_for' => 'case_study',
                'dslc_template_type' => 'default',
                'dslc_code' => '[dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="0" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjM6Ijc1OSI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjE6IjMiO3M6NzoicG9zdF9pZCI7czo0OiIxNzM5IjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTA6IkRTTENfSW1hZ2UiO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="18" padding_h="4" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo5OntzOjk6ImNzc19jb2xvciI7czoxNToicmdiKDUxLCA1MSwgNTEpIjtzOjEzOiJjc3NfZm9udF9zaXplIjtzOjI6IjI4IjtzOjE1OiJjc3NfZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjE1OiJjc3NfZm9udF9mYW1pbHkiO3M6MTE6IlJvYm90byBTbGFiIjtzOjE4OiJjc3NfdGV4dF90cmFuc2Zvcm0iO3M6OToidXBwZXJjYXNlIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MToiNyI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3MzkiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxMzoiRFNMQ19UUF9UaXRsZSI7fQ==[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YToxMTp7czoxMToidHBfZWxlbWVudHMiO3M6OToiY2F0ZWdvcnkgIjtzOjY6Im1hcmdpbiI7czoxOiI4IjtzOjU6ImNvbG9yIjtzOjE1OiJyZ2IoNTEsIDUxLCA1MSkiO3M6OToiZm9udF9zaXplIjtzOjI6IjE0IjtzOjE1OiJjc3NfZm9udF9mYW1pbHkiO3M6NjoiUm9ib3RvIjtzOjEwOiJsaW5rX2NvbG9yIjtzOjE1OiJyZ2IoNTEsIDUxLCA1MSkiO3M6MTY6ImxpbmtfY29sb3JfaG92ZXIiO3M6MTU6InJnYig5NiwgOTAsIDkwKSI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjE6IjgiO3M6NzoicG9zdF9pZCI7czo0OiIxNzM5IjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTI6IkRTTENfVFBfTWV0YSI7fQ==[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="yes" size="6"] [dslc_module]YTo1OntzOjc6ImNvbnRlbnQiO3M6MjM5OiI8cD5Mb3JlbSBpcHN1bSBkb2xvciBzaXQgYW1ldCwgY29uc2VjdGV0dXIgYWRpcGlzaWNpbmcgZWxpdCwgc2VkIGRvIGVpdXNtb2QgdGVtcG9yIGluY2lkaWR1bnQgdXQgbGFib3JlIGV0IGRvbG9yZSBtYWduYSBhbGlxdWEuIFV0IGVuaW0gYWQgbWluaW0gdmVuaWFtLCBxdWlzIG5vc3RydWQgZXhlcmNpdGF0aW9uIHVsbGFtY28gbGFib3JpcyBuaXNpIHV0IGFsaXF1aXAgZXggZWEgY29tbW9kbyBjb25zZXF1YXQuPC9wPiI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjE6IjQiO3M6NzoicG9zdF9pZCI7czo0OiIxNzM5IjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="yes" first="no" size="6"] [dslc_module]YTo1OntzOjc6ImNvbnRlbnQiO3M6MjQ1OiI8cD5Mb3JlbSBpcHN1bSBkb2xvciBzaXQgYW1ldCwgY29uc2VjdGV0dXIgYWRpcGlzaWNpbmcgZWxpdCwgc2VkIGRvIGVpdXNtb2QgdGVtcG9yIGluY2lkaWR1bnQgdXQgbGFib3JlIGV0IGRvbG9yZSBtYWduYSBhbGlxdWEuIFV0IGVuaW0gYWQgbWluaW0gdmVuaWFtLCBxdWlzIG5vc3RydWQgZXhlcmNpdGF0aW9uIHVsbGFtY28gbGFib3JpcyBuaXNpIHV0IGFsaXF1aXAgZXggZWEgY29tbW9kbyBjb25zZXF1YXQuJm5ic3A7PC9wPiI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjE6IjYiO3M6NzoicG9zdF9pZCI7czo0OiIxNzM5IjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="0" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjM6Ijc2MSI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6IjEwIjtzOjc6InBvc3RfaWQiO3M6NDoiMTczOSI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjEwOiJEU0xDX0ltYWdlIjt9[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="0" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjM6Ijc2MCI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6IjExIjtzOjc6InBvc3RfaWQiO3M6NDoiMTczOSI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjEwOiJEU0xDX0ltYWdlIjt9[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone" type="wrapped" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="60" padding_h="0" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YToxNDp7czo3OiJjb250ZW50IjtzOjk6IlRIQU5LIFlPVSI7czoxNzoiY3NzX21hcmdpbl9ib3R0b20iO3M6MjoiMjAiO3M6MTQ6ImNzc19tYWluX2NvbG9yIjtzOjE1OiJyZ2IoNTEsIDUxLCA1MSkiO3M6MTg6ImNzc19tYWluX2ZvbnRfc2l6ZSI7czoyOiIyOCI7czoyMDoiY3NzX21haW5fZm9udF93ZWlnaHQiO3M6MzoiNjAwIjtzOjIwOiJjc3NfbWFpbl9mb250X2ZhbWlseSI7czoxMToiUm9ib3RvIFNsYWIiO3M6MTk6ImNzc19tYWluX3RleHRfYWxpZ24iO3M6NjoiY2VudGVyIjtzOjE2OiJjc3NfaDJfZm9udF9zaXplIjtzOjI6IjI4IjtzOjE4OiJjc3NfaDJfZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjE4OiJjc3NfaDJfZm9udF9mYW1pbHkiO3M6MTE6IlJvYm90byBTbGFiIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MjoiMTIiO3M6NzoicG9zdF9pZCI7czo0OiIxNzUxIjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [dslc_module]YToxMDp7czoxNDoiY3NzX3RleHRfYWxpZ24iO3M6NjoiY2VudGVyIjtzOjEyOiJjc3NfYmdfY29sb3IiO3M6MTE6InRyYW5zcGFyZW50IjtzOjE4OiJjc3NfYmdfY29sb3JfaG92ZXIiO3M6MTE6InRyYW5zcGFyZW50IjtzOjE0OiJjc3NfaWNvbl9jb2xvciI7czoxNjoicmdiKDEwNiwgOTksIDk5KSI7czoyMDoiY3NzX2ljb25fY29sb3JfaG92ZXIiO3M6MTg6InJnYigxMjYsIDExOSwgMTE5KSI7czoxODoiY3NzX2ljb25fZm9udF9zaXplIjtzOjI6IjE5IjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MjoiMTQiO3M6NzoicG9zdF9pZCI7czo0OiIxNzM5IjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTE6IkRTTENfU29jaWFsIjt9[/dslc_module] [/dslc_modules_area] [/dslc_modules_section]'
            )
        );

        $single_post_templates[ 'case_study_variant' ] = array(
            'title' => __( 'Case Study Variant', 'ballista' ),
            'custom_fields' => array(
                'dslc_template_base' => 'theme',
                'dslc_template_for' => 'case_study',
                'dslc_template_type' => 'regular',
                'dslc_code' => '[dslc_modules_section show_on="desktop tablet phone " type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="rgb(221, 221, 221)" border_width="1" border_style="solid" border="top " margin_h="0" margin_b="0" padding="18" padding_h="4" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo5OntzOjk6ImNzc19jb2xvciI7czoxNToicmdiKDUxLCA1MSwgNTEpIjtzOjEzOiJjc3NfZm9udF9zaXplIjtzOjI6IjI4IjtzOjE1OiJjc3NfZm9udF93ZWlnaHQiO3M6MzoiNzAwIjtzOjE1OiJjc3NfZm9udF9mYW1pbHkiO3M6MTE6IlJvYm90byBTbGFiIjtzOjE4OiJjc3NfdGV4dF90cmFuc2Zvcm0iO3M6OToidXBwZXJjYXNlIjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MToiNyI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3MzkiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxMzoiRFNMQ19UUF9UaXRsZSI7fQ==[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YToxMTp7czoxMToidHBfZWxlbWVudHMiO3M6OToiY2F0ZWdvcnkgIjtzOjY6Im1hcmdpbiI7czoxOiI4IjtzOjU6ImNvbG9yIjtzOjE1OiJyZ2IoNTEsIDUxLCA1MSkiO3M6OToiZm9udF9zaXplIjtzOjI6IjE0IjtzOjE1OiJjc3NfZm9udF9mYW1pbHkiO3M6NjoiUm9ib3RvIjtzOjEwOiJsaW5rX2NvbG9yIjtzOjE1OiJyZ2IoNTEsIDUxLCA1MSkiO3M6MTY6ImxpbmtfY29sb3JfaG92ZXIiO3M6MTU6InJnYig5NiwgOTAsIDkwKSI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjE6IjgiO3M6NzoicG9zdF9pZCI7czo0OiIxNzM5IjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTI6IkRTTENfVFBfTWV0YSI7fQ==[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="yes" size="6"] [dslc_module]YTo1OntzOjc6ImNvbnRlbnQiO3M6MjM5OiI8cD5Mb3JlbSBpcHN1bSBkb2xvciBzaXQgYW1ldCwgY29uc2VjdGV0dXIgYWRpcGlzaWNpbmcgZWxpdCwgc2VkIGRvIGVpdXNtb2QgdGVtcG9yIGluY2lkaWR1bnQgdXQgbGFib3JlIGV0IGRvbG9yZSBtYWduYSBhbGlxdWEuIFV0IGVuaW0gYWQgbWluaW0gdmVuaWFtLCBxdWlzIG5vc3RydWQgZXhlcmNpdGF0aW9uIHVsbGFtY28gbGFib3JpcyBuaXNpIHV0IGFsaXF1aXAgZXggZWEgY29tbW9kbyBjb25zZXF1YXQuPC9wPiI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjE6IjQiO3M6NzoicG9zdF9pZCI7czo0OiIxNzM5IjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="yes" first="no" size="6"] [dslc_module]YTo1OntzOjc6ImNvbnRlbnQiO3M6MjQ1OiI8cD5Mb3JlbSBpcHN1bSBkb2xvciBzaXQgYW1ldCwgY29uc2VjdGV0dXIgYWRpcGlzaWNpbmcgZWxpdCwgc2VkIGRvIGVpdXNtb2QgdGVtcG9yIGluY2lkaWR1bnQgdXQgbGFib3JlIGV0IGRvbG9yZSBtYWduYSBhbGlxdWEuIFV0IGVuaW0gYWQgbWluaW0gdmVuaWFtLCBxdWlzIG5vc3RydWQgZXhlcmNpdGF0aW9uIHVsbGFtY28gbGFib3JpcyBuaXNpIHV0IGFsaXF1aXAgZXggZWEgY29tbW9kbyBjb25zZXF1YXQuJm5ic3A7PC9wPiI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjE6IjYiO3M6NzoicG9zdF9pZCI7czo0OiIxNzM5IjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTY6IkRTTENfVGV4dF9TaW1wbGUiO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone" type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="20" padding="0" padding_h="0" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjM6Ijc1OSI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjE6IjMiO3M6NzoicG9zdF9pZCI7czo0OiIxNzM5IjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTA6IkRTTENfSW1hZ2UiO30=[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone " type="full" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="0" padding_h="2.5" custom_class="" custom_id="" ] [dslc_modules_area last="no" first="yes" size="6"] [dslc_module]YTo2OntzOjU6ImltYWdlIjtzOjM6Ijc3MSI7czoxNzoiY3NzX21hcmdpbl9ib3R0b20iO3M6MjoiMjAiO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czoyOiI3MyI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3NTIiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxMDoiRFNMQ19JbWFnZSI7fQ==[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="yes" first="no" size="6"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjM6Ijc2OSI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6Ijc0IjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MiI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjEwOiJEU0xDX0ltYWdlIjt9[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="yes" size="4"] [dslc_module]YTo2OntzOjU6ImltYWdlIjtzOjM6Ijc2MCI7czoxNzoiY3NzX21hcmdpbl9ib3R0b20iO3M6MjoiMjAiO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czoyOiI3NSI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3NTIiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxMDoiRFNMQ19JbWFnZSI7fQ==[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="no" size="4"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjM6Ijc1NCI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6Ijc2IjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MiI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjEwOiJEU0xDX0ltYWdlIjt9[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="yes" first="no" size="4"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjM6Ijc2NyI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6Ijc3IjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MiI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjEwOiJEU0xDX0ltYWdlIjt9[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="yes" size="3"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjM6IjYxMSI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6Ijc4IjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MiI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjEwOiJEU0xDX0ltYWdlIjt9[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="no" size="3"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjM6IjYxNyI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6Ijc5IjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MiI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjEwOiJEU0xDX0ltYWdlIjt9[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="no" first="no" size="3"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjM6IjgwNyI7czoxODoibW9kdWxlX2luc3RhbmNlX2lkIjtzOjI6IjgwIjtzOjc6InBvc3RfaWQiO3M6NDoiMTc1MiI7czoxMToiZHNsY19tX3NpemUiO3M6MjoiMTIiO3M6OToibW9kdWxlX2lkIjtzOjEwOiJEU0xDX0ltYWdlIjt9[/dslc_module] [/dslc_modules_area] [dslc_modules_area last="yes" first="no" size="3"] [dslc_module]YTo1OntzOjU6ImltYWdlIjtzOjQ6IjE2OTEiO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czoyOiI4MSI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3NTIiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxMDoiRFNMQ19JbWFnZSI7fQ==[/dslc_module] [/dslc_modules_area] [/dslc_modules_section] [dslc_modules_section show_on="desktop tablet phone" type="wrapped" columns_spacing="spacing" bg_color="" bg_image_thumb="disabled" bg_image="" bg_image_repeat="repeat" bg_image_position="left top" bg_image_attachment="scroll" bg_image_size="auto" bg_video="" bg_video_overlay_color="#000000" bg_video_overlay_opacity="0" border_color="" border_width="0" border_style="solid" border="top right bottom left" margin_h="0" margin_b="0" padding="60" padding_h="0" custom_class="" custom_id="" ] [dslc_modules_area last="yes" first="no" size="12"] [dslc_module]YToxMDp7czo3OiJjb250ZW50IjtzOjQ4OiI8aDIgc3R5bGU9XCJ0ZXh0LWFsaWduOiBjZW50ZXI7XCI+VGhhbmsgWW91PC9oMj4iO3M6MjA6ImNzc19tYWluX2ZvbnRfZmFtaWx5IjtzOjExOiJSb2JvdG8gU2xhYiI7czoxOToiY3NzX21haW5fdGV4dF9hbGlnbiI7czo2OiJjZW50ZXIiO3M6MTY6ImNzc19oMl9mb250X3NpemUiO3M6MjoiMjgiO3M6MTg6ImNzc19oMl9mb250X3dlaWdodCI7czozOiI3MDAiO3M6MTg6ImNzc19oMl9mb250X2ZhbWlseSI7czoxMToiUm9ib3RvIFNsYWIiO3M6MTg6Im1vZHVsZV9pbnN0YW5jZV9pZCI7czoyOiIxMiI7czo3OiJwb3N0X2lkIjtzOjQ6IjE3MzkiO3M6MTE6ImRzbGNfbV9zaXplIjtzOjI6IjEyIjtzOjk6Im1vZHVsZV9pZCI7czoxNjoiRFNMQ19UZXh0X1NpbXBsZSI7fQ==[/dslc_module] [dslc_module]YToxMDp7czoxNDoiY3NzX3RleHRfYWxpZ24iO3M6NjoiY2VudGVyIjtzOjEyOiJjc3NfYmdfY29sb3IiO3M6MTE6InRyYW5zcGFyZW50IjtzOjE4OiJjc3NfYmdfY29sb3JfaG92ZXIiO3M6MTE6InRyYW5zcGFyZW50IjtzOjE0OiJjc3NfaWNvbl9jb2xvciI7czoxNjoicmdiKDEwNiwgOTksIDk5KSI7czoyMDoiY3NzX2ljb25fY29sb3JfaG92ZXIiO3M6MTg6InJnYigxMjYsIDExOSwgMTE5KSI7czoxODoiY3NzX2ljb25fZm9udF9zaXplIjtzOjI6IjE5IjtzOjE4OiJtb2R1bGVfaW5zdGFuY2VfaWQiO3M6MjoiMTQiO3M6NzoicG9zdF9pZCI7czo0OiIxNzM5IjtzOjExOiJkc2xjX21fc2l6ZSI7czoyOiIxMiI7czo5OiJtb2R1bGVfaWQiO3M6MTE6IkRTTENfU29jaWFsIjt9[/dslc_module] [/dslc_modules_area] [/dslc_modules_section]'
            )
        );

        /* End register templates */

        foreach ( $single_post_templates as $post_template ) {

            // Create post object
            $the_post = array(
                'post_title' => $post_template[ 'title' ],
                'post_status' => 'publish',
                'post_type' => 'dslc_templates',
            );

            // Insert the post into the database
            $post_id = wp_insert_post( $the_post );

            // If post added
            if ( $post_id ) {

                // Go through the custom fields and add them
                foreach ( $post_template[ 'custom_fields' ] as $custom_field_id => $custom_field_value ) {
                    add_post_meta( $post_id, $custom_field_id, $custom_field_value );
                }

            }

        }

    }

}