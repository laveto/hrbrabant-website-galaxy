<?php

namespace App\Modules\Vacancy\Resources\Components\Website\Modules\Vacancy\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function rules()
    {
        return [
            'vacancy_amount' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'vacancy_amount' => 'Items per pagina',
        ];
    }
}
