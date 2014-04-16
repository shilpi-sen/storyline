<?php
/**
 * storyline Theme Customizer
 *
 * @package storyline
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function storyline_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
}

add_action('customize_register', 'storyline_customize_register', 12);

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function storyline_customize_preview_js() {
    wp_enqueue_script('storyline_customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '20130508', true);
}

add_action('customize_preview_init', 'storyline_customize_preview_js');

function storyline_customizer($wp_customize) {

    class storyline_customize_textarea_control extends WP_Customize_Control {

        public $type = 'textarea';

        public function render_content() {
            ?>

            <label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
                <textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>
            </label>

            <?php
        }

    }

    // Add new section for theme layout and color schemes
    $wp_customize->add_section('storyline_theme_layout_settings', array(
        'title' => __('Layout & Color Scheme', 'storyline'),
        'priority' => 30,
    ));

    // Add setting for theme layout
    $wp_customize->add_setting('storyline_theme_layout', array(
        'default' => 'full-width',
    ));

    $wp_customize->add_control('storyline_theme_layout', array(
        'label' => 'Theme Layout',
        'section' => 'storyline_theme_layout_settings',
        'type' => 'radio',
        'choices' => array(
            'full-width' => __('Full Width', 'storyline'),
            'boxed' => __('Boxed', 'storyline'),
        ),
    ));

    // Add new setting for color schemes
    $wp_customize->add_setting('storyline_color_scheme', array(
        'default' => 'red',
    ));

    $wp_customize->add_control('storyline_color_scheme', array(
        'label' => 'Color schemes',
        'section' => 'storyline_theme_layout_settings',
        'type' => 'radio',
        'choices' => array(
            'blue' => __('Blue', 'storyline'),
            'red' => __('Red', 'storyline'),
            'green' => __('Green', 'storyline'),
            'gray' => __('Gray', 'storyline'),
            'purple' => __('Purple', 'storyline'),
            'orange' => __('Orange', 'storyline'),
            'brown' => __('Brown', 'storyline'),
            'pink' => __('Pink', 'storyline'),
        ),
    ));


    if (class_exists('Easy_Digital_Downloads')) {
        $wp_customize->add_section('storyline_edd_options', array(
            'title' => __('Easy Digital Downloads', 'storyline'),
            'description' => __('All other EDD options are under Dashboard => Downloads.', 'storyline'),
            'priority' => 70,
        ));

        // enable featured products on front page?
        $wp_customize->add_setting('storyline_edd_front_featured_products', array('default' => 0));
        $wp_customize->add_control('storyline_edd_front_featured_products', array(
            'label' => __('Show featured products on Front Page', 'storyline'),
            'section' => 'storyline_edd_options',
            'priority' => 10,
            'type' => 'checkbox',
        ));

        // store front/archive item count
        $wp_customize->add_setting('storyline_store_front_featured_count', array('default' => 6));
        $wp_customize->add_control('storyline_store_front_featured_count', array(
            'label' => __('Number of Featured Products', 'storyline'),
            'section' => 'storyline_edd_options',
            'settings' => 'storyline_store_front_featured_count',
            'priority' => 20,
        ));

        // store front/downloads archive headline
        $wp_customize->add_setting('storyline_edd_store_archives_title', array('default' => null));
        $wp_customize->add_control('storyline_edd_store_archives_title', array(
            'label' => __('Store/Download Archives Main Title', 'storyline'),
            'section' => 'storyline_edd_options',
            'settings' => 'storyline_edd_store_archives_title',
            'priority' => 30,
        ));
        // store front/downloads archive description
        $wp_customize->add_setting('storyline_edd_store_archives_description', array('default' => null));
        $wp_customize->add_control(new storyline_customize_textarea_control($wp_customize, 'storyline_edd_store_archives_description', array(
            'label' => __('Store/Download Archives Description', 'storyline'),
            'section' => 'storyline_edd_options',
            'settings' => 'storyline_edd_store_archives_description',
            'priority' => 40,
        )));
        // read more link
        $wp_customize->add_setting('storyline_product_view_details', array('default' => __('View Details', 'storyline')));
        $wp_customize->add_control('storyline_product_view_details', array(
            'label' => __('Store Link', 'storyline'),
            'section' => 'storyline_edd_options',
            'settings' => 'storyline_product_view_details',
            'priority' => 50,
        ));
        // store front/archive item count
        $wp_customize->add_setting('storyline_store_front_count', array('default' => 9));
        $wp_customize->add_control('storyline_store_front_count', array(
            'label' => __('Store Item Count', 'storyline'),
            'section' => 'storyline_edd_options',
            'settings' => 'storyline_store_front_count',
            'priority' => 60,
        ));
    }


    // Add new section for displaying Featured Posts on Front Page
    $wp_customize->add_section('storyline_front_page_post_options', array(
        'title' => __('Front Page Featured Posts', 'storyline'),
        'description' => __('Settings for displaying featured posts on Front Page', 'storyline'),
        'priority' => 60,
    ));
    // enable featured posts on front page?
    $wp_customize->add_setting('storyline_front_featured_posts_check', array('default' => 0));
    $wp_customize->add_control('storyline_front_featured_posts_check', array(
        'label' => __('Show featured posts on Front Page', 'storyline'),
        'section' => 'storyline_front_page_post_options',
        'priority' => 10,
        'type' => 'checkbox',
    ));

    // Front featured posts section headline
    $wp_customize->add_setting('storyline_front_featured_posts_title', array('default' => __('Latest Posts', 'storyline')));
    $wp_customize->add_control('storyline_front_featured_posts_title', array(
        'label' => __('Featured Section Title', 'storyline'),
        'section' => 'storyline_front_page_post_options',
        'settings' => 'storyline_front_featured_posts_title',
        'priority' => 10,
    ));

    // select number of posts for featured posts on front page
    $wp_customize->add_setting('storyline_front_featured_posts_count', array('default' => 3));
    $wp_customize->add_control('storyline_front_featured_posts_count', array(
        'label' => __('Number of posts to display', 'storyline'),
        'section' => 'storyline_front_page_post_options',
        'settings' => 'storyline_front_featured_posts_count',
        'priority' => 20,
    ));


    // featured post read more link
    $wp_customize->add_setting('storyline_front_featured_link_text', array('default' => __('Read more', 'storyline')));
    $wp_customize->add_control('storyline_front_featured_link_text', array(
        'label' => __('Posts Read More Link Text', 'storyline'),
        'section' => 'storyline_front_page_post_options',
        'settings' => 'storyline_front_featured_link_text',
        'priority' => 30,
    ));

    // Add footer text section
    $wp_customize->add_section('storyline_footer', array(
        'title' => 'Footer Text', // The title of section
        'priority' => 70,
    ));

    $wp_customize->add_setting('storyline_footer_footer_text', array(
        'default' => '',
    ));
    $wp_customize->add_control(new storyline_customize_textarea_control($wp_customize, 'storyline_footer_footer_text', array(
        'section' => 'storyline_footer', // id of section to which the setting belongs
        'settings' => 'storyline_footer_footer_text',
    )));

    
    // Add custom CSS section
    $wp_customize->add_section('storyline_custom_css', array(
        'title' => 'Custom CSS', // The title of section
        'priority' => 80,
    ));
    
    $wp_customize->add_setting('storyline_custom_css');
    
    $wp_customize->add_control(new storyline_customize_textarea_control($wp_customize, 'storyline_custom_css', array(
        'section' => 'storyline_custom_css', // id of section to which the setting belongs
        'settings' => 'storyline_custom_css', 
    )));
    
    //remove default customizer sections
    $wp_customize->remove_section('background_image'); 
    $wp_customize->remove_section('colors');
}

add_action('customize_register', 'storyline_customizer', 11);

function storyline_generate_css($selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true) {
    $return = '';
    $mod = get_theme_mod($mod_name);
    if (!empty($mod)) {
        $return = sprintf('%s { %s:%s; }', $selector, $style, $prefix . $mod . $postfix
        );
        if ($echo) {
            echo $return;
        }
    }
    return $return;
}

function storyline_header_output() {
    ?>
    <!--Customizer CSS--> 
    <style type="text/css">
    <?php storyline_generate_css('#site-name', 'color', 'title_textcolor', ''); ?>
    <?php storyline_generate_css('.sidebarwidget a', 'color', 'link_textcolor', ''); ?>
    <?php storyline_generate_css('.site-logo', 'display', 'name', 'none'); ?>
    <?php echo esc_attr(get_theme_mod('storyline_custom_css')); ?>
    </style> 
    <!--/Customizer CSS-->
    <?php
}

// Output custom CSS to live site
add_action('wp_head', 'storyline_header_output');
