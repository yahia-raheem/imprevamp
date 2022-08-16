<?php
$boxSections[] = array(
	'title' => esc_html__('Title wrapper', 'wbkz'),
	'desc' => esc_html__('Change the title wrapper section configuration.', 'wbkz'),
	'fields' => array(
		array(
			'id' => 'local_title_wrapper',
			'type' => 'button_set',
			'title' => esc_html__('Enable this layout part?', 'wbkz'),
			'subtitle' => esc_html__('If on, this layout part will be displayed.', 'wbkz'),
			'options' => array(
				'1' => esc_html__('On', 'wbkz'),
				'' => esc_html__('Default', 'wbkz'),
				'0' => esc_html__('Off', 'wbkz'),
			),
			'default' => '',
		),

		
	),
);
