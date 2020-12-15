<?php

namespace Octopy\Indonesian\Boundaries\Models;

use Illuminate\Support\Collection;
use Laravolt\Indonesia\Models\City;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed city
 * @property mixed city_id
 */
class CityGeometry extends Model
{
    /**
     * @var string
     */
    protected $table = 'city_geometries';

    /**
     * @var string[]
     */
    protected $fillable = [
        'city_id', 'geometry',
    ];

    /**
     * @var string[]
     */
    protected $with = [
        'city',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'id', 'city_id', 'city',
    ];

    /**
     * @return array
     */
    public function getPropertiesAttribute() : array
    {
        return [
            'code' => $this->city_id,
            'name' => $this->city->name,
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

        return City::where('id', $code)->count() !== 0;
    }

    /**
     * @param  Builder $builder
     * @param  array   $search
     * @return Collection
     */
    public function scopeSearch(Builder $builder, array $search) : Collection
    {
        return $builder->whereIn('city_id', $search)->get();
    }

    /**
     * @return BelongsTo
     */
    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}