<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:contacts'],
            'phone' => ['required', 'string', 'max:15'],
            'cellphone' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:255'],
            'neighborhood' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:50'],
        ];
    }
}
