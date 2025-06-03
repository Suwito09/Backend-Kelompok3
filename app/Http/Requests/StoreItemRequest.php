<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ];
    }
}
