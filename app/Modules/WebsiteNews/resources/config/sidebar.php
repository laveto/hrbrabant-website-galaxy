<?php

if(!$websiteNewsCategoryActive) {
    return [
        [
            'action' => [App\Modules\WebsiteNews\Http\Controllers\NewsController::class, 'index'],
            'label' => 'Blog',
            'icon' => 'far fa-newspaper',
            'permission' => 'WebsiteNews::News.index',
            'weight' => 106,
        ]
    ];
}

return [
    [
        'action' => [App\Modules\WebsiteNews\Http\Controllers\NewsController::class, 'index'],
        'label' => 'Blog',
        'icon' => 'far fa-newspaper',
        'permission' => 'WebsiteNews::News.index',
        'weight' => 106,
        'items' => [

            [
                'action' => [App\Modules\WebsiteNews\Http\Controllers\NewsController::class, 'index'],
                'icon' => 'far fa-newspaper',
                'label' => 'Overzicht',
                'permission' => 'WebsiteNews::News.index',
            ],

            [
                'action' => [App\Modules\WebsiteNews\Http\Controllers\NewsCategoryController::class, 'index'],
                'icon' => 'far fa-fw fa-pencil',
                'label' => 'Beheer categorieën',
                'permission' => 'WebsiteNews::NewsCategory.index',
            ],

        ]
    ],
];
