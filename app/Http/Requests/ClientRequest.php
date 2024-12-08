<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientRequest extends FormRequest
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
            'nom'=>'required|max:255|string|min:4',
            'prenom'=>'required|max:255|string|min:4',
            'email'=>'required|email|unique:clients,email',
            'quartier'=>'required|string|max:255|min:4',
            'ville'=>'required|string|max:255|min:4',
            'password'=>'required|confirmed|max:10|min:4',
        ];
    }
    public function messages(){
        return [
            'email.unique'=>'cet email existe déja !',
            'password.confirmed' => 'Le mot de passe de confirmation ne correspond pas.',

        ];
    }

}
