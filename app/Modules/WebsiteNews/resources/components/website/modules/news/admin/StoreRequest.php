<?php

namespace App\Modules\WebsiteNews\Resources\Components\Website\Modules\News\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function rules()
    {
        return [
            'paginate_amount' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        return [
            'paginate_amount' => 'Items per pagina',
        ];
    }
}
