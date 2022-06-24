<!DOCTYPE html>

<html <?php language_attributes() ?>>

<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    $custom_logo_id = get_theme_mod('custom_logo');
    ?>
    <!-- ----------------------------------------------------- nav start ------------------------------------------------------------ -->
    <div id="wkSideNar" class="sidenav">
        <div class="sec-bg">
            <?php echo wp_get_attachment_image(147, 'full', false); ?>
        </div>
        <div class="sidebar-header">
            <a class="brand" href="<?php echo home_url(); ?>">
                <?php echo wp_get_attachment_image($custom_logo_id, 'full', true, ['class' => 'site-logo']); ?>
            </a>
            <a href="javascript:void(0)" class="closebtn">&times;</a>
        </div>
        <?php
        wp_nav_menu(array(
            'theme_location'    => 'header-menu',
            'depth'             => 3,
            'container'         => false,
            'menu_class'        => 'd-flex flex-column mobile-menu',
        ));
        ?>
    </div>
    <div class="nav-container">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <a class="navbar-brand" href="<?php echo home_url(); ?>">
                    <?php echo wp_get_attachment_image($custom_logo_id, 'full', true, ['class' => 'site-logo']); ?>
                    <span class="icon-imp-name"></span>
                </a>
                <button class="navbar-toggler btn" type="button">
                    <span class="icon-burger"></span>
                </button>

                <div class="collapse navbar-collapse d-none d-lg-block" id="navbarSupportedContent">
                    <?php
                    wp_nav_menu(array(
                        'theme_location'    => 'header-menu',
                        'depth'             => 3,
                        'container'         => false,
                        'menu_class'        => 'desktop-menu',
                    ));
                    ?>
                </div>
            </nav>
        </div>
    </div>
    <!-- ----------------------------------------------------- nav end ------------------------------------------------------------ -->
