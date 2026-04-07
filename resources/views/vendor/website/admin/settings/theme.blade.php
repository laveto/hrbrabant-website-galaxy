@extends('admin::layouts.layout', [
    'viewCssNs' => $cssNs,
	'title' => 'Instellingen',
])

@section('content')

    <div class="{{ $cssNs }}">

        <div class="flex">

            <div class="w-full">

                @component('crud::form.index', ['route' => action([\Galaxy\Website\Http\Controllers\Admin\Settings\ThemeController::class, 'index'])])

                    @slot('content')

                        @inputValues(@$theme)

                        <x-admin::card title="Header & Footer instellingen">
                            @input('text', [
                                'name' => 'settings.header_button',
                                'labelFromRequest' => \App\Http\Requests\Galaxy\Website\Admin\Settings\StoreTheme::class,
                            ])

                            @input('text', [
                                'name' => 'settings.header_button_link',
                                'labelFromRequest' => \App\Http\Requests\Galaxy\Website\Admin\Settings\StoreTheme::class,
                            ])

                            @input('image', [
                                'name' => 'settings.website.footer_image',
                                'labelFromRequest' => \App\Http\Requests\Galaxy\Website\Admin\Settings\StoreTheme::class,
                                'outputOptions' => [
                                    'width' => 1920,
                                    'height' => 368,
                                ],
                                'media' => [
                                    'model' => \Galaxy\Settings\Services\SettingsService::getModel('theme'),
                                    'collectionName' => 'settings.website.footer_image',
                                ],
                            ])
                        </x-admin::card>


                        @if(config('website.theme_settings.media'))

                            <div class="card">

                                <div class="card-head">

                                    <h2 class="card-title">Thema media instellingen</h2>

                                </div>

                                <div class="card-sub">

                                    <div class="itemWrapper">
                                        @input('image', [
                                            'name' => 'settings.website.logo',
                                            'labelFromRequest' => \Galaxy\Website\Http\Requests\Admin\Settings\StoreTheme::class,
                                            'outputOptions' => [
                                                'width' => config('website.settings.theme.media.theme.logo.width'),
                                                'height' => config('website.settings.theme.media.theme.logo.height'),
                                            ],
                                            'media' => [
                                                'model' => \Galaxy\Settings\Services\SettingsService::getModel('theme'),
                                                'collectionName' => 'settings.website.logo',
                                            ],
                                        ])
                                    </div>

                                    <div class="itemWrapper">
                                        @input('image', [
                                            'name' => 'settings.website.footer_logo',
                                            'required' => false,
                                            'labelFromRequest' => \Galaxy\Website\Http\Requests\Admin\Settings\StoreTheme::class,
                                            'outputOptions' => [
                                                'width' => config('website.settings.theme.media.theme.logo.width'),
                                                'height' => config('website.settings.theme.media.theme.logo.height'),
                                            ],
                                            'media' => [
                                                'model' => \Galaxy\Settings\Services\SettingsService::getModel('theme'),
                                                'collectionName' => 'settings.website.footer_logo',
                                            ],
                                        ])
                                    </div>

                                    <div class="itemWrapper">
                                        @input('image', [
                                            'name' => 'settings.mail.logo',
                                            'labelFromRequest' => \Galaxy\Website\Http\Requests\Admin\Settings\StoreTheme::class,
                                            'outputOptions' => [
                                                'width' => config('website.settings.theme.media.theme.mail.width') ?? 400,
                                                'height' => config('website.settings.theme.media.theme.mail.height') ?? 250,
                                                'mime' => ['image/png', 'image/jpg', 'image/jpeg'],
                                            ],
                                            'media' => [
                                                'model' => \Galaxy\Settings\Services\SettingsService::getModel('theme'),
                                                'collectionName' => 'settings.mail.logo',
                                            ],
                                        ])
                                    </div>

                                    <div class="itemWrapper">
                                        @input('file', [
                                            'name' => 'settings.website.favicon',
                                            'labelFromRequest' => \Galaxy\Website\Http\Requests\Admin\Settings\StoreTheme::class,
                                            'instruction' => 'Upload een favicon zip hier, om deze te genereren klik <a href="https://realfavicongenerator.net/" target="_blank" class="text-indigo-500">hier</a>.',
                                            'model' => \Galaxy\Settings\Services\SettingsService::getModel('theme'),
                                            'required' => false,
                                            'attributes' => [
                                                'accept' => '.zip',
                                            ],
                                        ])
                                    </div>

                                </div>

                            </div>

                        @endif

                        @if(config('website.theme_settings.color'))

                            <div class="card">

                                <div class="card-head">

                                    <h2 class="card-title">Thema kleur instellingen</h2>

                                </div>

                                <div class="card-sub">

                                    <div class="itemWrapper flex flex-wrap">

                                        @inputStyle('tailwind-inverse')

                                        @foreach(config('website.settings.theme.colors.names') ?? [] as $colorName => $translatedName)

                                            <div class="itemWrapper w-1/2 {{ $loop->index >= 2 ? 'border-t' : '' }}">
                                                @input('colorpicker', [
                                                    'name' => 'settings.color.'.$colorName,
                                                    'labelFromRequest' => \Galaxy\Website\Http\Requests\Admin\Settings\StoreTheme::class,
                                                ])
                                            </div>

                                        @endforeach

                                        @popInputStyle

                                        <div class="w-full">

                                            @inputDataset([
                                                'title' => 'Meer kleuren',
                                                'icon' => 'fas fa-palette',
                                                'instruction' => 'Voeg hier meer kleuren toe',
                                                'items' => (array) @$theme->settings['color']['custom'],
                                                'name' => 'settings[color][custom]',
                                                'label' => 'Kleur',
                                                'sortable' => false,
                                                'type' => 'table',
                                                'tableColumns' => [
                                                    'Kleur',
                                                ],
                                            ])

                                            <td>
                                                @input('colorpicker', [
                                                    'name' => 'color',
                                                    'label' => false,
                                                    'spacing' => false,
                                                ])
                                            </td>

                                            @endInputDataset()

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @endif

                        @if(config('website.theme_settings.fonts'))

                            <div class="card">

                                <div class="card-head">

                                    <h2 class="card-title">Thema font instellingen</h2>

                                </div>

                                <div class="card-sub">

                                    @foreach(config('website.settings.theme.fonts.families') ?? [] as $fontFamily => $translatedName)

                                        <div class="itemWrapper">
                                            @input('vSelect', [
                                                'name' => 'settings.fonts.'.$fontFamily,
                                                'labelFromRequest' => \Galaxy\Website\Http\Requests\Admin\Settings\StoreTheme::class,
                                                'dataUrl' => action([\Galaxy\Website\Http\Controllers\Admin\Settings\ThemeController::class, 'getFonts']),
                                                'instruction' => 'Maak een keuze uit één van de <a href="https://fonts.google.com/" target="_blank" class="text-indigo-500">Google webfont</a> lettertypes.',
                                            ])
                                        </div>

                                    @endforeach

                                </div>

                            </div>

                        @endif

                    @endslot

                @endcomponent

            </div>

        </div>

        @if(config('website.multi_website.enabled'))

            @foreach (config('website.settings.theme.canvasses') ?? [] as $themeCanvas => $canvasName)

                @include('canvas::editor', [
                    'title' => ucfirst($canvasName),
                    'instruction' => 'Maak hier de '.$canvasName.' op die getoond wordt wanneer bezoekers de pagina openen.',
                    'canvas' => \Galaxy\Canvas\Models\Canvas::findOrFail($theme->settings[$themeCanvas]),
                ])

            @endforeach

        @endif

    </div>

@endsection
