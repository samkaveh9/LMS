<?php

namespace Samkaveh\Course\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Samkaveh\Course\Models\Course;
use Samkaveh\Course\Rule\ValidTeacher;


class CourseRequest extends FormRequest
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
        $rules = [
            'category_id' => 'required',
            'teacher_id' => ['required','exists:users,id',new ValidTeacher()],
            'title' => 'required|min:3|max:255',
            'priority' => 'nullable|numeric',
            'price' => 'required|numeric|min:0|max:10000000',
            'percent' => 'required|numeric|min:0|max:100',
            'type' => ['required',Rule::in(Course::$types)],
            'status' => ['required', Rule::in(Course::$statuses)],
            'banner' => 'required|mimes:jpg,png,jpeg'
        ];

        if (request()->method == 'PUT') {
            $rules['banner'] = 'nullable|mimes:jpg,png,jpeg';
        }

        return $rules;
    }
}
