<?php if (!defined('ABSPATH')) die('-1');


class IMPOptions extends IMPTheme {


	private static $_instance = null;

	private static $default = array(
		'general_styles_primary' => '#166eff',
		'enable_header' => 1,
		'header_layout'  =>  'style1',
		'header_color_scheme'  =>  'header_light',
		'header--search'  => 1,
		'posts_layout_template'  => 'standard-post',

		'title_wrapper'  => 4,
		'title_wrapper_layout'  => 'style2',
		'title_wrapper_color_scheme'  => 'dark',
		'title_wrapper_text_align'  => 'text-center',
		
		'products_layout'  => 'style1',

		'layout_sidebars'  	     => 'right',
		'posts_layout_sidebars'  => 'right',
		'layout--sidebars'  	 => 'right',
		'single_post_nav'  	 	 => 1,

		'footer'  =>  1,
		'footer_col_1' => '3',
		'footer_col_2' => '3',
		'footer_col_3' => '3',
		'footer_col_4' => '3',
		'top_footer_styles_color_scheme' => 'dark',
		'bottom_footer'  => 1,
		'footer_layout'  => 'style1',
		'bottom_footer_left_cols_sm'  => 12,
		'bottom_footer_text_content'  => '© 2021 imp Theme. Made with love.',
		'bottom_footer_text_content_left'  => '© 2021 imp Theme. Made with love.',
		'bottom_footer_text_left'  => 1,
		'footer_copyright_left'  => 1,
		'bottom_footer_styles_second_align'  => 'text-center',
		'bottom_footer_styles_first_align'  => 'text-center',
	);


	private function __construct() {
		if (!class_exists('Redux')) {
			global ${self::$theme_options};
			${self::$theme_options} = self::$default;
			return;
		}

		add_action('redux/metaboxes/' . self::$theme_options . '/boxes', array($this, 'metaboxes'));

		add_action('after_setup_theme', array($this, 'after_setup_theme')); // before Setup and Shop
	}


	public function after_setup_theme() {
		Redux::setArgs(self::$theme_options, self::settings());
		self::sections();
		Redux::init(self::$theme_options);
	}


	public static function init() {
		if(is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	private function settings() {
		return array(
			// TYPICAL -> Change these values as you need/desire
			'opt_name'             => self::$theme_options,
			// This is where your data is stored in the database and also becomes your global variable name.
			'display_name'         => self::$theme->get('Name'),
			// Name that appears at the top of your panel
			'display_version'      => self::$theme->get('Version'),
			// Version that appears at the top of your panel
			'menu_type'            => 'menu',
			//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
			'allow_sub_menu'       => true,
			// Show the sections below the admin menu item or not
			'menu_title'           => esc_html__('Theme options', 'imp'),
			'page_title'           => esc_html__('Theme options', 'imp'),
			// You will need to generate a Google API key to use this feature.
			// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
			'google_api_key'       => 'AIzaSyAE2vi1BKhb-fnoRAkDHZNe30kBoEzgKDA',
			// Set it you want google fonts to update weekly. A google_api_key value is required.
			'google_update_weekly' => true,
			// Must be defined to add google fonts to the typography module
			'async_typography'     => true,
			// Use a asynchronous font on the front end or font string
			//'disable_google_fonts_link' => true, // Disable this in case you want to create your own google fonts loader
			'admin_bar'            => true,
			// Show the panel pages on the admin bar
			'admin_bar_icon'       => 'dashicons-portfolio',
			// Choose an icon for the admin bar menu
			'admin_bar_priority'   => 50,
			// Choose an priority for the admin bar menu
			'global_variable'      => '',
			// Set a different name for your global variable other than the opt_name
			'dev_mode'             => false,
			// Show the time the page took to load, etc
			'update_notice'        => false,
			// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
			'customizer'           => true,
			// Enable basic customizer support
			//'open_expanded'     => true, // Allow you to start the panel in an expanded way initially.
			//'disable_save_warn' => true, // Disable the save warning when a user changes a field

			// OPTIONAL -> Give you extra features
			'page_priority'        => null,
			// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
			'page_parent'          => 'themes.php',
			// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
			'page_permissions'     => 'manage_options',
			// Permissions needed to access the options panel.
			'menu_icon'            => '',
			// Specify a custom URL to an icon
			'last_tab'             => '',
			// Force your panel to always open to a specific tab (by id)
			'page_icon'            => 'icon-themes',
			// Icon displayed in the admin panel next to your menu_title
			'page_slug'            => '',
			// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
			'save_defaults'        => true,
			// On load save the defaults to DB before user clicks save or not
			'default_show'         => false,
			// If true, shows the default value next to each field that is not the default value.
			'default_mark'         => '',
			// What to print by the field's title if the value shown is default. Suggested: *
			'show_import_export'   => true,
			// Shows the Import/Export panel when not used as a field.

			// CAREFUL -> These options are for advanced use only
			'transient_time'       => 60 * MINUTE_IN_SECONDS,
			'output'               => true,
			// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
			'output_tag'           => true,
			// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
			// 'footer_credit'     => '', // Disable the footer credit of Redux. Please leave if you can help it.

			// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
			'database'             => '',
			// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
			'system_info'          => false,
		);
	}


	private function sections() {
		$theme_options = self::$theme_options;

		include self::$theme_dir . '/classes/options/content.php';

		include self::$theme_dir . '/classes/options/title_wrapper.php';
		include self::$theme_dir . '/classes/options/footer.php';

		include self::$theme_dir . '/classes/options/social.php';
		include self::$theme_dir . '/classes/options/custom.php';
	}


	public function metaboxes($metaboxes) {
		$boxSections = array();
		$metaboxes = array();

		include self::$theme_dir . '/classes/options/metaboxes/title_wrapper.php';
		include self::$theme_dir . '/classes/options/metaboxes/custom.php';

		$metaboxes[] = array(
			'id' => 'page-theme-options',
			'title' => esc_html__('Page options', 'imp'),
			'post_types' => array('page'),
			'position' => 'normal',
			'priority' => 'high',
			'sections' => $boxSections,
		);

		include self::$theme_dir . '/classes/options/metaboxes/single_post.php';
		$metaboxes[] = array(
			'id' => 'post-theme-options',
			'title' => esc_html__('Page options', 'imp'),
			'post_types' => array('post'),
			'position' => 'normal',
			'priority' => 'high',
			'sections' => $boxSections,
		);
		array_pop($boxSections); // delete single post options

		include self::$theme_dir . '/classes/options/metaboxes/single_team.php';
		$metaboxes[] = array(
			'id' => 'team-theme-options',
			'title' => esc_html__('Team options', 'imp'),
			'post_types' => array('team'),
			'position' => 'normal',
			'priority' => 'high',
			'sections' => $boxSections,
		);
		array_pop($boxSections); // delete single post options
		
		include self::$theme_dir . '/classes/options/metaboxes/single_career.php';
		$metaboxes[] = array(
			'id' => 'career-theme-options',
			'title' => esc_html__('Course options', 'imp'),
			'post_types' => array('course'),
			'position' => 'normal',
			'priority' => 'high',
			'sections' => $boxSections,
		);
		array_pop($boxSections); // delete single post options

		$metaboxes = apply_filters('redux_ext__metaboxes_filter', $metaboxes);

		return $metaboxes;
	}

	public static function get($option) {
		return self::get_option($option);
	}


	public static function get_metaboxes_option($option) {
		if (!empty($option) && function_exists('redux_post_meta')) {
			return redux_post_meta(self::$theme_options, get_the_ID(), $option);
		}
		return false;
	}


}

IMPOptions::init();
