<?php

namespace App\Http\Requests\API\Auth;

use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AgentsRegisterRequest extends FormRequest
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
            'name' => ['required','string','min:3','max:30'],
            'email' => ['required','email','string','max:55'],
            'password' => ['required','string','min:6'],
            'birthdate' => ['date_format:d/m/Y'],
        ];
    }



    public function messages()
    {
        return [
            'birthdate.date_format' => 'Invalid date of :attribute format',
            'password.min' => 'minimum length  :attribute !',
        ];
    }
}
