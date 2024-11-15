<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInstitutionsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'institutions' => 'required|array|min:1',
            'institutions.*' => 'exists:instituicoes,id'
        ];
    }

    public function messages()
    {
        return [
            'institutions.required' => 'Selecione pelo menos uma instituição.',
            'institutions.min' => 'O usuário deve pertencer a pelo menos uma instituição.',
            'institutions.*.exists' => 'Uma das instituições selecionadas não existe.'
        ];
    }
}
