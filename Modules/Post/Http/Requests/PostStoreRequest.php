<?php

namespace Modules\Post\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PostStoreRequest
 * @package Modules\Vouchers\Http\Requests
 */
class PostStoreRequest extends FormRequest
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
            'title' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'thiếu title'
        ];
    }

}
