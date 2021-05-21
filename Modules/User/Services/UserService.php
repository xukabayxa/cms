<?php

namespace Modules\User\Services;

use Modules\User\Entities\User;
use Modules\User\Repositories\UserRepository;

/**
 * Class UserRepository
 * @package Modules\Platform\User\Repositories
 */
class UserService
{
    protected $repository;

    public function __construct(UserRepository $repository)
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
     * @param User $entity
     * @param array $data
     */
    public function update($entity, $data)
    {

    }

}
