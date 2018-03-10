<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ProjectRequest
 * @package App\Http\Requests
 */
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
        $required = (null === $this->project) ? 'required|image64:jpeg,jpg,png' : '';
        $id = (null === $this->project) ? '' : ','.$this->project->id;

        return [
            'slug' => 'nullable|max:200|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:projects,slug'.$id,
            'name' => 'required|max:50',
            'description' => 'required|max:50',
            'preloader' => 'required|max:50',
            'hero_image' => $required,
            'hero_image_preview' => $required,
            'hero_color' => 'nullable|max:30',
            'info_subtitle' => 'required|max:140',
            'info_description' => 'required|max:300',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_featured' => 'boolean',
            'is_dark' => 'boolean',
            'country_id' => 'required|exists:countries,id',
            'client_id' => 'required|exists:clients,id',
            'sections.*.order' => 'required_without:sections.*.visible',
            'sections.*.color' => 'nullable|max:30',
            'sections.*.model.body' => 'required_if:sections.*.component,ProjectStickySection,ProjectTextInformation',
            'sections.*.model.image' => 'required_if:sections.*.component,ProjectStickySection',
            'sections.*.model.images.*.image' => 'required_without:sections.*.model.images.*.visible',
            'sections.*.model.images.*.background_size' => 'required_without:sections.*.model.images.*.visible',
            'sections.*.model.images.*.color' => 'nullable|max:30',
        ];
    }

    /**
     *
     */
    public function messages()
    {
        return [
            'sections.*.order.required' => 'Section Order position is required',
            'sections.*.model.body.required' => 'The Section Body is required',
        ];
    }
}
