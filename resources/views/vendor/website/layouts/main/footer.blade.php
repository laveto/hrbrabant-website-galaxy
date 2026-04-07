<?php
    $logo = \Galaxy\Settings\Services\SettingsService::getModel('theme')->getFirstMediaUrl('settings.website.footer_logo');
    $footerImage = \Galaxy\Settings\Services\SettingsService::getModel('theme')->getFirstMediaUrl('settings.website.footer_image');
?>
<footer class="{{ $cssNs }}">

    <div class="relative">
        <img src="{{ $footerImage }}" alt="Footer afbeelding" class="aspect-[3/1] sm:aspect-[auto] w-full object-cover" />

        <svg class="absolute bottom-0 -mb-1 left-0 right-0 w-full h-1/3 sm:h-[90%]" xmlns="http://www.w3.org/2000/svg" width="1440" height="250.453" viewBox="0 0 1440 250.453" preserveAspectRatio="none">
            <g id="Group_1030" data-name="Group 1030" transform="translate(2051 -5294.359)">
                <path id="Subtraction_1" data-name="Subtraction 1" d="M1440,289.66H0V112.628c40.625-5.594,80.92-10.518,119.766-14.637,37.836-4.012,75.413-7.379,111.689-10.008,35.249-2.554,70.3-4.485,104.174-5.739,32.839-1.216,65.549-1.833,97.221-1.833,39.215,0,78.207.946,115.894,2.813,35.845,1.775,71.672,4.44,106.487,7.922,32.843,3.284,65.909,7.408,98.28,12.258,30.19,4.523,60.9,9.846,91.273,15.821,117.558,23.127,219.973,53.8,319.015,83.456l.019.006c38.313,11.473,77.931,23.338,117.053,34.314,21.031,5.9,40.352,11.111,59.066,15.931,20.966,5.4,40.659,10.177,60.2,14.607,13.37,3.038,26.781,5.943,39.86,8.636v13.485h0Z" transform="translate(-2051 5255.152)" fill="#D65A54"/>
                <g id="Group_1029" data-name="Group 1029" transform="translate(-2051 5294.359)" opacity="0.4">
                    <path id="Path_36" data-name="Path 36" d="M0,23.072V185c53.852,4.858,107.345,7.2,159.222,7.2,130.322,0,249.514-14.034,335.5-34.184,119.91-28.247,225.46-44.8,351.473-44.8,149.17,0,327.958,71.427,593.807,125.582V212.885c-13.1-2.339-26.387-4.678-39.85-7.377C1032.7,133.361,758.953-67.606,0,23.072" transform="translate(0 0)" fill="#E88A85"/>
                </g>
            </g>
        </svg>

    </div>

    @php($footerBlock = \Galaxy\WebsiteBlocks\Models\Block::where('key', 'footer')->first())
    <div class="bg-palette-blue">
        <div class="container font-semibold navItems">
            <div class="grid gap-4 py-4 lg:grid-cols-12 lg:pt-12 lg:pb-24">
                <div class="col-span-5 mb-4 lg:mb-0">
                    <img src="{{ $logo }}" alt="Logo {{ config('app.name') }}" />
                </div>

                <div class="col-span-2">
                    <div class="mb-2 font-medium text-white uppercase opacity-75">
                        {{ $footerBlock->extra?->{'kolom_1_->_titel'}->value ?? '' }}
                    </div>

                    @include('website::partials.menu', [
                        'websiteMenuName' => 'Footer',
                        'style' => 'ul',
                        'ulClass' => 'flex-col gap-3',
                        'aClass' => 'text-white hover:opacity-75'
                    ])
                </div>

                <div class="flex flex-col col-span-2 text-white">
                    <div class="mb-2 font-medium text-white uppercase opacity-75">
                        {{ $footerBlock->extra?->{'kolom_2_->_titel_1'}->value ?? '' }}
                    </div>

                    {!! $footerBlock->extra?->{'kolom_2_->_beschrijving'}->value ?? '' !!}

                    <div class="pt-8 mb-2 text-white uppercase opacity-75">
                        {{ $footerBlock->extra?->{'kolom_2_->_titel_2'}->value ?? '' }}
                    </div>

                    {!! $footerBlock->extra?->{'kolom_2_->_beschrijving_2'}->value ?? '' !!}
                </div>

                <div class="flex flex-col col-span-2 font-medium text-white">
                    <div class="mb-2 font-medium text-white uppercase opacity-75">
                        {{ $footerBlock->extra?->{'kolom_3_->_titel'}->value ?? '' }}
                    </div>

                    {!! $footerBlock->extra?->{'kolom_3_->_beschrijving'}->value ?? '' !!}

                    <div class="pt-4 mt-auto mb-2 font-medium text-white uppercase opacity-75">
                        {{ $footerBlock->extra?->{'kolom_4_->_titel'}->value ?? '' }}
                    </div>

                    {!! $footerBlock->extra?->{'kolom_4_->_beschrijving'}->value ?? '' !!}
                </div>
            </div>
        </div>

        <div class="container">

            <div class="flex flex-col gap-4 py-4 mt-4 border-t border-white border-opacity-25 lg:flex-row lg:items-center lg:py-8 lg:mt-0">
                @include('canvas::socialIcons.render', [
                    'space' => 'flex space-x-6',
                    'textColor' => 'text-white',
                    'isFooter' => true,
                ])
                <div class="flex flex-col gap-8 text-sm lg:pl-8 lg:ml-auto md:flex-row md:items-center">
                    <div class="text-white opacity-50 lg:text-center">
                        &copy; <?= date('Y') ?> {{ config('app.name') }}
                    </div>

                    @include('website::partials.menu', [
                        'websiteMenuName' => 'Subfooter',
                        'style' => 'ul',
                        'ulClass' => 'gap-2 lg:gap-8 flex-col lg:flex-row',
                        'liClass' => '',
                        'aClass' => 'text-white opacity-75 hover:opacity-100'
                    ])

                    <div class="text-white">
                        <span class="opacity-50">Realisatie:</span> <a href="https://www.laveto.nl" target="_blank" class="opacity-75 hover:opacity-100">Laveto</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</footer>
