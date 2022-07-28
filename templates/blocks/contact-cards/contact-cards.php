<?php
add_filter( 'rwmb_meta_boxes', 'imp_contact_cards' );

function imp_contact_cards( $meta_boxes ) {
    $prefix = '';

    if (is_rtl()) {
        $_RTL = '-rtl';
    } else {
        $_RTL = '';
    }

    $meta_boxes[] = [
        'title'    => __( 'Contact Cards', 'imp' ),
        'id'       => 'contact-cards-block',
        'icon'     => 'phone',
        'category' => 'imp-blocks',
        'supports' => [
            'align' => [''],
        ],
        'type'     => 'block',
        'render_template' => get_template_directory() . '/templates/blocks/contact-cards/contact-cards-template.php',
        'context'  => 'side',
        'fields'   => [
            [
                'name'   => __( 'Contact Card', 'imp' ),
                'id'     => $prefix . 'contact_card',
                'type'   => 'group',
                'clone'      => true,
                'sort_clone' => true,
                'fields' => [
                    [
                        'name'    => __( 'Type', 'imp' ),
                        'id'      => $prefix . 'type',
                        'type'    => 'select',
                        'options' => [
                            'phone'    => __( 'Phone', 'imp' ),
                            'email'    => __( 'Email', 'imp' ),
                            'location' => __( 'Location', 'imp' ),
                        ],
                    ],
                    [
                        'name' => __( 'Title', 'imp' ),
                        'id'   => $prefix . 'title',
                        'type' => 'text',
                    ],
                    [
                        'name'       => __( 'Info', 'imp' ),
                        'id'         => $prefix . 'info',
                        'type'       => 'text',
                        'clone'      => true,
                        'sort_clone' => true,
                    ],
                ],
            ],
        ],
    ];

    return $meta_boxes;
}