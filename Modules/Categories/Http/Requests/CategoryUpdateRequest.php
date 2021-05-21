<?php

namespace Modules\Categories\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CategoryUpdateRequest
 * @package Modules\Vouchers\Http\Requests
 */
class CategoryUpdateRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'thumbnail' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'parent_id' => 'nullable|exists:categories,id'
        ];
    }

}