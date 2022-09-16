<?php

function imp_theme_support()
{
    add_theme_support('menus');
    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
	* Let WordPress manage the document title.
	* This theme does not use a hard-coded <title> tag in the document head,
	* WordPress will provide it for us.
	*/
    add_theme_support('title-tag');

    /*
        * Enable support for Post Formats.
        *
        * See: https://codex.wordpress.org/Post_Formats
        */
    add_theme_support(
        'post-formats',
        array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'audio',
        )
    );

    /*
	* Enable support for Post Thumbnails on posts and pages.
	*/

    add_theme_support('post-thumbnails');

    /*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
    add_theme_support(
        'html5',
        array(
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
            'navigation-widgets',
        )
    );

    // Add support for custom logo
    add_theme_support('custom-logo');
    // add_theme_support(
    //     'custom-logo',
    //     array(
    //         'height'      => 100,
    //         'width'       => 400,
    //         'flex-height' => true,
    //         'flex-width'  => true,
    //         'header-text' => array('site-title', 'site-description'),
    //     )
    // );

    // Add support for custom bg
    add_theme_support(
        'custom-background',
        array(
            'default-color'          => '',
            'default-image'          => '',
            'default-repeat'         => '',
            'default-position-x'     => '',
            'default-position-y'     => '',
            'default-size'           => '',
            'default-attachment'     => '',
            'wp-head-callback'       => '_custom_background_cb',
            'admin-head-callback'    => '',
            'admin-preview-callback' => ''
        )
    );

    add_theme_support('editor-color-palette', array(
        array(
            'name' => __('Sunset Orange', 'IMP'),
            'slug' => 'sunset-orange',
            'color' => '#FA483C',
        ),
        array(
            'name' => __('Athens Gray', 'IMP'),
            'slug' => 'athens-gray',
            'color' => '#F7F8FA',
        ),
        array(
            'name' => __('Black', 'IMP'),
            'slug' => 'black',
            'color' => '#000',
        ),
        array(
            'name' => __('white', 'IMP'),
            'slug' => 'white',
            'color' => '#fff',
        ),
    ));

    //IMP Widgets
	function widgets_init() {
		register_sidebar(array(
			'name'          => esc_html__('Primary Sidebar', 'imp'),
			'id'            => 'primary',
			'description'   => esc_html__('Widgets displayed at left & Right side of content.', 'imp'),
			'before_widget' => '<div id="%1$s" class="theme-widget theme_widget_sidebar %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="theme-widget-title">',
			'after_title'   => '</h6>',
		));
		register_sidebar(array(
			'name'          => esc_html__('Footer #1 column', 'imp'),
			'id'            => 'footer_1',
			'description'   => esc_html__('Widgets displayed at footer.', 'imp'),
			'before_widget' => '<div id="%1$s" class="theme-widget theme_widget_footer %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="theme-widget-title">',
			'after_title'   => '</h6>',
		));
		register_sidebar(array(
			'name'          => esc_html__('Footer #2 column', 'imp'),
			'id'            => 'footer_2',
			'description'   => esc_html__('Widgets displayed at footer.', 'imp'),
			'before_widget' => '<div id="%1$s" class="theme-widget theme_widget_footer %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="theme-widget-title">',
			'after_title'   => '</h6>',
		));
		register_sidebar(array(
			'name'          => esc_html__('Footer #3 column', 'imp'),
			'id'            => 'footer_3',
			'description'   => esc_html__('Widgets displayed at footer.', 'imp'),
			'before_widget' => '<div id="%1$s" class="theme-widget theme_widget_footer %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="theme-widget-title">',
			'after_title'   => '</h6>',
		));
		register_sidebar(array(
			'name'          => esc_html__('Footer #4 column', 'imp'),
			'id'            => 'footer_4',
			'description'   => esc_html__('Widgets displayed at footer.', 'imp'),
			'before_widget' => '<div id="%1$s" class="theme-widget theme_widget_footer %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6 class="theme-widget-title">',
			'after_title'   => '</h6>',
		));
	}
    add_action('widgets_init', 'widgets_init');

    // add_theme_support('custom-spacing');


    // add_theme_support('editor-font-sizes');

    add_theme_support('align-wide');
}

add_action('after_setup_theme', 'imp_theme_support');
