<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
        $formType = $this->input('form_type');

        if ($formType === 'create') {
            return [
                'create_category_name' => ['required','exists:categories,name'],
                'create_content' => ['required', 'string', 'max:20'],
            ];
        }
        elseif ($formType === 'update') {
            return [
                'update_category_name' => ['required','exists:categories,name'],
                'update_content' => ['required', 'string', 'max:20'],
            ];
        }
        return [];
    }

    public function messages()
    {
        return [
            'create_category_name.required' => 'カテゴリを入力してください',
            'create_category_name.exists' => 'カテゴリが存在しません',
            'create_content.required' => 'Todoを入力してください',
            'create_content.string' => 'Todoを文字列で入力してください',
            'create_content.max' => 'Todoを20文字以下で入力してください',

            'update_category_name.required' => 'カテゴリを入力してください',
            'update_category_name.exists' => 'カテゴリが存在しません',
            'update_content.required' => 'Todoを入力してください',
            'update_content.string' => 'Todoを文字列で入力してください',
            'update_content.max' => 'Todoを20文字以下で入力してください',
        ];
    }
}
