<?php
add_filter( 'rwmb_meta_boxes', 'imp_our_stats_block' );
function imp_our_stats_block( $meta_boxes ) {
    $prefix = '';

    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }

    $meta_boxes[] = [
        'title'           => __( 'Our Stats', 'imp' ),
        'id'              => 'our-stats',
        'icon'     => 'clipboard',
        'category'        => 'imp-blocks',
        'supports'        => [
            'align' => [''],
        ],
        'render_template' => get_template_directory() . '/templates/blocks/our-stats/our-stats-template.php',
        'enqueue_style'   => get_stylesheet_directory_uri() . '/dist/assets/css/blocks/our-stats/our-stats-template' . $_RTL . '.css',
        'type'            => 'block',
        'context'         => 'side',
        'fields'          => [
            [
                'name'   => __( 'Stat Group', 'imp' ),
                'id'     => $prefix . 'stat_group',
                'type'   => 'group',
                'clone'      => true,
                'sort_clone' => true,
                'fields' => [
                    [
                        'name' => __( 'Count', 'imp' ),
                        'id'   => $prefix . 'count',
                        'type' => 'text',
                    ],
                    [
                        'name' => __( 'Suffix', 'imp' ),
                        'id'   => $prefix . 'suffix',
                        'type' => 'text',
                    ],
                    [
                        'name'    => __( 'Icon', 'imp' ),
                        'id'      => $prefix . 'icon',
                        'type'    => 'select',
                        'options' => [
                            'fa-solid fa-display'        => __( 'Videos', 'imp' ),
                            'fa-solid fa-book-open'      => __( 'Courses', 'imp' ),
                            'fa-solid fa-graduation-cap' => __( 'Students', 'imp' ),
                            'fa-solid fa-heart'          => __( 'Satisfaction', 'imp' ),
                        ],
                    ],
                ],
            ],
        ],
    ];

    return $meta_boxes;
}