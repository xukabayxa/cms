<?php

namespace Modules\SystemResource\Entities;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SystemResource
 * @package Modules\SystemResource\Entities
 *
 * @property int $id
 * @property string $name
 * @property string $patch
 * @property int $created_by_id
 */
class SystemResource extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name' ,'path', 'created_by_id'];

    protected $table = 'system_resources';
}
