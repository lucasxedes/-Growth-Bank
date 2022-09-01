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
            'document_type' => 'required|string',
            'document_number' => 'required|numeric|unique:users,document_number',
            'email' => [
                'required',
                'email',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'min:6',
                'max:15',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome obrigatório, minimo 3 letras',
            'document_number.unique' => 'O campo documento é inválido, já foi inserido no sistema',
            'email.unique' => 'O campo email é inválido, já foi inserido no sistema',
            'document_type.required' => 'Selecione [CPF] ou [CNPJ]',
            'document_number.required' => 'Informe o número [CPF] ou [CNPJ]',
            'email.required' => 'Email é obrigatorio, EX: user@email.com',
            'password.required' => 'password. min:6 max:15 caracteres'
        ];
    }
}
