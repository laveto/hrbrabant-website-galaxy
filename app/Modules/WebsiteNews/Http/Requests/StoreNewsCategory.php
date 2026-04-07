<?php

namespace App\Modules\WebsiteNews\Http\Requests;

use Galaxy\Crud\Http\Requests\Form\StoresMediaInModel;
use Illuminate\Foundation\Http\FormRequest;

class StoreNewsCategory extends FormRequest
{
    use StoresMediaInModel;

    public function rules(): array
    {
        if (count(config('core.languages')) > 1) {
            return [
                'name.' . head(config('core.languages')) => 'required|string',
                'name.*' => 'nullable|string',
                'slug.' . head(config('core.languages')) => 'required|string',
                'slug.*' => 'nullable|string',
            ];
        }
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
        ];
    }

    public function media(): array
    {
        return ['image'];
    }
}
