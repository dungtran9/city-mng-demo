<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormCustomerCreateRequest extends FormRequest
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
        return [
            'name'=>'required|min:2|max:32',
            'email'=>'required|email|unique:customers,email',
            'dob'=>'required|date|after:today'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên người dùng không được để trống.',
            'name.max'=>'Tên người dùng quá dài',
            'name.min'=>'Tên người dùng quá ngắn',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'dob.required'=>'ngày sinh không được để trống',
            'dob.after'=>'ngày sinh không hợp lệ'

        ];
    }
}
