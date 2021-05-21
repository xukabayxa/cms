<?php

namespace Modules\Post\Services;

use Modules\Post\Entities\Post;
use Modules\Post\Repositories\PostRepository;

/**
 * Class PostRepository
 * @package Modules\Platform\User\Repositories
 */
class PostService
{
    protected $repository;

    public function __construct(PostRepository $repository)
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
     * @param Post $entity
     * @param array $data
     */
    public function update($entity, $data)
    {

    }

}
