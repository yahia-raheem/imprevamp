<?php

add_filter('rwmb_meta_boxes', 'payment_section_function_name');

function payment_section_function_name($meta_boxes)
{
    $prefix_theme   = 'IMP';
    $prefix = '';

    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }

    $meta_boxes[] = [
        'title'           => $prefix_theme . esc_html__(' - Payment - Paymob', 'imp'),
        'id'              => 'payment-section-block',
        'icon'            => 'image-flip-horizontal',
        'category'        => 'imp-blocks',
        'supports'        => [
            'align' => [''],
        ],
        'render_template' => get_template_directory() . '/templates/blocks/payment/payment-template.php',
        'enqueue_style'   => get_stylesheet_directory_uri() . '/dist/assets/css/blocks/payment/payment'.$_RTL.'.css',
        'type'            => 'block',
        'context'         => 'side',
        'fields'          => [
            [
                'name' => __('Paymob iframe link', 'imp'),
                'id'   => $prefix . 'iframe_code',
                'type' => 'text',
            ],
        ],
    ];

    return $meta_boxes;
}