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
        'member' => [
            'width' => 1000,
            'height' => 500,
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
            'members',
        ],

    ],

];
