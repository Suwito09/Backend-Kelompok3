<?php

namespace App\Http\Requests;

use App\Enums\ItemStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateStatusItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', new Enum(ItemStatus::class)],
        ];
    }
}
