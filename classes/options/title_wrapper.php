<?php
Redux::setSection( $theme_options, array(
	'id' => 'main_sec_title_wrapper',
	'title' => esc_html__('Title wrapper', 'wbkz'),
	'icon' => 'ti ti-layout-cta-center',
	'fields' => array(
		array(
			'id' => 'title_wrapper',
			'type' => 'switch',
			'title' => esc_html__('Enable this layout part?', 'wbkz'),
			'subtitle' => esc_html__('If on, this layout part will be displayed.', 'wbkz'),
			'default' => 1,
		),

		array(
			'id' => 'title_wrapper_full_height',
			'type' => 'switch',
			'title' => esc_html__('Full viewport height', 'wbkz'),
			'subtitle' => esc_html__('If on, title wrapper will have same height than viewport/window.', 'wbkz'),
			'default' => 0,
		),

		array(
			'id' => 'title_wrapper--desc',
			'type' => 'switch',
			'title' => esc_html__('Description after title', 'wbkz'),
			'default' => 1,
			'required' => array('title_wrapper--title_and_desc_cols_sm', '!=', 0),
		),

		array(
			'id' => 'title_wrapper_breadcrumb',
			'type' => 'switch',
			'title' => esc_html__('Breadcrumb', 'wbkz'),
			'default' => 1,
		),

		array(
			'id' => 'title_wrapper_text_align',
			'type' => 'button_set',
			'title' => esc_html__('Text align', 'wbkz'),
			'options' => array(
				'text-left' => esc_html__('Left', 'wbkz'),
				'text-center' => esc_html__('Center', 'wbkz'),
				'text-right' => esc_html__('Right', 'wbkz'),
			),
			'default' => 'text-center',
		),

		array(
			'id' => 'title_wrapper_bg',
			'type' => 'background',
			'title' => esc_html__('Title wrapper background', 'wbkz'),
		),

	)
) );
