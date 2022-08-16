<?php
$boxSections[] = array(
	'title' => esc_html__('Posts', 'wbkz'),
	'desc' => esc_html__('Change posts templates and configurations.', 'wbkz'),
	'fields' => array(
		array(
			'id'       => 'pdf-media',
			'type'     => 'text',
			'title'    => __('PDF Link', 'wbkz'),
			'desc'     => __('Please Add your PDF link here.', 'wbkz'),
			'validate' => 'url',
		),
	)
);
