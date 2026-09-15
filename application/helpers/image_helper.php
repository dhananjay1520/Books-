<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('book_image_url')) {
    function book_image_url($image) {
        $value = trim(html_entity_decode((string)$image, ENT_QUOTES, 'UTF-8'));
        $placeholder = base_url('assets/uploads/placeholder-book.svg');
        if ($value === '') return $placeholder;
        if (preg_match('~^https?://~i', $value)) return $value;

        $value = str_replace('\\', '/', $value);
        $value = preg_replace('~[?#].*$~', '', $value);
        if ($value === null) $value = '';

        // Strip an absolute Windows/Linux project path when it is stored in the DB.
        $fcp = str_replace('\\', '/', rtrim((string)FCPATH, '/\\'));
        if ($fcp !== '' && stripos($value, $fcp) === 0) {
            $value = ltrim(substr($value, strlen($fcp)), '/');
        }

        // Handle values such as C:/xampp/htdocs/book/assets/uploads/foo.jpg.
        $value = preg_replace('~^[A-Za-z]:/xampp/htdocs/[^/]+/~i', '', $value);
        if ($value === null) $value = '';
        $value = ltrim($value, '/');

        // If the DB stored a full URL path, keep only its pathname.
        if (strpos($value, '://') !== false) {
            $parts = parse_url($value);
            if (!empty($parts['path'])) $value = ltrim($parts['path'], '/');
        }

        $base = basename($value);
        if ($base === '' || $base === '.' || $base === '..') return $placeholder;

        $candidates = array(
            $value,
            preg_replace('~^(?:assets/)?uploads/~i', 'assets/uploads/', $value),
            'assets/uploads/' . $base,
            'uploads/products/' . $value,
            'uploads/products/' . $base,
            'uploads/' . $value,
            'uploads/' . $base,
        );

        foreach (array_unique($candidates) as $candidate) {
            $candidate = ltrim(str_replace('\\', '/', (string)$candidate), '/');
            if ($candidate === '') continue;
            $full = FCPATH . str_replace('/', DIRECTORY_SEPARATOR, $candidate);
            if (is_file($full)) {
                $segments = array_values(array_filter(explode('/', $candidate), 'strlen'));
                return base_url(implode('/', array_map('rawurlencode', $segments)));
            }
        }

        // Legacy image folders: search once per request and remember the index.
        static $index = null;
        if ($index === null) {
            $index = array();
            foreach (array(FCPATH.'assets/uploads/', FCPATH.'uploads/') as $scanRoot) {
                if (!is_dir($scanRoot)) continue;
                try {
                    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($scanRoot, FilesystemIterator::SKIP_DOTS));
                    foreach ($it as $file) {
                        if (!$file->isFile()) continue;
                        $index[strtolower($file->getFilename())] = str_replace('\\', '/', $file->getPathname());
                    }
                } catch (Throwable $e) { /* Never break the page because an image folder cannot be scanned. */ }
            }
        }

        $found = $index[strtolower($base)] ?? '';
        if ($found !== '') {
            $rootPath = str_replace('\\', '/', rtrim(FCPATH, '/\\')) . '/';
            $relative = ltrim(str_replace($rootPath, '', $found), '/');
            if ($relative !== '') {
                $segments = array_values(array_filter(explode('/', $relative), 'strlen'));
                return base_url(implode('/', array_map('rawurlencode', $segments)));
            }
        }
        return $placeholder;
    }
}
