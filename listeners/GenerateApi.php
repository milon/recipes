<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class GenerateApi
{
    public function handle(Jigsaw $jigsaw)
    {
        $data = collect($jigsaw->getCollection('posts')->map(function ($page) use ($jigsaw) {
            return [
                'title'             => $page->title,
                'link'              => rightTrimPath($jigsaw->getConfig('baseUrl')) . $page->getPath(),
                'date'              => $page->date,
                'excerpt'           => $page->excerpt,
                'body'              => $page->getContent(),
                'englishSearchTerm' => str_replace('-', ' ', $page->getFilename()),
                'categories'        => $page->categories ?? []
            ];
        })->values());

        mkdir($jigsaw->getDestinationPath().'/api', 0755);
        file_put_contents($jigsaw->getDestinationPath() . '/api/index.json', json_encode($data));
    }
}
