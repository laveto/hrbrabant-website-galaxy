<?php

return [

    /**
     *  Here we define the environments. We map the branch to the corresponding deploy url.
     */
    'environments' => [

        [
            'branch' => 'main',
            'deploy_url' => env('LASSO_TRIGGER_DEPLOY_URL'),
        ],

        /*
        [
            'branch' => 'develop',
            'deploy_url' => env('LASSO_TRIGGER_DEPLOY_URL_SECONDARY'),
        ],
        */

    ],

];
