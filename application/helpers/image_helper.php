<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('book_image_url')) {
    function book_image_url($image) {
        $image = trim((string)$image);
        if ($image === '') return base_url('assets/uploads/placeholder-book.svg');
        if (preg_match('#^https?://#i', $image)) return $image;
        $image = str_replace('\\', '/', $image);
        $image = ltrim($image, '/');
        $candidates = [
            $image,
            'uploads/products/'.$image,
            'uploads/products/'.basename($image),
            'assets/uploads/'.$image,
            'assets/uploads/'.basename($image),
        ];
        foreach (array_unique($candidates) as $candidate) {
            $candidate = ltrim($candidate, '/');
            if (is_file(FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $candidate))) {
                $parts = array_filter(explode('/', $candidate), 'strlen');
                return base_url(implode('/', array_map('rawurlencode', $parts)));
            }
        }
        return base_url('assets/uploads/placeholder-book.svg');
    }
}
