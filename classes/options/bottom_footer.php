<?php
Redux::setSection( $theme_options, array(
	'id' => 'main_sec_bottom_footer',
	'title' => esc_html__('Bottom footer', 'wbkz'),
	'icon' => 'el el-chevron-down',
) );

Redux::setSection( $theme_options, array(
	'id' => 'sec_bottom_footer',
	'title' => esc_html__('Bottom footer settings', 'wbkz'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'bottom_footer',
			'type' => 'switch',
			'title' => esc_html__('Enable this layout part?', 'wbkz'),
			'subtitle' => esc_html__('If on, this layout part will be displayed.', 'wbkz'),
			'default' => 1,
		),

		array(
			'id' => 'bottom_footer_left_cols_sm',
			'type' => 'slider',
			'title' => esc_html__('Left area columns', 'wbkz'),
			'subtitle' => esc_html__('Define columns number of bottom footer left area.', 'wbkz'),
			'default' => '6',
			'min' => '0',
			'step' => '1',
			'max' => '12',
		),

		array(
			'id' => 'bottom_footer_right_cols_sm',
			'type' => 'slider',
			'title' => esc_html__('Right area columns', 'wbkz'),
			'subtitle' => esc_html__('Define columns number of bottom footer right area.', 'wbkz'),
			'default' => '6',
			'min' => '0',
			'step' => '1',
			'max' => '12',
		),

		array(
			'id' => 'bottom_footer_menu',
			'type' => 'switch',
			'title' => esc_html__('Menu', 'wbkz'),
			'subtitle' => esc_html__('If on, menu will be displayed.', 'wbkz'),
			'default' => 1,
		),

		array(
			'id' => 'bottom_footer_text',
			'type' => 'switch',
			'title' => esc_html__('Text module', 'wbkz'),
			'subtitle' => esc_html__('If on, a rich text module will be displayed.', 'wbkz'),
			'default' => 1,
		),

			array(
				'id' => 'bottom_footer_text_content',
				'type' => 'editor',
				'title' => esc_html__('Text module content', 'wbkz'),
				'subtitle' => esc_html__('Place any text to be displayed in bottom footer.', 'wbkz'),
				'default' => 'All rights reserved. Powered by <a href="#">imp Theme</a>.',
				'required' => array('bottom_footer--text', '=', 1),
			),

			array(
				'id' => 'bottom_footer_text_content_ar',
				'type' => 'editor',
				'title' => esc_html__('Text module content AR', 'wbkz'),
				'subtitle' => esc_html__('Place any text to be displayed in bottom footer.', 'wbkz'),
				'default' => 'All rights reserved. Powered by <a href="#">imp Theme</a>.',
			),

		array(
			'id' => 'bottom_footer_social',
			'type' => 'switch',
			'title' => esc_html__('Social module', 'wbkz'),
			'subtitle' => esc_html__('If on, a social icon module will be displayed.', 'wbkz'),
			'default' => 0,
		),

			array(
				'id' => 'bottom_footer_social_links',
				'type' => 'sortable',
				'mode' => 'checkbox',
				'title' => esc_html__('Social links', 'wbkz'),
				'subtitle' => esc_html__('Enable social links to be displayed.', 'wbkz'),
				'options' => self::$social_icons,
				'default' => self::$social_icons_default,
				'required' => array('bottom_footer_social', '=', 1),
			),

		// array(
		// 	'id' => 'bottom_footer--wpml_modules_section',
		// 	'type' => 'section',
		// 	'title' => esc_html__('WPML modules', 'wbkz'),
		// 	'indent' => true,
		// ),
    //
		// 	array(
		// 		'id' => 'bottom_footer--wpml_lang',
		// 		'type' => 'switch',
		// 		'title' => esc_html__('WPML language flags', 'wbkz'),
		// 		'subtitle' => esc_html__('If on, the avaliable languages flags will be displayed. Only works with WPML activated.', 'wbkz'),
		// 		'default' => 0,
		// 	),
    //
		// 	array(
		// 		'id' => 'bottom_footer--wpml_currency',
		// 		'type' => 'switch',
		// 		'title' => esc_html__('WPML shop currencies', 'wbkz'),
		// 		'subtitle' => esc_html__('If on, the avaliable currencies flags will be displayed. Only works with WPML + WooCommerce Multilingual activated.', 'wbkz'),
		// 		'default' => 0,
		// 	),
    //
		// array(
		// 	'id' => 'bottom_footer--wpml_modules_section__end',
		// 	'type' => 'section',
		// 	'indent' => false,
		// ),
	)
) );

Redux::setSection( $theme_options, array(
	'id' => 'sec_bottom_footer_styles',
	'title' => esc_html__('Bottom footer styles', 'wbkz'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'bottom_footer_styles_color_scheme',
			'type' => 'button_set',
			'title' => esc_html__('Color Scheme', 'wbkz'),
			'options' => array(
				'light' => esc_html__('Light', 'wbkz'),
				'dark' => esc_html__('Dark', 'wbkz'),
			),
			'default' => 'light',
		),

		array(
			'id' => 'bottom_footer_styles_first_align',
			'type' => 'button_set',
			'title' => esc_html__('First area align', 'wbkz'),
			'options' => array(
				'left' => esc_html__('Left', 'wbkz'),
				'center' => esc_html__('Center', 'wbkz'),
				'right' => esc_html__('Right', 'wbkz'),
			),
			'default' => 'left',
		),

		array(
			'id' => 'bottom_footer_styles_second_align',
			'type' => 'button_set',
			'title' => esc_html__('Second area align', 'wbkz'),
			'options' => array(
				'left' => esc_html__('Left', 'wbkz'),
				'center' => esc_html__('Center', 'wbkz'),
				'right' => esc_html__('Right', 'wbkz'),
			),
			'default' => 'right',
		),

		array(
			'id' => 'bottom_footer_styles_border',
			'type' => 'border',
			'title' => esc_html__('Bottom footer border', 'wbkz'),
			'subtitle' => esc_html__('Select a custom border to be applied in the bottom footer.', 'wbkz'),
			'all' => false,
			'left' => false,
			'right' => false,
		),

		array(
			'id' => 'bottom_footer_styles_padding',
			'type' => 'spacing',
			'mode' => 'padding',
			'title' => esc_html__('Bottom footer padding', 'wbkz'),
			'units' => 'px',
		),

		array(
			'id' => 'bottom_footer_styles_bg',
			'type' => 'background',
			'title' => esc_html__('Bottom footer background', 'wbkz'),
		),

	)
) );
