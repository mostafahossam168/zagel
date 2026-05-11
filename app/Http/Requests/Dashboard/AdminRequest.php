<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'                  => 'required|string|max:255',
                    'email'                 => 'required|email|unique:users,email',
                    'phone'                 => 'nullable|string|max:20',
                    'status'                => 'required',
                    'role'                  => 'required',
                    'image'                 => 'nullable|image|max:2048',
                    'password'              => 'required|string|min:8|confirmed',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name'                  => 'required|string|max:255',
                    'email'                 => 'required|email|unique:users,email,' . $this->route('admin'),
                    'phone'                 => 'nullable|string|max:20',
                    'status'                => 'required',
                    'role'                  => 'required',
                    'image'                 => 'nullable|image|max:2048',
                    'password'              => 'nullable|string|min:8|confirmed',
                ];
            default:
                return [];
        }
    }
}
