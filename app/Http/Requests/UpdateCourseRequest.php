<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'price' => 'nullable|numeric',
            'title' => 'nullable|string|min:3|max:255',
            'category_id' => 'nullable|numeric|exists:categories,id',
            'description' => 'nullable|string',
            'lang' => 'nullable|string',
        ];
    }
}
