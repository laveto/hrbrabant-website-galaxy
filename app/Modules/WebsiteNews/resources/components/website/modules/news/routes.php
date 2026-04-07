<?php

Route::get('', [App\Modules\WebsiteNews\Resources\Components\Website\Modules\News\WebsiteController::class, 'index']);
Route::get('/{news:slug}', [App\Modules\WebsiteNews\Resources\Components\Website\Modules\News\WebsiteController::class, 'show']);
