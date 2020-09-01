<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'name'                 => 'required|alpha_spaces|min:6|max:20',
            'email'                => 'required|email|max:255|unique:users',
            'password'             => 'required|min:4',
            'password_confirm'     => 'required|same:password',
            'g-recaptcha-response' => 'required|captcha'
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required'              => 'Данное поле обязательно к заполнению',
            'email'                 => 'Данное поле должно содержать валидный email адрес',
            'max'                   => 'Данное поле не должно содержать больше чем :max символов',
            'min'                   => 'Данное поле должно содержать больше чем :min символов',
            'alpha_spaces'          => 'Данное поле может содержать только буквенные символы и пробелы',

            'email.unique'          => 'Данный email адрес уже используется другим пользователем',
            'password_confirm.same' => 'Данные пароли не совпадают'
        ];
    }
}
