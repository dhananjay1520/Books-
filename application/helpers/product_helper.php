<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * BookSpot image helper.
 *
 * Handles legacy database values, Windows absolute paths, relative upload paths,
 * spaces/special characters in filenames and missing files without throwing a
 * fatal error. All public callers should use product_image_url() or
 * profile_image_url().
 */
if (!function_exists('bookspot_normalize_image_path')) {
    function bookspot_normalize_image_path($path) {
        $path = trim(html_entity_decode((string) $path, ENT_QUOTES, 'UTF-8'));
        if ($path === '') {
            return '';
        }

        // Remove query strings/fragments from stored URLs.
        $path = preg_replace('~[?#].*$~', '', $path);
        $path = str_replace('\\', '/', $path);

        // If an old database value contains a full URL, keep only its path.
        if (preg_match('#^https?://#i', $path)) {
            $urlPath = parse_url($path, PHP_URL_PATH);
            $path = $urlPath !== null ? $urlPath : $path;
        }

        // Convert a Windows absolute filesystem path into a relative web path.
        $fcp = str_replace('\\', '/', rtrim((defined('FCPATH') ? FCPATH : ''), '/\\'));
        if ($fcp !== '' && stripos($path, $fcp) === 0) {
            $path = substr($path, strlen($fcp));
        }

        // Also strip common XAMPP project prefixes if a database contains one.
        $path = preg_replace('~^[A-Za-z]:/xampp/htdocs/[^/]+/~i', '', $path);
        $path = preg_replace('#^/+\./+#', '', $path);
        $path = ltrim($path, '/');

        return $path;
    }
}

if (!function_exists('bookspot_relative_from_absolute')) {
    function bookspot_relative_from_absolute($absolutePath) {
        $absolutePath = str_replace('\\', '/', (string) $absolutePath);
        $root = str_replace('\\', '/', rtrim((defined('FCPATH') ? FCPATH : ''), '/\\'));
        if ($root !== '' && stripos($absolutePath, $root . '/') === 0) {
            return ltrim(substr($absolutePath, strlen($root)), '/');
        }
        return '';
    }
}

if (!function_exists('bookspot_url_for_file')) {
    function bookspot_url_for_file($relative) {
        $relative = ltrim(str_replace('\\', '/', (string) $relative), '/');
        $parts = array_values(array_filter(explode('/', $relative), 'strlen'));
        return base_url(implode('/', array_map('rawurlencode', $parts)));
    }
}

if (!function_exists('book_find_uploaded_file')) {
    function book_find_uploaded_file($value, $type = 'product') {
        $value = bookspot_normalize_image_path($value);
        if ($value === '') {
            return false;
        }

        $basename = basename($value);
        if ($basename === '' || $basename === '.' || $basename === '..') {
            return false;
        }

        $fcp = defined('FCPATH') ? FCPATH : '';
        if ($fcp === '') {
            return false;
        }

        // If the value itself is already a valid relative path, use it first.
        $directCandidates = [
            $value,
            preg_replace('#^(?:[^/]+/)?(?:assets/)?uploads/#i', '', $value),
        ];

        // Common locations used by BookSpot over its different versions.
        $clean = $directCandidates[1];
        $commonCandidates = [
            'assets/uploads/' . $clean,
            'assets/uploads/' . $basename,
            'uploads/products/' . $clean,
            'uploads/products/' . $basename,
            'uploads/' . $clean,
            'uploads/' . $basename,
        ];

        if ($type === 'profile') {
            $commonCandidates[] = 'uploads/profile/' . $clean;
            $commonCandidates[] = 'uploads/profile/' . $basename;
            $commonCandidates[] = 'uploads/admin_profile/' . $clean;
            $commonCandidates[] = 'uploads/admin_profile/' . $basename;
            $commonCandidates[] = 'assets/uploads/' . $basename;
        }

        foreach (array_unique(array_merge($directCandidates, $commonCandidates)) as $candidate) {
            $candidate = ltrim(str_replace('\\', '/', (string) $candidate), '/');
            if ($candidate === '') {
                continue;
            }
            $full = $fcp . str_replace('/', DIRECTORY_SEPARATOR, $candidate);
            if (is_file($full)) {
                return $candidate;
            }
        }

        // Last-resort basename search. This keeps old imported images working
        // even when their original category folder no longer matches the DB.
        $roots = [
            $fcp . 'assets/uploads/',
            $fcp . 'uploads/',
        ];
        foreach ($roots as $root) {
            if (!is_dir($root)) {
                continue;
            }
            try {
                $iterator = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($root, FilesystemIterator::SKIP_DOTS)
                );
                foreach ($iterator as $file) {
                    if ($file->isFile() && strcasecmp($file->getFilename(), $basename) === 0) {
                        $relative = bookspot_relative_from_absolute($file->getPathname());
                        if ($relative !== '') {
                            return $relative;
                        }
                    }
                }
            } catch (Throwable $e) {
                // Never break the page because an image folder cannot be scanned.
            }
        }

        return false;
    }
}

if (!function_exists('book_asset_url')) {
    function book_asset_url($path) {
        $found = book_find_uploaded_file($path, 'product');
        return $found
            ? bookspot_url_for_file($found)
            : base_url('assets/uploads/placeholder-book.svg');
    }
}

if (!function_exists('product_image_url')) {
    function product_image_url($image) {
        $image = trim((string) $image);
        if ($image !== '' && preg_match('#^https?://#i', $image)) {
            return $image;
        }
        return book_asset_url($image);
    }
}

if (!function_exists('profile_image_url')) {
    function profile_image_url($image, $admin = false) {
        $image = trim((string) $image);
        if ($image !== '' && preg_match('#^https?://#i', $image)) {
            return $image;
        }
        $found = book_find_uploaded_file($image, 'profile');
        return $found
            ? bookspot_url_for_file($found)
            : base_url('assets/uploads/profile-placeholder.svg');
    }
}
