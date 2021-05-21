<?php

namespace Modules\SystemResource\Services;

use Modules\SystemResource\Entities\SystemResource;
use Modules\SystemResource\Repositories\SystemResourceRepository;

/**
 * Class SystemResourceRepository
 * @package Modules\Platform\User\Repositories
 */
class SystemResourceService
{
    protected $repository;

    public function __construct(SystemResourceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $data
     */
    public function create($data)
    {

    }

    /**
     * @param SystemResource $entity
     * @param array $data
     */
    public function update($entity, $data)
    {

    }

}
