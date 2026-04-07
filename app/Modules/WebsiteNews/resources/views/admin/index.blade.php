@extends('admin::layouts.layout', [
	'viewCssNs' => $cssNs,
	'title' => 'Blog',
])

@section('actions-right')
    @if(config('website_news.index_canvas'))
        <a href="{{ action([App\Modules\WebsiteNews\Http\Controllers\NewsController::class, 'indexCanvas']) }}{{ request()->has('language') ? '?language='.request()->language() : '' }}" class="mr-2 btn btn-primary">
            @include('admin::partials.icons.pencil', ['class' => 'mr-2'])
            Overzicht bewerken
        </a>
    @endif

    <a href="{{ action([App\Modules\WebsiteNews\Http\Controllers\NewsController::class, 'create']) }}{{ request()->has('language') ? '?language='.request()->language() : '' }}"
       class="btn btn-success">
        @include('admin::partials.icons.plus', ['class' => 'mr-2'])
        Blog item toevoegen
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
