<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'default_percent' => 'required|regex:/^\d+(\.\d{1,2})?$/|gt:0',
            'send_birthday_gift_time' => 'required|date_format:H:i',
            'birthday_template' => 'required|min:3|max:1000',
        ];
    }
}
