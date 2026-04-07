@extends('admin::layouts.layout', [
	'viewCssNs' => $cssNs,
	'title' => 'Blog categorieën',
])

@section('actions-right')
    <a href="{{ action([App\Modules\WebsiteNews\Http\Controllers\NewsCategoryController::class, 'create']) }}"
       class="btn pull-right btn-success">
        @include('admin::partials.icons.plus', ['class' => 'mr-2'])
        Categorie toevoegen
    </a>
@endsection

@section('content')

    <div class="{{ $cssNs }}">

        {!! $dataTable->table() !!}

    </div>

@endsection

@push('foot')
    {!! $dataTable->scripts() !!}
@endpush
