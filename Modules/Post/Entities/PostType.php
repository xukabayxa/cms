<?php

namespace Modules\Post\Entities;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PostType
 * @package Modules\Post\Entities
 *
 * @property int $id
 * @property string $name
 *
 */
class PostType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name'];

}
