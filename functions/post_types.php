<?php
add_action('init', 'imp_register_courses');
function imp_register_courses()
{
    $labels = [
        'name'                     => esc_html__('Courses', 'imp'),
        'singular_name'            => esc_html__('Course', 'imp'),
        'add_new'                  => esc_html__('Add New', 'imp'),
        'add_new_item'             => esc_html__('Add new course', 'imp'),
        'edit_item'                => esc_html__('Edit Course', 'imp'),
        'new_item'                 => esc_html__('New Course', 'imp'),
        'view_item'                => esc_html__('View Course', 'imp'),
        'view_items'               => esc_html__('View Courses', 'imp'),
        'search_items'             => esc_html__('Search Courses', 'imp'),
        'not_found'                => esc_html__('No courses found', 'imp'),
        'not_found_in_trash'       => esc_html__('No courses found in Trash', 'imp'),
        'parent_item_colon'        => esc_html__('Parent Course:', 'imp'),
        'all_items'                => esc_html__('All Courses', 'imp'),
        'archives'                 => esc_html__('Course Archives', 'imp'),
        'attributes'               => esc_html__('Course Attributes', 'imp'),
        'insert_into_item'         => esc_html__('Insert into course', 'imp'),
        'uploaded_to_this_item'    => esc_html__('Uploaded to this course', 'imp'),
        'featured_image'           => esc_html__('Featured image', 'imp'),
        'set_featured_image'       => esc_html__('Set featured image', 'imp'),
        'remove_featured_image'    => esc_html__('Remove featured image', 'imp'),
        'use_featured_image'       => esc_html__('Use as featured image', 'imp'),
        'menu_name'                => esc_html__('Courses', 'imp'),
        'filter_items_list'        => esc_html__('Filter courses list', 'imp'),
        'filter_by_date'           => esc_html__('', 'imp'),
        'items_list_navigation'    => esc_html__('Courses list navigation', 'imp'),
        'items_list'               => esc_html__('Courses list', 'imp'),
        'item_published'           => esc_html__('Course published', 'imp'),
        'item_published_privately' => esc_html__('Course published privately', 'imp'),
        'item_reverted_to_draft'   => esc_html__('Course reverted to draft', 'imp'),
        'item_scheduled'           => esc_html__('Course scheduled', 'imp'),
        'item_updated'             => esc_html__('Course updated', 'imp'),
        'text_domain'              => esc_html__('imp', 'imp'),
    ];
    $args = [
        'label'               => esc_html__('Courses', 'imp'),
        'labels'              => $labels,
        'description'         => '',
        'public'              => true,
        'hierarchical'        => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'query_var'           => true,
        'can_export'          => true,
        'delete_with_user'    => true,
        'has_archive'         => true,
        'rest_base'           => '',
        'show_in_menu'        => true,
        'menu_position'       => '',
        'menu_icon'           => 'dashicons-book-alt',
        'capability_type'     => 'post',
        'supports'            => ['title', 'editor', 'thumbnail'],
        'taxonomies'          => [],
        'rewrite'             => [
            'with_front' => false,
        ],
    ];

    register_post_type('course', $args);
}

add_action('init', 'imp_register_instructors');
function imp_register_instructors()
{
    $labels = [
        'name'                     => esc_html__('Instructors', 'imp'),
        'singular_name'            => esc_html__('Instructor', 'imp'),
        'add_new'                  => esc_html__('Add New', 'imp'),
        'add_new_item'             => esc_html__('Add new instructor', 'imp'),
        'edit_item'                => esc_html__('Edit Instructor', 'imp'),
        'new_item'                 => esc_html__('New Instructor', 'imp'),
        'view_item'                => esc_html__('View Instructor', 'imp'),
        'view_items'               => esc_html__('View Instructors', 'imp'),
        'search_items'             => esc_html__('Search Instructors', 'imp'),
        'not_found'                => esc_html__('No instructors found', 'imp'),
        'not_found_in_trash'       => esc_html__('No instructors found in Trash', 'imp'),
        'parent_item_colon'        => esc_html__('Parent Instructor:', 'imp'),
        'all_items'                => esc_html__('All Instructors', 'imp'),
        'archives'                 => esc_html__('Instructor Archives', 'imp'),
        'attributes'               => esc_html__('Instructor Attributes', 'imp'),
        'insert_into_item'         => esc_html__('Insert into instructor', 'imp'),
        'uploaded_to_this_item'    => esc_html__('Uploaded to this instructor', 'imp'),
        'featured_image'           => esc_html__('Featured image', 'imp'),
        'set_featured_image'       => esc_html__('Set featured image', 'imp'),
        'remove_featured_image'    => esc_html__('Remove featured image', 'imp'),
        'use_featured_image'       => esc_html__('Use as featured image', 'imp'),
        'menu_name'                => esc_html__('Instructors', 'imp'),
        'filter_items_list'        => esc_html__('Filter instructors list', 'imp'),
        'filter_by_date'           => esc_html__('', 'imp'),
        'items_list_navigation'    => esc_html__('Instructors list navigation', 'imp'),
        'items_list'               => esc_html__('Instructors list', 'imp'),
        'item_published'           => esc_html__('Instructor published', 'imp'),
        'item_published_privately' => esc_html__('Instructor published privately', 'imp'),
        'item_reverted_to_draft'   => esc_html__('Instructor reverted to draft', 'imp'),
        'item_scheduled'           => esc_html__('Instructor scheduled', 'imp'),
        'item_updated'             => esc_html__('Instructor updated', 'imp'),
        'text_domain'              => esc_html__('imp', 'imp'),
    ];
    $args = [
        'label'               => esc_html__('Instructors', 'imp'),
        'labels'              => $labels,
        'description'         => '',
        'public'              => true,
        'hierarchical'        => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'query_var'           => true,
        'can_export'          => true,
        'delete_with_user'    => true,
        'has_archive'         => true,
        'rest_base'           => '',
        'show_in_menu'        => true,
        'menu_position'       => '',
        'menu_icon'           => 'dashicons-businessman',
        'capability_type'     => 'post',
        'supports'            => ['title', 'editor', 'thumbnail'],
        'taxonomies'          => [],
        'rewrite'             => [
            'with_front' => false,
        ],
    ];

    register_post_type('instructor', $args);
}

add_action('init', 'imp_register_lectures');
function imp_register_lectures()
{
    $labels = [
        'name'                     => esc_html__('Lectures', 'imp'),
        'singular_name'            => esc_html__('Lecture', 'imp'),
        'add_new'                  => esc_html__('Add New', 'imp'),
        'add_new_item'             => esc_html__('Add new lecture', 'imp'),
        'edit_item'                => esc_html__('Edit Lecture', 'imp'),
        'new_item'                 => esc_html__('New Lecture', 'imp'),
        'view_item'                => esc_html__('View Lecture', 'imp'),
        'view_items'               => esc_html__('View Lectures', 'imp'),
        'search_items'             => esc_html__('Search Lectures', 'imp'),
        'not_found'                => esc_html__('No lectures found', 'imp'),
        'not_found_in_trash'       => esc_html__('No lectures found in Trash', 'imp'),
        'parent_item_colon'        => esc_html__('Parent Lecture:', 'imp'),
        'all_items'                => esc_html__('All Lectures', 'imp'),
        'archives'                 => esc_html__('Lecture Archives', 'imp'),
        'attributes'               => esc_html__('Lecture Attributes', 'imp'),
        'insert_into_item'         => esc_html__('Insert into lecture', 'imp'),
        'uploaded_to_this_item'    => esc_html__('Uploaded to this lecture', 'imp'),
        'featured_image'           => esc_html__('Featured image', 'imp'),
        'set_featured_image'       => esc_html__('Set featured image', 'imp'),
        'remove_featured_image'    => esc_html__('Remove featured image', 'imp'),
        'use_featured_image'       => esc_html__('Use as featured image', 'imp'),
        'menu_name'                => esc_html__('Lectures', 'imp'),
        'filter_items_list'        => esc_html__('Filter lectures list', 'imp'),
        'filter_by_date'           => esc_html__('', 'imp'),
        'items_list_navigation'    => esc_html__('Lectures list navigation', 'imp'),
        'items_list'               => esc_html__('Lectures list', 'imp'),
        'item_published'           => esc_html__('Lecture published', 'imp'),
        'item_published_privately' => esc_html__('Lecture published privately', 'imp'),
        'item_reverted_to_draft'   => esc_html__('Lecture reverted to draft', 'imp'),
        'item_scheduled'           => esc_html__('Lecture scheduled', 'imp'),
        'item_updated'             => esc_html__('Lecture updated', 'imp'),
        'text_domain'              => esc_html__('imp', 'imp'),
    ];
    $args = [
        'label'               => esc_html__('Lectures', 'imp'),
        'labels'              => $labels,
        'description'         => '',
        'public'              => true,
        'hierarchical'        => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'query_var'           => true,
        'can_export'          => true,
        'delete_with_user'    => true,
        'has_archive'         => true,
        'rest_base'           => '',
        'show_in_menu'        => true,
        'menu_position'       => '',
        'menu_icon'           => 'dashicons-book',
        'capability_type'     => 'post',
        'supports'            => ['title', 'editor', 'thumbnail'],
        'taxonomies'          => [],
        'rewrite'             => [
            'with_front' => false,
        ],
    ];

    register_post_type('lecture', $args);
}