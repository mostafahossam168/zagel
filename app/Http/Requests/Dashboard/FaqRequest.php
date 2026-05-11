<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'question' => ['required', 'string'],
            'answer'   => ['required', 'string'],
            'status'   => ['required', 'string', 'in:active,inactive'],
        ];
    }
}
