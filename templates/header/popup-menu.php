<div id="wkSideNar" class="imp-sidebar-navigation">
	<div class="sidebar-scroll scrollbar-macosx">
		<div class="imp-fullscreen-wrap">
			<div class="imp-close-button close-sidebar-button">
				<a href="#" class="imp-close-sidemenu">
					<span>
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<line x1="18" y1="6" x2="6" y2="18"/>
						<line x1="6" y1="6" x2="18" y2="18"/>
					</svg>
					</span>
				</a>
			</div>
			<nav class="fullscreen-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'fullscreen-menu-wrap') ); ?>
			</nav>
			<?php IMPCourse::icon_language_flags('top_header', false); ?>
		</div>
	</div>
	<div class="sidebar-overlay imp-close-sidemenu"></div>
</div>
