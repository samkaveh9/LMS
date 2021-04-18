<?php

namespace Samkaveh\RolePermission\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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

        if ($this->isMethod('post')) {
            return [
                'name' => 'required|min:3|unique:roles',
                'permissions' => 'required|array|min:1'
            ];
        }
    
        if ($this->isMethod('put')) {
            return [
                'name' => 'required|min:3|unique:roles,name,' . request()->id,
                'permissions' => 'required|array|min:1'
            ];
        }

    }
}
