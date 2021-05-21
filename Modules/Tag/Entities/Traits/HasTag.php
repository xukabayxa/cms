<?php

namespace Modules\Tag\Entities\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use Modules\Tag\Entities\Tag;

/**
 * Trait Tag
 * @package Modules\Tag\Entities\Tag
 * @mixin Model
 *
 * Relations
 * @property-read Collection|Tag[] $tags
 */
trait HasTag
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany|Tag[]
     */
    public function tags()
    {
        return $this->morphMany(Tag::class,'tagable');
    }
}
