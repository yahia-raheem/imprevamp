<?php

add_filter('rwmb_meta_boxes', 'accordion_section_function_name');

function accordion_section_function_name($meta_boxes)
{
    $prefix_theme   = 'IMP';
    $prefix = '';

    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }

    $meta_boxes[] = [
        'title'           => $prefix_theme . esc_html__(' - Accordion', 'imp'),
        'id'              => 'accordion-section-block',
        'icon'            => 'align-full-width',
        'category'        => 'theme',
        'supports'        => [
            'align'           => ['left'],
            'customClassName' => true,
        ],
        'parent'   => ['meta-box/course-tabs-block'],
        'render_template' => get_template_directory() . '/framework/blocks/accordion/accordion-template.php',
        'enqueue_style'   => get_stylesheet_directory_uri() . '/dist/assets/css/blocks/accordion/accordion'.$_RTL.'.css',
        'type'            => 'block',
        'context'         => 'side',
        'fields'          => [
            [
                'name'        => __('Accordion', 'imp'),
                'id'          => 'accordions',
                'type'        => 'group',
                'collapsible' => true,
                'group_title' => '{#}',
                'clone'       => true,
                'sort_clone'  => true,
                'fields'      => [
                    [
                        'name' => __('Title', 'imp'),
                        'id'   => $prefix . 'title',
                        'type' => 'wysiwyg',
                    ],
                    [
                        'name' => __('Description', 'imp'),
                        'id'   => $prefix . 'description',
                        'type' => 'wysiwyg',
                    ],
                ],
            ],
        ],
    ];

    return $meta_boxes;
}