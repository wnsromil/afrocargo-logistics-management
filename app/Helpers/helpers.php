<?php

function isActive($urls, $class = 'active',$default='')
{
    
    if (!is_array($urls)) {
        $urls = explode(',',$urls);
        if(count($urls) > 1){
            foreach ((array) $urls as $url) {
                if (request()->is($url)) {
                    return $class;
                }
            }
        }
        if (request()->is($urls[0])) {
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

