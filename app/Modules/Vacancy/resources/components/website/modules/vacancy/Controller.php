<?php

namespace App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy;

use App\Modules\Vacancy\Models\Vacancy;
use Galaxy\Core\Http\Controllers\Controller as BaseController;
use Galaxy\Website\Contracts\WebsitePage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class Controller extends BaseController
{
    public function index(WebsitePage $websitePage): Factory|View|Application
    {
        return view('vacancy-component::website.modules.vacancy.index', compact('websitePage'));
    }

    /**
     * @return Application|Factory|View
     */
    public function show(Vacancy $vacancy, WebsitePage $websitePage)
    {
        $vacancy->load('vacancyValues');
        return view('vacancy-component::website.modules.vacancy.show', compact('vacancy', 'websitePage'));
    }
}
