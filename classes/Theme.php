<?php if (!defined('ABSPATH')) die('-1');


class IMPTheme {

	private static $_instance = null;

	protected static $theme = null;

	protected static $theme_prefix = 'imp';

	protected static $theme_dir = null;
	
	protected static $theme_uri = null;

	protected static $theme_options = null;

	protected static $social_icons = null;

	protected static $social_icons_default = array();


	private function __construct() {
		self::$theme = wp_get_theme();

		self::$theme_dir = get_template_directory();
		
		self::$theme_uri = get_template_directory_uri();

		self::$theme_options = self::$theme_prefix . '_options';

		self::$social_icons = array(
			// don't forget to add brand colors in CSS
			'link'          	=> '<i class="fa fa-lg fa-fw fa-link"></i> &nbsp; ' . esc_attr__('Custom Link', 'wbkz'),
			'envelope'      	=> '<i class="fa fa-lg fa-fw fa-envelope"></i> &nbsp; ' . esc_attr__('Mail', 'wbkz'),
			'map'           	=> '<i class="fa fa-lg fa-fw fa-map"></i> &nbsp; ' . esc_attr__('Map', 'wbkz'),
			'map-marker-alt'	=> '<i class="fa fa-lg fa-fw fa-map-marker"></i> &nbsp; ' . esc_attr__('Map marker', 'wbkz'),
			'facebook-f'    	=> '<i class="fa fa-lg fa-fw fa-facebook"></i> &nbsp; ' . esc_attr__('Facebook', 'wbkz'),
			'twitter'       	=> '<i class="fa fa-lg fa-fw fa-twitter"></i> &nbsp; ' . esc_attr__('Twitter', 'wbkz'),
			'instagram'     	=> '<i class="fa fa-lg fa-fw fa-instagram"></i> &nbsp; ' . esc_attr__('Instagram', 'wbkz'),
			'google-plus-g' 	=> '<i class="fa fa-lg fa-fw fa-google-plus"></i> &nbsp; ' . esc_attr__('Google+', 'wbkz'),
			'youtube'       	=> '<i class="fa fa-lg fa-fw fa-youtube"></i> &nbsp; ' . esc_attr__('YouTube', 'wbkz'),
			'tumblr'        	=> '<i class="fa fa-lg fa-fw fa-tumblr"></i> &nbsp; ' . esc_attr__('Tumblr', 'wbkz'),
			'pinterest'     	=> '<i class="fa fa-lg fa-fw fa-pinterest"></i> &nbsp; ' . esc_attr__('Pinterest', 'wbkz'),
			'linkedin-in'      	=> '<i class="fa fa-lg fa-fw fa-linkedin"></i> &nbsp; ' . esc_attr__('LinkedIn', 'wbkz'),
			'dribbble'      	=> '<i class="fa fa-lg fa-fw fa-dribbble"></i> &nbsp; ' . esc_attr__('Dribbble', 'wbkz'),
			'vimeo-v'  				=> '<i class="fa fa-lg fa-fw fa-vimeo-square"></i> &nbsp; ' . esc_attr__('Vimeo', 'wbkz'),
			'whatsapp'      	=> '<i class="fa fa-lg fa-fw fa-whatsapp"></i> &nbsp; ' . esc_attr__('WhatsApp', 'wbkz'),
			'telegram'      	=> '<i class="fa fa-lg fa-fw fa-telegram"></i> &nbsp; ' . esc_attr__('Telegram', 'wbkz'),
			'behance'       	=> '<i class="fa fa-lg fa-fw fa-behance"></i> &nbsp; ' . esc_attr__('Behance', 'wbkz'),
			'flickr'        	=> '<i class="fa fa-lg fa-fw fa-flickr"></i> &nbsp; ' . esc_attr__('Flickr', 'wbkz'),
			'skype'         	=> '<i class="fa fa-lg fa-fw fa-skype"></i> &nbsp; ' . esc_attr__('Skype', 'wbkz'),
			'medium'        	=> '<i class="fa fa-lg fa-fw fa-medium"></i> &nbsp; ' . esc_attr__('Medium', 'wbkz'),
			'vk'            	=> '<i class="fa fa-lg fa-fw fa-vk"></i> &nbsp; ' . esc_attr__('VK', 'wbkz'),
			'odnoklassniki' 	=> '<i class="fa fa-lg fa-fw fa-odnoklassniki"></i> &nbsp; ' . esc_attr__('Odnoklassniki', 'wbkz'),
			'foursquare'    	=> '<i class="fa fa-lg fa-fw fa-foursquare"></i> &nbsp; ' . esc_attr__('FourSquare', 'wbkz'),
			'wordpress'     	=> '<i class="fa fa-lg fa-fw fa-wordpress"></i> &nbsp; ' . esc_attr__('WordPress', 'wbkz'),
			'stumbleupon'   	=> '<i class="fa fa-lg fa-fw fa-stumbleupon"></i> &nbsp; ' . esc_attr__('StumbleUpon', 'wbkz'),
			'soundcloud'    	=> '<i class="fa fa-lg fa-fw fa-soundcloud"></i> &nbsp; ' . esc_attr__('SoundCloud', 'wbkz'),
			'vine'          	=> '<i class="fa fa-lg fa-fw fa-vine"></i> &nbsp; ' . esc_attr__('Vine', 'wbkz'),
			'github'        	=> '<i class="fa fa-lg fa-fw fa-github"></i> &nbsp; ' . esc_attr__('GitHub', 'wbkz'),
			'bitbucket'     	=> '<i class="fa fa-lg fa-fw fa-bitbucket"></i> &nbsp; ' . esc_attr__('Bitbucket', 'wbkz'),
			'twitch'        	=> '<i class="fa fa-lg fa-fw fa-twitch"></i> &nbsp; ' . esc_attr__('Twitch', 'wbkz'),
			'weibo'         	=> '<i class="fa fa-lg fa-fw fa-weibo"></i> &nbsp; ' . esc_attr__('Weibo', 'wbkz'),
			'tencent-weibo' 	=> '<i class="fa fa-lg fa-fw fa-tencent-weibo"></i> &nbsp; ' . esc_attr__('Tecent Weibo', 'wbkz'),
			'renren'        	=> '<i class="fa fa-lg fa-fw fa-renren"></i> &nbsp; ' . esc_attr__('RenRen', 'wbkz'),
			'xing'          	=> '<i class="fa fa-lg fa-fw fa-xing"></i> &nbsp; ' . esc_attr__('Xing', 'wbkz'),
			'tripadvisor' 		=> '<i class="fa fa-lg fa-fw fa-tripadvisor"></i> &nbsp; ' . esc_attr__('TripAdvisor', 'wbkz'),
		);

		foreach (self::$social_icons as $id => $icon_and_name) {
			self::$social_icons_default[$id] = false;
		}
		
		add_filter( 'body_class', array($this, 'body_class'));

	}

	public static function init() {
		if(is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	protected static function get_option($option, $local_prefix = true) {
		if (empty($option)) {
			return false;
		}

		$options = $GLOBALS[self::$theme_options];

		$value = false;

		if (isset($options[$option]) && $options[$option] != '') {
			$value = $options[$option];
		}

		$post_type = get_post_type();
		$single_option_name = 'single_'.$post_type.'--'.$option;
		$archive_option_name = $post_type.'s--'.$option;
		$search_option_name = 'search--'.$option;

		if (is_singular()) {

			if (isset($options[$single_option_name])) {
				$_value = $options[$single_option_name];

				if (is_array($_value)) {
					unset($_value['media']);
					unset($_value['google']);
					unset($_value['border-style']);
					foreach ($_value as $key => $item) {
						if ($item != '' && $item != 'px') {
							$value[$key] = $item;
						}
					}
					return $value;
				}

				if ($_value != '' && $_value != null) {
					$value = $_value;
				}
			}

			if (function_exists('redux_post_meta')) {
				$prefix = '';
				if ($local_prefix) {
					$prefix = 'local_';
				}
				$metaboxes = redux_post_meta(self::$theme_options, get_the_ID());
				if (isset($metaboxes[$prefix . $option])) {
					$_value = $metaboxes[$prefix . $option];

					if (is_array($_value)) {
						unset($_value['media']);
						unset($_value['google']);
						unset($_value['border-style']);
						foreach ($_value as $key => $item) {
							if ($item != '' && $item != 'px') {
								$value[$key] = $item;
							}
						}
						return $value;
					}

					if ($_value != '' && $_value != null) {
						$value = $_value;
					}
				}
			}

		} elseif (!is_search() && isset($options[$archive_option_name])) {

			$_value = $options[$archive_option_name];

			if (is_array($_value)) {
				unset($_value['media']);
				unset($_value['google']);
				foreach ($_value as $key => $item) {
					if ($item != '') {
						$value[$key] = $item;
					}
				}
				return $value;
			}

			if ($_value != '' && $_value != null) {
				$value = $_value;
			}

		} elseif (is_search() && isset($options[$search_option_name])) {

			$_value = $options[$search_option_name];

			if (is_array($_value)) {
				unset($_value['media']);
				unset($_value['google']);
				foreach ($_value as $key => $item) {
					if ($item != '') {
						$value[$key] = $item;
					}
				}
				return $value;
			}

			if ($_value != '' && $_value != null) {
				$value = $_value;
			}

		}

		return $value;
	}

	public function body_class($classes) {
		$classes[] = 'imp_imp';
		return $classes;
  	}

}

IMPTheme::init();
