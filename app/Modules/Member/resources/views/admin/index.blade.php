@extends('admin::layouts.layout', [
	'viewCssNs' => $cssNs,
	'title' => __('Leden'),
])

@section('actions-right')
    <a href="{{ action([App\Modules\Member\Http\Controllers\MemberController::class, 'create']) }}{{ request()->has('language') ? '?language='.request()->language() : '' }}"
       class="btn btn-success"
    >
        @include('admin::partials.icons.plus', ['class' => 'mr-2'])
        {{ __('Medewerker toevoegen') }}
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
