<?php
add_filter( 'rwmb_meta_boxes', 'imp_clients_block' );

function imp_clients_block( $meta_boxes ) {
    $prefix = '';

    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }

    $meta_boxes[] = [
        'title'    => __( 'clients slider block', 'imp' ),
        'id'       => 'clients-slider-block',
        'icon'     => 'lightbulb',
        'category' => 'imp-blocks',
        'supports' => [
            'align' => [''],
        ],
        'render_template' => get_template_directory() . '/templates/blocks/clients-slider/clients-slider-template.php',
        'enqueue_style'   => get_stylesheet_directory_uri() . '/dist/assets/css/blocks/clients-slider/clients-slider-template' . $_RTL . '.css',
        'type'     => 'block',
        'context'  => 'side',
        'fields'   => [
            [
                'name' => __( 'Block\'s Title', 'imp' ),
                'id'   => $prefix . 'block_title',
                'type' => 'wysiwyg',
            ],
            [
                'name'             => __( 'Clients', 'imp' ),
                'id'               => $prefix . 'clients',
                'type'             => 'image_advanced',
                'max_file_uploads' => 12,
            ],
        ],
    ];

    return $meta_boxes;
}