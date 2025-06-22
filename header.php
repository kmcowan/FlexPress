<?php
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header id="masthead" class="site-header">
        <div class="container">
            <?php
            $header_layout = get_theme_mod('header_layout', 'centered');

            switch ($header_layout) {
                case 'centered':
                    ?>
                    <div class="header-centered">
                        <div class="site-branding">
                            <?php
                            if (has_custom_logo()) {
                                the_custom_logo();
                            } else {
                                ?>
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </h1>
                                <p class="site-description"><?php bloginfo('description'); ?></p>
                                <?php
                            }
                            ?>
                        </div>
                        <nav id="site-navigation" class="main-navigation">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id' => 'primary-menu',
                                'container_class' => 'menu-container',
                            ));
                            ?>
                        </nav>
                    </div>
                    <?php
                    break;

                case 'left':
                    ?>
                    <div class="header-left">
                        <div class="site-branding">
                            <?php
                            if (has_custom_logo()) {
                                the_custom_logo();
                            } else {
                                ?>
                                <h1 class="site-title">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <?php bloginfo('name'); ?>
                                    </a>
                                </h1>
                                <?php
                            }
                            ?>
                        </div>
                        <nav id="site-navigation" class="main-navigation">
                            <?php
                            wp_nav_menu(array(
                                'theme_location' => 'primary',
                                'menu_id' => 'primary-menu',
                            ));
                            ?>
                        </nav>
                    </div>
                    <?php
                    break;
            }
            ?>
        </div>
    </header>

    <div id="content" class="site-content">
        <div class="container">
