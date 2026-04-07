<?php

return [

    /**
     * Information to show in the module selector when the user can choose a module to link on a website page.
     */
    'meta' => [
        'name' => 'Blog',
        'icon' => 'far fa-newspaper',
        'intro' => 'Een module om blogs toe te voegen aan je website.',
        'description' => '
			<p>'.
                __('Met deze module kan je blogs laten zien op de website.')
            .'</p>
		'
    ],

    'canvas' => false,

    'websitePage' => [

        /**
         * Determines if a user may delete a page having this module.
         *
         * Use false if you have a (seeded) page which never may be deleted, like a webshop checkout page.
         */
        'deletable' => false,

        /**
         * Determines if only 1 instance is allowed of this module in the website.
         *
         * Use true if you have a webshop checkout page, which we only need 1 of.
         */
        'unique' => true,

    ],

];
