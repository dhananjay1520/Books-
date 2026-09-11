<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('book_normalize_path')) {
    function book_normalize_path($path) {
        $path = trim((string)$path);
        if ($path === '') return '';
        $path = str_replace('\\', '/', $path);
        // Handle URLs saved in the database (including http://localhost/book/...)
        if (preg_match('#^https?://#i', $path)) {
            $parsed = parse_url($path, PHP_URL_PATH);
            $path = $parsed ?: $path;
        }
        return ltrim($path, '/');
    }
}

if (!function_exists('book_url_for_file')) {
    function book_url_for_file($relative) {
        $relative = ltrim(str_replace('\\', '/', $relative), '/');
        $parts = array_values(array_filter(explode('/', $relative), 'strlen'));
        return base_url(implode('/', array_map('rawurlencode', $parts)));
    }
}

if (!function_exists('book_find_uploaded_file')) {
    function book_find_uploaded_file($value, $type = 'product') {
        $value = book_normalize_path($value);
        if ($value === '') return false;
        $basename = basename($value);

        $roots = [
            FCPATH . 'uploads/',
            FCPATH . 'assets/uploads/'
        ];

        $candidates = [$value];
        if ($type === 'profile') {
            $candidates = array_merge($candidates, [
                'uploads/profile/' . $value,
                'uploads/profile/' . $basename,
                'uploads/admin_profile/' . $value,
                'uploads/admin_profile/' . $basename,
                'assets/uploads/' . $value,
                'assets/uploads/' . $basename
            ]);
        } else {
            $candidates = array_merge($candidates, [
                'uploads/products/' . $value,
                'uploads/products/' . $basename,
                'assets/uploads/' . $value,
                'assets/uploads/' . $basename
            ]);
        }

        foreach (array_unique($candidates) as $candidate) {
            $candidate = book_normalize_path($candidate);
            if ($candidate !== '' && is_file(FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $candidate))) {
                return $candidate;
            }
        }

        // Last-resort lookup: the original project has many legacy images stored
        // inside category subfolders under assets/uploads. Find the same filename.
        foreach ($roots as $root) {
            if (!is_dir($root)) continue;
            try {
                $iterator = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
                );
                foreach ($iterator as $file) {
                    if ($file->isFile() && strcasecmp($file->getFilename(), $basename) === 0) {
                        $full = str_replace('\\', '/', $file->getPathname());
                        $base = rtrim(str_replace('\\', '/', FCPATH), '/') . '/';
                        return ltrim(str_replace($base, '', $full), '/');
                    }
                }
            } catch (Throwable $e) {
                // Keep the placeholder fallback if the filesystem iterator is unavailable.
            }
        }
        return false;
    }
}

if (!function_exists('book_asset_url')) {
    function book_asset_url($path) {
        $path = book_normalize_path($path);
        if ($path === '') return base_url('assets/uploads/placeholder-book.svg');
        if (preg_match('#^https?://#i', (string)$path)) return $path;
        $found = book_find_uploaded_file($path, 'product');
        return $found ? book_url_for_file($found) : base_url('assets/uploads/placeholder-book.svg');
    }
}

if (!function_exists('product_image_url')) {
    function product_image_url($image) {
        $image = trim((string)$image);
        if ($image === '') return base_url('assets/uploads/placeholder-book.svg');
        if (preg_match('#^https?://#i', $image)) return $image;
        $found = book_find_uploaded_file($image, 'product');
        return $found ? book_url_for_file($found) : base_url('assets/uploads/placeholder-book.svg');
    }
}

if (!function_exists('profile_image_url')) {
    function profile_image_url($image, $admin = false) {
        $image = trim((string)$image);
        if ($image === '') return base_url('assets/uploads/profile-placeholder.svg');
        if (preg_match('#^https?://#i', $image)) return $image;
        $found = book_find_uploaded_file($image, 'profile');
        return $found ? book_url_for_file($found) : base_url('assets/uploads/profile-placeholder.svg');
    }
}
