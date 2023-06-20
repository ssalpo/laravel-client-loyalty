<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PointRequest extends FormRequest
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
            'client_id' => 'required|exists:clients,id',
            'percent' => 'required',
            'sell_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/|gt:0',
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'percent' => option('default_percent')
        ]);
    }
}
