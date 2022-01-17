<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class GenerateSearchIndex
{
    public function handle(Jigsaw $jigsaw)
    {
        $data = collect($jigsaw->getCollection('posts')->map(function ($page) use ($jigsaw) {
            return [
                'title'             => $page->title,
                'link'              => rightTrimPath($jigsaw->getConfig('baseUrl')) . $page->getPath('web'),
                'excerpt'           => $page->excerpt,
                'englishSearchTerm' => str_replace('-', ' ', $page->getFilename()),
                'categories'        => $page->categories ?? []
            ];
        })->values());

        file_put_contents($jigsaw->getDestinationPath() . '/index.json', json_encode($data));
    }
}
