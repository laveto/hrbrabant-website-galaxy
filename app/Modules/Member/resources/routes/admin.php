<?php

Route::adminModulesGroup(function () {
    Route::resource('members', App\Modules\Member\Http\Controllers\MemberController::class)->except('show');
    Route::post('members/set-order', [App\Modules\Member\Http\Controllers\MemberController::class, 'setOrder']);
});
