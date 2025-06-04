<?php

namespace App\Http\Requests;

use App\Enums\ReturnStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateStatusReturnRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', new Enum(ReturnStatus::class)],
        ];
    }
}
