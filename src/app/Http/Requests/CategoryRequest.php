<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                'create_name' => ['required', 'string', 'max:10','unique:categories,name'],
            ];
        }
        elseif ($formType === 'update') {
            return [
                'update_name' => ['required', 'string', 'max:10','unique:categories,name'],
            ];
        }
        return [];
    }

    public function messages()
    {

        return [
            'create_name.required' => 'カテゴリを入力してください',
            'create_name.string' => 'カテゴリを文字列で入力してください',
            'create_name.max' => 'カテゴリを10文字以下で入力してください',
            'create_name.unique' => 'カテゴリが既に存在しています',
            'update_name.required' => 'カテゴリを入力してください',
            'update_name.string' => 'カテゴリを文字列で入力してください',
            'update_name.max' => 'カテゴリを10文字以下で入力してください',
            'update_name.unique' => 'カテゴリが既に存在しています',
        ];
    }
}
