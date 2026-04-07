<?php

Route::adminModulesGroup(function () {
    Route::resource('blogs', App\Modules\WebsiteNews\Http\Controllers\NewsController::class)->except('show');
    Route::resource('blogs/categories', App\Modules\WebsiteNews\Http\Controllers\NewsCategoryController::class);
    Route::get('blogs/indexCanvas', [App\Modules\WebsiteNews\Http\Controllers\NewsController::class, 'indexCanvas']);
});
