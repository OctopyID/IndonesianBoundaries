<?php

namespace Octopy\Indonesian\Boundaries\Models;

use Laravolt\Indonesia\Models\Province;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed province
 * @property mixed province_id
 */
class ProvinceGeometry extends Model
{
    /**
     * @var string
     */
    protected $table = 'province_geometries';

    /**
     * @var string[]
     */
    protected $fillable = [
        'province_id', 'geometry',
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'province',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'id', 'province_id', 'province',
    ];

    /**
     * @return array
     */
    public function getPropertiesAttribute() : array
    {
        return [
            'code' => $this->province_id,
            'name' => $this->province->name,
        ];
    }

    /**
     * @param  int|null $code
     * @return bool
     */
    public function valid(?int $code) : bool
    {
        if (is_null($code)) {
            return false;
        }

        return Province::whereId($code)->count() !== 0;
    }

    /**
     * @param  Builder $builder
     * @param  array   $search
     * @return Collection
     */
    public function scopeSearch(Builder $builder, array $search) : Collection
    {
        return $builder->whereIn('province_id', $search)->get();
    }

    /**
     * @return BelongsTo
     */
    public function province() : BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}