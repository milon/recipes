<?php

if (!function_exists('category_slug')) {
    /**
     * URL-safe slug for a recipe category/tag name.
     */
    function category_slug(string $category): string
    {
        $slug = (string) str($category)->slug();

        return $slug !== '' ? $slug : 'tag-' . substr(md5($category), 0, 8);
    }
}

if (!function_exists('recipe_card_content')) {
    /**
     * Split rendered recipe HTML into the pieces a recipe card lays out separately.
     *
     * @param string|null $leadImage Photo shown by the card itself, so the body copy can drop it.
     * @return array{intro: string, ingredients: string, ingredientsTitle: string, method: string, methodTitle: string, extra: string}
     */
    function recipe_card_content(string $html, ?string $leadImage = null): array
    {
        if ($leadImage) {
            $html = recipe_without_image($html, $leadImage);
        }

        $chunks = preg_split('/<h2\b[^>]*>(.*?)<\/h2>/s', $html, -1, PREG_SPLIT_DELIM_CAPTURE);

        $parsed = [
            'intro' => trim((string) array_shift($chunks)),
            'ingredients' => '',
            'ingredientsTitle' => 'উপকরণ',
            'method' => '',
            'methodTitle' => 'রন্ধনপ্রণালী',
            'extra' => '',
        ];

        for ($i = 0; isset($chunks[$i + 1]); $i += 2) {
            $title = trim(strip_tags($chunks[$i]));
            $body = trim($chunks[$i + 1]);

            if ($parsed['ingredients'] === '' && str_contains($title, 'উপকরণ')) {
                $parsed['ingredients'] = $body;
                $parsed['ingredientsTitle'] = $title;
            } elseif ($parsed['method'] === '' && str_contains($title, 'রন্ধনপ্রণালী')) {
                $parsed['method'] = $body;
                $parsed['methodTitle'] = $title;
            } else {
                $parsed['extra'] .= '<h2>' . $title . '</h2>' . $body;
            }
        }

        return $parsed;
    }
}

if (!function_exists('recipe_without_image')) {
    /**
     * Remove every occurrence of one image from a block of rendered HTML.
     */
    function recipe_without_image(string $html, string $src): string
    {
        $image = '<img[^>]*src="' . preg_quote($src, '/') . '"[^>]*>';

        $html = preg_replace('/<p>\s*' . $image . '\s*<\/p>/', '', $html) ?? $html;

        return preg_replace('/' . $image . '/', '', $html) ?? $html;
    }
}

if (!function_exists('recipe_method_steps')) {
    /**
     * Turn the method paragraphs into numbered steps, keeping in-between photos in place.
     *
     * Returns the HTML untouched when the section holds anything other than paragraphs,
     * so unexpected markup is never reshaped into steps.
     *
     * @param callable|null $formatNumber Formats each step number, e.g. into Bengali digits.
     */
    function recipe_method_steps(string $html, ?callable $formatNumber = null): string
    {
        $blocks = '/<p\b[^>]*>(.*?)<\/p>/s';

        if (trim(preg_replace($blocks, '', $html) ?? 'unparsed') !== '') {
            return $html;
        }

        if (!preg_match_all($blocks, $html, $matches)) {
            return $html;
        }

        $output = '';
        $steps = [];
        $number = 1;

        $flush = function () use (&$output, &$steps, &$number, $formatNumber) {
            if (!$steps) {
                return;
            }

            $output .= '<ol class="recipe-steps" start="' . $number . '">';

            foreach ($steps as $step) {
                $label = $formatNumber ? $formatNumber($number) : (string) $number;

                $output .= '<li class="recipe-step">'
                    . '<span class="recipe-step-number" aria-hidden="true">' . $label . '</span>'
                    . '<div class="recipe-step-body">' . $step . '</div>'
                    . '</li>';

                $number++;
            }

            $output .= '</ol>';
            $steps = [];
        };

        foreach ($matches[1] as $content) {
            if (str_contains($content, '<img')) {
                $flush();
                $output .= '<figure class="recipe-figure">' . $content . '</figure>';

                continue;
            }

            $steps[] = $content;
        }

        $flush();

        return $output;
    }
}

if (!function_exists('recipe_figures')) {
    /**
     * Promote image-only paragraphs to figures so they can be styled as photos.
     */
    function recipe_figures(string $html): string
    {
        return preg_replace(
            '/<p>\s*(<img[^>]*>)\s*<\/p>/',
            '<figure class="recipe-figure">$1</figure>',
            $html
        ) ?? $html;
    }
}

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
