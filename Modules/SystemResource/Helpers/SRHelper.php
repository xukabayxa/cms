<?php
namespace Modules\SystemResource\Helpers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Modules\SystemResource\Entities\SystemResource;

class SRHelper {
    /**
     * @param $imageFile
     * @param $folder
     * @param string $disk
     * @param bool $thumbnail
     * @return array
     */
    public static function uploadFile($imageFile, $folder, $disk = 'public') {
        $base_path = base_path(). DIRECTORY_SEPARATOR. $disk;
        $now = date("YmdHis");
        $imageName = $now . '_' . $imageFile->getClientOriginalName();

        $dir_original = implode(DIRECTORY_SEPARATOR, [$base_path, $folder]);


        if (!File::exists($dir_original)) {
            File::makeDirectory($dir_original, 0777, true);
        }

        $imageFile->move($dir_original, $imageName);

        $path_original = $dir_original . DIRECTORY_SEPARATOR. $imageName;

        $rsl = [
            'name' => $imageName,
            'path' => str_replace($base_path, '', $path_original),
        ];
        return $rsl;
    }

    public static function saveImage($image_data)
    {
        $image_data['created_by_id'] = 1;
        $image = new SystemResource($image_data);
        $image->save();

        return $image;
    }
}
