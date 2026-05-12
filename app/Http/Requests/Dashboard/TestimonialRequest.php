<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'company'  => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'content'  => 'required|string',
            'image'    => 'nullable|image|max:2048',
            'rating'   => 'required|integer|min:1|max:5',
            'status'   => 'required|in:active,inactive',
        ];
    }
}
