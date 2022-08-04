<?php
add_filter( 'rwmb_meta_boxes', 'imp_course_sidebar' );

function imp_course_sidebar( $meta_boxes ) {
    $prefix = '';

    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }

    $meta_boxes[] = [
        'title'    => __( 'Course Sidebar', 'imp' ),
        'id'       => 'course-sidebar-block',
        'icon'     => 'table-col-before',
        'category' => 'imp-blocks',
        'supports' => [
            'align' => [''],
        ],
        'type'     => 'block',
        'render_template' => get_template_directory() . '/templates/blocks/course-sidebar/course-sidebar-template.php',
        'enqueue_style'   => get_stylesheet_directory_uri() . '/dist/assets/css/blocks/course-sidebar/course-sidebar-template' . $_RTL . '.css',
        'context'  => 'side',
        'fields'   => [
            [
                'name'              => __( 'Detect from post', 'imp' ),
                'id'                => $prefix . 'detect_from_post',
                'type'              => 'checkbox',
                'label_description' => __( 'Do you want to detect the current course automatically?', 'imp' ),
            ],
            [
                'name'              => __( 'Course', 'imp' ),
                'id'                => $prefix . 'course',
                'type'              => 'post',
                'label_description' => __( 'Which course should we use', 'imp' ),
                'post_type'         => ['course'],
                'field_type'        => 'select_advanced',
                'visible'           => [
                    'when'     => [['detect_from_post', '=', false]],
                    'relation' => 'or',
                ],
            ],
        ],
    ];

    return $meta_boxes;
}