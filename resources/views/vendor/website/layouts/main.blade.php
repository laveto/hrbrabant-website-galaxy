@extends('website::layouts.main.html', [
    'meta' => $meta ?? [
        'title' => (@$title ? "$title - " : '') . (\Galaxy\Settings\Services\SettingsService::get('common', 'website_title') ?: config('app.name')),
    ],
])

@section('body')
    @if ($js_body = \Galaxy\Settings\Services\SettingsService::get('advanced', 'js_body'))
        {!! $js_body !!}
    @endif

    <div class="{{ $cssNs }}">

        {{-- Wrapper for MMenu --}}
        <div class="flex flex-col min-h-screen wrapper">

            @include('website::layouts.main.creation')

            @if (!config('website.multi_website.enabled'))
                @include('website::layouts.main.header')

                <div class='bg-white py-3 sticky top-[80px] z-50 lg:hidden'>
                    @include('canvas::socialIcons.render', [
                       'space' => 'flex items-center justify-center gap-4',
                       'textColor' => 'text-black block flex items-center justify-center',
                       // Its not really a footer but just checks for specific icon
                       'isFooter' => true,
                   ])
                </div>

                @if( request()->websitePage() && request()->websitePage()->show_slider )
                    @include('website::layouts.main.slider')
                @endif

                {{--
                @include('website::partials.breadcrumbs', [
                    'websiteMenu' => 'Main', // Optional, defaults to "Main"
                ])
                --}}
            @endif

            {{-- Page scraper for searching scrapes from this div --}}
            <div class="main">
                @yield('main.content')

                @if(livewire_installed() && config('website.livewire_enabled'))
                    {{ @$slot }}
                @endif
            </div>

            {{-- ^ Until this div ^
                Put all fixed/position absolute things in this div if you don't want them to be scraped.
                Otherwise put them in <div class="main"> --}}
            <div class="relative fixed-content">
                @include('website::layouts.main.fixed')

                <div class="hidden lg:block fixed right-0 top-1/2 -translate-y-1/2 z-40 rounded-tl-2xl rounded-bl-2xl bg-[#A8403B] bg-opacity-[90%] py-6 px-2">
                    @include('canvas::socialIcons.render', [
                        'space' => 'flex flex-col gap-4',
                        'textColor' => 'text-white block flex items-center justify-center',
                    ])
                </div>
            </div>

            @if (!config('website.multi_website.enabled'))
                @include('website::layouts.main.footer')
            @endif

        </div>

        @include('website::partials.menu', [
            'websiteMenuName' => 'Mobiel',
            'style' => 'mmenu',
        ])

        @stack('foot')

        <div class="modals">
            @include('website::partials.modal')
        </div>

    </div>
@endsection
