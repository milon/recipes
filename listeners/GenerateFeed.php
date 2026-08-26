<?php

namespace App\Listeners;

use Suin\RSSWriter\Channel;
use Suin\RSSWriter\Feed;
use Suin\RSSWriter\Item;
use TightenCo\Jigsaw\Jigsaw;

class GenerateFeed
{
    public function handle(Jigsaw $jigsaw)
    {
        $config = $jigsaw->getConfig();

        if (!$config['baseUrl']) {
            echo("\nTo generate a rss.xml file, please specify a 'baseUrl' in config.php.\n\n");
            return;
        }

        $this->writeFeed($jigsaw, 'posts', 'bn', 'feed.xml');
        $this->writeFeed($jigsaw, 'posts_en', 'en', 'en/feed.xml');
    }

    private function writeFeed(Jigsaw $jigsaw, string $collection, string $locale, string $path): void
    {
        $baseUrl = rtrim($jigsaw->getConfig('baseUrl'), '/');
        $siteName = site_translation($locale, 'site.name');
        $feed = new Feed();

        $channel = new Channel();
        $channel
            ->title($siteName)
            ->description(site_translation($locale, 'site.description'))
            ->url($baseUrl . ($locale === 'en' ? '/en' : ''))
            ->feedUrl($baseUrl . "/{$path}")
            ->language($locale)
            ->copyright('Copyright © ' . $siteName . ' ' . (new \DateTime())->format('Y'))
            ->pubDate((new \DateTime())->getTimestamp())
            ->lastBuildDate((new \DateTime())->getTimestamp())
            ->appendTo($feed);

        $jigsaw->getCollection($collection)->each(function ($post) use ($baseUrl, $channel, $locale) {
            // Blog item
            $url = $baseUrl . $post->getPath('web');
            $item = new Item();
            $item
                ->title($post->title)
                ->description($post->excerpt)
                ->contentEncoded($post)
                ->url($url)
                ->author(site_translation($locale, 'site.author'))
                ->pubDate(strtotime($post->date))
                ->guid($url, true)
                ->preferCdata(true) // By this, title and description become CDATA wrapped HTML.
                ->appendTo($channel);
        });

        $jigsaw->writeOutputFile($path, $feed->render());
    }
}
