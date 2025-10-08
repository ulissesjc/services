<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest
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

        $serviceId = $this->route('service');

        $rules = [
            'glpi_number_call' => ['required', 'string', Rule::unique('services', 'glpi_number_call')->ignore($serviceId)],
            'category' =>
                [
                    'required',
                    'string',
                    Rule::in([
                        'lab_review',
                        'admin_review',
                        'printer_check',
                        'tablet_check',
                        'net_check',
                        'others'
                    ]),
                ],
            'description' => ['required', 'string'],
            'date' => ['required', 'date', 'before_or_equal:today'],
            'mode' =>
                [
                    'required',
                    'string',
                    Rule::in([
                        'in_person',
                        'remote',
                        'bench'
                    ]),
                ],
            'city' => ['required'],
            'school_id' => ['required', 'exists:schools,id']
        ];

        return $rules;
    }

    public function messages():array
    {
        return [
            'glpi_number_call.required' => 'O número do chamado GLPI é obrigatório',
            'glpi_number_call.string' => 'O número do chamado GLPI deve ser uma string',
            'glpi_number_call.unique' => 'Já existe um atendimento cadastrado com esse número',

            'category.required' => 'A categoria é obrigatória',
            'category.string' => 'A categoria deve ser uma string',
            'category.in' => 'A categoria é inválida',

            'description.required' => 'A descrição é obrigatória',
            'description.string' => 'A descrição deve ser um text',

            'date.required' => 'A data é obrigatória',
            'date.date' => 'A data deve ser tipo date',
            'date.before_or_equal' => 'A data não pode ser futura',

            'mode.required' => 'A forma de atendimento é obrigatória',
            'mode.string' => 'A forma de atendimento deve ser uma string',
            'mode.in' => 'A forma de atendimento selecionada é inválido',

            'city.required' => 'É necessário selecionar o município',

            'school_id.required' => 'É necessário selecionar a escola',
            'school_id.exists' => 'A escola selecionada não existe'
        ];
    }

}
