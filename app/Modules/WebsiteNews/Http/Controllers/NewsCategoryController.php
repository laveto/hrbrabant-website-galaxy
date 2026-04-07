<?php

namespace App\Modules\WebsiteNews\Http\Controllers;

use Galaxy\Core\Http\Controllers\Admin\HasRightsTrait;
use Galaxy\Core\Http\Controllers\Controller;
use App\Modules\WebsiteNews\Http\Requests\StoreNewsCategory;
use App\Modules\WebsiteNews\Models\WebsiteNewsCategory;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class NewsCategoryController extends Controller
{
    use HasRightsTrait;

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Builder $builder)
    {
        // Feed DataTable?
        if (request()->ajax()) {
            return DataTables::eloquent(WebsiteNewsCategory::query())
                ->addColumnTranslated('name')

                // Add actions.
                ->addActionEdit(action([static::class, 'edit'], ['category' => ':id']))
                ->addActionDestroy(action([static::class, 'destroy'], ['category' => ':id']))
                ->make(true);
        }

        // Init DataTable.
        $dataTable = $builder->columns([
            [
                'data' => 'name',
                'name' => 'name->nl',
                'title' => 'Naam',
            ],
        ])
            ->withActions()
            ->parameters([
                'order' => [
                    [0, 'asc'],
                ],
            ]);

        // Init view.
        return view('website_news::admin.categories.index', compact('dataTable'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        // View
        return view('website_news::admin.categories.createEdit');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreNewsCategory $request): \Illuminate\Http\RedirectResponse
    {
        // Create model
        $model = new WebsiteNewsCategory();

        // Save model
        $this->save($model, $request);

        // Redirect and notify
        return redirect()->action([static::class, 'index'])
            ->with('success', __('Blog categorie is toegevoegd'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(WebsiteNewsCategory $category)
    {
        // View
        return view('website_news::admin.categories.createEdit', compact('category'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(WebsiteNewsCategory $category, StoreNewsCategory $request): \Illuminate\Http\RedirectResponse
    {
        // Update block
        $this->save($category, $request);

        // Redirect and notify
        return redirect()->action([static::class, 'index'])
            ->with('success', __('Blog categorie is aangepast'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(WebsiteNewsCategory $category): \Illuminate\Http\RedirectResponse
    {
        // Delete model
        $category->delete();

        // Redirect and notify
        return redirect()->action([static::class, 'index'])
            ->with('success', __('Blog is verwijderd'));
    }

    /**
     * This function saves the model(s) to the database
     *  (used as shortcut so you don't have code duplication)
     *
     * @param $model
     * @param $request
     */
    protected function save($model, $request): void
    {
        // Fill and save model
        $request->saveModel($model);
    }
}
