<header id="imp-header" class="imp-layout-header imp-hover-header">
    <div class="imp-layout-header--container d-sm-none d-xs-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="imp-header-section">
                    <div class="imp-header--start">
                        <?php IMPCourse::icon_language_flags('top_header', false); ?>
                    </div>
                    <div class="imp-header--end">
                        <nav id="site-navigation" class="imp-site-navigation">
                            <?php
                            $attr = array(
                                'container_class' => 'imp-mega-menu-wrap hidden-xs hidden-sm',
                                'container_id' => 'navigation-menu',
                                'items_wrap'      => '<ul id="%1$s" class="imp-nav-menu %2$s">%3$s</ul>',
                            );
                            /* Select menu dynamic */
                            $menu_slug = get_post_meta(get_the_ID(),'tb_menu',true);
                            if($menu_slug != '' && $menu_slug != 'global') {
                                $attr['menu'] = $menu_slug;
                            }
                            /* Select theme location */
                            $menu_locations = get_nav_menu_locations();
                            if (!empty($menu_locations['header-menu'])) {
                                $attr['theme_location'] = 'header-menu';
                                $attr['walker'] = new imp_walker_nav_menu();
                                wp_nav_menu( $attr );
                            } else { ?>
                                <span class="imp-assign-menu"><?php echo esc_html__('Assign a menu at Appearance > Menus', 'solik');?> </span>
                            <?php } ?>
                        </nav>
                        
                        <div class="imp-dropdown-header-dots">
                            <div class="imp-social-icon-wrapper">
                                <ul class="imp-header-social-media">
                                    <?php
                                    $social_links = IMPOptions::get('header--social_links');
                                    foreach ($social_links as $key => $social_link) {
                                        if ($social_link) { ?>
                                        <?php if ($key == 'link' || $key == 'envelope' || $key == 'map' || $key == 'map-marker-alt' ) { $icon_class = 'fas'; } else { $icon_class = 'fab'; } ?>
                                        <li class="<?php echo esc_attr($key); ?>">
                                            <a href="<?php echo esc_url(IMPOptions::get('social--' . $key)); ?>" target="_blank" class="social-links">
                                                <i class="<?php echo esc_attr($icon_class);?>  fa-<?php echo esc_attr($key); ?>"></i>
                                            </a>
                                        </li>
                                        <?php }
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="imp-header-section-end">
                    <div class="imp-header-bottom--logo">
                        <a class="navbar-logo header_logo_light" href="<?php echo esc_url(home_url( '/' )); ?>">
                            <img alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"
                            class="main-logo" src="<?php echo THEME_DIR_URI. '/src/images/logo.png'; ?>"/>
                        </a>
                    </div>
                    <div class="imp-header-bottom--search">
                        <?php get_template_part( 'templates/header/header-category');?>
                    </div>
                    <div class="imp-header-bottom--auth">
                        <div class="imp-header-auth">
                            <a target="_blank" href="https://lms.imanagementpro.com/login/index.php" class="imp-header-log-in">
                                <i class="fa-regular fa-user"></i>
                                <span><?php echo esc_html__( 'Log in', 'imp' )?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Mobile Header -->
	<div id="imp-header-mobile" class="imp-header-mobile">
		<?php get_template_part( 'templates/header/mobile-header' ); ?>
	</div>
</header>