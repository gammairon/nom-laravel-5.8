<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'slug'              => 'required|string|max:191|alpha_dash|unique:tags,slug',
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

        if($this->isMethod('put'))
            $rules['slug'] = 'required|string|max:191|alpha_dash|unique:tags,slug,'.$this->tag->id;

        return $rules;
    }
}
