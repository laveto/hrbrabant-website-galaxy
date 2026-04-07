@extends('admin::layouts.layout', [
    'viewCssNs' => $cssNs,
    'title' => 'Medewerker ' . (@$member ? ' bewerken' : ' toevoegen'),
    'breadcrumbs' => [
        action([App\Modules\Member\Http\Controllers\MemberController::class, 'index']) => __('Leden'),
    ],
])

@section('content')

    @component('crud::form.index')
        @slot('content')
            @inputValues(@$member)

            <x-admin::card title="Algemene informatie">

                @input('text', [
                    'name' => 'title',
                    'multilanguage' => count(config('core.languages')) > 1,
                ])

                @input('text', [
                    'name' => 'subtitle',
                    'multilanguage' => count(config('core.languages')) > 1,
                    'labelFromRequest' => \App\Modules\Member\Http\Requests\StoreMember::class,
                ])

                @input('slug', [
                    'name' => 'slug',
                    'trigger' => 'title',
                    'multilanguage' => count(config('core.languages')) > 1,
                ])

                @input('richtext', [
                    'name' => 'content',
                    'multilanguage' => count(config('core.languages')) > 1,
                ])

                @input('image', [
                    'name' => 'image',
                    'instruction' => __('Afbeelding van het lid'),
                    'required' => true,
                    'outputOptions' => [
                        'width' => 1152,
                        'height' => 768,
                    ],
                    'media' => [
                        'model' => @$member,
                        'collectionName' => 'default',
                    ],
                ])

                @input('switch', [
                    'name' => 'published',
                    'value' => 1,
                ])

            </x-admin::card>


            <x-admin::card title="Contact informatie">

                @input('select', [
                    'name' => 'location',
                    'values' => [
                        'terneuzen' => 'Terneuzen',
                        'goes' => 'Goes',
                    ],
                    'required' => false,
                    'multiple' => true,
                ])

                @input('email', [
                    'name' => 'email',
                ])

                @input('text', [
                    'name' => 'linkedin',
                    'labelFromRequest' => \App\Modules\Member\Http\Requests\StoreMember::class,
                ])

                @input('text', [
                    'name' => 'whatsapp',
                    'labelFromRequest' => \App\Modules\Member\Http\Requests\StoreMember::class,
                ])

            </x-admin::card>
        @endslot
    @endcomponent

@endsection
