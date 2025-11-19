<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'user_id'             => 'required|integer|exists:users,id',
            'name'                => 'required|string|max:255',
            'content'             => 'required|string',
            'slug'                => 'string|max:191|alpha_dash|unique:posts,slug|unique:pages,slug',
            'status'              => 'required|string|max:50',
            'parent_id'           => 'nullable|integer|exists:pages,id',
            'public_date'         => 'required|string',
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
            $rules['slug'] = 'string|max:191|alpha_dash|unique:posts,slug|unique:pages,slug,'. $this->page->id;

        return $rules;
    }
}
