<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Permite o acesso à validação
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
            'isbn' => 'required|string|size:10|unique:books,isbn',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'zip_code' => 'required|integer|digits:8',
            'street' => 'required|string|max:255',
            'complement' => 'nullable|string|max:100',
            'neighborhood' => 'required|string|max:100',
            'unit' => 'nullable|string|max:50',
            'city' => 'required|string|max:100',
            'state' => 'required|string|size:2',
        ];
    }

    /**
     * Get the custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'year_of_publication.lte' => 'The publication year cannot be greater than the current year.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'zip_code' => (int) str_replace('-', '', $this->zip_code),
        ]);
    }
}
