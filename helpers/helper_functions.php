<?php

function get_author_type($author_id)
{
    $author_types = get_option('simple_schema_author_types', array());

    if (array_key_exists($author_id, $author_types)) {
        return $author_types[$author_id];
    } else {
        return 'Person';
    }
}

function get_organization_schema_optional_fields(&$json_ld, $site_description, $site_logo)
{
    if ($site_description) {
        $json_ld["description"] = $site_description;
    }

    if ($site_logo) {
        $json_ld["logo"] = $site_logo;
    }
}

function get_blogposting_schema_optional_fields(&$json_ld, $post_thumbnail, $site_description, $site_logo)
{
    if ($post_thumbnail) {
        $json_ld["image"] = array(
            "@type" => "ImageObject",
            "url" => $post_thumbnail
        );
    }

    if ($site_description) {
        $json_ld["publisher"]["description"] = $site_description;
    }

    if ($site_logo) {
        $json_ld["publisher"]["logo"] = array(
            "@type" => "ImageObject",
            "url" => $site_logo
        );
    }
}
