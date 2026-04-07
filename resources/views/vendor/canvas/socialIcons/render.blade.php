<div class="{{ $cssNs }} {{ @$space ?: 'space-x-2' }}" x-data='{ tooltip: false }' @click.away="tooltip = false">

    @foreach(config('website.settings.social_media') ?? [] as $socialMediaName => $icon)
        @if(empty($icon) || !($socialValue = optional(\Galaxy\Settings\Services\SettingsService::get('common'))[$socialMediaName.'_link']))
            @continue
        @endif

        <div class="relative inline-block">
            @if($socialMediaName == 'Telefoon' && !@$isFooter)
                <a
                    href="#"
                    x-on:click.prevent="tooltip = !tooltip"
                    aria-label="{{ $socialMediaName }}"
                    class="{{ @$textColor !== 'disabled' ? @$textColor : '' }} transition {{ $stateClass ?? 'opacity-50 hover:opacity-100' }}"
                >
                    <i class="{{ $icon['icon'] ?? $icon }} {{ $iconClass ?? 'text-2xl' }}" aria-hidden="true" role="presentation"></i>
                </a>
                <span
                    x-show="tooltip"
                    class="absolute right-[50px] top-1 bg-palette-grayishlighterbue text-white text-xs rounded px-2 py-1 w-max"
                >
                    <a href="tel:{{ $socialValue }}" class="hover:underline"
                        aria-label="{{ $socialMediaName }}"
                    >
                        {{ $socialValue }}
                    </a>
                </span>
            @elseif($socialMediaName == 'Telefoon' && @$isFooter)
                <a
                    href="tel:{{ $socialValue }}"
                    aria-label="{{ $socialMediaName }}"
                    class="{{ @$textColor !== 'disabled' ? @$textColor : '' }} transition {{ $stateClass ?? 'opacity-50 hover:opacity-100' }}"
                >
                    <i class="{{ $icon['icon'] ?? $icon }} {{ $iconClass ?? 'text-2xl' }}" aria-hidden="true" role="presentation"></i>
                </a>
            @else
                <a
                    href="{{ $socialValue }}"
                    target="_blank"
                    aria-label="{{ $socialMediaName }}"
                    class="{{ @$textColor !== 'disabled' ? @$textColor : '' }} transition {{ $stateClass ?? 'opacity-50 hover:opacity-100' }}"
                >
                    <i class="{{ $icon['icon'] ?? $icon }} {{ $iconClass ?? 'text-2xl' }}" aria-hidden="true" role="presentation"></i>
                </a>
            @endif
        </div>
    @endforeach

</div>
