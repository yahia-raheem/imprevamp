<?php

function imp_customization($wp_customize)
{
    $wp_customize->add_section('social_media_section', array('title' => 'Social Media',));
    $wp_customize->add_setting('facebook', array('default' => '',));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'facebook_control',
        array(
            'label' => 'Facebook',
            'section' => 'social_media_section',
            'settings' => 'facebook',
        )
    ));
    $wp_customize->add_setting('linked_in', array('default' => '',));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'linked_in_control',
        array(
            'label' => 'Linked In',
            'section' => 'social_media_section',
            'settings' => 'linked_in',
        )
    ));
    $wp_customize->add_setting('youtube', array('default' => '',));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'youtube_control',
        array(
            'label' => 'Youtube',
            'section' => 'social_media_section',
            'settings' => 'youtube',
        )
    ));
}
add_action('customize_register', 'imp_customization');

function determine_the_title($echo = true)
{
    $result = '';
    if (is_single()) {
        $post = get_queried_object();
        $postType = get_post_type_object(get_post_type($post));
        if ($postType) {
            $result = esc_html($postType->labels->name);
        } else {
            $result = get_the_title($post);
        }
    } elseif (is_tax()) {
        $postType = get_queried_object();
        $result = esc_html($postType->name);
    } elseif (is_archive()) {
        $postType = get_queried_object();
        $result = esc_html($postType->labels->name);
    } elseif (is_page()) {
        $result = get_the_title();
    }
    if ($echo) {
        echo $result;
    } else {
        return $result;
    }
}

add_action('get_header', 'my_filter_head');

function my_filter_head()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
}

function my_pagination($max_num_of_pages)
{
    $big = 999999999;
    $pagination = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $max_num_of_pages,
        'show_all' => true,
        'prev_text' => '<i class="fas fa-arrow-left"></i>' . 'Prev',
        'next_text' => 'Next' . '<i class="fas fa-arrow-right"></i>'
    ));
    return $pagination;
}

# function theme_lang_switcher()
# {
#     $languages = icl_get_languages('skip_missing=1');
#     if (1 < count($languages)) {
#         $menu = '<div class="dropdown-menu" aria-labelledby="dropdownLang">';
#         foreach ($languages as $l) {
#             if (!$l['active']) {
#                 $menu .= '<a class="dropdown-item" href="' . $l['url'] . '"><img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" class="lang-flag flag-desktop" />' . $l['translated_name'] . '</a>';
#             }
#         }
#         $menu .= '</div>';
#         echo $menu;
#     }
# }

# ------------------------------------------------------------------------ api ------------------------------------------------
# add_action('rest_api_init', function () {
#     register_rest_route('generaldata/v1', '/getimage/(?P<id>\d+)', array(
#         'methods' => 'GET',
#         'callback' => 'get_image',
#         'args' => array(
#             'id' => array(
#                 'validate_callback' => function ($param, $request, $key) {
#                     return is_numeric($param);
#                 }
#             ),
#         ),
#         'permission_callback' => '__return_true'
#     ));
# });
# 
# function get_image($data)
# {
#     $imageId = $data['id'];
#     $image = wp_get_attachment_image($imageId, 'full', true);
#     return $image;
# }
