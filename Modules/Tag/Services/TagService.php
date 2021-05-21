<?php

namespace Modules\Tag\Services;

use Modules\Tag\Entities\Tag;
use Modules\Tag\Repositories\TagRepository;

/**
 * Class TagRepository
 * @package Modules\Platform\User\Repositories
 */
class TagService
{
    protected $repository;

    public function __construct(TagRepository $repository)
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
     * @param Tag $entity
     * @param array $data
     */
    public function update($entity, $data)
    {

    }

}
