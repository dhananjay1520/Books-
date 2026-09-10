<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Product Helper
|--------------------------------------------------------------------------
| Product images DB me kabhi sirf filename ("cover.jpg") store hote hain
| aur kabhi full/relative path ke saath. Views mein seedha
| htmlspecialchars($product['image']) likhne se image "not found" ho jati
| thi kyunki browser use current page ke relative path se dhoondhta tha.
| Ye helper hamesha ek sahi, complete image URL return karta hai.
*/

if (!function_exists('product_image_url')) {
    function product_image_url($image) {
        $image = trim((string) $image);

        // Koi image set hi nahi hai -> ek clean placeholder dikhao
        if ($image === '') {
            return 'https://placehold.co/400x600/f4f4f4/999999?text=No+Image';
        }

        // Already a full URL (http/https)
        if (preg_match('#^https?://#i', $image)) {
            return $image;
        }

        $CI =& get_instance();

        // Path already has a folder in it (e.g. "assets/uploads/x.jpg" or "/assets/uploads/x.jpg")
        if (strpos($image, '/') !== false) {
            return $CI->config->base_url(ltrim($image, '/'));
        }

        // Sirf filename hai -> assume products ki images assets/uploads/ me hain
        return $CI->config->base_url('assets/uploads/' . rawurlencode($image));
    }
}
