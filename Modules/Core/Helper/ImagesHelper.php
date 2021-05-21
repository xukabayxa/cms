<?php
namespace Modules\Core\Helper;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Modules\Core\Entities\Image;

/**
 * Class MenuHelper
 * @package Modules\Platform\MenuManager\Helper
 */
class ImagesHelper
{
    /**
     * Upload base64 image
     *
     * @param $imageBase64
     * @param $folder 'Folder in public'
     * @param string $disk
     * @param bool $thumbnail
     * @return mixed
     */
    public static function uploadImageBase64($imageBase64, $folder, $disk = 'public', $thumbnail = true)
    {
        preg_match("/data:image\/(.*?);/", $imageBase64, $image_extension); // extract the image extension
        $image = preg_replace('/data:image\/(.*?);base64,/', '', $imageBase64); // remove the type part
        $image = str_replace(' ', '+', $image);
        $image = base64_decode($image);

        $base_path = base_path(). DIRECTORY_SEPARATOR. $disk;
        $date_folder = date("Ym");
        $imageName = md5(time()) . '.' . $image_extension[1]; // generating unique file name;

        if ($thumbnail) {
            $dir_original = re_implode(DIRECTORY_SEPARATOR, [$base_path, $folder, 'original', $date_folder]);

        } else {
            $dir_original = re_implode(DIRECTORY_SEPARATOR, [$base_path, $folder, $date_folder]);
        }

        if (!File::exists($dir_original)) {
            File::makeDirectory($dir_original, 0777, true);
        }
        // save image to original path
        $path_original = $dir_original . DIRECTORY_SEPARATOR. $imageName;
        file_put_contents($path_original, $image);

        $rsl = [
            'name' => $imageName,
            'path' => str_replace($base_path, '', $path_original)
        ];

        if ($thumbnail) {
            // resize image and save to thumbnail folder
            $dir_thumbnail = re_implode(DIRECTORY_SEPARATOR, [$base_path, $folder, 'thumbnail', $date_folder]);
            if (!File::exists($dir_thumbnail)) {
                File::makeDirectory($dir_thumbnail, 0777, true);
            }
            $path_thumbnail = $dir_thumbnail . DIRECTORY_SEPARATOR. $imageName;
            $img = \Intervention\Image\Facades\Image::make($path_original)
                ->resize(
                    200,
                    null,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                );
            $img->save($path_thumbnail);

            $rsl['path_thumbnail'] = str_replace($base_path, '', $path_thumbnail);
        }

        return $rsl;
    }

    /**
     * @param $imageFile
     * @param $folder
     * @param string $disk
     * @param bool $thumbnail
     * @return array
     */
    public static function uploadFile($imageFile, $folder, $disk = 'public', $thumbnail = true) {
        $base_path = base_path(). DIRECTORY_SEPARATOR. $disk;
        $date_folder = date("Ym");
        $now = date("YmdHis");
        $imageName = $now . '_' . $imageFile->getClientOriginalName();

        if ($thumbnail) {
//            $dir_original = re_implode(DIRECTORY_SEPARATOR, [$base_path, $folder, 'original', $date_folder]);
            $dir_original = implode(DIRECTORY_SEPARATOR, [$base_path, $folder, 'original', $date_folder]);
        } else {
//            $dir_original = re_implode(DIRECTORY_SEPARATOR, [$base_path, $folder, $date_folder]);
            $dir_original = implode(DIRECTORY_SEPARATOR, [$base_path, $folder, $date_folder]);
        }
        if (!File::exists($dir_original)) {
            File::makeDirectory($dir_original, 0777, true);
        }

        $imageFile->move($dir_original, $imageName);
        $path_original = $dir_original . DIRECTORY_SEPARATOR. $imageName;
        $rsl = [
            'name' => $imageName,
            'path' => str_replace($base_path, '', $path_original),
            'path_thumbnail' => ''
        ];

        if ($thumbnail) {
            // resize image and save to thumbnail folder
//            $dir_thumbnail = re_implode(DIRECTORY_SEPARATOR, [$base_path, $folder, 'thumbnail', $date_folder]);
            $dir_thumbnail = implode(DIRECTORY_SEPARATOR, [$base_path, $folder, 'thumbnail', $date_folder]);
            if (!File::exists($dir_thumbnail)) {
                File::makeDirectory($dir_thumbnail, 0777, true);
            }
            $path_thumbnail = $dir_thumbnail . DIRECTORY_SEPARATOR. $imageName;
            $img = \Intervention\Image\Facades\Image::make($path_original)
                ->resize(
                    200,
                    null,
                    function ($constraint) {
                        $constraint->aspectRatio();
                    }
                );
            $img->save($path_thumbnail);

            $rsl['path_thumbnail'] = str_replace($base_path, '', $path_thumbnail);
        }

        return $rsl;
    }

    /**
     * Save image in database
     *
     * @param $image_data
     * @param $id
     * @param $class
     * @return mixed
     */
    public static function saveImage($image_data, $id = null, $class = null)
    {
        $image_data['imageable_id'] = $id;
        $image_data['imageable_type'] = $class;
        $image = new Image($image_data);
        $image->save();

        return $image;
    }

    public static function moveImages($imageable_id, $image_ids, $search, $replace)
    {
        $images = Image::query()->whereIn('id', $image_ids)->where(['status' => Image::STATUS_TMP])->get();
        foreach ($images as $image) {
            $image->path = self::moveFile($image->name, $image->path, $search, $replace);
            $image->path_thumbnail = self::moveFile($image->name, $image->path_thumbnail, $search, $replace);
            $image->imageable_id = $imageable_id;
            $image->status = Image::STATUS_MOVED;
            $image->save();
        }
    }

    public static function moveFile($name, $path, $search, $replace) {
        $tmp_dir = str_replace($name, '', $path);
        $new_dir = public_path(str_replace($search, $replace, $tmp_dir));
        if (!File::exists($new_dir)) {
            File::makeDirectory($new_dir, 0777, true);
        }
        $new_path = str_replace($search, $replace, $path);

        File::move(public_path($path), public_path($new_path));
        return $new_path;
    }

    public static function deleteImages($ids) {
        Image::query()->whereIn('id', $ids)->delete();
    }
}
