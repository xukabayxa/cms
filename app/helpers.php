<?php

use Carbon\Carbon;

if (! function_exists('re_implode')) {
    function re_implode($separator = "", array $array) {
        if (config('env.PHP_VERSION') === '7.4') {
            return implode($array, $separator);
        } else {
            return implode($separator, $array);
        }
    }
}
