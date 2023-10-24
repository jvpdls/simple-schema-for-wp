<?php

/**
 * Plugin Name: Simple Schema for SEO
 * Description: A basic plugin that adds valid basic schema to your blog.
 * Version: 1.0.0
 * Author: João Santos
 * Author URI: https://joaosantos.net.br/
 */

include_once(plugin_dir_path(__FILE__) . 'admin.php');
include_once(plugin_dir_path(__FILE__) . 'schema.php');
include_once(plugin_dir_path(__FILE__) . 'settings/general-settings.php');
include_once(plugin_dir_path(__FILE__) . 'settings/author-settings.php');
include_once(plugin_dir_path(__FILE__) . 'settings/page-settings.php');

function simple_schema_uninstall()
{
    unregister_setting('simple_schema_options', 'simple_schema_site_type');
    unregister_setting('simple_schema_options', 'simple_schema_site_description');
    unregister_setting('simple_schema_options', 'simple_schema_site_logo_url');
    unregister_setting('simple_schema_options', 'simple_schema_contact_page');
    unregister_setting('simple_schema_options', 'simple_schema_about_page');
    unregister_setting('simple_schema_options', 'simple_schema_author_types');
    delete_option('simple_schema_site_type');
    delete_option('simple_schema_site_description');
    delete_option('simple_schema_site_logo_url');
    delete_option('simple_schema_contact_page');
    delete_option('simple_schema_about_page');
    delete_option('simple_schema_author_types');

    remove_menu_page('simple-schema-settings');
}
register_uninstall_hook(__FILE__, 'simple_schema_uninstall');
