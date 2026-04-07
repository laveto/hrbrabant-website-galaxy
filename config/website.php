<?php

$result = require __DIR__ . '/../galaxy/modules/Website/resources/config/module.php';

$result['settings']['social_media'] = [
    'Telefoon' => [
        'icon' => 'fas fa-phone',
        'request' => 'tel',
    ],
    'Mail' => [
        'icon' => 'fas fa-envelope',
        'request' => 'mail',
    ],
    'Facebook' => 'fab fa-facebook-f',
    'Instagram' => 'fab fa-instagram',
    'Linkedin' => 'fab fa-linkedin-in',
    'Twitter' => 'fab fa-twitter',
    'YouTube' => 'fab fa-youtube',
    'Vimeo' => 'fab fa-vimeo',
    'Pinterest' => 'fab fa-pinterest',
    'TikTok' => 'fab fa-tiktok',
    'WhatsApp' => 'fab fa-whatsapp',
];

$result['slider'] = [
    'video' => false,

    'intern_link' => true,
    'extern_link' => true,

    'image' => [
        'active' => true,
        'width' => '1920',
        'height' => '767',
    ],
];

$result['livewire_enabled'] = true;

$result['structured_data'] = [
    'enabled' => true,
];

return $result;
