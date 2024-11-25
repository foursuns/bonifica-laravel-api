<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . ($userId ? $userId->id : null),
            'message' => 'required',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422));                
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is mandatory',
            'email.required' => 'The email field is mandatory',
            'email.email' => 'The email field must be valid',
            'email.unique' => 'The email field must be unique',
            'message.required' => 'The message field is mandatory',
        ];
    }
}
