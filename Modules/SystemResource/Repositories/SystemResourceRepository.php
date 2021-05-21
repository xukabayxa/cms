<?php

namespace Modules\SystemResource\Repositories;

use Modules\SystemResource\Entities\SystemResource;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class SystemResourceRepository
 * @package Modules\Platform\User\Repositories
 */
class SystemResourceRepository extends BaseRepository
{
    public function model()
    {
        return SystemResource::class;
    }

}
