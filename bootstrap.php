<?php

use TightenCo\Jigsaw\Jigsaw;

/** @var $container \Illuminate\Container\Container */
/** @var $events \TightenCo\Jigsaw\Events\EventBus */

/**
 * You can run custom code at different stages of the build process by
 * listening to the 'beforeBuild', 'afterCollections', and 'afterBuild' events.
 *
 * For example:
 *
 * $events->beforeBuild(function (Jigsaw $jigsaw) {
 *     // Your code here
 * });
 */

// Generate sitemap listener
$events->afterBuild(App\Listeners\GenerateSitemap::class);

// Generate rss feed listener
$events->afterBuild(App\Listeners\GenerateFeed::class);

// Generate search index
$events->afterBuild(App\Listeners\GenerateSearchIndex::class);

// Generate json API index
$events->afterBuild(App\Listeners\GenerateApiIndex::class);
