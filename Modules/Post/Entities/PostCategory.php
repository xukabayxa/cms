<?php

namespace Modules\Post\Entities;
use Illuminate\Database\Eloquent\Model;
use Modules\Tag\Entities\Traits\HasTag;

/**
 * Class Post
 * @package Modules\Post\Entities
 *
 * @property int $id
 * @property int $post_id
 * @property int $category_id
 *
 */
class PostCategory extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'post_id', 'category_id'];

}
