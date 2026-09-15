<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('book_image_url')) {
    /**
     * Single, safe image URL entry-point for cart/checkout pages.
     * Delegates to the project's central product image resolver so every page
     * uses exactly the same path rules and placeholder behavior.
     */
    function book_image_url($image) {
        $image = trim(html_entity_decode((string)$image, ENT_QUOTES, 'UTF-8'));
        if ($image === '') {
            return base_url('assets/uploads/placeholder-book.svg');
        }

        if (function_exists('product_image_url')) {
            return product_image_url($image);
        }

        // Defensive fallback in case this helper is used before product_helper
        // has been loaded. Avoid regex-based path rewriting entirely.
        if (preg_match('#^https?://#i', $image)) {
            return $image;
        }
        $image = str_replace('\\', '/', $image);
        $image = ltrim($image, '/');
        $image = preg_replace('#^.*?(assets/uploads/|uploads/)#i', '$1', $image);
        return base_url($image ?: 'assets/uploads/placeholder-book.svg');
    }
}
