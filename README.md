# FlexPress
A Flexible WordPress Theme with Built-in Editor
# FlexPress WordPress Theme

A modern, highly customizable WordPress theme with an intuitive built-in customizer that makes theme customization accessible to everyone.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Theme Structure](#theme-structure)
- [Using the Customizer](#using-the-customizer)
- [Adding Images to Your Theme](#adding-images-to-your-theme)
- [Customization Options](#customization-options)
- [Developer Guide](#developer-guide)
- [Frequently Asked Questions](#frequently-asked-questions)
- [Support](#support)
- [License](#license)

## Features

### Core Features
- **Intuitive Customizer Interface** - All settings organized in logical panels
- **Live Preview** - See changes instantly as you customize
- **Responsive Design** - Mobile-first approach, looks great on all devices
- **Multiple Layout Options** - Various header and sidebar configurations
- **Typography Control** - Google Fonts integration with system font fallbacks
- **Color Schemes** - Full control over primary, secondary, and accent colors
- **Widget Areas** - Sidebar and footer widget support
- **SEO Optimized** - Clean, semantic HTML5 markup
- **Translation Ready** - Fully prepared for localization
- **Accessibility Ready** - WCAG 2.1 compliant markup

### Technical Features
- Modern CSS with CSS Custom Properties (CSS Variables)
- Vanilla JavaScript with jQuery for WordPress compatibility
- Modular file structure for easy customization
- WordPress Coding Standards compliant
- No dependencies on page builders or frameworks

## Requirements

- WordPress 5.0 or higher
- PHP 7.2 or higher
- MySQL 5.6 or higher

## Installation

### Method 1: Manual Installation

1. Download the theme files
2. Create a new folder called `flexpress` in `/wp-content/themes/`
3. Create the following file structure:

```
flexpress/
├── assets/
│   ├── css/
│   │   └── main.css
│   ├── js/
│   │   └── main.js
│   └── images/          # Create this folder for your images
├── functions.php
├── style.css
├── index.php
├── header.php
├── footer.php
├── page.php
├── single.php
└── README.md
```

4. Copy the provided code into each respective file
5. Go to **Appearance > Themes** in WordPress admin
6. Find FlexPress and click **Activate**

### Method 2: Upload via WordPress Admin

1. Zip the `flexpress` folder
2. Go to **Appearance > Themes > Add New**
3. Click **Upload Theme**
4. Choose the zip file and click **Install Now**
5. Activate the theme

## Theme Structure

```
flexpress/
├── assets/
│   ├── css/
│   │   └── main.css          # Main stylesheet
│   ├── js/
│   │   └── main.js           # Theme JavaScript
│   └── images/               # Theme images (user-added)
├── functions.php             # Theme functions and customizer settings
├── style.css                 # Theme information header
├── index.php                 # Main template file
├── header.php               # Site header template
├── footer.php               # Site footer template
├── page.php                 # Page template
├── single.php               # Single post template
└── README.md                # This file
```

## Using the Customizer

1. Navigate to **Appearance > Customize** in your WordPress admin
2. You'll see the following panels:

### General Settings
- **Logo & Branding**: Upload your logo or use text-based site title
- **Site Width**: Control the maximum width of your content (800-2000px)

### Colors & Appearance
- **Primary Colors**: Set primary, secondary, and accent colors
- **Background Colors**: Customize body and header backgrounds

### Typography
- **Font Selection**: Choose from system fonts or Google Fonts
- **Font Sizes**: Adjust base font size (12-24px)

### Layout Settings
- **Header Layout**: Choose from 4 different header styles
- **Sidebar Position**: Left, right, or no sidebar

### Advanced Settings
- **Custom CSS**: Add your own CSS rules
- **Smooth Scrolling**: Enable/disable smooth scroll behavior

## Adding Images to Your Theme

Since FlexPress is a clean starter theme, it doesn't include any default images. Here's how to add images:

### 1. Theme Images Directory

Create an `images` folder inside the `assets` directory:
```
flexpress/assets/images/
```

### 2. Adding a Default Header Image

To add a default header image:

```php
// In functions.php, add to the flexpress_setup() function:
add_theme_support('custom-header', array(
    'default-image' => get_template_directory_uri() . '/assets/images/default-header.jpg',
    'width' => 1920,
    'height' => 400,
    'flex-height' => true,
    'flex-width' => true,
));
```

### 3. Adding Logo Options

The theme already supports custom logos. To add a default logo:

1. Place your logo in `/assets/images/logo.png`
2. Users can override this via **Customizer > General Settings > Logo & Branding**

### 4. Adding Featured Images

Featured images are already enabled. To set default featured images:

```php
// In functions.php, add this function:
function flexpress_default_featured_image($html, $post_id, $post_thumbnail_id, $size, $attr) {
    if (empty($html)) {
        $html = '<img src="' . get_template_directory_uri() . '/assets/images/default-featured.jpg" alt="' . get_the_title($post_id) . '" />';
    }
    return $html;
}
add_filter('post_thumbnail_html', 'flexpress_default_featured_image', 10, 5);
```

### 5. Adding Background Patterns

To add background pattern options:

1. Add pattern images to `/assets/images/patterns/`
2. Add this to the customizer in `functions.php`:

```php
// In flexpress_customize_register function:
$wp_customize->add_setting('background_pattern', array(
    'default' => 'none',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('background_pattern', array(
    'label' => __('Background Pattern', 'flexpress'),
    'section' => 'flexpress_bg_colors',
    'type' => 'select',
    'choices' => array(
        'none' => 'None',
        'dots' => 'Dots',
        'grid' => 'Grid',
        'diagonal' => 'Diagonal Lines',
    ),
));
```

### 6. Image Optimization Tips

- **Format**: Use JPEG for photos, PNG for logos/icons, SVG for scalable graphics
- **Size**: Optimize images before upload (recommended max width: 1920px)
- **Compression**: Use tools like TinyPNG or ImageOptim
- **Lazy Loading**: WordPress 5.5+ includes lazy loading by default

### 7. Adding Image Sizes

Register custom image sizes in `functions.php`:

```php
add_image_size('flexpress-featured', 1200, 600, true);
add_image_size('flexpress-thumbnail', 400, 300, true);
```

## Customization Options

### Color Customization
- Primary Color (default: #007cba)
- Secondary Color (default: #005a87)
- Accent Color (default: #f0b849)
- Body Background (default: #ffffff)
- Header Background (default: #ffffff)

### Typography Options
- Body Font (12 options including Google Fonts)
- Heading Font (12 options including Google Fonts)
- Base Font Size (12-24px)

### Layout Options
- Site Maximum Width (800-2000px)
- Header Layout (4 styles)
- Sidebar Position (left/right/none)

## Developer Guide

### Adding New Customizer Options

```php
// Example: Adding a new color option
$wp_customize->add_setting('button_color', array(
    'default' => '#007cba',
    'sanitize_callback' => 'sanitize_hex_color',
));

$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_color', array(
    'label' => __('Button Color', 'flexpress'),
    'section' => 'flexpress_primary_colors',
)));
```

### Creating Child Themes

1. Create a new folder: `flexpress-child`
2. Create `style.css`:

```css
/*
Theme Name: FlexPress Child
Template: flexpress
*/
```

3. Create `functions.php`:

```php
<?php
function flexpress_child_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'flexpress_child_styles');
```

### Adding Custom Page Templates

Create a new file (e.g., `template-fullwidth.php`):

```php
<?php
/**
 * Template Name: Full Width
 */
get_header();
?>
<!-- Your custom template code -->
<?php get_footer(); ?>
```

## Frequently Asked Questions

### How do I change the site logo?
Go to **Customizer > General Settings > Logo & Branding** and upload your logo.

### Can I use this theme for commercial projects?
Yes, FlexPress is GPL licensed and free for personal and commercial use.

### How do I add social media icons?
You can add a social media menu or use a plugin like "Simple Social Icons".

### Is this theme WooCommerce compatible?
The base theme doesn't include WooCommerce support, but it can be easily added.

### How do I create a custom menu?
Go to **Appearance > Menus**, create a new menu, and assign it to "Primary Menu" or "Footer Menu" location.

## Support

### Documentation
For detailed documentation, visit the [theme documentation](#).

### Bug Reports
Report bugs and issues on our [GitHub repository](#).

### Community Support
- WordPress.org Support Forum
- Theme Facebook Group
- Developer Discord Server

### Premium Support
Premium support packages available at [theme website](#).

## Changelog

### Version 1.0.0 (Initial Release)
- Core theme functionality
- Customizer implementation
- Responsive design
- Google Fonts integration
- Widget areas
- Multiple layout options

## Credits

- Developed by: Kevin Cowan / Capture Club LLC
- Based on WordPress coding standards
- Google Fonts by Google
- Inspired by modern web design principles

## License

FlexPress is licensed under the GPL v2 or later.

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.