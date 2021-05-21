<?php

namespace Modules\Tag\Repositories;

use Modules\Tag\Entities\Tag;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class TagRepository
 * @package Modules\Platform\User\Repositories
 */
class TagRepository extends BaseRepository
{
    public function model()
    {
        return Tag::class;
    }

}
