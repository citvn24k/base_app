<?php

namespace App\Http\Requests;

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
        $rules = [
            'name' => 'required|unique:roles',
            'permissions' => 'required',
        ];
        if (request()->route('role')) {
            $id = request()->route('role');
            $rules['name'] = 'required|unique:roles,name,' . $id;
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn cần nhập tên vai trò',
            'name.unique' => 'Tên vai trò đã tồn tại',
            'permissions.required' => 'Bạn phải chọn ít nhất 1 chức năng'
        ];
    }
}
