<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreditCardRequest extends FormRequest
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
            'slug'             => 'required|string|max:191|alpha_dash|unique:credit_cards,slug',
            'name'             => 'required|string|max:255',
            'organization_id'  => 'required|integer|exists:banks,id',
            'ref_link'         => 'required|string|max:255',
            'rating'           => 'required|numeric',
            'max_limit'        => 'required|numeric',
            'income_max_limit' => 'required|numeric',
            'grace_period'     => 'required|integer',
            'rate_in'          => 'required|numeric',
            'rate_after'       => 'required|numeric',
            'service'          => 'nullable|string',
            'cash_back'        => 'nullable|numeric',
            'loan'             => 'nullable|numeric',
            'chip'             => 'nullable|boolean',
            'pay_wave'         => 'nullable|boolean',
            'visa'             => 'nullable|boolean',
            'master_card'      => 'nullable|boolean',

            'preview'          => 'nullable|string',
            'min_age'          => 'required|integer',
            'max_age'          => 'required|integer',
            'currency'         => 'nullable|string|max:255',
            'list_documents'   => 'nullable|string',
            'terms_repayment'  => 'nullable|string',
            'fines_penalties'  => 'nullable|string',
            'insurance'        => 'nullable|string',

            'advantages'       => 'array',

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
            $rules['slug'] = 'required|string|max:191|alpha_dash|unique:credit_cards,slug,'.$this->credit_card->id;
        }

        return $rules;
    }
}