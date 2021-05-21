<?php

namespace Modules\Post\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Categories\Entities\Category;
use Modules\Categories\Entities\Traits\HasCategory;
use Modules\Tag\Entities\Traits\HasTag;
use Nwidart\Modules\Collection;

/**
 * Class Post
 * @package Modules\Post\Entities
 *
 * @property int $id
 * @property string $title
 * @property string $short_content
 * @property string $content
 * @property string $slug
 * @property string $created_by_id
 *
 * Relations
 * @property-read Collection|Category[] $categories
 */
class Post extends Model
{
    use HasTag, HasCategory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'title', 'short_content', 'content', 'created_by_id', 'slug', 'type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Category[]
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id')->withTimestamps();
    }
}
