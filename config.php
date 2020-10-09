<?php

return [
    // Replace with the baseUrl of your site. For example, https://jigsaw-clean-blog.netlify.com
    'baseUrl' => 'http://localhost:8000',
    'production' => false,


    'collections' => [
        // Posts collection sorted by date and in descending order (latest post at the top)
        'posts' => [
            'path' => [
                'web' => '/recipe/{filename}',
                'api' => '/api/recipe/{filename}',
            ],
            'sort' => '-date',
            'api' => function ($page) {
                return json_encode([
                    'title'             => $page->title,
                    'link'              => $page->getApiUrl(),
                    'date'              => $page->date,
                    'excerpt'           => $page->excerpt,
                    'subtitle'          => $page->subtitle,
                    'thumbnail'         => $page->getApiThumbnail(),
                    'body'              => $page->getBody(),
                    'englishSearchTerm' => str_replace('-', ' ', $page->getFilename()),
                    'categories'        => $page->categories ?? []
                ]);
            },
        ]
    ],

    // Number of collection items to show per page
    'perPage' => 7,

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

    // Social media links/icons that are used in the footer, add as many as you like!
    'socials' => [
        'twitter' => [
            'link' => 'https://twitter.com/to_milon',
            'icon' => 'fab fa-twitter',
        ],
        'facebook' => [
            'link' => 'https://www.facebook.com/sohoj.recipes',
            'icon' => 'fab fa-facebook-f',
        ],
        'rss' => [
            'link' => '/feed.xml',
            'icon' => 'fas fa-rss',
        ]
    ],

    // Google Analytics Tracking Id. For example, UA-123456789-1
    'gaTrackingId' => 'UA-162769200-1',

    'getApiUrl' => function($page) {
        return rightTrimPath($page->baseUrl) . "/api/recipe/{$page->getFilename()}.json";
    },

    'getApiThumbnail' => function($page) {
        return rightTrimPath($page->baseUrl) . $page->metaImage;
    },

    'getBody' => function($page) {
        return str_replace(
            '/assets/images',
            $page->baseUrl . '/assets/images',
            $page->getContent()
        );
    },

    'banglaDate' => function ($page, $date) {
        // format date
        $str = date("F j, Y", strtotime($date));

        // translate number
        $str = $page->translateNumber($str);

        // translate day
        $enDay = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $enShortDay = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $bnDay = ['জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];

        $str = str_replace($enDay, $bnDay, $str);
        return str_replace($enShortDay, $bnDay, $str);
    },

    'translateNumber' => function($page, $number) {
        $enNum = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $bnNum = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return str_replace($enNum, $bnNum, $number);
    },

    'randomBackground' => function ($page) {
        $random = rand(1, 10);
        return "/assets/images/backgrounds/bg-$random.jpg";
    },
];
