<?php

return [

    /**
     * Meta data, which will be used in the Gallery to promote this block.
     */
    'meta' => [
        'name' => 'Klantverhalen',
        'description' => 'Blok om klantverhalen te tonen',
        'tags' => Galaxy\Canvas\Helpers\Tag::get(['image', 'text']),
    ],

    'defaultOptions' => [
        'rounded' => 'rounded-2xl',
    ]

];
