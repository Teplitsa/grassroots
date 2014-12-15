<?php
/**
 * Theme editor (customizer) settings
 **/

add_action('customize_register', 'grt_customize_register');
function grt_customize_register(WP_Customize_Manager $wp_customize) {

    $wp_customize->add_section('grt_spec_settings', array(
        'title'      => __('Grassroots settings', 'grt'),
        'priority'   => 30,
    ));
   

    $wp_customize->add_setting('logo', array(
        'default'   => false,
        'transport' => 'refresh', // postMessage
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
        'label'    => __('Header logo', 'grt'),
        'section'  => 'grt_spec_settings',
        'settings' => 'logo',
        'priority' => 1,
    )));

    $wp_customize->add_setting('favicon', array(
        'default'   => false,
        'transport' => 'postMessage', // Just to remove unnecessary page reloading
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'favicon', array(
        'extensions' => array('ico', 'png'),
        'label'    => __('Website favicon', 'grt'),
        'section'  => 'grt_spec_settings',
        'settings' => 'favicon',
        'priority' => 2,
    )));

      
    $wp_customize->add_setting('display_single_campaign_date', array(
        'default'   => true,
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('display_single_campaign_date', array(
        'type' => 'checkbox',
        'label'    => __('Display campaign date', 'grt'),
        'section'  => 'grt_spec_settings',
        'settings' => 'display_single_campaign_date',
        'priority' => 4,
    ));

    $wp_customize->add_setting('hide_theme_brand', array(
        'default'   => false,
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control('hide_theme_brand', array(
        'type' => 'checkbox',
        'label'    => __('Hide theme branding', 'grt'),
        'section'  => 'grt_spec_settings',
        'settings' => 'hide_theme_brand',
        'priority' => 5,
    ));

    $wp_customize->add_setting('homepage_template', array(
        'default'   => 'posts',
        'transport' => 'refresh',
    ));
    
    $wp_customize->add_control('homepage_template', array(
        'type' => 'radio',
        'choices' => array(            
            'posts'     => __('Posts', 'grt'),
            'campaigns' => __('Campaigns', 'grt'),
        ),
        'label'    => __('You homepage list contains', 'grt'),
        'section'  => 'static_front_page',
        'settings' => 'homepage_template',
        'priority' => 30,
    ));
}

// Theme editor scripts:
add_action('customize_preview_init', 'grt_add_editor_scripts');
function grt_add_editor_scripts() {

    wp_enqueue_script(
        'grt-live-preview',
        get_template_directory_uri().'/js/theme-live-preview.js',
        array('jquery', 'customize-preview'), GRT_VERSION, true
    );
}

add_action('customize_controls_enqueue_scripts', 'grt_custom_customize_enqueue');
function grt_custom_customize_enqueue() {
    wp_enqueue_script(
        'grt-theme-options',
        get_template_directory_uri().'/js/theme-options.js',
        array('jquery'), GRT_VERSION, true
    );
}

/** Helper function to output theme customized CSS */
function grt_generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true) {

    $return = '';
    $mod = get_theme_mod($mod_name);
    if($mod) {

        $return = sprintf('%s { %s:%s; }', $selector, $style, $prefix.$mod.$postfix);
        if($echo) {
            echo $return;
            return '';
        }
    }

    return $return;
}

// Output custom CSS:
//add_action('wp_head', 'grt_header_output');
function grt_header_output() {?>

    <!-- Customizer CSS -->

    <style type="text/css">
        <?php grt_generate_css('body a', 'color', 'accent_color'); ?>
        <?php grt_generate_css('body a:hover', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.main-menu .current-menu-item:before', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.main-menu .current_page_item:before', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.widget-content .textwidget a:hover', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.widget_grt_recent_posts a:hover .title', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.widget_grt_recent_comments a:hover .title', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.widget_archive li a:hover', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.widget_categories li a:hover', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.widget_meta li a:hover', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.widget_nav_menu li a:hover', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.widget_rss .widget-content ul a.rsswidget:hover', 'color', 'accent_color'); ?>
        <?php grt_generate_css('#wp-calendar thead', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.widget_tag_cloud a:hover', 'background', 'accent_color'); ?>
        <?php grt_generate_css('.search-button:hover .genericon', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.flex-direction-nav a:hover', 'background-color', 'accent_color'); ?>
        <?php grt_generate_css('a.post-quote:hover', 'background', 'accent_color'); ?>
        <?php grt_generate_css('.posts .post-title a:hover', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.post-content a', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.post-content a:hover', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.post-content a:hover', 'border-bottom-color', 'accent_color'); ?>
        <?php grt_generate_css('.post-content blockquote:before', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.post-content fieldset legend', 'background', 'accent_color'); ?>
        <?php grt_generate_css('.post-content input[type="submit"]:hover', 'background', 'accent_color'); ?>
        <?php grt_generate_css('.post-content input[type="button"]:hover', 'background', 'accent_color'); ?>
        <?php grt_generate_css('.post-content input[type="reset"]:hover', 'background', 'accent_color'); ?>
        <?php grt_generate_css('.page-links a:hover', 'background', 'accent_color'); ?>
        <?php grt_generate_css('.comments .pingbacks li a:hover', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.comment-header h4 a:hover', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.bypostauthor.commet .comment-header:before', 'background', 'accent_color'); ?>
        <?php grt_generate_css('.form-submit #submit:hover', 'background-color', 'accent_color'); ?>

        <?php grt_generate_css('.nav-toggle.active', 'background-color', 'accent_color'); ?>
        <?php grt_generate_css('.mobile-menu .current-menu-item:before', 'color', 'accent_color'); ?>
        <?php grt_generate_css('.mobile-menu .current_page_item:before', 'color', 'accent_color'); ?>

        <?php grt_generate_css('body#tinymce.wp-editor a', 'color', 'accent_color'); ?>
        <?php grt_generate_css('body#tinymce.wp-editor a:hover', 'color', 'accent_color'); ?>
        <?php grt_generate_css('body#tinymce.wp-editor fieldset legend', 'background', 'accent_color'); ?>
        <?php grt_generate_css('body#tinymce.wp-editor blockquote:before', 'color', 'accent_color'); ?>
    </style>

<?php }