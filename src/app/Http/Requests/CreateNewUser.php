<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ture;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191'],
            'password' => ['required', 'min:8', 'max:191']

        ];
    }

   public function messages()
    {
        return [
            'name.required' => 'nameを入力してください',
            'name.string' => 'nameを文字列で入力してください',
            'name.max' => 'nameを191文字以下で入力してください',
            'emali.required' => 'emailを入力してください',
            'email.string' => 'emailを文字列で入力してください',
            'email.email' => 'emailをメール形式で入力してください',
            'email.max' => 'emailを191文字以下で入力してください',
            'password.required' => 'passwordを文字列で入力してください',
            'password.min' => 'passwordを8文字以上で入力してください',
            'password.max' => 'passwordを191文字以下で入力してください',
        ];
    }
}
