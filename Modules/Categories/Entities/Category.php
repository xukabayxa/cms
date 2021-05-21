<?php

namespace Modules\Categories\Entities;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Entities\Image;
use Modules\Core\Entities\Traits\HasThumbnail;

/**
 * Class Category
 * @package Modules\Categories\Entities
 *
 * @property int $id
 * Relations
 *
 * @method Builder|self categoryPost
 */
class Category extends Model
{
    use SoftDeletes, HasThumbnail;

    const TYPE_COMMON = 10;
    const TYPE_PRODUCT = 20;
    const TYPE_POST = 30;
    const TYPE_SPECIAL = 40;
    const TYPE_FAQ = 50;

    const LIST_TYPE = [
        10 => 'Chung',
        20 => 'Sản phẩm',
        30 => 'Bài viết',
        40 => 'Đặc biệt',
        50 => 'Câu hỏi thường gặp'
    ];

    const LIST_TYPE_NOTE = [
        10 => 'Dùng chung cho sản phẩm và bài viết',
        20 => 'Chỉ dùng cho sản phẩm',
        30 => 'Chỉ dùng cho bài viết',
        40 => 'Sản phẩm trong những danh mục này sẽ được hiển thị ngoài trang chủ',
        50 => 'Chỉ dùng cho câu hỏi thường gặp'
    ];

    const DISPLAY_AT_HOME = 10;
    const DISPLAY_AT_BANNER = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'alias', 'thumbnail', 'description', 'parent_id', 'status', 'type',
        'product_type_id', 'display_at'];


    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * @param Builder|self $query
     * @return Builder
     */
    public function scopeCategoryPost($query)
    {
        return $query->where('type', self::TYPE_POST);
    }
}
