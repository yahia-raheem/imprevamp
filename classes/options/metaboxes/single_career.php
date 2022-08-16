<?php
$boxSections[] = array(
	'title' => esc_html__('Career', 'wbkz'),
	'desc' => esc_html__('Change career templates and configurations.', 'wbkz'),
	'fields' => array(
		array(
			'id'       		=> 'local_career_type',
			'type'     		=> 'text',
			'title'    		=> esc_html__('Employment type', 'wbkz'),
			'subtitle'    	=> esc_html__('Choose Employment type.', 'wbkz'),
			'desc'     		=> esc_html__('Choose Employment type.', 'wbkz'),
			'placeholder' 	=> 'Click to enter details'
		),
		array(
			'id'       		=> 'local_career_address',
			'type'     		=> 'text',
			'title'    		=> esc_html__('Job Address', 'wbkz'),
			'subtitle'    	=> esc_html__('Choose Job Address.', 'wbkz'),
			'desc'     		=> esc_html__('Choose Job Address.', 'wbkz'),
			'placeholder' 	=> 'Click to enter skills'
		),
		array(
			'id'       		=> 'local_career_link',
			'type'     		=> 'text',
			'title'    		=> esc_html__('Job Url', 'wbkz'),
			'subtitle'    	=> esc_html__('Choose Job Url.', 'wbkz'),
			'desc'     		=> esc_html__('Choose Job Url.', 'wbkz'),
			'placeholder' 	=> 'Click to enter skills'
		),
	)
);
