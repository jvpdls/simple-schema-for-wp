<?php

function get_delete_options_checkbox()
{
    $value = get_option('simple_schema_delete_options_checkbox', 0);
    return $value;
}
