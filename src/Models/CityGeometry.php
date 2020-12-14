<?php

namespace Octopy\Indonesian\Boundaries\Models;

use Illuminate\Support\Collection;
use Laravolt\Indonesia\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Octopy\Indonesian\Boundaries\Models\Casts\GeometryCast;

/**
 * @method get()
 * @method search(array|mixed|string[] $city)
 * @property mixed city
 * @property mixed city_id
 */
class CityGeometry extends Model
{
    use SpatialTrait;

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
        'city',
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
        'id', 'city_id', 'city', 'created_at', 'updated_at',
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
     * CityGeometry constructor.
     * @param  array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('laravolt.indonesia.table_prefix') . $this->table;
    }

    /**
     * @param  Builder $builder
     * @param  array   $cities
     * @return Collection
     */
    public function scopeSearch(Builder $builder, array $cities) : Collection
    {
        return $builder->whereIn('city_id', $cities)->get();
    }

    /**
     * @return BelongsTo
     */
    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}