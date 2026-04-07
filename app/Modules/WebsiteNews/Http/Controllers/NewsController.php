<?php

namespace App\Modules\WebsiteNews\Http\Controllers;

use App\Modules\WebsiteNews\Http\Requests\StoreNews;
use Galaxy\Canvas\Actions\CanvasByTag;
use Galaxy\Canvas\Actions\Temporary\GetCanvas;
use Galaxy\Canvas\Actions\Temporary\SaveCanvasToModel;
use Galaxy\Core\Http\Controllers\Admin\HasRightsTrait;
use Galaxy\Core\Http\Controllers\Controller;
use App\Modules\WebsiteNews\Models\WebsiteNews;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class NewsController extends Controller
{
    use HasRightsTrait;

    public function index(Builder $builder): View|Factory|Application|JsonResponse
    {
        // Feed DataTable?
        if (request()->ajax()) {
            $datatables = DataTables::eloquent(WebsiteNews::query())
                ->addColumnTranslated('title')
                ->addColumnDate('date')
                ->addColumnBoolean('published', null, fn ($model) => $model->isPublished())
                ->addColumnDatetime('created_at');

                if( config('website_news.category.active') ) {
                    $datatables->addColumnTranslated('websiteNewsCategory.name', 'website_news_category');
                }

            return $datatables
                ->filterColumn('published', function ($query, $keyword) {
                    $sql = 'CASE WHEN published <> 0 THEN ":ja" ELSE ":nee" END  like ?';
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })

                // Add actions.
                ->addActionEdit(action([static::class, 'edit'], ['blog' => ':id']))
                ->addActionDestroy(action([static::class, 'destroy'], ['blog' => ':id']))
                ->make(true);
        }

        $columns = array_merge(
            config('website_news.category.active') 
                ? [
                    [
                        'data' => 'website_news_category',
                        'title' => 'Categorie',
                    ] 
                ]
                : [],

            [
                [
                    'data' => 'title',
                    'name' => 'title',
                    'title' => 'Titel',
                ],
                [
                    'data'=> 'date',
                    'name'=> 'date',
                    'width' => 150,
                ],
                [
                    'data' => 'published',
                    'title' => 'Gepubliceerd',
                    'width' => 200,
                ],
            ]
        );

        // Init DataTable.
        $dataTable = $builder
            ->columns($columns)
            ->withActions()
            ->parameters([
                'order' => [[count($columns) - 2, 'desc']],
            ]);

        // Init view.
        return view('website_news::admin.index', compact('dataTable'));
    }

    public function indexCanvas()
    {
        if (config('website_news.index_canvas')) {
            CanvasByTag::run('website_news_index');
        }

        return view('website_news::admin.indexCanvas');
    }

    public function create(): Factory|View|Application
    {
        if (config('website_news.show_canvas')) {
            GetCanvas::run('website_news');
        }

        return view('website_news::admin.createEdit');
    }

    public function store(StoreNews $request): RedirectResponse
    {
        $model = new WebsiteNews();

        $this->save($model, $request);

        return redirect()
            ->action([self::class, 'index'])
            ->with('success', __('Blog is toegevoegd'));
    }

    public function edit(WebsiteNews $blog): Factory|View|Application
    {
        return view('website_news::admin.createEdit', compact('blog'));
    }

    public function update(WebsiteNews $blog, StoreNews $request): RedirectResponse
    {
        $this->save($blog, $request);

        return redirect()
            ->action([self::class, 'index'])
            ->with('success', __('Blog is aangepast'));
    }

    public function destroy(WebsiteNews $blog): RedirectResponse
    {
        $blog->delete();

        return redirect()
            ->action([self::class, 'index'])
            ->with('success', __('Blog is verwijderd'));
    }

    protected function save($model, $request): void
    {
        $request->saveModel($model);

        // Save temporary canvas to model?
        if (config('website_news.canvas')) {
            SaveCanvasToModel::run('website_news', $model);
        }
    }
}
