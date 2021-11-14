<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'item_name' => 'required|string|max:100',
            'unit_price' => 'required|integer',
            'item_category' => 'required',
            'item_image' => 'file|image|mimes:png,jpeg',
        ];
    }
}
