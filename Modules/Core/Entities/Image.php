<?php

namespace Modules\Core\Entities;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'name',
        'path',
        'path_thumbnail',
        'imageable_id',
        'imageable_type',
        'status'
    ];

    const TMP_PRODUCTS_FOLDER = 'tmp/products';
    const PRODUCTS_FOLDER = 'products';

    const STATUS_TMP = 0;
    const STATUS_MOVED = 10;

    /**
     * Get the owning imageable model.
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
