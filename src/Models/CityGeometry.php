<?php

namespace Octopy\Indonesian\Boundaries\Models;

use Laravolt\Indonesia\Models\city;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;

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
     * cityGeometry constructor.
     * @param  array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('laravolt.indonesia.table_prefix') . $this->table;
    }

    /**
     * @return BelongsTo
     */
    public function city() : BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}