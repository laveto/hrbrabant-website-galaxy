@extends('website::layouts.main', [
    'title' => $websitePage->title_page ?: $websitePage->title_menu,
])

@section('main.content')

    <div class="{{ $cssNs }}">

        <livewire:vacancy.overview
            :websitePage='$websitePage'
        />

    </div>

@endsection
