<?php

namespace Modules\SystemResource\Entities\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use Modules\SystemResource\Entities\SystemResource;

/**
 * Trait SystemResource
 * @package Modules\SystemResource\Entities\SystemResource
 * @mixin Model
 *
 * Relations
 */
trait HasSystemResource
{
    /**
     * @return
     */
    public function systemresource()
    {

    }
}
