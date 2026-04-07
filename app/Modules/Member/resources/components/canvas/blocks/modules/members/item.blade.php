<div class="{{ $cssNs }} flex flex-col gap-4">

    @if($member->hasMedia())

        <div class="w-full">

            @media($member, [
                'collection' => 'default',
                'fit' => 'object-cover',
                'class' => 'w-full rounded-2xl',
            ])

        </div>

    @endif

    <div class="flex flex-col flex-1 w-full">

        <h5 class="w-full mb-0">
            {{ $member->title }}
        </h5>

        <div class="mb-2 text-palette-darkgray">
            {{ $member->subtitle }}
        </div>

        <div class="text-palette-darkgray">
            {!! $member->content !!}
        </div>

        <div class="flex items-center gap-4 pt-2 mt-auto text-xl text-palette-gray">
            @if($member->linkedin)
                <a href="{{ $member->linkedin }}" target="_blank">
                    <i class="transition fab fa-linkedin-in hover:opacity-75"></i>
                </a>
            @endif

            @if($member->email)
                <a href="mailto:{{ $member->email }}">
                    <i class="transition fas fa-envelope hover:opacity-75"></i>
                </a>
            @endif

            @if($member->whatsapp)
                <a href="{{ $member->whatsapp }}" target="_blank">
                    <i class="transition fab fa-whatsapp hover:opacity-75"></i>
                </a>
            @endif

            @if(!empty($member->location) && is_array($member->location))
                @foreach($member->location as $location)
                    @php($link = match($location) {
                        'terneuzen' => 'https://www.google.nl/maps/place/HR+Zeeland/@51.3362398,3.8260197,17z/data=!3m1!4b1!4m6!3m5!1s0x47c480fd5afb6ed7:0x67685aca82943b75!8m2!3d51.3362398!4d3.8285946!16s%2Fg%2F11clwkycwp?entry=ttu&g_ep=EgoyMDI1MDEyMC4wIKXMDSoASAFQAw%3D%3D',
                        'goes' => 'https://www.google.nl/maps/place/HR+Zeeland+Goes/@51.5027208,3.8850454,17z/data=!3m1!4b1!4m6!3m5!1s0x47c4898a03532f5f:0xbd9ea4df09d1791a!8m2!3d51.5027208!4d3.8876203!16s%2Fg%2F11kpj8ssdp?entry=ttu&g_ep=EgoyMDI1MDEyMC4wIKXMDSoASAFQAw%3D%3D',
                        default => null
                    })
                    <a class="ml-4 text-base" href="{{ $link }}" target="_blank">
                        <i class="fas fa-map-marker-alt"></i>
                        <span class="ml-1">{{ ucfirst($location) }}</span>
                    </a>
                @endforeach
            @endif
        </div>

    </div>
    
</div>
