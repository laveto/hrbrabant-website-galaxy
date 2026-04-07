<?php

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
     * Determine the image dimensions.
     */
    'image' => [
        'vacancy' => [
            'width' => 1920,
            'height' => 1080,
        ],
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
            'vacancies',
        ],

    ],

    'api' => [
        'key' => env('OTYS_API_KEY'),
        'website_id' => env('OTYS_WEBSITE_ID', 2),
    ],

];
