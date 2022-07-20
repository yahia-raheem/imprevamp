<?php
add_filter( 'rwmb_meta_boxes', 'imp_section_title_block' );

function imp_section_title_block( $meta_boxes ) {
    $prefix = '';

    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }

    $meta_boxes[] = [
        'title'    => __( 'Section Title Block', 'imp' ),
        'icon'     => 'editor-aligncenter',
        'id'       => 'section-title-block',
        'category' => 'imp-blocks',
        'supports' => [
            'align' => [''],
        ],
        'render_template' => get_template_directory() . '/templates/blocks/section-title/section-title-template.php',
        'enqueue_style'   => get_stylesheet_directory_uri() . '/dist/assets/css/blocks/section-title/section-title-template' . $_RTL . '.css',
        'type'     => 'block',
        'context'  => 'side',
        'fields'   => [
            [
                'name' => __( 'Section title', 'imp' ),
                'id'   => $prefix . 'section_title',
                'type' => 'text',
            ],
            [
                'name' => __( 'Section Subtitle', 'imp' ),
                'id'   => $prefix . 'section_subtitle',
                'type' => 'text',
            ],
            [
                'name'       => __( 'Call To Action', 'imp' ),
                'id'         => $prefix . 'call_to_action',
                'type'       => 'post',
                'post_type'  => ['post', 'page', 'course', 'instructor', 'lecture'],
                'field_type' => 'select_advanced',
            ],
            [
                'name'              => __( 'Has Padding Top', 'imp' ),
                'id'                => $prefix . 'has_padding_top',
                'type'              => 'checkbox',
                'label_description' => __( 'Should a 150px padding top be added to the section\'s top and bottom?', 'imp' ),
            ],
            [
                'name'              => __( 'Has Padding Bottom', 'imp' ),
                'id'                => $prefix . 'has_padding_bottom',
                'type'              => 'checkbox',
                'label_description' => __( 'Should a 150px padding bottom be added to the section\'s top and bottom?', 'imp' ),
            ],
        ],
    ];

    return $meta_boxes;
}