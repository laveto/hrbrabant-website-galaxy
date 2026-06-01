@pushOnce('head')
    <link rel="stylesheet" href="/vendor/nouislider/nouislider.min.css">
    <script src="/vendor/nouislider/nouislider.min.js" defer></script>
    <style>
        .hours-slider {
            height: 14px;
            margin: 0 8px;
            border: none;
            background: #f3f4f6;
            border-radius: 9999px;
            box-shadow: none;
        }
        .hours-slider .noUi-connects {
            border-radius: 9999px;
        }
        .hours-slider .noUi-connect {
            background: currentColor;
        }
        .hours-slider .noUi-handle {
            width: 16px;
            height: 24px;
            top: -5px;
            right: -8px;
            border: 2px solid currentColor;
            background: #fff;
            border-radius: 9999px;
            box-shadow: none;
            cursor: pointer;
        }
        .hours-slider .noUi-handle::before,
        .hours-slider .noUi-handle::after {
            display: none;
        }
        .hours-slider .noUi-handle.noUi-active {
            box-shadow: 0 0 0 4px rgba(0, 0, 0, 0.08);
        }
    </style>
@endPushOnce

<div class="container" id='vacancies' x-data="{
        open: false,
    }">

    <div class='grid grid-cols-3 py-8'>

        <div class='lg:col-span-1'>

            <div x-cloak x-show="open" class="filterMenu fixed lg:relative inset-0 z-50 lg:z-0 lg:!block" role="dialog"
                aria-modal="true">
                <div x-show="open" x-cloak x-transition:enter="transition-opacity ease-linear duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity ease-linear duration-300"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 bg-black bg-opacity-25 lg:bg-transparent" @click="open = false"
                    aria-hidden="true"></div>

                <div x-show="open" x-cloak x-transition:enter="transition ease-in-out duration-300 transform"
                    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition ease-in-out duration-300 transform"
                    x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                    class="filterGroup relative max-w-xs lg:max-w-full w-full h-full bg-white lg:bg-transparent shadow-xl lg:shadow-none px-6 py-4 pb-6 lg:px-1 lg:py-0 flex flex-col overflow-y-auto lg:!block">
                    <div class="flex items-center pb-4 mb-4 border-b lg:hidden">
                        <h3 class="mb-0 text-xl">{{ __('Filters') }}</h3>
                        <button class="ml-auto" type="button" x-on:click="open = false">
                            <i class="text-xl fal fa-times"></i>
                        </button>
                    </div>

                    <div class='flex items-center justify-center w-full py-3 mb-4 transition border border-gray-400 rounded-lg cursor-pointer lg:w-3/5 hover:bg-black hover:border-black hover:text-white'
                        wire:click='resetFilter()'>
                        Filters wissen
                    </div>

                    <div class="md:w-3/4">
                        <div class="flex flex-col gap-4 mb-4 lg:hidden">
                            <label class="px-4 py-2 border border-g™ray-200 rounded-lg hover:opacity-75 cursor-pointer
                                {{ $this->checkInFilter('matchCriteria_15', 'Uitzenden') ? 'bg-gray-200 hover:bg-opacity-75' : '' }}
                            ">
                                <input type="checkbox" class="hidden"
                                    wire:model.live="filter.matchCriteria_15.Uitzenden">
                                <i class='mr-2 text-base far fa-helmet-safety text-palette-purple'></i>
                                {{ __('Operationeel & uitvoerend') }}
                            </label>

                            <label class="px-4 py-2 border border-gray-200 rounded-lg hover:opacity-75 cursor-pointer
                                {{ $this->checkInFilter('matchCriteria_15', 'Werving en Selectie') ? 'bg-gray-200 hover:bg-opacity-75' : '' }}
                            ">
                                <input type="checkbox" class="hidden"
                                    wire:model.live="filter.matchCriteria_15.Werving en Selectie">
                                <i class='mr-2 text-base far fa-display text-palette-pink'></i>
                                {{ __('Werving en Selectie') }}
                            </label>
                        </div>

                        @php
                            $hoursRangeMin = \App\Modules\Vacancy\Http\Livewire\Overview::HOURS_RANGE_MIN;
                            $hoursRangeMax = \App\Modules\Vacancy\Http\Livewire\Overview::HOURS_RANGE_MAX;
                        @endphp

                        <div class="mb-8 lg:w-3/4" wire:ignore x-data="{
                                displayMin: @js($hoursMin ?? $hoursRangeMin),
                                displayMax: @js($hoursMax ?? $hoursRangeMax),
                                isActive: @js($hoursMin !== null || $hoursMax !== null),
                                tries: 0,
                                init() {
                                    const el = this.$refs.slider;
                                    const min = {{ $hoursRangeMin }};
                                    const max = {{ $hoursRangeMax }};
                                    const startMin = @js($hoursMin) ?? min;
                                    const startMax = @js($hoursMax) ?? max;

                                    const setup = () => {
                                        if (typeof window.noUiSlider === 'undefined') {
                                            if (this.tries++ < 30) return setTimeout(setup, 100);
                                            return console.warn('noUiSlider failed to load');
                                        }
                                        window.noUiSlider.create(el, {
                                            start: [startMin, startMax],
                                            connect: true,
                                            step: 1,
                                            range: { min, max },
                                        });
                                        el.noUiSlider.on('update', (values) => {
                                            this.displayMin = parseInt(values[0]);
                                            this.displayMax = parseInt(values[1]);
                                        });
                                        el.noUiSlider.on('change', (values) => {
                                            const newMin = parseInt(values[0]);
                                            const newMax = parseInt(values[1]);
                                            this.isActive = true;
                                            this.$wire.setHoursRange(newMin, newMax);
                                        });

                                        this.$wire.on('hours-reset', () => this.resetVisual());
                                    };
                                    setup();
                                },
                                resetVisual() {
                                    if (this.$refs.slider.noUiSlider) {
                                        this.$refs.slider.noUiSlider.set([{{ $hoursRangeMin }}, {{ $hoursRangeMax }}], false);
                                    }
                                    this.isActive = false;
                                },
                                reset() {
                                    this.resetVisual();
                                    this.$wire.clearHoursFilter();
                                }
                            }">
                            <div class='mb-3 text-base font-bold text-palette-lightblue'>
                                {{ __('Aantal uren per week') }}
                            </div>
                            <div class='flex items-center justify-between mb-3 text-sm text-gray-700'>
                                <span x-show="isActive">
                                    <span x-text="displayMin"></span> – <span x-text="displayMax"></span> uur
                                </span>
                                <span x-show="!isActive" class="text-gray-500">{{ __('Alle uren') }}</span>
                                <button type="button" x-show="isActive" x-on:click="reset()"
                                    class="text-xs text-palette-lightblue hover:underline">
                                    {{ __('Wissen') }}
                                </button>
                            </div>
                            <div x-ref="slider" class="hours-slider text-palette-lightblue"></div>
                        </div>

                        @if($this->vacancyValues->count() > 0)
                            @foreach($this->matchCriteriaFilters as $matchCriteria)
                                <div class='mb-8'>
                                    <div class='mb-3 text-base font-bold text-palette-lightblue'>
                                        {{ $this->vacancyValues->first(fn($value) => $value['unique_key'] === $matchCriteria && $value['key'] === 'value_title')['value'] }}
                                    </div>
                                    @foreach($this->allVacancyValues->filter(fn($value) => $value['unique_key'] == $matchCriteria && $value['key'] !== 'value_title') as $key => $vacancyValue)

                                        @php
                                            // Convert value to URL-safe format for wire:model
                                            $safeValue = $this->getEncodedValue($vacancyValue['value']);
                                        @endphp
                                        <div class="relative flex items-center py-2">
                                            <div class="flex items-center h-6">
                                                <input id="box_{{ $vacancyValue['id'] }}"
                                                    wire:model.live="filter.{{ $vacancyValue['unique_key'] }}.{{ $safeValue }}"
                                                    type="checkbox"
                                                    checked='{{ $this->checkInFilter($vacancyValue['unique_key'], $vacancyValue['value']) }}'
                                                    class="w-5 h-5 border-2 border-gray-300 rounded cursor-pointer text-palette-lightblue focus:ring-palette-lighterblue">
                                            </div>
                                            <div class="flex items-center justify-between w-full ml-3 lg:w-3/5 gap-x-4">
                                                <div>
                                                    <label for="box_{{ $vacancyValue['id'] }}"
                                                        class="text-base font-normal text-gray-900 cursor-pointer">
                                                        {{ $vacancyValue['value'] }}
                                                    </label>
                                                </div>
                                                <div class='hidden text-gray-500'>
                                                    {{ $this->filterCount[$vacancyValue['value']] ?? 0 }}</div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>

            </div>
        </div>

        <div class='col-span-3 lg:col-span-2'>
            <div class='items-center hidden mb-4 text-sm font-medium lg:flex'>
                {{ $vacancyCount . ' resultaten' }}

                <div class="flex gap-4 ml-auto">
                    <label class="px-4 py-2 border border-gray-200 rounded-lg hover:opacity-75 cursor-pointer
                        {{ $this->checkInFilter('matchCriteria_15', 'Uitzenden') ? 'bg-gray-200 hover:bg-opacity-75' : '' }}
                    ">
                        <input type="checkbox" class="hidden" wire:model.live="filter.matchCriteria_15.Uitzenden">
                        <i class='mr-2 text-base far fa-helmet-safety text-palette-purple'></i>
                        {{ __('Operationeel & uitvoerend') }}
                    </label>

                    <label class="px-4 py-2 border border-gray-200 rounded-lg hover:opacity-75 cursor-pointer
                        {{ $this->checkInFilter('matchCriteria_15', 'Werving en Selectie') ? 'bg-gray-200 hover:bg-opacity-75' : '' }}
                    ">
                        <input type="checkbox" class="hidden"
                            wire:model.live="filter.matchCriteria_15.Werving en Selectie">
                        <i class='mr-2 text-base far fa-display text-palette-pink'></i> {{ __('Werving en Selectie') }}
                    </label>
                </div>
            </div>

            <div class='lg:hidden'>
                <div class='flex items-center justify-between'>
                    <div class='text-sm font-medium'>{{ $vacancyCount . ' resultaten' }}</div>
                    <div class='px-6 py-3 text-gray-500 border border-gray-200 rounded-lg hover:opacity-75'
                        x-on:click="open = !open">
                        <i class='mr-2 far fa-sliders-up'></i> Filters
                    </div>
                </div>
            </div>

            @forelse($vacancies as $vacancy)

            @php($colors = $this->getVacancyColor($vacancy))

            @php(    $typeVacancy = $vacancy->vacancyValues->where('unique_key', 'matchCriteria_15')->where('key', '!=', 'value_title')->first() )
            <div class='flex flex-col items-start p-8 my-8 space-y-4 bg-white lg:my-10 rounded-xl'
                style='box-shadow: 0 8px 24px #0000001F;' data-vacancy-type="{{ $typeVacancy?->value ?: '' }}">
                <div class='text-2xl font-semibold {{ $colors['color'] }}'>
                    @if($colors['color'] == 'text-palette-purple')
                        <img class='inline-block w-8' src='/img/website/hrbrabant-softindigo.svg' alt='HR Brabant logo'>
                    @elseif($colors['color'] == 'text-palette-pink')
                        <img class='inline-block w-8 [transform:_translate3d(0,0,0)]' src='/img/website/hrbrabant-berryrose.svg'
                            alt='HR Brabant logo'>
                    @endif

                    {{ $vacancy->title }}
                </div>
                <div class='font-medium text-base text-gray-500 leading-[30px] line-clamp-3'>
                    {!! $this->getVacancyValue($vacancy, 'textField_summary', 'text') !!}
                </div>
                <div
                    class='w-full grid md:items-start xl:items-center md:grid-cols-[repeat(auto-fill,_minmax(160px,_1fr))] xl:grid-cols-[2fr_repeat(3,_minmax(160px,_1fr))] 2xl:grid-cols-[repeat(auto-fill,_minmax(180px,_1fr))] gap-x-6 gap-y-4'>
                    <div class='flex items-center sm:order-1'>
                        <i class="mr-3 far fa-location-dot text-3xl fa-fw {{ $colors['color'] }}"></i>
                        <div class='text-sm font-medium {{ $colors['color'] ?: 'text-gray-800' }}'>
                            {{ $vacancy->location }}
                        </div>
                    </div>

                    @if(
                            $showHours = $vacancy->vacancyValues->where('unique_key', 'matchCriteria_8')
                                ->where('key', '!=', 'value_title')
                                ->first()
                        )
                        <div class='flex items-center sm:order-1'>
                            <i class="mr-3 far fa-clock text-3xl fa-fw {{ $colors['color'] }}"></i>
                            <div class='text-sm font-medium {{ $colors['color'] ?: 'text-gray-800' }}'>
                                {{ $showHours->value }}
                            </div>
                        </div>
                    @else
                        <div class="sm:order-1"></div>
                    @endif

                    @if(
                            $saleryRange = implode(' - ', array_filter([
                                $vacancy->salaryMin ? '€' . number_format((float) str_replace('€', '', $vacancy->salaryMin), 0, ',', '.') : null,
                                $vacancy->salaryMax ? '€' . number_format((float) str_replace('€', '', $vacancy->salaryMax), 0, ',', '.') : null
                            ]))
                        )
                        <div class='flex items-center sm:order-1'>
                            <i class="mr-3 far fa-coins text-3xl fa-fw {{ $colors['color'] }}"></i>
                            <div class='text-sm font-medium {{ $colors['color'] ?: 'text-gray-800' }}'>
                                {{ $saleryRange }}
                            </div>
                        </div>
                    @else
                        <div class="sm:order-1"></div>
                    @endif

                    <div class="order-1 xl:order-none lg:col-span-2 xl:col-auto">
                        <a class='block btn-primary-bigger-no-bg hover:bg-opacity-75 {{ $colors['background'] ?: 'bg-black' }}'
                            href='{{ action([\App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy\Controller::class, 'show'], ['vacancy' => $vacancy]) }}'>
                            Bekijk vacature
                        </a>
                    </div>
                </div>
            </div>
            @empty
            Er zijn geen resultaten gevonden.
            @endforelse

            <div class='py-4'>
                {{ $vacancies->links('vacancy-component::website.modules.vacancy.partials.pagination') }}
            </div>

        </div>

    </div>

</div>