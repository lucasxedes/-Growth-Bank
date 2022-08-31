<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUser extends FormRequest
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
            'name' => 'required|string|max:255|min:3',
            'document_type' => 'required',
            'document_number' =>'required|alpha_num|max:11|min:11',
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'min:6',
                'max:15',
            ],
        ];
    }
}
