<?php namespace App\Listeners;

use Illuminate\Support\Str;
use TightenCo\Jigsaw\Jigsaw;
use samdark\sitemap\Sitemap;

class GenerateSitemap
{
    protected $exclude = [
        '/assets/*',
        '*/favicon.ico',
        '*/404*',
        '/api/*',
        '/en/api/*',
        '*/index.json',
        '*/sitemap.xml',
        '*/feed.xml',
    ];

    public function handle(Jigsaw $jigsaw)
    {
        $baseUrl = $jigsaw->getConfig('baseUrl');

        if (!$baseUrl) {
            echo("\nTo generate a sitemap.xml file, please specify a 'baseUrl' in config.php.\n\n");
            return;
        }

        $baseUrl = rtrim($baseUrl, '/');
        $sitemap = new Sitemap($jigsaw->getDestinationPath() . '/sitemap.xml', true);

        $paths = collect($jigsaw->getOutputPaths())
            ->map(fn ($path) => $this->normalizePath($path))
            ->filter(fn ($path) => !$this->isExcluded($path))
            ->unique()
            ->values();

        $pathSet = $paths->flip();
        $added = [];

        $paths->each(function ($path) use ($baseUrl, $sitemap, $pathSet, &$added) {
            if (isset($added[$path])) {
                return;
            }

            $alternate = $this->alternatePath($path);

            if ($alternate && isset($pathSet[$alternate]) && !isset($added[$alternate])) {
                $isEnglish = $path === '/en' || str_starts_with($path, '/en/');
                $bangla = $isEnglish ? $alternate : $path;
                $english = $isEnglish ? $path : $alternate;

                $sitemap->addItem([
                    'bn' => $this->absoluteUrl($baseUrl, $bangla),
                    'en' => $this->absoluteUrl($baseUrl, $english),
                ], time(), Sitemap::DAILY);

                $added[$bangla] = true;
                $added[$english] = true;

                return;
            }

            $sitemap->addItem($this->absoluteUrl($baseUrl, $path), time(), Sitemap::DAILY);
            $added[$path] = true;
        });

        $sitemap->write();
    }

    public function isExcluded($path)
    {
        return Str::is($this->exclude, $path);
    }

    private function normalizePath(string $path): string
    {
        $path = '/' . ltrim($path, '/');

        return $path === '/' ? '/' : rtrim($path, '/');
    }

    private function absoluteUrl(string $baseUrl, string $path): string
    {
        return $path === '/' ? $baseUrl : $baseUrl . $path;
    }

    private function alternatePath(string $path): ?string
    {
        if ($this->isPaginatedPath($path)) {
            return null;
        }

        return match (true) {
            $path === '/' => '/en',
            $path === '/en' => '/',
            $path === '/about' => '/en/about',
            $path === '/en/about' => '/about',
            $path === '/contact' => '/en/contact',
            $path === '/en/contact' => '/contact',
            str_starts_with($path, '/en/recipe/') => substr($path, 3),
            str_starts_with($path, '/recipe/') => '/en' . $path,
            default => $this->categoryAlternate($path),
        };
    }

    private function isPaginatedPath(string $path): bool
    {
        return (bool) preg_match('#/(?:\d+)$#', $path);
    }

    private function categoryAlternate(string $path): ?string
    {
        if (!preg_match('#^(/en)?/category/([^/]+)$#', $path, $matches)) {
            return null;
        }

        $isEnglish = $matches[1] === '/en';
        $slug = $matches[2];
        $locale = $isEnglish ? 'en' : 'bn';
        $targetLocale = $isEnglish ? 'bn' : 'en';
        $categories = require __DIR__ . '/../lang/categories.php';

        foreach ($categories['bn_to_en'] as $bangla => $english) {
            $source = $locale === 'en' ? $english : $bangla;

            if (category_slug($source) !== $slug) {
                continue;
            }

            $translated = translated_category($source, $targetLocale);

            if (!$translated) {
                return null;
            }

            $prefix = $targetLocale === 'en' ? '/en/category/' : '/category/';

            return $prefix . category_slug($translated);
        }

        return null;
    }
}
