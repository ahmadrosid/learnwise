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
            'is_free' => 'nullable|numeric',
            'title' => 'nullable|string|min:3|max:255',
            'category_id' => 'nullable|numeric|exists:categories,id',
            'description' => 'nullable|string',
            'position' => 'required|numeric',
        ];
    }
}


/*
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->integer('course_id')->nullable()->constrained('courses');
            $table->boolean('is_free')->default(false);
            $table->boolean('is_published')->default(false);
            $table->integer('position')->nullable();
            $table->string('video_url')->nullable();
 * */
