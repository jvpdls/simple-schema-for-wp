<?php

include_once plugin_dir_path(__FILE__) . 'helpers/helper_functions.php';

function set_organization_schema()
{
    $site_type = get_option('simple_schema_site_type', 'Organization');
    $site_title = get_bloginfo('name');
    $site_description = get_option('simple_schema_site_description');
    $site_logo = get_option('simple_schema_site_logo_url');
    $site_url = get_site_url();

    $json_ld = array(
        "@context" => "https://schema.org",
        "@type" => $site_type,
        "name" => $site_title,
        "url" => $site_url
    );

    get_organization_schema_optional_fields($json_ld, $site_description, $site_logo);

    $markup = '<script type="application/ld+json">' . json_encode($json_ld, JSON_PRETTY_PRINT) . '</script>';
    echo $markup;
}
add_action('wp_head', 'set_organization_schema');

function set_contact_page_schema()
{
    $contact_page = get_option('simple_schema_contact_page');

    if (is_page($contact_page)) {
        $page_title = get_the_title();
        $page_url = get_page_link();

        $json_ld = array(
            "@context" => "https://schema.org",
            "@type" => "ContactPage",
            "name" => $page_title,
            "url" => $page_url
        );

        $markup = '<script type="application/ld+json">' . json_encode($json_ld, JSON_PRETTY_PRINT) . '</script>';
        echo $markup;
    }
}
add_action('wp_head', 'set_contact_page_schema');

function set_about_page_schema()
{
    $about_page = get_option('simple_schema_about_page');

    if (is_page($about_page)) {
        $page_title = get_the_title();
        $page_url = get_page_link();

        $json_ld = array(
            "@context" => "https://schema.org",
            "@type" => "AboutPage",
            "name" => $page_title,
            "url" => $page_url
        );

        $markup = '<script type="application/ld+json">' . json_encode($json_ld, JSON_PRETTY_PRINT) . '</script>';
        echo $markup;
    }
}
add_action('wp_head', 'set_about_page_schema');

function set_blogposting_schema()
{
    if (is_single()) {

        $post_title = get_the_title();
        $post_thumbnail = get_the_post_thumbnail_url();
        $post_excerpt = get_the_excerpt();
        $post_permalink = get_permalink();

        $published_date =  get_the_date('c');
        $modified_date = get_the_modified_date('c');

        $site_type = get_option('simple_schema_site_type', 'Organization');
        $site_title = get_bloginfo('name');
        $site_description = get_option('simple_schema_site_description');
        $site_logo = get_option('simple_schema_site_logo_url');
        $site_url = get_site_url();

        $author_name = get_the_author_meta('display_name');
        $author_description = get_the_author_meta('description');
        $author_id = get_the_author_meta('ID');
        $author_url = get_author_posts_url($author_id);
        $author_type = get_author_type($author_id);

        $json_ld = array(
            "@context" => "https://schema.org",
            "@type" => "BlogPosting",
            "headline" => $post_title,
            "datePublished" => $published_date,
            "dateModified" => $modified_date,
            "author" => array(
                "@type" => $author_type,
                "name" => $author_name,
                "url" => $author_url
            ),
            "publisher" => array(
                "@type" => $site_type,
                "name" => $site_title,
                "url" => $site_url
            ),
            "description" => $post_excerpt,
            "mainEntityOfPage" => array(
                "@type" => "WebPage",
                "@id" => $post_permalink
            )
        );

        get_blogposting_schema_optional_fields($json_ld, $author_description, $post_thumbnail, $site_description, $site_logo);

        $markup = '<script type="application/ld+json">' . json_encode($json_ld, JSON_PRETTY_PRINT) . '</script>';

        echo $markup;
    }
}
add_action('wp_head', 'set_blogposting_schema');
