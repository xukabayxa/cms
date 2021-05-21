<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserStoreRequest
 * @package Modules\Vouchers\Http\Requests
 */
class UserStoreRequest extends FormRequest
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
