<?php

return [
    [
        'action' => [App\Modules\Member\Http\Controllers\MemberController::class, 'index'],
        'label' => 'Medewerkers',
        'icon' => 'far fa-users',
        'permission' => 'Member::Member.index',
        'weight' => 107,
    ],
];
