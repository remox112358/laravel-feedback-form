<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
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
            'subject' => 'required|min:4|max:32',
            'message' => 'required|min:8|max:1000',
            'file'    => 'nullable|file|max:20480'
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
            'required'      => 'Данное поле обязательно к заполнению',
            'max'           => 'Данное поле не должно содержать больше чем :max символов',
            'min'           => 'Данное поле должно содержать больше чем :min символов',
            'file'          => 'Данное поле должно содержать валидный файл (успешно загруженный)',

            'file.max'      => 'Данное поле не должно содержать файл весящий больше чем :max килобайт'
        ];
    }
}
