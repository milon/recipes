<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class GenerateSearchIndex
{
    public function handle(Jigsaw $jigsaw)
    {
        $this->writeIndex($jigsaw, 'posts', 'index.json');
        $this->writeIndex($jigsaw, 'posts_en', 'en/index.json');
    }

    private function writeIndex(Jigsaw $jigsaw, string $collection, string $path): void
    {
        $data = collect($jigsaw->getCollection($collection)->map(function ($page) use ($jigsaw) {
            return [
                'title' => $page->title,
                'link' => rightTrimPath($jigsaw->getConfig('baseUrl')) . $page->getPath('web'),
                'excerpt' => $page->excerpt,
                'image' => $page->metaImage ?? null,
                'englishSearchTerm' => str_replace('-', ' ', $page->getFilename()),
                'categories' => $page->categories ?? [],
            ];
        })->values());

        file_put_contents($jigsaw->getDestinationPath() . "/{$path}", json_encode($data));
    }
}
