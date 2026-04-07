@extends('admin::layouts.layout', [
	'viewCssNs' => $cssNs,
	'title' => 'Blog index canvas',
])

@section('content')

    <div class="{{ $cssNs }}">

        @if( config('website_news.index_canvas') )
            @include('canvas::editor', [
                 'title' => __('Canvas'),
                 'instruction' => __('Pas aan welke canvas blokken getoond worden op de blog index pagina.'),
                 'canvas' => \Galaxy\Canvas\Actions\CanvasByTag::run('website_news_index')
             ])
        @endif

    </div>

@endsection
