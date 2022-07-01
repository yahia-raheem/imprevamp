<?php
add_filter( 'rwmb_meta_boxes', 'imp_home_slider_block' );
function imp_home_slider_block( $meta_boxes ) {
    $prefix = '';

    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }

    $meta_boxes[] = [
        'title'           => __( 'Home Slider', 'imp' ),
        'id'              => 'home-slider',
        'icon'            => 'image-flip-horizontal',
        'category'        => 'imp-blocks',
        'supports'        => [
            'align' => [''],
        ],
        'render_template' => get_template_directory() . '/templates/blocks/home-slider/home-slider-template.php',
        'enqueue_style'   => get_stylesheet_directory_uri() . '/dist/assets/css/blocks/home-slider/home-slider-template' . $_RTL . '.css',
        'type'            => 'block',
        'context'         => 'side',
        'fields'          => [
            [
                'name'       => __( 'Course', 'imp' ),
                'id'         => $prefix . 'hs_course',
                'type'       => 'post',
                'post_type'  => ['course'],
                'field_type' => 'select_advanced',
                'multiple'   => true,
            ],
        ],
    ];

    return $meta_boxes;
}