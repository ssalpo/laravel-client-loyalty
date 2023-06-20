<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'company_id' => 'required',
            'name' => 'required|min:1|max:255',
            'username' => 'required|min:1|max:40',
            'password' => 'nullable|min:1|max:40',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'company_id' => auth()->user()->company_id
        ]);
    }
}
