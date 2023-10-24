<?php

function simple_schema_options_page()
{
    add_menu_page(
        'Simple Schema Plugin',
        'Simple Schema',
        'manage_options',
        'simple-schema-settings',
        'simple_schema_options_page_html'
    );
}
add_action('admin_menu', 'simple_schema_options_page');

function simple_schema_options_page_html()
{
?>
    <div class="wrap">
        <h2>Simple Schema Options</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('simple_schema_options');
            do_settings_sections('simple-schema-settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

function enqueue_admin_style()
{
    if (isset($_GET['page']) && $_GET['page'] === 'simple-schema-settings') {
        $css_url = plugin_dir_url(__FILE__) . 'css/admin.css';

        wp_register_style('simple-schema-admin-style', $css_url);
        wp_enqueue_style('simple-schema-admin-style');
    }
}

add_action('admin_enqueue_scripts', 'enqueue_admin_style');
