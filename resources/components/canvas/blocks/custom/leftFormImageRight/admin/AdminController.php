<?php

namespace Resources\Components\Canvas\Blocks\Custom\LeftFormImageRight\Admin;

use Galaxy\Core\Http\Controllers\Controller;
use Galaxy\WebsiteForms\Models\Form;
use Illuminate\Support\Collection;

class AdminController extends Controller
{
    /**
     * @return Collection
     */
    public function getForms(): Collection
    {
        return Form::orderBy('name')->get();
    }
}
