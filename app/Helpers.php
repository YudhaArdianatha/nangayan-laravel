<?php

if (!function_exists('limit_words')) {
    function limit_words($text, $limit) {
        $words = explode(' ', $text);
        if (count($words) > $limit) {
            return implode(' ', array_slice($words, 0, $limit)) . '... <a href="/suites">Read More</a>';
        }
        return $text;
    }
}