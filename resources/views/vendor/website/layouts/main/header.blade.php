<?php
    $logo = \Galaxy\Settings\Services\SettingsService::getModel('theme')->getFirstMedia('settings.website.logo');
    $themeSettings = \Galaxy\Settings\Services\SettingsService::getModel('theme');
?>
<header class="{{ $cssNs }} flex bg-white py-3 sticky top-0 z-40 border-b">

    <div class="container flex items-center">

        <div class="flex items-center justify-between w-full mobile-nav lg:hidden">

            @if($logo)
                <a class="w-1/2 sm:w-1/3" href="/">
                    @media($logo, [
                        'collection' => 'settings.website.logo',
                        'fit' => 'object-contain',
                        'alt' => config('app.name')
                    ])
                </a>
            @endif

            <button class="hamburger hamburger--slider" type="button"
                aria-label="Menu"
            >
                <span class="hamburger-box">
                    <span class="bg-black hamburger-inner"></span>
                </span>
            </button>

        </div>

        <div class="items-center hidden w-full lg:flex">

            <div class="w-1/6">

                @if($logo)
                    <a class="logo" href="/">
                        @media($logo, [
                            'collection' => 'settings.website.logo',
                            'fit' => 'object-contain',
                            'alt' => config('app.name')
                        ])
                    </a>
                @endif

            </div>

            <div class="flex justify-end w-5/6 menu">

                <div class="flex text-sm font-semibold">

                    @include('website::partials.menu', [
                        'websiteMenuName' => 'Main',
                        'style' => 'navbar',
                    ])

                    <div class="flex items-center pl-6 ml-auto font-normal">
                        <a href="{{ $themeSettings['settings']['header_button_link'] ?? '' }}" class="text-sm btn-primary">
                            {{ $themeSettings['settings']['header_button'] }}
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</header>
