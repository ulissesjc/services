<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $userId = $this->route('user')?->id;

        $rules = [
            'type' =>
                [
                    'required',
                    'string',
                    Rule::in([
                        'admin',
                        'common'
                    ]),
                ],
            'name' => ['required', 'string', 'min: 5', 'max: 255'],
            'username' => ['required', 'string', 'min: 5', 'max: 50', Rule::unique('users', 'username')->ignore($userId)],
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = ['required', 'string', 'min:5', 'max:100'];
            $rules['password_check'] = ['required', 'same:password'];
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['password'] = ['nullable', 'string', 'min:5', 'max:100'];
            $rules['password_check'] = ['nullable', 'same:password'];
        }

        return $rules;
    }

    public function messages():array
    {
        return [
            'type.required' => 'O tipo é obrigatório',
            'type.string' => 'O tipo deve ser uma string',
            'type.in' => 'O tipo selecionado é inválido',

            'name.required' => 'O nome é obrigatório',
            'name.string' => 'O nome deve ser uma string',
            'name.min' => 'O nome deve ter no mínimo :min caracteres',
            'name.max' => 'O nome deve ter no máximo :max caracteres',

            'username.required' => 'O username é obrigatório',
            'username.string' => 'O username deve ser uma string',
            'username.min' => 'O username deve ter no mínimo :min caracteres',
            'username.max' => 'O username deve ter no máximo :max caracteres',
            'username.unique' => 'Este username não está disponível',

            'password.required' => 'A senha é obrigatória',
            'password.string' => 'A senha deve ser uma string',
            'password.min' => 'A senha deve ter no mínimo :min caracteres',
            'password.max' => 'A senha deve ter no máximo :max caracteres',

            'password_check.required' => 'A confirmação da senha é obrigatória',
            'password_check.same' => 'As senhas não conferem'
        ];
    }
}
