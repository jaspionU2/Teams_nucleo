<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class createTeamRequest extends FormRequest
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
            'id' => ['required', 'integer'], 
            'nameTime' => ['required', 'string', 'max:30', 'min:3'],
            'players' => ['array', 'max:3'], 
            'players.*.name' => 'required|string|min:3|max:30',
            'players.*.position' => 'required|string',
            'foundation_date' => ['required', 'date'],
        ];
    }

    public function messages()
    { 
         return[
               'id.required' => 'este campo é obrigatorio',
               'id.integer' => 'o campo precisa ser preenchido com um inteiro',
               'nameTime.required' => 'o campo nome do time é obrigatorio',
               'nameTime.min' => 'o campo nome do time deve ter no minimo 3 caracteres',
               'players.array' => 'o campo players deve ser um array',
               'players.*.name.required' => 'o campo nome do jogador é obrigatorio',
               'players.*.name.min' => ' o campo nome do jogador deve ter no minimo 3 caracteres',
               'foundation_date.required' => 'o campo data de fundação é obrigatorio'
         ];
    }
}
