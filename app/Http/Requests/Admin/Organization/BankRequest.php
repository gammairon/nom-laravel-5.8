<?php

namespace App\Http\Requests\Admin\Organization;

use Illuminate\Foundation\Http\FormRequest;

class BankRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'slug'            => 'required|string|max:191|alpha_dash|unique:banks,slug',
            'name'            => 'required|string|max:255',
            'president_name'  => 'required|string|max:255',
            'rating'          => 'nullable|numeric|max:999',
            'mfo'             => 'nullable|string|max:255',
            'swift'           => 'nullable|string|max:255',
            'egrdpou'         => 'nullable|string|max:255',
            'number_reg'      => 'nullable|string|max:255',
            'date_reg'        => 'nullable|date_format:d/m/Y',
            'number_license'  => 'nullable|string|max:255',
            'date_license'    => 'nullable|date_format:d/m/Y',
            'description'     => 'nullable|string',
            'head_office'     => 'nullable|string|max:255',
            'phone'           => 'nullable|string|max:255',
            'email'           => 'nullable|email|string|max:255',
            'web_site'        => 'nullable|string|url|max:255',
            'preview'         => 'nullable|string',

            'primary_media'       => 'array',
            'primary_media.url'   => 'nullable|string',
            'primary_media.alt'   => 'nullable|string',
            'primary_media.title' => 'nullable|string',
            'president_photo'       => 'array',
            'president_photo.url'   => 'nullable|string',
            'president_photo.alt'   => 'nullable|string',
            'president_photo.title' => 'nullable|string',

            'seo'                 => 'array',
            'seo.title'           => 'nullable|string|max:255',
            'seo.description'     => 'nullable|string',
            'seo.keywords'        => 'nullable|string',
            'seo.canonical'       => 'nullable|string|max:255|url',
            'seo.robot_index'     => 'nullable|string',
            'seo.robot_follow'    => 'nullable|string',
        ];

        if($this->isMethod('put')){
            $rules['slug'] = 'required|string|max:191|alpha_dash|unique:banks,slug,'.$this->bank->id;
        }

        return $rules;
    }
}
