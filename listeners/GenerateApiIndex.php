<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class GenerateApiIndex
{
    public function handle(Jigsaw $jigsaw)
    {
        $this->writeIndex($jigsaw, 'posts', 'api/index.json');
        $this->writeIndex($jigsaw, 'posts_en', 'en/api/index.json');
    }

    private function writeIndex(Jigsaw $jigsaw, string $collection, string $path): void
    {
        $data = collect($jigsaw->getCollection($collection)->map(function ($page) {
            return [
                'title' => $page->title,
                'link' => $page->getApiUrl(),
                'thumbnail' => $page->getApiThumbnail(),
                'date' => $page->date,
                'excerpt' => $page->excerpt,
                'categories' => $page->categories ?? [],
                'servings' => $page->servings ?? null,
                'prepMinutes' => $page->prepMinutes ?? null,
            ];
        })->values());

        file_put_contents($jigsaw->getDestinationPath() . "/{$path}", json_encode($data));
    }
}
