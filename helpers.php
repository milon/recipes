<?php

if (!function_exists('vite_asset')) {
    /**
     * Get the path to a versioned asset from the Vite manifest.
     *
     * @param string $path Asset path (e.g. 'css/main.css' or 'js/main.js')
     * @param string $buildDir Build directory (e.g. 'assets/build')
     * @return string URL to the versioned asset
     */
    function vite_asset(string $path, string $buildDir = 'assets/build'): string
    {
        static $manifest = null;
        $manifestPath = __DIR__ . '/source/assets/build/.vite/manifest.json';
        if (!is_file($manifestPath)) {
            $manifestPath = __DIR__ . '/source/assets/build/manifest.json';
        }

        if ($manifest === null) {
            if (!is_file($manifestPath)) {
                return '/' . trim($buildDir, '/') . '/' . ltrim($path, '/');
            }
            $manifest = json_decode(file_get_contents($manifestPath), true) ?: [];
        }

        $buildDir = '/' . trim($buildDir, '/');

        foreach ($manifest as $entry) {
            if (empty($entry['isEntry'])) {
                continue;
            }
            if (str_ends_with($path, '.css') && !empty($entry['css'])) {
                return $buildDir . '/' . $entry['css'][0];
            }
            if (str_ends_with($path, '.js') && !empty($entry['file'])) {
                return $buildDir . '/' . $entry['file'];
            }
        }

        return $buildDir . '/' . ltrim($path, '/');
    }
}
