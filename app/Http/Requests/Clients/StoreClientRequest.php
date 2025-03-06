<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'contact_name' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'string', 'email', 'max:255', Rule::unique('clients')],
            'contact_phone_number' => ['required'],
            'company_name' => ['required'],
            'company_address' => ['required'],
            'company_city' => ['required', 'string'],
            'company_zip' => ['required', 'integer'],
            'company_vat' => ['required', 'numeric'],
        ];
    }
}
