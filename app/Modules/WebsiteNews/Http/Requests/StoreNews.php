<?php

namespace App\Modules\WebsiteNews\Http\Requests;

use Galaxy\Crud\Http\Requests\Form\StoresMediaInModel;
use Illuminate\Foundation\Http\FormRequest;

class StoreNews extends FormRequest
{
    use StoresMediaInModel;

    public function rules(): array
    {
        // Default news module rules
        if (count(config('core.languages')) > 1) {
            $rules = array_merge(
                config('website_news.category.active')
                    ? [
                        'website_news_category_id' => 'integer',
                    ]
                    : [],

                [
                    'title.' . head(config('core.languages')) => 'required|string',
                    'title.*' => 'nullable|string',
                    'slug.' . head(config('core.languages')) => 'required|string',
                    'slug.*' => 'nullable|string',
                    // 'intro.' . head(config('core.languages')) => 'required|string|min:10|max:300',
                    // 'intro.*' => 'nullable|string|min:10|max:300',
                    'published' => 'required',
                    'meta_title.*' => 'nullable|string',
                    'meta_description.*' => 'nullable|string',
                ],

                !config('website_news.show_canvas')
                    ? [
                        'content.' . head(config('core.languages')) => 'required',
                        'content.*' => 'nullable',
                    ]
                    : [],
            );
        } else {
            $rules = array_merge(
                config('website_news.category.active')
                    ? [
                        'website_news_category_id' => 'integer',
                    ]
                    : [],

                [
                    'title' => 'required|string',
                    'slug' => 'required|string',
                    // 'intro' => 'required|string|min:10|max:300',
                    'published' => 'required',
                    'meta_title' => 'nullable|string|max:60',
                    'meta_description' => 'nullable|string|max:160',
                ],

                !config('website_news.show_canvas')
                    ? [
                        'content' => 'required',
                    ]
                    : [],
            );
        }

        // Extended news module
        if (config('website_news.extended')) {
            if (count(config('core.languages')) > 1) {
                $rules = array_merge($rules, [
                    'author.*' => 'nullable|string',
                ]);
            } else {
                $rules = array_merge($rules, [
                    'author' => 'nullable|string',
                ]);
            }

            $rules = array_merge($rules, [
                'date' => 'nullable|date',
                'publish_at' => 'nullable|date',
                'unpublish_at' => 'nullable|date',
            ]);
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
            'meta_title' => 'Titel',
            'meta_description' => 'Omschrijving',
        ];
    }
}
