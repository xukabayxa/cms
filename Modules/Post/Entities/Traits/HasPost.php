<?php

namespace Modules\Post\Entities\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use Modules\Post\Entities\Post;

/**
 * Trait Post
 * @package Modules\Post\Entities\Post
 * @mixin Model
 *
 * Relations
 */
trait HasPost
{
    /**
     * @return
     */
    public function post()
    {

    }
}
