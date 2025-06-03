<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReturnRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'student_number' => 'required|string|digits_between:1,12',
            'proof' => 'required|string|max:255',
        ];
    }
}
