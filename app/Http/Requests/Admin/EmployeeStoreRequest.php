<?php

declare(strict_types = 1);

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'first_name' => 'nullable|string|max:30',
            'last_name' => 'nullable|string|max:50',
            'email' => 'required|email|unique:admins',
            'password' => 'required|confirmed|min:8',
        ];
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'first_name' => $this->input('first_name'),
            'last_name' => $this->input('last_name'),
            'email' => $this->input('email'),
            'password' => bcrypt($this->input('password')),
        ];
    }
}