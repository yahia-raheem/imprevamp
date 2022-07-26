<?php
add_filter('rwmb_meta_boxes', 'imp_content_block');

function imp_content_block($meta_boxes)
{
    $prefix = '';

    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }

    $meta_boxes[] = [
        'title'    => __('IMP content Block', 'imp'),
        'icon'     => 'editor-aligncenter',
        'id'       => 'imp-content-block',
        'category' => 'imp-blocks',
        'supports' => [
            'align' => [''],
        ],
        'render_template' => get_template_directory() . '/templates/blocks/imp-content/imp-content-template.php',
        'enqueue_style'   => get_stylesheet_directory_uri() . '/dist/assets/css/blocks/imp-content/imp-content-template' . $_RTL . '.css',
        'type'     => 'block',
        'context'  => 'side',
        'fields'   => [
            [
                'name' => __('Padding Top', 'imp'),
                'id'   => $prefix . 'padding_top',
                'type' => 'number',
            ],
            [
                'name' => __('Padding Bottom', 'imp'),
                'id'   => $prefix . 'padding_bottom',
                'type' => 'number',
            ],
            [
                'name' => __('Background Color', 'imp'),
                'id'   => $prefix . 'background_color',
                'type' => 'color',
                'label_description' => __('Input #fea203 for primary theme color and #21225F for theme dark blue and #f6f8fa for light grey', 'your-text-domain'),
            ],
        ],
    ];

    return $meta_boxes;
}