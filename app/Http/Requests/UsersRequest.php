<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'enum' => 'integer|unique:doctors,doctor_ref',
            'name' => 'required|string|max:100',
            'age' => 'nullable|integer|min:18',
            'sexe' => 'required|in:Homme,Femme',
            'type' => 'required|in:doctor,clinique,laboratoire',
            'telephone' => 'required',
            'email' => 'required|email|unique:users,email',
            'specialite' => 'required|string',
            'password' => 'required',
        ];
    }
}
