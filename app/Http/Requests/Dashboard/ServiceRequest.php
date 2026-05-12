<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title_ar'       => 'required|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image'          => 'nullable|image|max:2048',
            'category_id'    => 'nullable|exists:categories,id',
            'price'          => 'nullable|numeric|min:0',
            'currency'       => 'nullable|string|max:10',
            'is_purchasable' => 'boolean',
            'sort_order'     => 'nullable|integer|min:0',
            'status'         => 'required|in:active,inactive',
        ];
    }
}
