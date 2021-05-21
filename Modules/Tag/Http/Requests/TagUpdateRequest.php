<?php

namespace Modules\Tag\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TagUpdateRequest
 * @package Modules\Vouchers\Http\Requests
 */
class TagUpdateRequest extends FormRequest
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
        return [];
    }

}
