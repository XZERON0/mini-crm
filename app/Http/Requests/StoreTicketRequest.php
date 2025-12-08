<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer.name' => 'required|string|max:255',
            'customer.phone' => 'required|string|regex:/^\+7\d{10}$/', 
            'customer.email' => 'required|email|max:255',
            'subject' => 'required|string|max:500',
            'text' => 'required|string',
            'files.*' => 'nullable|file|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'customer.phone.regex' => 'Телефон должен быть в формате +7XXXXXXXXXX (11 цифр)',
        ];
    }
}