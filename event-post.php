<?php
function event_post_type() {
    register_post_type('event',
        array(
            'labels' => array(
                'name' => __('Events'),
                'singular_name' => __('Event')
            ),
            'public'           => true,
            'has_archive'      => true,
            'menu_position'    => 5,
            'menu_icon'        => 'dashicons-calendar',
            'show_ui'          => true,
            'show_in_menu'     => true,
            'supports'         => array('title', 'editor', 'thumbnail'),
            'capability_type'  => 'post',
            'capabilities'     => array(
                'create_posts' => 'do_not_allow', // prevent non-admin from creating
            ),
            'map_meta_cap' => true,
        )
    );
}
add_action('init', 'event_post_type');