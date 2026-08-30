<?php

use League\HTMLToMarkdown\HtmlConverter;

$renderApi = function ($page) {
    return json_encode([
        'title' => $page->title,
        'link' => $page->getApiUrl(),
        'date' => $page->date,
        'excerpt' => $page->excerpt,
        'subtitle' => $page->subtitle,
        'thumbnail' => $page->getApiThumbnail(),
        'body' => $page->getBody(),
        'englishSearchTerm' => str_replace('-', ' ', $page->getFilename()),
        'categories' => $page->categories ?? [],
        'servings' => $page->servings ?? null,
        'prepMinutes' => $page->prepMinutes ?? null,
    ]);
};

return [
    // Replace with the baseUrl of your site. For example, https://jigsaw-clean-blog.netlify.com
    'baseUrl' => 'http://recipes.test/',
    'production' => false,
    'locale' => 'bn',

    'contactFormUrl' => 'https://formspree.io/f/mjvqjkvl',

    'collections' => [
        // Posts collection sorted by date and in descending order (latest post at the top)
        'posts' => [
            'path' => [
                'web' => '/recipe/{filename}',
                'api' => '/api/recipe/{filename}',
            ],
            'sort' => '-date',
            'locale' => 'bn',
            'api' => $renderApi,
        ],
        'posts_en' => [
            'path' => [
                'web' => '/en/recipe/{filename}',
                'api' => '/en/api/recipe/{filename}',
            ],
            'sort' => '-date',
            'locale' => 'en',
            'api' => $renderApi,
        ],
    ],

    // Number of collection items to show per page
    'perPage' => 9,

    // Number of links in the pagination section, should be a odd number greater than or equals to 3
    'paginatationLinkNumber' => 5,

    // The email address to send the https://formspree.io/ contact form submissions to
    'email' => 'contact@milon.im',

    // The name of the site. This is used in the nav and footer
    'siteName' => 'সহজ রেসিপি',

    // The description of the site. This is used in for the site's default metadata
    'siteDescription' => 'রান্না করা খুব কঠিন কোন কাজ না, আমি যেহেতু পারছি, পারবেন আপনিও...',

    // The name of the site Author. Your name! This is used when building the rss feed
    'siteAuthor' => 'মিলন',

    't' => function ($page, string $key, array $replace = []) {
        return site_translation($page->locale ?? 'bn', $key, $replace);
    },

    'localizedSiteName' => function ($page) {
        return $page->t('site.name');
    },

    'localizedSiteDescription' => function ($page) {
        return $page->t('site.description');
    },

    'localePrefix' => function ($page) {
        return ($page->locale ?? 'bn') === 'en' ? '/en' : '';
    },

    'homeUrl' => function ($page) {
        return ($page->locale ?? 'bn') === 'en' ? '/en' : '/';
    },

    'alternateUrl' => function ($page) {
        if ($page->alternateUrlPath ?? null) {
            return $page->alternateUrlPath;
        }

        $locale = $page->locale ?? 'bn';
        if ($page->date ?? null) {
            $filename = $page->getFilename();

            if ($locale === 'en') {
                return "/recipe/{$filename}";
            }

            return english_recipe_exists($filename) ? "/en/recipe/{$filename}" : '/en';
        }

        return $locale === 'en' ? '/' : '/en';
    },

    'hasTranslation' => function ($page) {
        if (($page->translationAvailable ?? null) !== null) {
            return (bool) $page->translationAvailable;
        }

        if ($page->alternateUrlPath ?? null) {
            return true;
        }

        if ($page->date ?? null) {
            return ($page->locale ?? 'bn') === 'en'
                || english_recipe_exists($page->getFilename());
        }

        return false;
    },

    // How many bg-{n}.jpg files live in source/assets/images/backgrounds
    'backgroundCount' => 10,

    // Social media links/icons that are used in the footer, add as many as you like!
    'socials' => [
        'twitter' => [
            'link' => 'https://twitter.com/to_milon',
            'icon' => 'twitter',
        ],
        'facebook' => [
            'link' => 'https://www.facebook.com/sohoj.recipes',
            'icon' => 'facebook',
        ],
        'rss' => [
            'link' => '/feed.xml',
            'icon' => 'rss',
        ]
    ],

    'getCategoryUrl' => function ($page, $category) {
        return $page->localePrefix() . '/category/' . category_slug((string) $category);
    },

    'getApiUrl' => function($page) {
        return rightTrimPath($page->baseUrl) . $page->getPath('api');
    },

    'getApiThumbnail' => function($page) {
        return rightTrimPath($page->baseUrl) . $page->metaImage;
    },

    'getBody' => function ($page) {
        static $converter;

        if ($converter === null) {
            $converter = new HtmlConverter(['header_style' => 'atx']);
            $converter->getConfig()->setOption('strip_tags', true);
        }

        $markdown = $converter->convert($page->getContent());

        return str_replace(
            '/assets/images',
            $page->baseUrl . '/assets/images',
            $markdown
        );
    },

    'formatDate' => function ($page, $date) {
        // format date
        $str = date("F j, Y", strtotime($date));
        if (($page->locale ?? 'bn') === 'en') {
            return $str;
        }

        // translate number
        $str = $page->translateNumber($str);

        // translate day
        $enDay = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $enShortDay = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $bnDay = ['জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];

        $str = str_replace($enDay, $bnDay, $str);
        return str_replace($enShortDay, $bnDay, $str);
    },

    'translateNumber' => function($page, $number) {
        if (($page->locale ?? 'bn') === 'en') {
            return (string) $number;
        }

        $enNum = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $bnNum = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return str_replace($enNum, $bnNum, $number);
    },

    'formatServings' => function ($page, $servings = null) {
        $servings = (int) ($servings ?? $page->servings ?? 0);

        return $servings > 0
            ? $page->t('recipe.servings', ['count' => $page->translateNumber($servings)])
            : null;
    },

    'formatPrepTime' => function ($page, $minutes = null) {
        $minutes = (int) ($minutes ?? $page->prepMinutes ?? 0);
        if ($minutes <= 0) {
            return null;
        }

        if ($minutes < 60) {
            return $page->t('recipe.minutes', ['count' => $page->translateNumber($minutes)]);
        }

        $hours = intdiv($minutes, 60);
        $remainder = $minutes % 60;
        $label = $page->t('recipe.hours', ['count' => $page->translateNumber($hours)]);

        if ($remainder) {
            $label .= ' ' . $page->t('recipe.minutes', ['count' => $page->translateNumber($remainder)]);
        }

        return $label;
    },

    'backgroundImage' => function ($page, $number) {
        return "/assets/images/backgrounds/bg-$number.jpg";
    },

    'heroBackground' => function ($page) {
        static $backgrounds = [];

        $key = spl_object_id($page);

        return $backgrounds[$key] ??= $page->backgroundImage(rand(1, $page->backgroundCount));
    },

    'randomBackground' => function ($page) {
        return $page->backgroundImage(rand(1, $page->backgroundCount));
    },
];
