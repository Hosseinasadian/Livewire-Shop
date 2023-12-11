<?php

namespace App\Http\Requests\Admin\Template;

use Illuminate\Foundation\Http\FormRequest;

class PropertiesRequest extends FormRequest
{
    public $attributes = [
        'properties.*.name' => 'name of property'
    ];

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
            'properties' => ['array'],
            'properties.*.name' => ['required'],
            'properties.*.slug' => ['required'],
            'properties.*.type' => ['required'],
            'properties.*.model' => ['required_if:properties.*.type,relational', 'exclude_unless:properties.*.type,relational'],
            'properties.*.items' => ['required_if:properties.*.type,select', 'exclude_unless:properties.*.type,select', 'array'],
            'properties.*.optionsHasImage' => ['exclude_unless:properties.*.type,select','nullable','in:1'],
            'properties.*.optionsHasDescription' => ['exclude_unless:properties.*.type,select','nullable','in:1'],
            'properties.*.items.*.name'=>['required'],
            'properties.*.items.*.description'=>['exclude_unless:properties.*.optionsHasDescription,1','nullable','min:10'],
            'properties.*.items.*.image'=>['exclude_unless:properties.*.optionsHasImage,1','nullable','url'],
        ];
    }

    public function messages()
    {
        return [
            'properties.array' => 'The properties format is invalid.',
            'properties.*.name.required' => 'The name of property is required.',
            'properties.*.slug.required' => 'The slug of property is required.',
            'properties.*.type.required' => 'The type of property is required.',
            'properties.*.model.required_if' => 'The model of relational property is required.',
            'properties.*.items.required_if' => 'The options of select property is required.',
            'properties.*.items.*.name.required' => 'The name of select property option is required.',
            'properties.*.items.*.description.min' => 'The description of select property option must be at least :min characters.',
            'properties.*.items.*.image.url'=>'The image of select property option must be a valid URL.',
            'properties.*.optionsHasImage.in'=>'The optionsHasImage field is invalid.',
            'properties.*.optionsHasDescription.in'=>'The optionsHasDescription field is invalid.',
        ];
    }
}
