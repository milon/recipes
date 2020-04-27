<?php

namespace App\Listeners;

use TightenCo\Jigsaw\Jigsaw;

class GenerateApiIndex
{
    public function handle(Jigsaw $jigsaw)
    {
        $data = collect($jigsaw->getCollection('posts')->map(function ($page) use ($jigsaw) {
            return [
                'title'      => $page->title,
                'link'       => $page->getApiUrl(),
                'thumbnail'  => $page->getApiThumbnail(),
                'date'       => $page->date,
                'excerpt'    => $page->excerpt,
                'categories' => $page->categories ?? []
            ];
        })->values());

        file_put_contents($jigsaw->getDestinationPath() . '/api/index.json', json_encode($data));
    }
}
