<?php
// Redux::setSection( $theme_options, array(
// 	'id' => 'main_sec_content',
// 	'title' => esc_html__('Content', 'wbkz'),
// 	'icon' => 'el el-align-left',
// ) );


Redux::setSection( $theme_options, array(
	'id' => 'main_sec_content',
	'title' => esc_html__('Content settings', 'wbkz'),
	'icon' => 'ti ti-layout-accordion-merged',
	'fields' => array(
		array(
			'id' => 'header--social_links',
			'type' => 'sortable',
			'mode' => 'checkbox',
			'title' => esc_html__('Social links', 'cps'),
			'subtitle' => esc_html__('Enable social links to be displayed.', 'cps'),
			'options' => self::$social_icons,
			'default' => self::$social_icons_default,
		),
		array(
			'id' => 'content_styles_padding',
			'type' => 'spacing',	
			'mode' => 'padding',
			'title' => esc_html__('Content padding', 'wbkz'),
			'right' => false,
			'left' => false,
			'units' => 'px',
		),

		array(
			'id' => 'content_styles_bg',
			'type' => 'background',
			'title' => esc_html__('Content background', 'wbkz'),
		),
	)
) );
