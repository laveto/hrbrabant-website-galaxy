<?php

return [

    /**
     * Metadata, which will be used in the Gallery to promote this block.
     */
    'meta' => [
        'name' => 'Card: Formulier / Afbeelding',
        'description' => 'Een \'card\' met links tekst en rechts een vullende afbeelding.',
        'tags' => \Galaxy\Canvas\Helpers\Tag::get(['text', 'image']),
    ],

    'defaultOptions' => [
        // Padding sizes
        ...(new \Galaxy\Canvas\Helpers\MarginHelper())->convertLabelToPadding([
            'top' => 'large',
            'bottom' => 'large',
        ]),
    ]

];
