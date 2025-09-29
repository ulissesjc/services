<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SchoolRequest extends FormRequest
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
        $schoolId = $this->route('school');

        $rules =  [
            'name' => ['required', 'string', 'min: 5', 'max: 255'],
            'inep' => ['required', 'string', 'size: 8', Rule::unique('schools', 'inep')->ignore($schoolId)],
            'cnpj' => ['required', 'string', 'size: 18', Rule::unique('schools', 'cnpj')->ignore($schoolId)],
            'email' => ['required','string','email', 'min:3', 'max:50', Rule::unique('schools','email')->ignore($schoolId)],
            'phone' => ['nullable', 'string', 'size: 14', Rule::unique('schools', 'phone')->ignore($schoolId)],
            'city' =>
                [
                    'required',
                    'string',
                    Rule::in([
                        'Lagarto',
                        'Poço Verde',
                        'Riachão do Dantas',
                        'Simão Dias',
                        'Tobias Barreto'
                    ]),
                ],
            'address' => ['required', 'string', 'min: 10', 'max: 255'],
            'has_lab' => ['required', 'boolean'],
            'has_resource_room' => ['required', 'boolean']
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'name.string' => 'O nome deve ser uma string',
            'name.min' => 'O nome deve ter no mínimo :min caracteres',
            'name.max' => 'O nome deve ter no máximo :max caracteres',

            'inep.required' => 'O código MEC é obrigatório',
            'inep.string' => 'O código MEC deve ser uma string',
            'inep.size' => 'O código MEC deve ter exatamente :size caracteres',
            'inep.unique' => 'Já existe uma escola com o código MEC informado',

            'cnpj.required' => 'O CNPJ é obrigatório',
            'cnpj.string' => 'O CNPJ deve ser uma string',
            'cnpj.size' => 'O CNPJ deve ter exatamente :size caracteres',
            'cnpj.unique' => 'Já existe uma escola com o CNPJ informado',

            'email.required' => 'O e-mail é obrigatório',
            'email.string' => 'O e-mail deve ser uma string',
            'email.email' => 'É necessário enviar um e-mail válido',
            'email.min' => 'O e-mail deve ter no mínimo :min caracteres',
            'email.max' => 'O e-mail deve ter no máximo :max caracteres',
            'email.unique' => 'É necessário enviar um e-mail válido',

            'phone.string' => 'O telefone deve ser uma string',
            'phone.size' => 'O telefone deve ter exatamente :size caracteres',
            'phone.unique' => 'Este telefone não está disponível',

            'city.required' => 'O município é obrigatório',
            'city.string' => 'O município deve ser uma string',
            'city.in' => 'A cidade selecionada é inválida',

            'address.required' => 'O endereço é obrigatório',
            'address.string' => 'O endereço deve ser uma string',
            'address.min' => 'O endereço deve ter no mínimo :min caracteres',
            'address.max' => 'O endereço deve ter no máximo :max caracteres',

            'has_lab.required' => 'É obrigatório informar se a escola possui laboratório',
            'has_lab.boolean' => 'Esse campo deve ser verdadeiro ou falso',

            'has_resource_room.required' => 'É obrigatório informar se a escola possui sala de recursos',
            'has_resource_room.boolean' => 'Esse campo deve ser verdadeiro ou falso',
        ];
    }
}
