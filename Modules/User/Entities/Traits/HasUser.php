<?php

namespace Modules\User\Entities\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use Modules\User\Entities\User;

/**
 * Trait User
 * @package Modules\User\Entities\User
 * @mixin Model
 *
 * Relations
 */
trait HasUser
{
    /**
     * @return
     */
    public function user()
    {

    }
}
