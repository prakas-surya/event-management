<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // or return auth()->check() if you want to authorize only authenticated users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255|min:3',
            'description' => 'nullable|max:255',
            'date' => 'required|date',
            'location' => 'required|max:255|min:5',
            'status' => 'required|in:completed,pending'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'date.required' => 'The date field is required.',
            'location.required' => 'The location field is required.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.'
        ];
    }
}
