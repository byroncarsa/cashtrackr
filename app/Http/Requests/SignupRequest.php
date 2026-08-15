<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Override;

class SignupRequest extends FormRequest
{
    #[Override]
    public function messages() : array
    {
        return [
            'name.required' => 'El nombre es obligaotio',
            'email.required' => 'El email es obligaotio',
            'email.email' => 'El email no es valido',
            'email.unique' => 'El email ya esta registrado',
            'password.required' => 'La constraseña es obligatoria',
            'password.confirmes' => 'Las constraseñas no coinciden',
            'password.min' => 'La constraseña debe tener como minimo :min caracteres',
            'password.mixed' => 'La constraseña debe tener al menos 1 letra mayuscula y letra minuscula',
            'password.symbols' => 'La constraseña debe tener al menos 1 caracter especial',
            'password.numbers' => 'La constraseña debe tener al menos 1 numero',
            'password.uncompromised' => 'La constraseña a aparecido en filtraciones de datos. Elige una mas segura'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            // 'password' => ['required', 'confirmed', 'min:8']
            'password' => ['required', 'confirmed', 
                Password::min(3)
                    ->letters()
                    ->mixedCase()
                    ->symbols()
                    ->numbers()
                    ->uncompromised()
            ]
        ];
    }
}
