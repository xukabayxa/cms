<?php

namespace Modules\Categories\Entities\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Categories\Entities\Category;

/**
 * Trait Categories
 * @package Modules\Areas\Entities\Traits
 * @mixin Model
 *
 * Relations
 */
trait HasCategory
{
    /**
     * @return
     */
    public function categories()
    {

    }

    /**
     * @return Builder[]|Collection|Category[]
     */
    public function getCategoryPost()
    {
        return Category::categoryPost()->get();
    }
}
