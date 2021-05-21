<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Modules\Core\Helper\ImagesHelper;
use Modules\Core\Http\Requests\UploadImageRequest;

class ImagesController extends CmsBaseController
{
    /**
     * @param UploadImageRequest $request
     * @return JsonResponse
     */
    public function uploadImage(UploadImageRequest $request) {
        $image_data = ImagesHelper::uploadFile($request->image, 'uploads/images', 'public',false);
        $path = $image_data['path'];
        $url = config('app.url') . $path;
        return response()->json(['url' => $url]);
    }
}
