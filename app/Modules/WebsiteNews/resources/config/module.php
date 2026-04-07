<?php

// Since this value gets passed to the sidebar config, we set it up here.
$websiteNewsCategoryActive = false;

return [

    /**
     * Concord
     */
    'routes' => [

        'prefix' => '',

        /**
         * Link to a middleware group located in our ServiceProvider of this module.
         *
         * Don't overwrite this middleware property. Use `$this->app['router']->prependMiddlewareToGroup('admin', MyMiddleware::class);` from other Concord modules to extend this middleware group.
         */
        'middleware' => [
            'admin',
        ],

        /**
         * This can be used to add middleware to the Route::concordModuleGroup function
         */
        'groupMiddleware' => [
            'admin',
            'admin.auth',
        ],

        'files' => [
            'admin',
        ],

    ],

    /**
     * Use the extended version of the module? e.g. extra functionalities?
     */
    'extended' => true,

    'pagination' => 5,

    /**
     * Determine if the category functionality should be active or not.
     */
    'category' => [
        'active' => $websiteNewsCategoryActive,
    ],

    'item' => [
        'show' =>  [
            'title' => true,
            'image' => true,
            'author' => true,
            'read_more' => false,

            'date' => [
                // Show the news item date.
                'active' => true,
                
                // Show the news item date until this date. Carbon parseable.
                'show_until' => '-2 months',
            ],

        ]
    ],

    'sorting' => [
        'default' => 'date',
        'direction' => 'desc',

        'fallback' => 'COALESCE(publish_at, created_at)',
    ],

    /**
     * Determine the image dimensions.
     */
    'image' => [
        'news' => [
            'width' => 1620,
            'height' => 1024,
        ],
        'category' => [
            'width' => 1620,
            'height' => 1024,
        ]
    ],

    /**
     * Admin specific settings.
     */
    'admin' => [

        /**
         * Sidebar
         */
        'sidebar' => require 'sidebar.php',

    ],

    /**
     * Core specific settings.
     */
    'core' => [

        /**
         * Summarize all tables which should be seeder using iSeed.
         */
        'table_seeders' => [
            'website_news_categories',
            'website_news',
        ],

    ],

    'show_canvas' => true,

    'index_canvas' => false,

];
