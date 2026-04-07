<?php

namespace App\Http\Requests\Galaxy\Website\Admin\Settings;

use Galaxy\Crud\Http\Requests\Form\ShowsErrorsInForm;
use Galaxy\Crud\Http\Requests\Form\StoresMediaInModel;
use Galaxy\Website\Http\Requests\Admin\Settings\StoreThemeContract;
use Illuminate\Foundation\Http\FormRequest;

class StoreTheme extends FormRequest implements StoreThemeContract
{
    use StoresMediaInModel,
        ShowsErrorsInForm;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $data = [];

        // Custom
        $data = array_merge($data, [
           'settings.header_button' => 'required',
           'settings.header_button_link' => 'required',
           'settings.website.footer_image' => 'required',
        ]);

        if (config('website.theme_settings.color')) {
            foreach (config('website.settings.theme.colors.names') ?? [] as $colorName => $translatedName) {
                $data['settings.color.'.$colorName] = 'required';
            }
        }

        if (config('website.theme_settings.fonts')) {
            foreach (config('website.settings.theme.fonts.families') ?? [] as $fontFamily => $translatedName) {
                $data['settings.fonts.' . $fontFamily] = 'required';
            }
        }

        if (config('website.theme_settings.color')) {
            $data['settings.color.custom.*.color'] = 'required';
        }

        if (config('website.theme_settings.media')) {
            $data['settings.website.logo'] = 'required';
            $data['settings.website.footer_logo'] = 'nullable';
            $data['settings.mail.logo'] = 'required';
            $data['settings.website.favicon'] = 'nullable|file';
        }

        return $data;
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        $data = [];

        foreach (config('website.settings.theme.colors.names') ?? [] as $colorName => $translatedName) {
            $data['settings.color.'.$colorName] = $translatedName.' kleur';
        }

        foreach (config('website.settings.theme.fonts.families') ?? [] as $fontFamily => $translatedName) {
            $data['settings.fonts.'.$fontFamily] = $translatedName.' font';
        }

        return [
            'settings.website.logo' => 'Website logo',
            'settings.website.footer_logo' => 'Footer logo',
            'settings.mail.logo' => 'Mail logo',
            'settings.website.favicon' => 'Favicon pakket',

            // Custom
            'settings.header_button' => 'Header knop tekst',
            'settings.header_button_link' => 'Header knop link',
            'settings.website.footer_image' => 'Footer afbeelding',
        ] + $data;
    }

    /**
     * @return string[]
     */
    public function media(): array
    {
        return [
            'settings.website.logo',
            'settings.website.footer_logo',
            'settings.mail.logo',

            // Custom
            'settings.website.footer_image',
        ];
    }
}
