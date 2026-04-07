<?php

return [

    /**
     * Meta data, which will be used in the Gallery to promote this block.
     */
    'meta' => [
        'name' => 'Blog',
        'description' => 'Met dit blok kan je blog items inladen vanuit de blog module.',
        'tags' => \Galaxy\Canvas\Helpers\Tag::get(['module']),
    ],

];
