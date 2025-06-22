<?php
/**
 * Theme Name: FlexPress
 * Description: A super-intuitive WordPress theme with advanced customization options
 * Version: 1.0
 * Author: Your Name
 */
// Theme Setup
function flexpress_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-background');
    add_theme_support('custom-header');

    // Register menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'flexpress'),
        'footer' => __('Footer Menu', 'flexpress'),
    ));
}
add_action('after_setup_theme', 'flexpress_setup');

// Enqueue styles and scripts
function flexpress_scripts() {
    wp_enqueue_style('flexpress-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('flexpress-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');

    // Add custom CSS from customizer
    $custom_css = flexpress_generate_custom_css();
    wp_add_inline_style('flexpress-main', $custom_css);

    wp_enqueue_script('flexpress-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'flexpress_scripts');

// Customizer Settings
function flexpress_customize_register($wp_customize) {
    // Remove default sections we don't need
    $wp_customize->remove_section('colors');

    // 1. GENERAL SETTINGS PANEL
    $wp_customize->add_panel('flexpress_general', array(
        'title' => __('General Settings', 'flexpress'),
        'priority' => 10,
    ));

    // Logo & Branding Section
    $wp_customize->add_section('flexpress_branding', array(
        'title' => __('Logo & Branding', 'flexpress'),
        'panel' => 'flexpress_general',
        'priority' => 10,
    ));

    // Site width
    $wp_customize->add_setting('site_max_width', array(
        'default' => '1200',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('site_max_width', array(
        'label' => __('Maximum Site Width (px)', 'flexpress'),
        'section' => 'flexpress_branding',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 800,
            'max' => 2000,
            'step' => 10,
        ),
    ));

    // 2. COLOR SETTINGS PANEL
    $wp_customize->add_panel('flexpress_colors', array(
        'title' => __('Colors & Appearance', 'flexpress'),
        'priority' => 20,
    ));

    // Primary Colors
    $wp_customize->add_section('flexpress_primary_colors', array(
        'title' => __('Primary Colors', 'flexpress'),
        'panel' => 'flexpress_colors',
    ));

    // Primary Color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#007cba',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => __('Primary Color', 'flexpress'),
        'section' => 'flexpress_primary_colors',
    )));

    // Secondary Color
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#005a87',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label' => __('Secondary Color', 'flexpress'),
        'section' => 'flexpress_primary_colors',
    )));

    // Accent Color
    $wp_customize->add_setting('accent_color', array(
        'default' => '#f0b849',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'accent_color', array(
        'label' => __('Accent Color', 'flexpress'),
        'section' => 'flexpress_primary_colors',
    )));

    // Background Colors
    $wp_customize->add_section('flexpress_bg_colors', array(
        'title' => __('Background Colors', 'flexpress'),
        'panel' => 'flexpress_colors',
    ));

    // Body Background
    $wp_customize->add_setting('body_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'body_bg_color', array(
        'label' => __('Body Background', 'flexpress'),
        'section' => 'flexpress_bg_colors',
    )));

    // Header Background
    $wp_customize->add_setting('header_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_bg_color', array(
        'label' => __('Header Background', 'flexpress'),
        'section' => 'flexpress_bg_colors',
    )));

    // 3. TYPOGRAPHY PANEL
    $wp_customize->add_panel('flexpress_typography', array(
        'title' => __('Typography', 'flexpress'),
        'priority' => 30,
    ));

    // Font Settings
    $wp_customize->add_section('flexpress_fonts', array(
        'title' => __('Font Settings', 'flexpress'),
        'panel' => 'flexpress_typography',
    ));

    // Font choices
    $font_choices = array(
        'system' => 'System Fonts',
        'georgia' => 'Georgia, serif',
        'helvetica' => 'Helvetica, Arial, sans-serif',
        'times' => 'Times New Roman, serif',
        'arial' => 'Arial, sans-serif',
        'verdana' => 'Verdana, sans-serif',
        'courier' => 'Courier New, monospace',
        'roboto' => 'Roboto (Google Font)',
        'open-sans' => 'Open Sans (Google Font)',
        'lato' => 'Lato (Google Font)',
        'montserrat' => 'Montserrat (Google Font)',
        'poppins' => 'Poppins (Google Font)',
    );

    // Body Font
    $wp_customize->add_setting('body_font', array(
        'default' => 'system',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('body_font', array(
        'label' => __('Body Font', 'flexpress'),
        'section' => 'flexpress_fonts',
        'type' => 'select',
        'choices' => $font_choices,
    ));

    // Heading Font
    $wp_customize->add_setting('heading_font', array(
        'default' => 'system',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('heading_font', array(
        'label' => __('Heading Font', 'flexpress'),
        'section' => 'flexpress_fonts',
        'type' => 'select',
        'choices' => $font_choices,
    ));

    // Font Sizes
    $wp_customize->add_setting('body_font_size', array(
        'default' => '16',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('body_font_size', array(
        'label' => __('Body Font Size (px)', 'flexpress'),
        'section' => 'flexpress_fonts',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 12,
            'max' => 24,
        ),
    ));

    // 4. LAYOUT SETTINGS
    $wp_customize->add_panel('flexpress_layout', array(
        'title' => __('Layout Settings', 'flexpress'),
        'priority' => 40,
    ));

    // Header Layout
    $wp_customize->add_section('flexpress_header_layout', array(
        'title' => __('Header Layout', 'flexpress'),
        'panel' => 'flexpress_layout',
    ));

    $wp_customize->add_setting('header_layout', array(
        'default' => 'centered',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('header_layout', array(
        'label' => __('Header Layout', 'flexpress'),
        'section' => 'flexpress_header_layout',
        'type' => 'select',
        'choices' => array(
            'centered' => 'Centered Logo',
            'left' => 'Logo Left, Menu Right',
            'split' => 'Logo Center, Split Menu',
            'minimal' => 'Minimal Header',
        ),
    ));

    // Sidebar Layout
    $wp_customize->add_section('flexpress_sidebar_layout', array(
        'title' => __('Sidebar Layout', 'flexpress'),
        'panel' => 'flexpress_layout',
    ));

    $wp_customize->add_setting('sidebar_position', array(
        'default' => 'right',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('sidebar_position', array(
        'label' => __('Sidebar Position', 'flexpress'),
        'section' => 'flexpress_sidebar_layout',
        'type' => 'select',
        'choices' => array(
            'none' => 'No Sidebar',
            'left' => 'Left Sidebar',
            'right' => 'Right Sidebar',
        ),
    ));

    // 5. ADVANCED SETTINGS
    $wp_customize->add_section('flexpress_advanced', array(
        'title' => __('Advanced Settings', 'flexpress'),
        'priority' => 50,
    ));

    // Custom CSS
    $wp_customize->add_setting('custom_css', array(
        'default' => '',
        'sanitize_callback' => 'wp_strip_all_tags',
    ));

    $wp_customize->add_control('custom_css', array(
        'label' => __('Custom CSS', 'flexpress'),
        'section' => 'flexpress_advanced',
        'type' => 'textarea',
        'description' => __('Add your custom CSS here', 'flexpress'),
    ));

    // Enable smooth scroll
    $wp_customize->add_setting('enable_smooth_scroll', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    $wp_customize->add_control('enable_smooth_scroll', array(
        'label' => __('Enable Smooth Scrolling', 'flexpress'),
        'section' => 'flexpress_advanced',
        'type' => 'checkbox',
    ));
}
add_action('customize_register', 'flexpress_customize_register');

// Generate custom CSS from customizer settings
function flexpress_generate_custom_css() {
    $css = '';

    // Colors
    $primary_color = get_theme_mod('primary_color', '#007cba');
    $secondary_color = get_theme_mod('secondary_color', '#005a87');
    $accent_color = get_theme_mod('accent_color', '#f0b849');
    $body_bg_color = get_theme_mod('body_bg_color', '#ffffff');
    $header_bg_color = get_theme_mod('header_bg_color', '#ffffff');

    // Typography
    $body_font = get_theme_mod('body_font', 'system');
    $heading_font = get_theme_mod('heading_font', 'system');
    $body_font_size = get_theme_mod('body_font_size', '16');

    // Layout
    $site_max_width = get_theme_mod('site_max_width', '1200');

    // Build CSS
    $css .= "
    :root {
        --primary-color: {$primary_color};
        --secondary-color: {$secondary_color};
        --accent-color: {$accent_color};
        --body-bg: {$body_bg_color};
        --header-bg: {$header_bg_color};
        --body-font-size: {$body_font_size}px;
        --site-max-width: {$site_max_width}px;
    }
    
    body {
        background-color: var(--body-bg);
        font-size: var(--body-font-size);
        font-family: " . flexpress_get_font_family($body_font) . ";
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-family: " . flexpress_get_font_family($heading_font) . ";
    }
    
    .site-header {
        background-color: var(--header-bg);
    }
    
    .container {
        max-width: var(--site-max-width);
        margin: 0 auto;
        padding: 0 20px;
    }
    
    a {
        color: var(--primary-color);
    }
    
    a:hover {
        color: var(--secondary-color);
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }
    
    .btn-primary:hover {
        background-color: var(--secondary-color);
    }
    
    .accent-bg {
        background-color: var(--accent-color);
    }
    ";

    // Add custom CSS from user
    $custom_css = get_theme_mod('custom_css', '');
    if (!empty($custom_css)) {
        $css .= $custom_css;
    }

    return $css;
}

// Helper function to get font family
function flexpress_get_font_family($font) {
    $fonts = array(
        'system' => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif',
        'georgia' => 'Georgia, serif',
        'helvetica' => 'Helvetica, Arial, sans-serif',
        'times' => '"Times New Roman", Times, serif',
        'arial' => 'Arial, sans-serif',
        'verdana' => 'Verdana, sans-serif',
        'courier' => '"Courier New", Courier, monospace',
        'roboto' => '"Roboto", sans-serif',
        'open-sans' => '"Open Sans", sans-serif',
        'lato' => '"Lato", sans-serif',
        'montserrat' => '"Montserrat", sans-serif',
        'poppins' => '"Poppins", sans-serif',
    );

    return isset($fonts[$font]) ? $fonts[$font] : $fonts['system'];
}

// Load Google Fonts if needed
function flexpress_load_google_fonts() {
    $google_fonts = array('roboto', 'open-sans', 'lato', 'montserrat', 'poppins');
    $body_font = get_theme_mod('body_font', 'system');
    $heading_font = get_theme_mod('heading_font', 'system');

    $fonts_to_load = array();

    if (in_array($body_font, $google_fonts)) {
        $fonts_to_load[] = $body_font;
    }

    if (in_array($heading_font, $google_fonts) && $heading_font !== $body_font) {
        $fonts_to_load[] = $heading_font;
    }

    if (!empty($fonts_to_load)) {
        $font_families = array();
        foreach ($fonts_to_load as $font) {
            switch ($font) {
                case 'roboto':
                    $font_families[] = 'Roboto:wght@300;400;500;700';
                    break;
                case 'open-sans':
                    $font_families[] = 'Open+Sans:wght@300;400;600;700';
                    break;
                case 'lato':
                    $font_families[] = 'Lato:wght@300;400;700;900';
                    break;
                case 'montserrat':
                    $font_families[] = 'Montserrat:wght@300;400;500;600;700';
                    break;
                case 'poppins':
                    $font_families[] = 'Poppins:wght@300;400;500;600;700';
                    break;
            }
        }

        if (!empty($font_families)) {
            $fonts_url = 'https://fonts.googleapis.com/css2?family=' . implode('&family=', $font_families) . '&display=swap';
            wp_enqueue_style('flexpress-google-fonts', $fonts_url, array(), null);
        }
    }
}
add_action('wp_enqueue_scripts', 'flexpress_load_google_fonts');

// Register sidebars
function flexpress_widgets_init() {
    register_sidebar(array(
        'name' => __('Primary Sidebar', 'flexpress'),
        'id' => 'sidebar-primary',
        'description' => __('Main sidebar that appears on the left or right.', 'flexpress'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => __('Footer Widget Area', 'flexpress'),
        'id' => 'sidebar-footer',
        'description' => __('Footer widget area', 'flexpress'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'flexpress_widgets_init');

?>