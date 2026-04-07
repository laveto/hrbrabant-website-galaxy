<?php

Route::get('/', [\App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy\Controller::class, 'index']);
Route::get('/{vacancy:slug}', [\App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy\Controller::class, 'show']);
