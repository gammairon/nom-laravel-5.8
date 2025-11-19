<?php

namespace App\Http\Requests\Admin\Organization;

use Illuminate\Foundation\Http\FormRequest;

class MfoRequest extends FormRequest
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
     *
     */
    public function rules()
    {

        $rules = [
            'slug' => 'required|string|max:191|alpha_dash|unique:mfo_org,slug',
            'name' => 'required|string|max:255',
            'ref_link' => 'nullable|string|url',
            'rating' => 'nullable|numeric|max:999',
            'first_credit' => 'nullable|numeric',
            'preview' => 'nullable|string',
            'free_credit_description' => 'nullable|string',
            'free_credit_bid' => 'nullable|numeric',
            'free_credit_amount' => 'nullable|numeric',
            'min_amount' => 'nullable|numeric',
            'max_amount' => 'nullable|numeric',
            'repeat_credit_bid' => 'nullable|numeric',
            'min_term' => 'nullable|integer',
            'max_term' => 'nullable|integer',
            'min_age' => 'nullable|integer',
            'max_age' => 'nullable|integer',
            'time_review' => 'nullable|integer',
            'receiving_method_card' => 'nullable|boolean',
            'receiving_method_cash' => 'nullable|boolean',
            'special_offer' => 'nullable|string',
            'web_site' => 'nullable|string|url|max:255',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'address' => 'nullable|string',
            'work_time' => 'nullable|string',
            'nfs_license' => 'nullable|string|max:255',

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
            $rules['slug'] = 'required|string|max:191|alpha_dash|unique:mfo_org,slug,'.$this->mfo->id;
        }

        return $rules;
    }
}
