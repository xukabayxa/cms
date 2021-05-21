<?php

namespace Modules\User\Repositories;

use Modules\User\Entities\User;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepository
 * @package Modules\Platform\User\Repositories
 */
class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

}
