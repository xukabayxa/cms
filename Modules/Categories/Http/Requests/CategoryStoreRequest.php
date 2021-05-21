<?php

namespace Modules\Categories\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CategoryStoreRequest
 * @package Modules\Vouchers\Http\Requests
 */
class CategoryStoreRequest extends FormRequest
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