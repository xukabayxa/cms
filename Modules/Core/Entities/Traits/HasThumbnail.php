<?php

namespace Modules\Core\Entities\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Categories\Entities\Category;
use Modules\Core\Entities\Image;

/**
 * Trait Categories
 * @package Modules\Areas\Entities\Traits
 * @mixin Model
 *
 * Relations
 * @property-read Image $image
 */
trait HasThumbnail
{
    /**
     * @return MorphOne|Image
     */
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
