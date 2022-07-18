<?php
add_filter( 'rwmb_meta_boxes', 'imp_courses_list_block' );

function imp_courses_list_block( $meta_boxes ) {
    $prefix = '';
    
    $meta_boxes[] = [
        'title'    => __( 'Courses List Block', 'imp' ),
        'id'       => 'courses-list-block',
        'icon'     => 'book-alt',
        'category' => 'imp-blocks',
        'supports' => [
            'align' => [''],
        ],
        'render_template' => get_template_directory() . '/templates/blocks/courses-list/courses-list-template.php',
        'type'     => 'block',
        'parent'   => ['meta-box/section-title-block'],
        'context'  => 'side',
        'fields'   => [
            [
                'name'              => __( 'Filter Shown Courses', 'imp' ),
                'id'                => $prefix . 'filter_shown_courses',
                'type'              => 'select',
                'label_description' => __( 'Select courses by ', 'imp' ),
                'options'           => [
                    'all'      => __( 'Show All', 'imp' ),
                    'category' => __( 'By Category', 'imp' ),
                    'custom'   => __( 'Custom', 'imp' ),
                ],
                'std'               => 'custom',
                'required'          => true,
            ],
            [
                'name'              => __( 'Courses Categories', 'imp' ),
                'id'                => $prefix . 'taxonomy_advanced_z1yrusenrkn',
                'type'              => 'taxonomy_advanced',
                'label_description' => __( 'Select the categories you want to include', 'imp' ),
                'taxonomy'          => ['course-category'],
                'field_type'        => 'select_advanced',
                'multiple'          => true,
                'visible'           => [
                    'when'     => [['filter_shown_courses', '=', 'category']],
                    'relation' => 'and',
                ],
            ],
            [
                'name'              => __( 'Courses', 'imp' ),
                'id'                => $prefix . 'courses',
                'type'              => 'post',
                'label_description' => __( 'Select Shown Courses', 'imp' ),
                'post_type'         => ['course'],
                'field_type'        => 'select_advanced',
                'multiple'          => true,
                'visible'           => [
                    'when'     => [['filter_shown_courses', '=', 'custom']],
                    'relation' => 'and',
                ],
            ],
            [
                'name'              => __( 'Live-Recorded Filter', 'imp' ),
                'id'                => $prefix . 'live_recorded_filter',
                'type'              => 'select',
                'label_description' => __( 'Filter selected courses by live or recorded', 'imp' ),
                'options'           => [
                    'all'      => __( 'Show All', 'imp' ),
                    'recorded' => __( 'Show Recorded Only', 'imp' ),
                    'live'     => __( 'Show Live Only', 'imp' ),
                ],
                'std'               => 'all',
                'visible'           => [
                    'when'     => [['filter_shown_courses', '=', 'category']],
                    'relation' => 'or',
                ],
            ],
            [
                'name' => __( 'Number of Posts', 'imp' ),
                'id'   => $prefix . 'number_of_posts',
                'type' => 'number',
                'label_description' => __( 'How many posts should be displayed? (leave as -1 to display all courses)', 'imp' ),
                'step' => 1,
                'std'  => -1,
                'visible'           => [
                    'when'     => [['filter_shown_courses', '=', 'category']],
                    'relation' => 'or',
                ],
            ],
        ],
    ];

    return $meta_boxes;
}