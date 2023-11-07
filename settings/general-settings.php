<?php

function simple_schema_register_general_settings()
{
    $site_type_args = array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field'
    );

    $site_desc_args = array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => 'Site description'
    );

    $site_logo_args = array(
        'type' => 'string',
        'sanitize_callback' => 'esc_url_raw',
        'default' => 'https://example.com/wp-content/uploads/logo.webp'
    );

    add_settings_section('simple_schema_general_section', 'General Settings', null, 'simple-schema-settings');

    add_settings_field('simple_schema_site_type', 'Site Type', 'render_simple_schema_site_type', 'simple-schema-settings', 'simple_schema_general_section');
    register_setting('simple_schema_options', 'simple_schema_site_type', $site_type_args);

    add_settings_field('simple_schema_site_description', 'Site Description', 'render_simple_schema_site_description', 'simple-schema-settings', 'simple_schema_general_section');
    register_setting('simple_schema_options', 'simple_schema_site_description', $site_desc_args);

    add_settings_field('simple_schema_site_logo_url', 'Site Logo URL', 'render_simple_schema_site_logo_url', 'simple-schema-settings', 'simple_schema_general_section');
    register_setting('simple_schema_options', 'simple_schema_site_logo_url', $site_logo_args);
}
add_action('admin_init', 'simple_schema_register_general_settings');

function render_simple_schema_site_type()
{
    $site_type = get_option('simple_schema_site_type');

    if (empty($site_type)) {
        $site_type = 'Organization';
    }

    echo '<select name="simple_schema_site_type">';

    $options = array(
        'Organization' => 'Organization',
        'Person' => 'Person'
    );

    foreach ($options as $value => $label) {
        $selected = ($site_type == $value) ? 'selected="selected"' : '';
        echo '<option value="' . esc_attr($value) . '" ' . $selected . '>' . esc_html($label) . '</option>';
    }

    echo '</select>';
}

function render_simple_schema_site_description()
{
    $site_description = get_option('simple_schema_site_description');
    echo '<textarea name="simple_schema_site_description">' . esc_textarea($site_description) . '</textarea>';
}

function render_simple_schema_site_logo_url()
{
    $site_logo_url = get_option('simple_schema_site_logo_url');
    echo '<input type="text" name="simple_schema_site_logo_url" value="' . esc_url($site_logo_url) . '" />';
}
