<?php

add_action('wp_enqueue_scripts', 'astra_child_enqueue_style');
function astra_child_enqueue_style(){
    wp_enqueue_style('astra-child-style', get_stylesheet_uri(  ), array('astra-theme-css'));
}


// event custom post type
include_once('event-post.php');

// event custom post type
include_once('event-from.php');


function handle_event_form_submission() {
    if (isset($_POST['submit_event'])) {
        $title = sanitize_text_field($_POST['event_title']);
        $desc = sanitize_textarea_field($_POST['event_description']);
        $organizer = sanitize_text_field($_POST['organizer_name']);
        $datetime = sanitize_text_field($_POST['event_datetime']);
        $participants = intval($_POST['participants']);
        $location = sanitize_text_field($_POST['event_location']);
        $notes = sanitize_textarea_field($_POST['additional_notes']);

        $post_id = wp_insert_post(array(
            'post_title'   => $title,
            'post_content' => $desc,
            'post_type'    => 'event',
            'post_status'  => 'draft',
        ));

        if ($post_id) {
            update_post_meta($post_id, 'organizer_name', $organizer);
            update_post_meta($post_id, 'event_datetime', $datetime);
            update_post_meta($post_id, 'participants', $participants);
            update_post_meta($post_id, 'event_location', $location);
            update_post_meta($post_id, 'additional_notes', $notes);


            // feature image
            if (!empty($_FILES['feature_image']['name'])) {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                $uploadedfile = $_FILES['feature_image'];
                $upload_overrides = array('test_form' => false);
                $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
                if ($movefile && !isset($movefile['error'])) {
                    $filename = $movefile['file'];
                    $filetype = wp_check_filetype(basename($filename), null);
                    $attachment = array(
                        'post_mime_type' => $filetype['type'],
                        'post_title'     => sanitize_file_name(basename($filename)),
                        'post_status'    => 'inherit'
                    );
                    $attach_id = wp_insert_attachment($attachment, $filename, $post_id);
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
                    wp_update_attachment_metadata($attach_id, $attach_data);
                    set_post_thumbnail($post_id, $attach_id);
                }
            }
        }
    }
}

add_action('init', 'handle_event_form_submission');

?>