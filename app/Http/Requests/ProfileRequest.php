<?php

namespace App\Http\Requests;

use App\Profile;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'required|max:191',
            'email' => 'required|email',
            'comments' => 'max:500',
            'code_profile' => 'max:191',
            'vacancy' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx,jpeg,jpg,png',
        ];
    }
}
