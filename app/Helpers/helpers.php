<?php

function isActive($urls, $class = 'active',$default='')
{
    if (!is_array($urls)) {
        if (request()->is($urls)) {
            return $class;
        }
    }
    foreach ((array) $urls as $url) {
        if (request()->is($url)) {
            return $class;
        }
    }
    return $default;
}

