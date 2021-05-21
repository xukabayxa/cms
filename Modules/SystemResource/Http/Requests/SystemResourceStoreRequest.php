<?php

namespace Modules\SystemResource\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SystemResourceStoreRequest
 * @package Modules\Vouchers\Http\Requests
 */
class SystemResourceStoreRequest extends FormRequest
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
