<?php
add_filter( 'rwmb_meta_boxes', 'imp_categories_overview' );

function imp_categories_overview( $meta_boxes ) {
    $prefix = '';

    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }


    $meta_boxes[] = [
        'title'    => __( 'Categories Overview Block', 'imp' ),
        'id'       => 'categories-overview-block',
        'icon'     => 'admin-customizer',
        'category' => 'imp-blocks',
        'supports' => [
            'align' => [''],
        ],
        'type'     => 'block',
        'parent'   => ['meta-box/section-title-block'],
        'render_template' => get_template_directory() . '/templates/blocks/categories-overview/categories-overview-template.php',
        'enqueue_style'   => get_stylesheet_directory_uri() . '/dist/assets/css/blocks/categories-overview/categories-overview-template' . $_RTL . '.css',
        'context'  => 'side',
        'fields'   => [
            
            [
                'name'              => __( 'course Category', 'imp' ),
                'id'                => $prefix . 'course_category',
                'type'              => 'taxonomy_advanced',
                'label_description' => __( 'Select Multiple categories', 'imp' ),
                'taxonomy'          => ['course-category'],
                'field_type'        => 'select_advanced',
                'multiple'          => true,
                'select_all_none'   => true,
                'query_args'        => [
                    'hide_empty' => true,
                ],
            ],
        ],
    ];

    return $meta_boxes;
}