<?php

function simple_schema_register_page_settings()
{
    $webpage_args = array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field'
    );

    add_settings_section('simple_schema_pages_section', 'Pages Settings', null, 'simple-schema-settings');

    add_settings_field('simple_schema_contact_page', 'Contact Page', 'render_simple_schema_contact_page', 'simple-schema-settings', 'simple_schema_pages_section');
    register_setting('simple_schema_options', 'simple_schema_contact_page', $webpage_args);

    add_settings_field('simple_schema_about_page', 'About Page', 'render_simple_schema_about_page', 'simple-schema-settings', 'simple_schema_pages_section');
    register_setting('simple_schema_options', 'simple_schema_about_page', $webpage_args);
}
add_action('admin_init', 'simple_schema_register_page_settings');

function render_simple_schema_contact_page()
{
    $contact_page = get_option('simple_schema_contact_page');
    $pages = get_pages(array('post_type' => 'page'));

    echo '<select name="simple_schema_contact_page">';
    echo '<option value="none">Select a contact page</option>';

    foreach ($pages as $page) {
        $selected = ($contact_page == $page->ID) ? 'selected' : '';
        echo '<option value="' . esc_attr($page->ID) . '" ' . $selected . '>' . esc_html($page->post_title) . '</option>';
    }

    echo '</select>';
}

function render_simple_schema_about_page()
{
    $about_page = get_option('simple_schema_about_page');
    $pages = get_pages(array('post_type' => 'page'));

    echo '<select name="simple_schema_about_page">';
    echo '<option value="none">Select an about page</option>';

    foreach ($pages as $page) {
        $selected = ($about_page == $page->ID) ? 'selected' : '';
        echo '<option value="' . esc_attr($page->ID) . '" ' . $selected . '>' . esc_html($page->post_title) . '</option>';
    }

    echo '</select>';
}
