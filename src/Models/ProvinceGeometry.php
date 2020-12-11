<?php

namespace Octopy\Indonesian\Boundaries\Models;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Province;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Octopy\Indonesian\Boundaries\Models\Casts\GeometryCast;

/**
 * @method search(array|mixed|string[] $province)
 */
class ProvinceGeometry extends Model
{
    use SpatialTrait;

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
    protected $spatialFields = [
        'geometry',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'geometry' => GeometryCast::class,
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
    protected $appends = [
        'properties',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'id', 'province_id', 'province', 'created_at', 'updated_at',
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
     * ProvinceGeometry constructor.
     * @param  array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('laravolt.indonesia.table_prefix') . $this->table;
    }

    /**
     * @param  Builder $builder
     * @param  array   $provinces
     * @return Collection
     */
    public function scopeSearch(Builder $builder, array $provinces) : Collection
    {
        return $builder->whereIn('province_id', $provinces)->get();
    }

    /**
     * @return BelongsTo
     */
    public function province() : BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}