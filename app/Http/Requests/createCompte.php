<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createCompte extends FormRequest
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
        return [
            'email' =>'required|unique:users|ends_with:@uca.ac.ma',
            'nApogee' => 'unique:etudiants',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'svp remplir toutes les champs',
            'email.unique'  => 'il y-a déjà un compte avec cette adresse émail',
            'email.ends_with'  => 'svp utilisez une adresse émail académique',
            'nApogee.unique' => 'il y-a déjà un étudiant avec ce numéro',
        ];
    }
}
