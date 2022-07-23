<?php
add_filter('rwmb_meta_boxes', 'imp_banner_section');

function imp_banner_section($meta_boxes)
{
    $prefix = '';

    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }

    $meta_boxes[] = [
        'title'    => __('Banner Section block', 'imp'),
        'icon'     => 'category',
        'category' => 'imp-blocks',
        'id'       => 'imp-banner-block',
        'supports' => [
            'align' => [''],
        ],
        'type'     => 'block',
        'render_template' => get_template_directory() . '/templates/blocks/imp-banner/imp-banner-template.php',
        'enqueue_style'   => get_stylesheet_directory_uri() . '/dist/assets/css/blocks/imp-banner/imp-banner-template' . $_RTL . '.css',
        'context'  => 'side',
        'fields'   => [
            [
                'name' => __('Banner Text', 'imp'),
                'id'   => $prefix . 'banner_text',
                'type' => 'text',
            ],
            [
                'name'   => __('Banner Button', 'imp'),
                'id'     => $prefix . 'banner_button',
                'type'   => 'group',
                'fields' => [
                    [
                        'name' => __('Button Text', 'imp'),
                        'id'   => $prefix . 'button_text',
                        'type' => 'text',
                    ],
                    [
                        'name'              => __('Custom Link', 'imp'),
                        'id'                => $prefix . 'custom_link',
                        'type'              => 'checkbox',
                        'label_description' => __('Use custom link for button?', 'imp'),
                    ],
                    [
                        'name'       => __('Button\'s Post', 'imp'),
                        'id'         => $prefix . 'button_post',
                        'type'       => 'post',
                        'post_type'  => ['post', 'page', 'course', 'instructor', 'lecture'],
                        'field_type' => 'select_advanced',
                        'visible'    => [
                            'when'     => [['custom_link', '=', false]],
                            'relation' => 'or',
                        ],
                    ],
                    [
                        'name'    => __('Custom URL', 'imp'),
                        'id'      => $prefix . 'custom_url',
                        'type'    => 'url',
                        'visible' => [
                            'when'     => [['custom_link', '=', true]],
                            'relation' => 'or',
                        ],
                    ],
                ],
            ],
        ],
    ];

    return $meta_boxes;
}