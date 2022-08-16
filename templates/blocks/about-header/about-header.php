<?php
add_filter( 'rwmb_meta_boxes', 'imp_about_header' );

function imp_about_header( $meta_boxes ) {
    $prefix = '';

    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }

    $meta_boxes[] = [
        'title'    => __( 'about header', 'imp' ),
        'id'       => 'about-header',
        'icon'     => 'table-col-before',
        'category' => 'imp-blocks',
        'supports' => [
            'align' => [''],
        ],
        'type'     => 'block',
        'render_template' => get_template_directory() . '/templates/blocks/about-header/about-header-template.php',
        'enqueue_style'   => get_stylesheet_directory_uri() . '/dist/assets/css/blocks/about-header/about-header-template' . $_RTL . '.css',
        'context'  => 'side',
        'fields'   => [
            [
                'name' => __( 'Block image', 'imp' ),
                'id'   => $prefix . 'block_image',
                'type' => 'single_image',
            ],
            [
                'name' => __( 'Prefix', 'imp' ),
                'id'   => $prefix . 'prefix',
                'type' => 'text',
            ],
            [
                'name' => __( 'Title', 'imp' ),
                'id'   => $prefix . 'title',
                'type' => 'text',
            ],
            [
                'name' => __( 'Description', 'imp' ),
                'id'   => $prefix . 'description',
                'type' => 'textarea',
            ],
            [
                'name'       => __( 'Bullet point', 'imp' ),
                'id'         => $prefix . 'bullet_point',
                'type'       => 'text',
                'clone'      => true,
                'sort_clone' => true,
            ],
            [
                'name'   => __( 'Button', 'imp' ),
                'id'     => $prefix . 'button',
                'type'   => 'group',
                'fields' => [
                    [
                        'name' => __( 'Use custom link', 'imp' ),
                        'id'   => $prefix . 'use_custom_link',
                        'type' => 'checkbox',
                    ],
                    [
                        'name' => __( 'Text', 'imp' ),
                        'id'   => $prefix . 'text',
                        'type' => 'text',
                    ],
                    [
                        'name'       => __( 'Button\'s post', 'imp' ),
                        'id'         => $prefix . 'button_post',
                        'type'       => 'post',
                        'post_type'  => ['post', 'page', 'course', 'instructor', 'lecture'],
                        'field_type' => 'select_advanced',
                        'visible'    => [
                            'when'     => [['use_custom_link', '=', false]],
                            'relation' => 'or',
                        ],
                    ],
                    [
                        'name'    => __( 'Button\'s custom link', 'imp' ),
                        'id'      => $prefix . 'button_custom_link',
                        'type'    => 'url',
                        'visible' => [
                            'when'     => [['use_custom_link', '=', true]],
                            'relation' => 'or',
                        ],
                    ],
                ],
            ],
        ],
    ];

    return $meta_boxes;
}