@extends('crud::form.style', get_defined_vars())

@section('before')
    {{-- Usage of @ here is because some inputs do not have a cssNs or nameDotted --}}
    <div class="{{ @$cssNs }} <?=isset($errors) ? ($errors->has(@$nameDotted) ? 'has-error' : '') : ''?>" data-style="{{ @$style }}">

        <div class="flex flex-wrap mb-3">

            @if(@$forceLabel || $label)
                <label class="hidden w-full">

                    <h5 class="flex items-center">

                        {{ @$forceLabel ?? $label }}

                        @if($required || @$labelRequired)
                            <span class="text-red-500">
                                <i class="fas fa-circle required-circle"></i>
                            </span>
                        @endif

                    </h5>
                </label>
            @endif

            <div class="w-full input-wrapper">

                @include('crud::form.style.helpers.input_error')
                @overwrite

                {{-- Additional input styling --}}
                @section('xAttributes')
                    <input
                        class="block {{ $type !== 'submit' ? 'w-full' : '' }} px-4 py-2 text-sm tracking-wider placeholder-opacity-75 border border-gray-300 rounded focus:border-palette-lightblue focus:ring-palette-lightblue md:text-lg"
                    />
                @overwrite

                @section('input')
                    {{-- Is component? --}}
                    @if( ($slots = collect(@$__laravel_slots))->isNotEmpty() )

                        @foreach($slots as $slotName => $slot )
                            {{ @$slot }}
                        @endforeach

                    @else
                        @yield('input')
                    @endif
                @overwrite

                @section('after')

                    @include('crud::form.style.helpers.language_icon', compact('language'))

                    {{-- Render instruction? --}}
                    @if(@$instruction)
                        <small class="block mt-2 text-gray-500">{{ $instruction }}</small>
                    @endif

            </div>

        </div>

    </div>
@overwrite
