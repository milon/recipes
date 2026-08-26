<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class GenerateCategoryPages
{
    public function handle(Jigsaw $jigsaw)
    {
        $posts = $jigsaw->getCollection('posts');
        $perPage = (int) ($jigsaw->getConfig('perPage') ?? 9);

        $posts
            ->flatMap(fn ($post) => collect($post->categories ?? []))
            ->map(fn ($category) => (string) $category)
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->each(function (string $category) use ($jigsaw, $posts, $perPage) {
                $slug = category_slug($category);
                $collectionKey = "category_{$slug}";

                $filtered = $posts->filter(function ($post) use ($category) {
                    return collect($post->categories ?? [])
                        ->map(fn ($item) => (string) $item)
                        ->contains($category);
                })->values();

                $jigsaw->setConfig($collectionKey, $filtered);

                $jigsaw->paginateCollection(
                    path: "category/{$slug}",
                    collection: $collectionKey,
                    template: '_layouts.category',
                    perPage: $perPage,
                    variables: [
                        'category' => $category,
                        'categoryCount' => $filtered->count(),
                        'title' => "#{$category}",
                        'subtitle' => $jigsaw->getConfig('siteName'),
                        'description' => "{$category} বিষয়ক সব রেসিপি",
                    ],
                );
            });
    }
}
