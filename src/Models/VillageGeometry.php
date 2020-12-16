<?php

namespace Octopy\Indonesian\Boundaries\Models;


use Laravolt\Indonesia\Models\Village;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed village
 * @property mixed village_id
 */
class VillageGeometry extends Model
{
    /**
     * @var string
     */
    protected $table = 'village_geometries';

    /**
     * @return array
     */
    public function getPropertiesAttribute() : array
    {
        return [
            'code' => $this->village_id,
            'name' => $this->village->name,
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

        return Village::where('id', $code)->count() !== 0;
    }

    /**
     * @param  Builder $builder
     * @param  array   $search
     * @return Collection
     */
    public function scopeSearch(Builder $builder, array $search) : Collection
    {
        return $builder->whereIn('village_id', $search)->get();
    }

    /**
     * @return BelongsTo
     */
    public function village() : BelongsTo
    {
        return $this->belongsTo(Village::class, 'village_id');
    }
}
