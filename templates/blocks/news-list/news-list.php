<?php
add_filter( 'rwmb_meta_boxes', 'imp_news_list_block' );

function imp_news_list_block( $meta_boxes ) {
    $prefix = '';
    
    $meta_boxes[] = [
        'title'    => __( 'News List Block', 'imp' ),
        'id'       => 'news-list-block',
        'icon'     => 'book-alt',
        'category' => 'imp-blocks',
        'supports' => [
            'align' => [''],
        ],
        'render_template' => get_template_directory() . '/templates/blocks/news-list/news-list-template.php',
        'type'     => 'block',
        'parent'   => ['meta-box/section-title-block', 'meta-box/imp-content-block'],
        'context'  => 'side',
        'fields'   => [
            [
                'name'              => __( 'Filter Shown News', 'imp' ),
                'id'                => $prefix . 'filter_shown_news',
                'type'              => 'select',
                'label_description' => __( 'Select news by ', 'imp' ),
                'options'           => [
                    'all'      => __( 'Show All', 'imp' ),
                    'category' => __( 'By Category', 'imp' ),
                    'custom'   => __( 'Custom', 'imp' ),
                ],
                'std'               => 'custom',
                'required'          => true,
            ],
            [
                'name'              => __( 'News Categories', 'imp' ),
                'id'                => $prefix . 'taxonomy_advanced_z1yrusenrkn',
                'type'              => 'taxonomy_advanced',
                'label_description' => __( 'Select the categories you want to include', 'imp' ),
                'taxonomy'          => ['blog-category'],
                'field_type'        => 'select_advanced',
                'multiple'          => true,
                'visible'           => [
                    'when'     => [['filter_shown_news', '=', 'category']],
                    'relation' => 'and',
                ],
            ],
            [
                'name'              => __( 'News', 'imp' ),
                'id'                => $prefix . 'news',
                'type'              => 'post',
                'label_description' => __( 'Select Shown News', 'imp' ),
                'post_type'         => 'blog',
                'field_type'        => 'select_advanced',
                'multiple'          => true,
                'visible'           => [
                    'when'     => [['filter_shown_news', '=', 'custom']],
                    'relation' => 'and',
                ],
            ],
            [
                'name' => __( 'Number of Posts', 'imp' ),
                'id'   => $prefix . 'number_of_posts',
                'type' => 'number',
                'label_description' => __( 'How many posts should be displayed? (leave as -1 to display all news)', 'imp' ),
                'step' => 1,
                'std'  => -1,
                'visible'           => [
                    'when'     => [['filter_shown_news', '=', 'category']],
                    'relation' => 'or',
                ],
            ],
        ],
    ];

    return $meta_boxes;
}