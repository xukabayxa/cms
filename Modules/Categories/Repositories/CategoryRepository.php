<?php

namespace Modules\Categories\Repositories;

use Modules\Categories\Entities\Category;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CategoryRepository
 * @package Modules\Platform\User\Repositories
 */
class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return Category::class;
    }

    public function getCategoriesTree() {
        $categories = Category::query()
            ->whereIn('type', [Category::TYPE_COMMON, Category::TYPE_PRODUCT])
            ->whereNull('parent_id')
            ->get();
        return $this->getCategoryChildren($categories);
    }

    function getCategoryChildren($children)
    {
        $rsp = [];
        foreach ($children as $child) {
            $item = [
                'id' => $child->id,
                'name' => $child->name,
                'product_type_id' => $child->product_type_id
            ];
            if (count($child->children)) {
                $item['children'] = $this->getCategoryChildren($child->children);
            }
            $rsp[] = $item;
        }
        return $rsp;
    }
}
