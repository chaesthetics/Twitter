<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
class EditProfileRequest extends FormRequest
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
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Update failed!',
            'data' => $validator->errors(),
        ], 422));
    }
}
