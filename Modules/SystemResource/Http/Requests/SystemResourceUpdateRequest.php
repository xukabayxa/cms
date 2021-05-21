<?php

namespace Modules\SystemResource\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SystemResourceUpdateRequest
 * @package Modules\Vouchers\Http\Requests
 */
class SystemResourceUpdateRequest extends FormRequest
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
