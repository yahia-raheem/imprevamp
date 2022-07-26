<?php
add_filter( 'rwmb_meta_boxes', 'imp_inner_header' );

function imp_inner_header( $meta_boxes ) {
    $prefix = '';


    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }

    $meta_boxes[] = [
        'title'    => __( 'Inner Header Block', 'imp' ),
        'id'       => 'inner-header-block',
        'icon'     => 'align-full-width',
        'category' => 'imp-blocks',
        'supports' => [
            'align' => [''],
        ],
        'type'     => 'block',
        'render_template' => get_template_directory() . '/templates/blocks/inner-header/inner-header-template.php',
        'enqueue_style'   => get_stylesheet_directory_uri() . '/dist/assets/css/blocks/inner-header/inner-header-template' . $_RTL . '.css',
        'context'  => 'side',
        'fields'   => [
            [
                'name' => __( 'Background Image', 'imp' ),
                'id'   => $prefix . 'background_image',
                'type' => 'single_image',
            ],
        ],
    ];

    return $meta_boxes;
}