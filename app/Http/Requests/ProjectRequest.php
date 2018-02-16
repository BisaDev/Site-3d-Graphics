<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name' => 'required|max:50',
            'description' => 'required|max:50',
            'preloader' => 'required|max:50',
            //'hero_image' => 'mimes:jpeg,png|max:2000',
            //'hero_image_preview' => 'mimes:jpeg,png|max:2000',
            'hero_color' => 'required|max:7',
            'info_subtitle' => 'required|max:140',
            'info_description' => 'required|max:300',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            //'country_id' => 'required|exists:countries',
            //'client_id' => 'required|exists:clients',
        ];
    }
}
