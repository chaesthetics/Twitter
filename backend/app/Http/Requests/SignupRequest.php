<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class SignupRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|string|min:2|max:24',
            'lastname' => 'required|string|min:2|max:24',
            'email' => 'required|email',
            'password' => 'required|min:6|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
        ];
    }

    public function messages(){
        return[
            'firstname.required' => 'firstname is required',
            'firstname.string' => 'firstname should be string',
            'firstname.min' => 'firstname should be 2 or more characters',
            'firstname.max' => 'firstname should be no longer than 24 characters',
            'lastname.required' => 'lastname is required',
            'lastname.string' => 'lastname should be string',
            'lastname.min' => 'lastname should be 2 or more characters',
            'lastname.max' => 'lastname should be no longer than 24 characters',
            'email.required' => 'email is required',
            'email.email' => 'please use a valid email',
            'password.required' => 'password is required',
            'password.min' => 'password should be 6 or more characters',
            'password.regex' => 'password should have atleast 1 uppercase, 1 lowercase, number',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'succes' => false,
            'message' => 'Validation Error',
            'data' => $validator->errors(),
        ], 422));
    }
}
