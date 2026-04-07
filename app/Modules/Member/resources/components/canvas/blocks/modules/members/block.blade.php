<div @htmlAttrs($htmlAttrs)
     @canvasBlockAttrs([
        'label' => 'Leden',
        'panel' => 'BlockPanel'
    ])>

    <div class="container">

        <div class="grid lg:grid-cols-3 gap-8">
            <div>
                @canvasBlock('canvas::utils.text', [
                    'key' => 'text',
                    'options' => [
                        'html' => '<h2>Ons team</h2><p>Leer meer over ons team en ontdek de gezichten die uw ervaring met ons bedrijf persoonlijk en memorabel maken.</p>',
                    ],
                ])
            </div>

            <div class="col-span-2">
                @php
                    $membersQuery = App\Modules\Member\Models\Member::published()
                        ->multilanguage()
                        ->with('media')
                        ->orderBy('sequence');
                    
                    // Apply location filter if set
                    if (!empty($canvasBlock->options->location)) {
                        $membersQuery->whereJsonContains('location', $canvasBlock->options->location);
                    }
                    
                    $members = $membersQuery->get();
                    //->paginate(@$canvasBlock->options->pagination)
                @endphp

                @if($members->isNotEmpty())

                    <div class="grid md:grid-cols-2 gap-8">

                        @foreach($members as $member)

                            @include('member-component::canvas.blocks.modules.members.item')

                        @endforeach

                    </div>

                @else

                    <h2 class="py-10">{{ __('member::translation.no_items') }}</h2>

                @endif
            </div>

        </div>
    </div>

</div>
