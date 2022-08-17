<?php
add_filter( 'rwmb_meta_boxes', 'imp_course_tabs_block' );

function imp_course_tabs_block( $meta_boxes ) {
    $prefix = '';

    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }

    $meta_boxes[] = [
        'title'    => __( 'Course Tabs Block', 'imp' ),
        'icon'     => 'editor-aligncenter',
        'id'       => 'course-tabs-block',
        'category' => 'imp-blocks',
        'supports' => [
            'align' => [''],
        ],
        'render_template' => get_template_directory() . '/templates/blocks/course-tabs/course-tabs-template.php',
        'enqueue_style'   => get_stylesheet_directory_uri() . '/dist/assets/css/blocks/course-tabs/course-tabs-template' . $_RTL . '.css',
        'type'     => 'block',
        // 'context'  => 'side',
        'fields'   => [
            [
                'name'        => __('Curriculum Tab', 'imp'),
                'id'          => $prefix . 'curriculum-tabs',
                'type'        => 'group',
                'collapsible' => true,
                'group_title' => '{#}',
                'clone'       => true,
                'sort_clone'  => true,
                'fields'      => [
                    [
                        'name' => __('Title', 'imp'),
                        'id'   => $prefix . 'title',
                        'type' => 'text',
                    ],
                    [
                        'name'        => __('Curriculum Title', 'imp'),
                        'id'          => $prefix . 'course-curriculum-title',
                        'type'        => 'group',
                        'collapsible' => true,
                        'group_title' => '{#}',
                        'clone'       => true,
                        'sort_clone'  => true,
                        'fields'      => [
                            [
                                'name' => __('Title', 'imp'),
                                'id'   => $prefix . 'title',
                                'type' => 'text',
                            ],
                            [
                                'name' => __('Description', 'imp'),
                                'id'   => $prefix . 'description',
                                'type' => 'wysiwyg',
                            ],
                            [
                                'name'            => 'Select Your Type',
                                'id'              => 'type_select',
                                'type'            => 'select',
                                'multiple'        => true,
                                'placeholder'     => 'Select an item',
                                'select_all_none' => true,
                                'options'         => [
                                    ''                  => 'Select an item',
                                    'video'             => 'Video',
                                    'quiz'              => 'Quiz',
                                    'documents'         => 'Documents',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'name'        => __('FAQ', 'imp'),
                'id'          => $prefix . 'course-faq',
                'type'        => 'group',
                'collapsible' => true,
                'group_title' => '{#}',
                'clone'       => true,
                'sort_clone'  => true,
                'fields'      => [
                    [
                        'name' => __('Title', 'imp'),
                        'id'   => $prefix . 'title',
                        'type' => 'text',
                    ],
                    [
                        'name' => __('Description', 'imp'),
                        'id'   => $prefix . 'description',
                        'type' => 'wysiwyg',
                    ],
                ],
            ],
            [
                'name'        => __('Announcement', 'imp'),
                'id'          => $prefix . 'course-announcement',
                'type'        => 'group',
                'collapsible' => true,
                'group_title' => '{#}',
                'clone'       => true,
                'sort_clone'  => true,
                'fields'      => [
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