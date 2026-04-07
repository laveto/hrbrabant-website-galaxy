<?php

namespace App\Http\Requests\Galaxy\Website\Admin;

use Galaxy\Website\Http\Requests\Admin\StoreWebsitePage as GalaxyStoreWebsitePage;

class StoreWebsitePage extends GalaxyStoreWebsitePage
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'output_options.show_vacancy_search' => 'nullable|boolean',
        ]);
    }

    public function attributes(): array
    {
        return array_merge(parent::attributes(), [
            'output_options.show_vacancy_search' => 'Toon vacature zoekbalk',
        ]);
    }
}
