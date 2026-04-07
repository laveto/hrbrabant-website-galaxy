<?php

/**
 * @see https://konekt.dev/concord/1.3/configuration
 */
$baseArray = [

    /**
     * Don't touch this.
     */
    'class' => Galaxy\Core\Library\Concord\Concord::class,
    'convention' => Galaxy\Core\Library\Concord\ConcordConvention::class,

    /**
     * Define the Concord modules to boot.
     */
    'modules' => [

        /**
         * Start Core.
         */
        Galaxy\Core\Providers\ModuleServiceProvider::class,

        /**
         * Determine which of our Concord modules should be started.
         */
        Galaxy\Admin\Providers\ModuleServiceProvider::class,
        Galaxy\Canvas\Providers\ModuleServiceProvider::class,
        Galaxy\Crud\Providers\ModuleServiceProvider::class,
        Galaxy\Docs\Providers\ModuleServiceProvider::class,
        Galaxy\Website\Providers\ModuleServiceProvider::class,
        Galaxy\WebsiteBlocks\Providers\ModuleServiceProvider::class,
        Galaxy\WebsiteForms\Providers\ModuleServiceProvider::class,
        Galaxy\Settings\Providers\ModuleServiceProvider::class,
        Galaxy\Redirect\Providers\ModuleServiceProvider::class,

        /**
         * Place app specific Concord modules here.
         */
        \App\Modules\Member\Providers\ModuleServiceProvider::class,
        \App\Modules\Vacancy\Providers\ModuleServiceProvider::class,
        \App\Modules\WebsiteNews\Providers\ModuleServiceProvider::class,
        Galaxy\StructuredData\Providers\ModuleServiceProvider::class,
    ],

];

// Development specific modules: only load when the app.env == 'local'
$environment = config('app.env');
if ($environment == 'local' || $environment == 'testing') {
    $baseArray['modules'][] = Galaxy\GalaxyTests\Providers\ModuleServiceProvider::class;

    if (file_exists('./galaxy/modules/Roylerplate')) {
        $baseArray['modules'][] = Galaxy\Roylerplate\Providers\ModuleServiceProvider::class;
    }
}

return $baseArray;
