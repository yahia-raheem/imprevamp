<?php
Redux::setSection( $theme_options, array(
	'id' => 'main_sec_footer',
	'title' => esc_html__('Footer', 'wbkz'),
	'icon' => 'ti ti-layout-media-overlay-alt',
) );

//General setting
Redux::setSection( $theme_options, array(
	'id' => 'sec_footer_general',
	'title' => esc_html__('General setting', 'wbkz'),
	'subsection' => true,
	'fields' => array(
		// array(
		// 'id'          => 'footer_layout',
		// 'type'        => 'image_select',
		// 'title'       => esc_html__('Layout Footer Style', 'wbkz'),
		// 'subtitle'    => esc_html__('Select Footer Style from 3 unique style.', 'wbkz'),
		// 'options'     => array(
		// 	'style1'  		 =>  array(
		// 		'alt'   => 'Footer Style 1',
		// 		'img'   => THEME_DIR_URI.'/assets/images/admin-img/post/post-1.png'
		// 	),
		// 	'style2'  		 =>  array(
		// 		'alt'   => 'Footer Style 2',
		// 		'img'   => THEME_DIR_URI.'/assets/images/admin-img/post/post-2.png'
		// 	),
		// 	'style3'  		 =>  array(
		// 		'alt'   => 'Footer Style 3',
		// 		'img'   => THEME_DIR_URI.'/assets/images/admin-img/post/post-3.png'
		// 	),
		// ),
		// 'default'     => 'style1',
		// ),

		array(
			'id' => 'footer_fixed',
			'type' => 'switch',
			'title' => esc_html__('Fixed footer', 'wbkz'),
			'subtitle' => esc_html__('If on, footer and bottom footer will be fixed at screen bottom on page scroll.', 'wbkz'),
			'default' => 0,
		),

		array(
			'id' => 'footer_wide',
			'type' => 'switch',
			'title' => esc_html__('Wide footer', 'wbkz'),
			'subtitle' => esc_html__('If on, footer and bottom footer will be fixed at screen bottom on page scroll.', 'wbkz'),
			'default' => 0,
		),
	)
) );

//Top Footer setting
Redux::setSection( $theme_options, array(
	'id' => 'sec_footer_top',
	'title' => esc_html__('Top Footer settings', 'wbkz'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'footer',
			'type' => 'switch',
			'title' => esc_html__('Enable this layout part?', 'wbkz'),
			'subtitle' => esc_html__('If on, this layout part will be displayed.', 'wbkz'),
			'default' => 0,
		),

		array(
			'id' => 'top_footer_styles_color_scheme',
			'type' => 'button_set',
			'title' => esc_html__('Color Scheme', 'wbkz'),
			'options' => array(
				'light' => esc_html__('Light', 'wbkz'),
				'dark' => esc_html__('Dark', 'wbkz'),
			),
			'default' => 'light',
		),

		array(
			'id' => 'footer_col_1',
			'type' => 'slider',
			'title' => esc_html__('#1 column width', 'wbkz'),
			'subtitle' => esc_html__('Define column width, max is 12 parts, set as 0 to disable this area.', 'wbkz'),
			'default' => '3',
			'min' => '0',
			'step' => '1',
			'max' => '12',
		),

		array(
			'id' => 'footer_col_2',
			'type' => 'slider',
			'title' => esc_html__('#2 column width', 'wbkz'),
			'subtitle' => esc_html__('Define column width, max is 12 parts, set as 0 to disable this area.', 'wbkz'),
			'default' => '3',
			'min' => '0',
			'step' => '1',
			'max' => '12',
		),

		array(
			'id' => 'footer_col_3',
			'type' => 'slider',
			'title' => esc_html__('#3 column width', 'wbkz'),
			'subtitle' => esc_html__('Define column width, max is 12 parts, set as 0 to disable this area.', 'wbkz'),
			'default' => '3',
			'min' => '0',
			'step' => '1',
			'max' => '12',
		),

		array(
			'id' => 'footer_col_4',
			'type' => 'slider',
			'title' => esc_html__('#4 column width', 'wbkz'),
			'subtitle' => esc_html__('Define column width, max is 12 parts, set as 0 to disable this area.', 'wbkz'),
			'default' => '3',
			'min' => '0',
			'step' => '1',
			'max' => '12',
		),

		array(
			'id' => 'footer_col_5',
			'type' => 'slider',
			'title' => esc_html__('#5 column width', 'wbkz'),
			'subtitle' => esc_html__('Define column width, max is 12 parts, set as 0 to disable this area.', 'wbkz'),
			'default' => '0',
			'min' => '0',
			'step' => '1',
			'max' => '12',
		),

		array(
			'id' => 'footer_col_6',
			'type' => 'slider',
			'title' => esc_html__('#6 column width', 'wbkz'),
			'subtitle' => esc_html__('Define column width, max is 12 parts, set as 0 to disable this area.', 'wbkz'),
			'default' => '0',
			'min' => '0',
			'step' => '1',
			'max' => '12',
		),
	)
) );
//Top Footer Style setting
Redux::setSection( $theme_options, array(
	'id' => 'sec_footer_styles',
	'title' => esc_html__('Top Footer styles', 'wbkz'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'footer_styles_top_padding',
			'type' => 'spacing',
			'mode' => 'padding',
			'title' => esc_html__('Top Footer padding', 'wbkz'),
			'units' => 'px',
		),

		array(
			'id' => 'footer_styles_top_border',
			'type' => 'border',
			'title' => esc_html__('Top Footer border', 'wbkz'),
			'subtitle' => esc_html__('Select a custom border to be applied in the footer.', 'wbkz'),
			'all' => false,
			'left' => false,
			'right' => false,
		),

		array(
			'id' => 'footer_styles_top_bg',
			'type' => 'background',
			'title' => esc_html__('Top Footer background', 'wbkz'),
		),
	)
) );

//Bottom Footer setting
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
			'id' => 'footer_left_start',
			'type' => 'section',
			'title' => esc_html__('Footer Left Area', 'wbkz'),
			'subtitle' => esc_html__('In this section you can find Footer Left Area.', 'wbkz'),
			'indent' => true 
		),
		array(
			'id' => 'bottom_footer_left_cols_sm',
			'type' => 'slider',
			'title' => esc_html__('Left area columns', 'wbkz'),
			'subtitle' => esc_html__('Define columns number of bottom footer left area.', 'wbkz'),
			'default' => '4',
			'min' => '0',
			'step' => '1',
			'max' => '12',
		),
		//bottom_footer_left_cols_sm
			array(
				'id' => 'bottom_footer_menu_left',
				'type' => 'switch',
				'title' => esc_html__('Menu', 'wbkz'),
				'subtitle' => esc_html__('If on, menu will be displayed.', 'wbkz'),
				'default' => 1,
			),

			array(
				'id' => 'bottom_footer_text_left',
				'type' => 'switch',
				'title' => esc_html__('Text module', 'wbkz'),
				'subtitle' => esc_html__('If on, a rich text module will be displayed.', 'wbkz'),
				'default' => 0,
			),
				
			array(
				'id' => 'bottom_footer_social_left',
				'type' => 'switch',
				'title' => esc_html__('Social module', 'wbkz'),
				'subtitle' => esc_html__('If on, a social icon module will be displayed.', 'wbkz'),
				'default' => 0,
			),

		array(
			'id' => 'footer_center_start',
			'type' => 'section',
			'title' => esc_html__('Footer Center Area', 'wbkz'),
			'subtitle' => esc_html__('In this section you can find Footer Center Area.', 'wbkz'),
			'indent' => true 
		),
		//bottom_footer_center_cols_sm		
		array(
			'id' => 'bottom_footer_center_cols_sm',
			'type' => 'slider',
			'title' => esc_html__('Center area columns', 'wbkz'),
			'subtitle' => esc_html__('Define columns number of bottom footer center area.', 'wbkz'),
			'default' => '4',
			'min' => '0',
			'step' => '1',
			'max' => '12',
		),
			array(
				'id' => 'bottom_footer_menu_center',
				'type' => 'switch',
				'title' => esc_html__('Menu', 'wbkz'),
				'subtitle' => esc_html__('If on, menu will be displayed.', 'wbkz'),
				'default' => 0,
			),


			array(
				'id' => 'bottom_footer_text_center',
				'type' => 'switch',
				'title' => esc_html__('Text module', 'wbkz'),
				'subtitle' => esc_html__('If on, a rich text module will be displayed.', 'wbkz'),
				'default' => 0,
			),
	
			array(
				'id' => 'bottom_footer_social_center',
				'type' => 'switch',
				'title' => esc_html__('Social module', 'wbkz'),
				'subtitle' => esc_html__('If on, a social icon module will be displayed.', 'wbkz'),
				'default' => 1,
			),

		array(
			'id' => 'footer_right_start',
			'type' => 'section',
			'title' => esc_html__('Footer Right Area', 'wbkz'),
			'subtitle' => esc_html__('In this section you can find Footer Right Area.', 'wbkz'),
			'indent' => true 
		),		
			//bottom_footer_right_cols_sm
			array(
				'id' => 'bottom_footer_right_cols_sm',
				'type' => 'slider',
				'title' => esc_html__('Right area columns', 'wbkz'),
				'subtitle' => esc_html__('Define columns number of bottom footer right area.', 'wbkz'),
				'default' => '4',
				'min' => '0',
				'step' => '1',
				'max' => '12',
			),

			array(
				'id' => 'bottom_footer_menu_right',
				'type' => 'switch',
				'title' => esc_html__('Menu', 'wbkz'),
				'subtitle' => esc_html__('If on, menu will be displayed.', 'wbkz'),
				'default' => 0,
			),


			array(
				'id' => 'bottom_footer_text_right',
				'type' => 'switch',
				'title' => esc_html__('Text module', 'wbkz'),
				'subtitle' => esc_html__('If on, a rich text module will be displayed.', 'wbkz'),
				'default' => 0,
			),

			array(
				'id' => 'bottom_footer_social_right',
				'type' => 'switch',
				'title' => esc_html__('Social module', 'wbkz'),
				'subtitle' => esc_html__('If on, a social icon module will be displayed.', 'wbkz'),
				'default' => 0,
			),
		array(
			'id' => 'footer_option_start',
			'type' => 'section',
			'title' => esc_html__('Footer Value Area', 'wbkz'),
			'subtitle' => esc_html__('In this section you can find Footer Center Area.', 'wbkz'),
			'indent' => true 
		),
		array(
			'id' => 'bottom_footer_menu_name',
			'type' => 'select',
			'title' => esc_html__('Bottom Footer menu', 'wbkz'),
			'desc' => esc_html__('Select a menu to overwrite the Bottom Footer menu location.', 'wbkz'),
			'data' => 'menus',
			'default' => '',
		),
		array(
			'id' => 'bottom_footer_text_content',
			'type' => 'editor',
			'title' => esc_html__('Text module content', 'wbkz'),
			'subtitle' => esc_html__('Place any text to be displayed in bottom footer.', 'wbkz'),
			'default' => '© 2021 WBKZ Theme. Made with love.',
		),
		array(
			'id' => 'bottom_footer_text_content_ar',
			'type' => 'editor',
			'title' => esc_html__('Text module content AR', 'wbkz'),
			'subtitle' => esc_html__('Place any text to be displayed in bottom footer.', 'wbkz'),
			'default' => 'All rights reserved. Powered by <a href="http://web-keyz.com/">Webkeyz Theme</a>.',
		),
		array(
			'id' => 'bottom_footer_social_links',
			'type' => 'sortable',
			'mode' => 'checkbox',
			'title' => esc_html__('Social links', 'wbkz'),
			'subtitle' => esc_html__('Enable social links to be displayed.', 'wbkz'),
			'options' => self::$social_icons,
			'default' => self::$social_icons_default,
		),
	)
) );
//Bottom Footer Style setting
Redux::setSection( $theme_options, array(
	'id' => 'sec_bottom_footer_styles',
	'title' => esc_html__('Bottom footer styles', 'wbkz'),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'bottom_footer_styles_first_align',
			'type' => 'button_set',
			'title' => esc_html__('Left area align', 'wbkz'),
			'options' => array(
				'text-start' => esc_html__('Left', 'wbkz'),
				'text-center' => esc_html__('Center', 'wbkz'),
				'text-end' => esc_html__('Right', 'wbkz'),
			),
			'default' => 'text-start',
		),

		array(
			'id' => 'bottom_footer_styles_center_align',
			'type' => 'button_set',
			'title' => esc_html__('Center area align', 'wbkz'),
			'options' => array(
				'text-start' => esc_html__('Left', 'wbkz'),
				'text-center' => esc_html__('Center', 'wbkz'),
				'text-end' => esc_html__('Right', 'wbkz'),
			),
			'default' => 'text-center',
		),

		array(
			'id' => 'bottom_footer_styles_second_align',
			'type' => 'button_set',
			'title' => esc_html__('Right area align', 'wbkz'),
			'options' => array(
				'text-start' => esc_html__('Left', 'wbkz'),
				'text-center' => esc_html__('Center', 'wbkz'),
				'text-end' => esc_html__('Right', 'wbkz'),
			),
			'default' => 'text-end',
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
