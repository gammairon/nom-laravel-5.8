<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreditCashRequest extends FormRequest
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
            'slug'                   => 'required|string|max:191|alpha_dash|unique:credit_cash,slug',
            'name'                   => 'required|string|max:255',
            'organization_id'        => 'required|integer|exists:banks,id',
            'ref_link'               => 'required|string|max:255',
            'rating'                 => 'required|numeric',
            'min_amount'             => 'required|numeric',
            'max_amount'             => 'required|numeric',
            'income_max_amount'      => 'required|numeric',
            'min_term'               => 'required|integer',
            'max_term'               => 'required|integer',
            'percent_new_individual' => 'required|numeric',
            'percent_new_legal'      => 'required|numeric',
            'percent_client'         => 'required|numeric',
            'docs_individual'        => 'nullable|string',
            'docs_legal'             => 'nullable|string',
            'experience'             => 'nullable|string',

            'advantages'             => 'array',

            'primary_media'       => 'array',
            'primary_media.url'   => 'nullable|string',
            'primary_media.alt'   => 'nullable|string',
            'primary_media.title' => 'nullable|string',

            'seo'                 => 'array',
            'seo.title'           => 'nullable|string|max:255',
            'seo.description'     => 'nullable|string',
            'seo.keywords'        => 'nullable|string',
            'seo.canonical'       => 'nullable|string|max:255|url',
            'seo.robot_index'     => 'nullable|string',
            'seo.robot_follow'    => 'nullable|string',
        ];

        if($this->isMethod('put')){
            $rules['slug'] = 'required|string|max:191|alpha_dash|unique:credit_cash,slug,'.$this->credit_cash->id;
        }

        return $rules;
    }
}