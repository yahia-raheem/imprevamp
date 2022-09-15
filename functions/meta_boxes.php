<?php
add_filter('rwmb_meta_boxes', 'imp_course_categories_meta');

function imp_course_categories_meta($meta_boxes)
{
    $prefix = '';

    $meta_boxes[] = [
        'title'      => __('Course Category Custom Fields', 'imp'),
        'id'         => 'course-category-custom-fields',
        'taxonomies' => ['course-category'],
        'fields'     => [
            [
                'name' => __('Font Awesome Category Icon', 'imp'),
                'id'   => $prefix . 'font_awesome_classes',
                'type' => 'text',
                'desc' => __('Add space separated classes for the desired icon from font awesome', 'imp'),
            ],
        ],
    ];

    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'imp_course_meta');

function imp_course_meta($meta_boxes)
{
    $prefix = '';

    $meta_boxes[] = [
        'title'      => __('course settings', 'imp'),
        'id'         => 'course-settings',
        'post_types' => ['course'],
        'context'    => 'side',
        'fields'     => [
            [
                'name' => __('Is Discounted', 'imp'),
                'id'   => $prefix . 'is_discounted',
                'type' => 'checkbox',
            ],
            [
                'name' => __('Course Price', 'imp'),
                'id'   => $prefix . 'course_price',
                'type' => 'number',
            ],
            [
                'name'    => __('Discount Price', 'imp'),
                'id'      => $prefix . 'course_discount_price',
                'type'    => 'number',
                'visible' => [
                    'when'     => [['is_discounted', '=', true]],
                    'relation' => 'and',
                ],
            ],
            [
                'name' => __('Hours', 'imp'),
                'id'   => $prefix . 'course_hours',
                'type' => 'number',
            ],
            [
                'name'    => __('Level', 'imp'),
                'id'      => $prefix . 'course_level',
                'type'    => 'select',
                'options' => [
                    'basic'    => __('Basic', 'imp'),
                    'advanced' => __('Advanced', 'imp'),
                ],
            ],
            [
                'name' => __('Recorded?', 'imp'),
                'id'   => $prefix . 'course_recorded',
                'type' => 'checkbox',
            ],
            [
                'name'       => __('Instructor', 'imp'),
                'id'         => $prefix . 'course_instructor',
                'type'       => 'post',
                'post_type'  => ['instructor'],
                'field_type' => 'select_advanced',
            ],
            [
                'name' => __('Course Rating', 'imp'),
                'id'   => $prefix . 'course_rating',
                'type' => 'number',
                'min'  => 1,
                'max'  => 5,
                'step' => 1,
            ],
            [
                'name'    => __('Course Currency', 'imp'),
                'id'      => $prefix . 'course_currency',
                'type'    => 'select',
                'options' => [
                    'EGP' => __('Egyptian Pound', 'imp'),
                ],
                'std'     => 'EGP',
            ],
            [
                'name'        => __('Course Date', 'wk'),
                'id'          => $prefix . 'course_dates',
                'type'        => 'group',
                'collapsible' => true,
                'group_title' => '{#}',
                'clone'       => true,
                'sort_clone'  => true,
                'fields'      => [
                    [
                        'name'       => 'Date',
                        'id'         => 'course_date',
                        'type'       => 'date',
                        'js_options' => [
                            'dateFormat'      => 'yy-mm-dd',
                            'showButtonPanel' => false,
                        ],
                        'inline'    => false,
                        'timestamp' => false,
                    ],
                ],
            ],
        ],
    ];

    return $meta_boxes;
}

add_filter('rwmb_meta_boxes', 'imp_lecture_meta');

function imp_lecture_meta($meta_boxes)
{
    $prefix = '';

    $meta_boxes[] = [
        'title'      => __('lecture settings', 'imp'),
        'id'         => 'lecture-settings',
        'post_types' => ['lecture'],
        'context'    => 'side',
        'fields'     => [
            [
                'name'              => __('Course ', 'imp'),
                'id'                => $prefix . 'p_course',
                'type'              => 'post',
                'label_description' => __('The parent course of this lecture', 'imp'),
                'post_type'         => ['course'],
                'field_type'        => 'select_advanced',
                'parent'            => true,
            ],
        ],
    ];

    return $meta_boxes;
}