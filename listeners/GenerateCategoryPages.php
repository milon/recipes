<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class GenerateCategoryPages
{
    public function handle(Jigsaw $jigsaw)
    {
        $perPage = (int) ($jigsaw->getConfig('perPage') ?? 9);

        collect([
            'bn' => ['collection' => 'posts', 'prefix' => ''],
            'en' => ['collection' => 'posts_en', 'prefix' => 'en/'],
        ])->each(function (array $settings, string $locale) use ($jigsaw, $perPage) {
            $posts = $jigsaw->getCollection($settings['collection']);

            $posts
                ->flatMap(fn ($post) => collect($post->categories ?? []))
                ->map(fn ($category) => (string) $category)
                ->filter()
                ->unique()
                ->sort()
                ->values()
                ->each(function (string $category) use ($jigsaw, $posts, $perPage, $locale, $settings) {
                    $slug = category_slug($category);
                    $collectionKey = "category_{$locale}_{$slug}";
                    $translatedCategory = translated_category($category, $locale === 'en' ? 'bn' : 'en');
                    $alternateUrl = $translatedCategory
                        ? ($locale === 'en' ? '/category/' : '/en/category/') . category_slug($translatedCategory)
                        : ($locale === 'en' ? '/' : '/en');

                    $filtered = $posts->filter(function ($post) use ($category) {
                        return collect($post->categories ?? [])
                            ->map(fn ($item) => (string) $item)
                            ->contains($category);
                    })->values();

                    $jigsaw->setConfig($collectionKey, $filtered);

                    $jigsaw->paginateCollection(
                        path: "{$settings['prefix']}category/{$slug}",
                        collection: $collectionKey,
                        template: '_layouts.category',
                        perPage: $perPage,
                        variables: [
                            'locale' => $locale,
                            'alternateUrlPath' => $alternateUrl,
                            'translationAvailable' => $translatedCategory !== null,
                            'category' => $category,
                            'categoryCount' => $filtered->count(),
                            'title' => "#{$category}",
                            'subtitle' => site_translation($locale, 'site.name'),
                            'description' => site_translation(
                                $locale,
                                'category.description',
                                ['category' => $category],
                            ),
                        ],
                    );
                });
        });
    }
}
