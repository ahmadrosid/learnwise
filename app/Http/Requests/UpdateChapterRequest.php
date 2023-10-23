<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateChapterRequest extends FormRequest
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
            'is_free' => 'boolean',
            'title' => 'nullable|string|min:3|max:255',
            'category_id' => 'nullable|numeric|exists:categories,id',
            'description' => 'nullable|string',
            'position' => 'nullable|numeric',
            'next_chapter_id' => 'nullable|numeric|exists:chapters,id',
        ];
    }
}
