<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
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
            'title' => 'required|max:255',
            'altname' => 'required|max:255',
            'description' => 'required',
            'meta_description' => 'required|max:255',
            'prices' => 'required|array',
            'prices.*.size_id' => 'required|exists:products_sizes,id',
            'prices.*.price' => 'required|numeric|min:0',
            'current_tags' => 'array',
            'current_tags.*.id' => 'nullable|exists:tags,id',
            'current_tags.*.title' => 'required_without:current_tags.*.id|distinct',
            'images' => 'array',
            'images.*.id' => 'nullable|exists:images,id',
            'images.*.altname' => 'nullable|exists:images,altname',
            'images.*.path' => 'nullable|exists:images,path',
            'images.*.x1600' => 'nullable|exists:images,x1600',
            'images.*.priority' => 'numeric|min:0',
            'images_to_remove' =>'array',
        ];
    }
}
