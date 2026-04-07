<?php

namespace App\Modules\WebsiteNews\Resources\Components\Website\Modules\News;

use Galaxy\Canvas\Actions\CanvasByTag;
use Galaxy\Core\Http\Controllers\Controller;
use Galaxy\Website\Models\WebsitePage;
use App\Modules\WebsiteNews\Models\WebsiteNews;
use App\Modules\WebsiteNews\Services\NewsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class WebsiteController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(WebsitePage $websitePage)
    {
        // Grab all upcoming events
        $upcomingNews = WebsiteNews::published()
            ->multilanguage()
            ->with('media')
            ->orderBy(\DB::raw(NewsService::getOrderingExpression()), NewsService::getOrderingDirection())
            ->paginate($websitePage->module_options['paginate_amount'] ?? config('website_news.pagination'));

        // Set canvas.
        $canvas = CanvasByTag::run('website_news_index', false) ?: null;

        // Serve view.
        return view('website_news-component::website.modules.news.index', compact('websitePage', 'upcomingNews', 'canvas'));
    }

    /**
     * @return Application|Factory|View
     */
    public function show(WebsiteNews $news, WebsitePage $websitePage)
    {
        // Serve view.
        return view('website_news-component::website.modules.news.show', compact('news', 'websitePage'));
    }

}
