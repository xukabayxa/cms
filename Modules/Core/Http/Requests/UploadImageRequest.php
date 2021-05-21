<?php

namespace Modules\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BannerStoreRequest
 * @package Modules\Vouchers\Http\Requests
 */
class UploadImageRequest extends FormRequest
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
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ];
    }

}