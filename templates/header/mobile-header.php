<!-- Start Mobile Navbar -->
<div class="imp-layout-header imp-layout-header--mobile d-sm-block d-xs-block d-md-none">
	<div class="imp-mobile-icons">
		<div class="imp-logo-aria">
			<a class="navbar-logo header_logo_light" href="<?php echo esc_url(home_url( '/' )); ?>">
				<img alt="<?php echo esc_attr(get_bloginfo('name')); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>"
					class="main-logo" src="<?php echo THEME_DIR_URI. '/src/images/logo.webp'; ?>"/>
			</a>
		</div>
		<div class="sidebar-button">
			<?php IMPCourse::icon_popup_menu('', false); ?>
		</div>
	</div>
</div>
<!-- End Mobile Navbar -->
