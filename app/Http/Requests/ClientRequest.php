<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'required|min:2|max:255',
            'phone' => 'required|min:2|max:255',
            'birthday' => 'nullable|date_format:Y-m-d',
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'birthday' => ($this->birthday ? Carbon::parse($this->birthday) : now())->format('Y-m-d')
        ]);
    }
}
