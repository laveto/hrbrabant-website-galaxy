<?php

namespace App\Modules\Member\Http\Controllers;

use App\Modules\Member\Models\Member;
use App\Modules\Member\Http\Requests\StoreMember;
use Galaxy\Core\Http\Controllers\Admin\HasRightsTrait;
use Galaxy\Core\Http\Controllers\Controller;
use Galaxy\Crud\Http\Controllers\Datatable\SetReorderTrait;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;

class MemberController extends Controller
{
    use HasRightsTrait,
        SetReorderTrait;

    public function getSetOrderModel(): string
    {
        return Member::class;
    }

    public function index(Builder $builder): View|Factory|Application|JsonResponse
    {
        // Feed DataTable?
        if (request()->ajax()) {
            return DataTables::eloquent(Member::query()->orderBy('sequence'))
                ->addColumnTranslated('title')
                ->addColumnBoolean('published', null, fn ($model) => $model->isPublished())
                ->filterColumn('published', function ($query, $keyword) {
                    $sql = 'CASE WHEN published <> 0 THEN ":ja" ELSE ":nee" END  like ?';
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })

                // Add actions.
                ->addActionEdit(action([static::class, 'edit'], ['member' => ':id']))
                ->addActionDestroy(action([static::class, 'destroy'], ['member' => ':id']))
                ->make(true);
        }

        // Init DataTable.
        $dataTable = $builder
            ->columns([
                [
                    'data' => 'title',
                    'name' => 'title',
                    'title' => 'Titel',
                ],
                [
                    'data' => 'published',
                    'title' => 'Gepubliceerd',
                    'width' => 200,
                ],
            ])
            ->withActions()
            ->parameters([
                'order' => [[2, 'asc']],
            ]);

        $this->prepareDatatableForSetOrder($dataTable);

        // Init view.
        return view('member::admin.index', compact('dataTable'));
    }

    public function create(): Factory|View|Application
    {
        return view('member::admin.createEdit');
    }

    public function store(StoreMember $request): RedirectResponse
    {
        $model = new Member();

        $this->save($model, $request);

        return redirect()
            ->action([self::class, 'index'])
            ->with('success', __('Lid is toegevoegd'));
    }

    public function edit(Member $member): Factory|View|Application
    {
        return view('member::admin.createEdit', compact('member'));
    }

    public function update(Member $member, StoreMember $request): RedirectResponse
    {
        $this->save($member, $request);

        return redirect()
            ->action([self::class, 'index'])
            ->with('success', __('Lid is aangepast'));
    }

    public function destroy(Member $member): RedirectResponse
    {
        $member->delete();

        return redirect()
            ->action([self::class, 'index'])
            ->with('success', __('Lid is verwijderd'));
    }

    protected function save($model, $request): void
    {
        $request->saveModel($model);
    }
}
