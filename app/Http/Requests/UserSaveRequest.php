<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UserSaveRequest extends FormRequest
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
    {  if($this->password)
        {
            return [
                'password' => 'required|min:6|confirmed',
            ] ;
        }

        return [
            'name' => [
                'required',
                Rule::unique('users')->ignore($this->user()->id),
            ]
        ];
    }
}
