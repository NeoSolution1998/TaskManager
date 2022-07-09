<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:App\Models\Task,name',
            'description' => 'required',
            'status_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Это обязательное поле',
            'description.required' => 'Это обязательное поле',
            'status_id.required' => 'Это обязательное поле',
            'name.unique' => 'Статус с таким именем уже существует'
        ];
    }
}
