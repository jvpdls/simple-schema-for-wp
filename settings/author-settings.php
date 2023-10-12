<?php

function simple_schema_register_author_settings()
{
    $author_types_args = array(
        'type' => 'array',
        'sanitize_callback' => 'sanitize_simple_schema_author_types'
    );

    add_settings_section('simple-schema-authors-section', 'Simple Schema Author Settings', null, 'simple-schema-settings');

    add_settings_field('simple_schema_author_types', 'Author Types', 'render_simple_schema_author_types', 'simple-schema-settings', 'simple-schema-authors-section');
    register_setting('simple-schema-settings-group', 'simple_schema_author_types', $author_types_args);
}
add_action('admin_init', 'simple_schema_register_author_settings');

function render_simple_schema_author_types()
{
    $author_types = get_option('simple_schema_author_types', array());
    $author = get_users(array('fields' => array('ID', 'display_name')));

    foreach ($author as $author) {
        $selected_value = array_key_exists($author->ID, $author_types) ? $author_types[$author->ID] : '';
        echo "<label for='author-type-{$author->ID}'>{$author->display_name}</label>";
        echo "<select id='author-type-{$author->ID}' name='simple_schema_author_types[{$author->ID}]'>";
        echo "<option value='Person' " . selected($selected_value, 'Person', false) . ">Person</option>";
        echo "<option value='Organization' " . selected($selected_value, 'Organization', false) . ">Organization</option>";
        echo "</select><br>";
    }
}

function sanitize_simple_schema_author_types($input)
{
    $valid = array();
    $author = get_users(array('fields' => array('ID')));

    foreach ($author as $author) {
        if (array_key_exists($author->ID, $input) && in_array($input[$author->ID], array('Person', 'Organization'))) {
            $valid[$author->ID] = $input[$author->ID];
        }
    }

    return $valid;
}
