<?php

namespace Octopy\Indonesian\Boundaries\Models;


use Laravolt\Indonesia\Models\District;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed district
 * @property mixed district_id
 */
class DistrictGeometry extends Model
{
    /**
     * @var string
     */
    protected $table = 'district_geometries';

    /**
     * @return array
     */
    public function getPropertiesAttribute() : array
    {
        return [
            'code' => $this->district_id,
            'name' => $this->district->name,
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

        return District::where('id', $code)->count() !== 0;
    }

    /**
     * @param  Builder $builder
     * @param  array   $search
     * @return Collection
     */
    public function scopeSearch(Builder $builder, array $search) : Collection
    {
        return $builder->whereIn('district_id', $search)->get();
    }

    /**
     * @return BelongsTo
     */
    public function district() : BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
