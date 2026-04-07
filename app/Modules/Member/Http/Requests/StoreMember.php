<?php

namespace App\Modules\Member\Http\Requests;

use Galaxy\Crud\Http\Requests\Form\StoresMediaInModel;
use Illuminate\Foundation\Http\FormRequest;

class StoreMember extends FormRequest
{
    use StoresMediaInModel;

    public function rules(): array
    {
        // Default news module rules
        if (count(config('core.languages')) > 1) {
            $rules = array_merge(
                [
                    'title.' . head(config('core.languages')) => 'required|string',
                    'title.*' => 'nullable|string',
                    'subtitle.' . head(config('core.languages')) => 'required|string',
                    'subtitle.*' => 'nullable|string',
                    'slug.' . head(config('core.languages')) => 'required|string',
                    'slug.*' => 'nullable|string',
                    'content.' . head(config('core.languages')) => 'required',
                    'content.*' => 'nullable',
                    'published' => 'boolean',

                    'location' => 'nullable|array',
                    'location.*' => 'string|in:terneuzen,goes',
                    'email' => 'nullable|email',
                    'linkedin' => 'nullable',
                    'whatsapp' => 'nullable',
                ],
            );
        } else {
            $rules = array_merge(
                [
                    'title' => 'required|string',
                    'subtitle' => 'required|string',
                    'slug' => 'required|string',
                    'content' => 'required',
                    'published' => 'boolean',

                    'location' => 'nullable|array',
                    'location.*' => 'string|in:terneuzen,goes',
                    'email' => 'nullable|email',
                    'linkedin' => 'nullable',
                    'whatsapp' => 'nullable',
                ],
            );
        }

        return $rules;
    }

    public function media(): array
    {
        return ['image'];
    }

    public function messages(): array
    {
        return [
            'intro.*.min' => 'Intro moet minimaal :min characters bevatten',
            'intro.*.max' => 'Intro mag maar minimaal :max characters bevatten',
        ];
    }

    public function attributes()
    {
        return [
            'subtitle' => 'Subtitel',
            'linkedin' => 'LinkedIn',
            'whatsapp' => 'WhatsApp',
        ];
    }
}
