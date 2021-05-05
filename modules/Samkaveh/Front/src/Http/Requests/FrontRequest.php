<?php

namespace Samkaveh\Front\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FrontRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:100|unique:categories',
            'parent_id' => 'nullable|exists:categories,id'
        ];
    }
}
