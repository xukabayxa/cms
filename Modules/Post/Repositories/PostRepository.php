<?php

namespace Modules\Post\Repositories;

use Modules\Post\Entities\Post;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PostRepository
 * @package Modules\Platform\User\Repositories
 */
class PostRepository extends BaseRepository
{
    public function model()
    {
        return Post::class;
    }

}
