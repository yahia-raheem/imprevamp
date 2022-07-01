<?php

define("THEME_DIR", get_template_directory());

define("THEME_DIR_URI", get_template_directory_uri());

require THEME_DIR . '/functions/theme-support.php';
require_once THEME_DIR . '/classes/classes.php';


function imp_assets()
{
    wp_deregister_script('jquery');
    wp_enqueue_style('imp-stylesheet-base', get_stylesheet_directory_uri() . '/dist/assets/css/base.css', array(), '1.0.0', 'all');
    wp_enqueue_script('imp-scripts', get_stylesheet_directory_uri() . '/dist/assets/js/bundle.js', array(), '1.0.0', true);
    wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/18b7943afb.js', array(), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'imp_assets');

function myguten_enqueue()
{
    wp_enqueue_style('admin-stylesheet', get_template_directory_uri() . '/dist/assets/css/admin.css', array(), '1.0.0', 'all');
}
add_action('enqueue_block_editor_assets', 'myguten_enqueue');

function imp_functions()
{
    require_once get_template_directory() . '/functions/helpers.php';
    require_once get_template_directory() . '/functions/post_types.php';
    require_once get_template_directory() . '/functions/meta_boxes.php';
}
add_action('after_setup_theme', 'imp_functions');

function register_menu()
{
    register_nav_menus(array(
        'header-menu' => 'Header Menu',
    ));
}
add_action('init', 'register_menu');


function wk_blocks_categories($categories)
{

    return array_merge(
        $categories,
        [
            [
                'slug'  => 'imp-blocks',
                'title' => __('IMP - Blocks', 'imp-blocks'),
            ],
        ]
    );
};
add_action('block_categories', 'wk_blocks_categories', 10, 9);

require_once THEME_DIR . '/templates/blocks/blocks.php';