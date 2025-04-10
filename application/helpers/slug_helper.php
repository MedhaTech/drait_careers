<?php
function create_slug($string) {
    $slug = strtolower($string);
    $slug = preg_replace('/[^a-z0-9 -]/', '', $slug); // remove unwanted characters
    $slug = preg_replace('/\s+/', '-', $slug);         // replace spaces with -
    $slug = preg_replace('/-+/', '-', $slug);          // remove duplicate -
    return trim($slug, '-');
}
