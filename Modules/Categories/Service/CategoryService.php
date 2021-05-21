<?php

namespace Modules\Categories\Service;

use Illuminate\Support\Str;
use Modules\Categories\Entities\Category;
use Modules\Categories\Repositories\CategoryRepository;
use Modules\Core\Helper\ImagesHelper;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param $data
     * @param null $file
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function create($data, $file = null)
    {
        $names = explode(',', $data['name']);

        foreach ($names as $name) {
            $data['name'] = trim($name);
            $data['alias'] = Str::slug($data['name']);
            $category = $this->categoryRepository->create($data);
        }

        if (count($names) == 1) {
            if (!is_null($file)) {
                $image_data = ImagesHelper::uploadFile($file, 'categories');
                ImagesHelper::saveImage($image_data, $category->id, Category::class);
            }
        }

    }

    /**
     * @param Category $category
     * @param $data
     * @param null|UploadedFile $file
     * @return Category
     */
    public function update($category, $data, $file = null)
    {
        $data['alias'] = Str::slug($data['name']);

        if (!is_null($file)) {

            if ($category->image) {
                $category->image->delete();
            }

            $image_data = ImagesHelper::uploadFile($file, 'categories');
            ImagesHelper::saveImage($image_data, $category->id, Category::class);
        }

        $category = $this->categoryRepository->update($data, $category->id);

        return $category;
    }
}
