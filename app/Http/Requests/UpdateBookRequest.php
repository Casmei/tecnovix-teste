<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:150',
            'description' => 'nullable|string',
            'year_of_publication' => 'required|digits:4|integer|lte:' . now()->year,
            'isbn' => 'required|string|size:10',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
