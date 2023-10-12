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
