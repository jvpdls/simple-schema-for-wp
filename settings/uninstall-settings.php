<?php

include_once plugin_dir_path(dirname(__FILE__)) . 'helpers/settings-helper.php';

function simple_schema_register_uninstall_settings()
{
    $options_checkbox_args = array(
        'type' => 'boolean',
        'sanitize_callback' => 'sanitize_key'
    );

    add_settings_section('simple_schema_uninstall_section', 'Uninstall Settings', null, 'simple-schema-settings');

    add_settings_field('simple_schema_delete_options_checkbox', 'Delete options on uninstall?', 'render_simple_schema_delete_options_checkbox', 'simple-schema-settings', 'simple_schema_uninstall_section');
    register_setting('simple_schema_options', 'simple_schema_delete_options_checkbox', $options_checkbox_args);
}
add_action('admin_init', 'simple_schema_register_uninstall_settings');

function render_simple_schema_delete_options_checkbox()
{
    $value = get_delete_options_checkbox();
    echo '<input type="checkbox" id="simple_schema_delete_options_checkbox" name="simple_schema_delete_options_checkbox" value="1"';
    checked(1, $value);
    echo '>';
}
