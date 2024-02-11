<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'nullable',
            'main_image' => 'nullable',
            'category_id' => 'required|integer|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'integer|exists:tags,id'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Это поле необходимо',
            'content.required' => 'Это поле необходимо',
            'category_id.exists' => 'Категория должна быть',
            'category_id.integer' => 'Категория должна быть',
            'category_id.required' => 'id должен быть в базе',
            'tag_ids.exists' => 'id должен быть в базе',
            'tag_ids.nullable' => 'Тэги должны быть',
        ];
    }
}
