<?php

if (!function_exists('site_translation')) {
    /**
     * Read a translated site string using dot notation.
     */
    function site_translation(string $locale, string $key, array $replace = []): string
    {
        static $translations = [];

        $locale = $locale === 'en' ? 'en' : 'bn';
        $translations[$locale] ??= require __DIR__ . "/lang/{$locale}.php";

        $value = $translations[$locale];
        foreach (explode('.', $key) as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                return $key;
            }

            $value = $value[$segment];
        }

        if (!is_string($value)) {
            return $key;
        }

        foreach ($replace as $name => $replacement) {
            $value = str_replace(":{$name}", (string) $replacement, $value);
        }

        return $value;
    }
}

if (!function_exists('english_recipe_exists')) {
    function english_recipe_exists(string $filename): bool
    {
        return glob(__DIR__ . "/source/_posts_en/*/{$filename}.md") !== [];
    }
}

if (!function_exists('translated_category')) {
    function translated_category(string $category, string $locale): ?string
    {
        static $categories;

        $categories ??= require __DIR__ . '/lang/categories.php';

        if ($locale === 'en') {
            return $categories['bn_to_en'][$category] ?? null;
        }

        $englishToBangla = array_flip($categories['bn_to_en']);

        return $englishToBangla[$category] ?? null;
    }
}

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

if (!function_exists('responsive_image_path')) {
    /**
     * Build the public path for a generated image variant.
     */
    function responsive_image_path(string $src, string $variant): ?string
    {
        if (!str_starts_with($src, '/assets/images/')) {
            return null;
        }

        $relativePath = substr($src, strlen('/assets/images/'));
        $pathInfo = pathinfo($relativePath);
        $directory = ($pathInfo['dirname'] ?? '.') === '.' ? '' : $pathInfo['dirname'] . '/';

        return '/assets/images/responsive/' . $directory
            . $pathInfo['filename'] . ".{$variant}.webp";
    }
}

if (!function_exists('responsive_image_url')) {
    /**
     * Return a generated WebP variant for a local image when one exists.
     */
    function responsive_image_url(?string $src, string $variant): ?string
    {
        if (!$src) {
            return null;
        }

        $url = responsive_image_path($src, $variant);

        if (!$url) {
            return null;
        }

        return is_file(__DIR__ . '/source' . $url) ? $url : null;
    }
}

if (!function_exists('local_image_dimensions')) {
    /**
     * Read intrinsic dimensions for a local source image.
     *
     * @return array{width: int, height: int}|null
     */
    function local_image_dimensions(?string $src): ?array
    {
        static $dimensions = [];

        if (!$src || !str_starts_with($src, '/assets/images/')) {
            return null;
        }

        if (array_key_exists($src, $dimensions)) {
            return $dimensions[$src];
        }

        $size = @getimagesize(__DIR__ . '/source' . $src);

        return $dimensions[$src] = $size
            ? ['width' => $size[0], 'height' => $size[1]]
            : null;
    }
}

if (!function_exists('responsive_image_srcset')) {
    /**
     * Build a width-based WebP srcset for detail and hero images.
     */
    function responsive_image_srcset(?string $src): ?string
    {
        $small = responsive_image_url($src, 'detail-640');
        $mobile = responsive_image_url($src, 'detail-768');
        $large = responsive_image_url($src, 'detail-1280');
        $dimensions = local_image_dimensions($src);

        if (!$small || !$mobile || !$large || !$dimensions) {
            return $large;
        }

        $variants = [
            min(640, $dimensions['width']) => $small,
            min(768, $dimensions['width']) => $mobile,
            min(1280, $dimensions['width']) => $large,
        ];
        ksort($variants);

        return collect($variants)
            ->map(fn (string $url, int $width) => "{$url} {$width}w")
            ->implode(', ');
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

        $html = recipe_responsive_images($html);

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

            if ($parsed['ingredients'] === '' && (
                str_contains($title, 'উপকরণ')
                || strcasecmp($title, 'Ingredients') === 0
            )) {
                $parsed['ingredients'] = $body;
                $parsed['ingredientsTitle'] = $title;
            } elseif ($parsed['method'] === '' && (
                str_contains($title, 'রন্ধনপ্রণালী')
                || in_array(strtolower($title), ['method', 'directions', 'instructions'], true)
            )) {
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
     * Turn the method paragraphs into steps, keeping in-between photos in place.
     *
     * Returns the HTML untouched when the section holds anything other than paragraphs,
     * so unexpected markup is never reshaped into steps.
     */
    function recipe_method_steps(string $html): string
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

        $flush = function () use (&$output, &$steps, &$number) {
            if (!$steps) {
                return;
            }

            $output .= '<ol class="recipe-steps" start="' . $number . '">';

            foreach ($steps as $step) {
                $output .= '<li class="recipe-step">'
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

if (!function_exists('recipe_responsive_images')) {
    /**
     * Use generated WebP sources for in-body photos and load them lazily.
     */
    function recipe_responsive_images(string $html): string
    {
        return preg_replace_callback('/<img\b([^>]*)>/', function (array $match) {
            $attributes = rtrim($match[1]);
            $selfClosing = str_ends_with($attributes, '/');
            if ($selfClosing) {
                $attributes = rtrim(substr($attributes, 0, -1));
            }

            if (!str_contains($attributes, 'loading=')) {
                $attributes .= ' loading="lazy"';
            }

            if (!str_contains($attributes, 'decoding=')) {
                $attributes .= ' decoding="async"';
            }

            if (!preg_match('/\bsrc="([^"]+)"/', $attributes, $srcMatch)) {
                return '<img' . $attributes . ($selfClosing ? ' /' : '') . '>';
            }

            $dimensions = local_image_dimensions($srcMatch[1]);
            if ($dimensions && !str_contains($attributes, 'width=')) {
                $attributes .= ' width="' . $dimensions['width'] . '"';
            }
            if ($dimensions && !str_contains($attributes, 'height=')) {
                $attributes .= ' height="' . $dimensions['height'] . '"';
            }

            $webpSrcset = responsive_image_srcset($srcMatch[1]);
            if (!$webpSrcset) {
                return '<img' . $attributes . ($selfClosing ? ' /' : '') . '>';
            }

            return '<picture><source srcset="' . htmlspecialchars($webpSrcset, ENT_QUOTES)
                . '" sizes="(min-width: 992px) 760px, 100vw"'
                . ' type="image/webp"><img' . $attributes
                . ($selfClosing ? ' /' : '') . '></picture>';
        }, $html) ?? $html;
    }
}

if (!function_exists('recipe_figures')) {
    /**
     * Promote image-only paragraphs to figures so they can be styled as photos.
     */
    function recipe_figures(string $html): string
    {
        return preg_replace(
            '/<p>\s*(<picture>.*?<\/picture>|<img[^>]*>)\s*<\/p>/s',
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
